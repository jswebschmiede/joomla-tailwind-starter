import pkg from "gulp";
import tailwindcss from "tailwindcss";
import autoprefixer from "autoprefixer";
import browserSync from "browser-sync";
import logSymbols from "log-symbols";
import rename from "gulp-rename";
import postcss from "gulp-postcss";
import cleanCSS from "gulp-clean-css";
import postcssImport from "postcss-import";
import postcssImportGlob from "postcss-import-ext-glob";
import { rollup } from "rollup";
import babel from "@rollup/plugin-babel";
import commonjs from "@rollup/plugin-commonjs";
import nodeResolve from "@rollup/plugin-node-resolve";
import terser from "@rollup/plugin-terser";

const { src, dest, watch, series, parallel } = pkg;

// Cache for Rollup
let cache;

// Local Dev URL
const dev_url = "http://jdev4/";

//Load Previews on Browser on dev
const livePreview = (done) => {
  console.log("\n\t" + logSymbols.info, "BrowserSync loaded.\n");
  browserSync.init({
    proxy: dev_url,
    notify: false,
  });
  done();
};

// Triggers Browser reload
const previewReload = (done) => {
  console.log("\n\t" + logSymbols.info, "Reloading Browser Preview.\n");
  browserSync.reload({ stream: true, notify: false });
  done();
};

// PostCSS Styles
const devStyles = () => {
  return src(["./assets/css/styles.css"])
    .pipe(
      postcss([
        postcssImportGlob(),
        postcssImport(),
        tailwindcss(),
        autoprefixer(),
      ]),
    )
    .pipe(
      cleanCSS({ debug: true }, (details) => {
        console.log(
          "\n\t" + logSymbols.info,
          `${details.name}: ${details.stats.originalSize}`,
        );
        console.log(
          "\t" + logSymbols.info,
          `${details.name}: ${details.stats.minifiedSize}\n`,
        );
      }),
    )
    .pipe(rename({ suffix: ".min" }))
    .pipe(dest("./assets/css/"))
    .pipe(
      browserSync.reload({
        stream: true,
        notify: false,
      }),
    );
};

// Rollup Scripts
const devScripts = async () => {
  const bundle = await rollup({
    input: "./assets/js/main.js",
    plugins: [nodeResolve(), commonjs(), babel({ babelHelpers: "bundled" })],
  });
  cache = bundle.cache;

  return await bundle.write({
    file: "./assets/js/main.bundle.js",
    format: "iife",
    name: "mainBundle",
    sourcemap: true,
    plugins: [terser()],
  });
};

// Watch for Changes
const watchFiles = () => {
  console.log("\n\t" + logSymbols.info, "Watching files.\n");
  watch(
    [
      "./assets/css/**/*.css",
      "./assets/js/**/*.js",
      "./**/*.php",
      "../../modules/**/*.php",
    ],
    {
      interval: 1000,
      usePolling: true,
      ignored: ["./assets/css/styles.min.css", "./assets/js/main.bundle.js"],
    },
    series(parallel(devStyles, devScripts), previewReload),
  );
};

// Dev Task
export const dev = series(
  parallel(devStyles, devScripts),
  livePreview, // Live Preview Build
  watchFiles, // Watch for Live Changes
);

// Default task
export default dev;
