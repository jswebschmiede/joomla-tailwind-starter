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
const server = browserSync.create();
const dev_url = "http://jdev4/";
let cache;

const paths = {
  css: {
    src: "./assets/css/tailwind.css",
    dest: "./assets/css/",
    watch: "./assets/css/**/*.css",
  },
  js: {
    src: "./assets/js/main.js",
    dest: "./assets/js/",
  },
};

//Load Previews on Browser on dev
const livePreview = (done) => {
  server.init({
    proxy: dev_url,
    notify: false,
  });
  done();
};

// Triggers Browser reload
const previewReload = (done) => {
  console.log("\n\t" + logSymbols.info, "Reloading Browser Preview.\n");
  server.reload();
  done();
};

// PostCSS Styles
const devStyles = () => {
  return src([paths.css.src])
    .pipe(
      postcss([
        postcssImportGlob(),
        postcssImport(),
        tailwindcss(),
        autoprefixer(),
      ]),
    )
    .pipe(cleanCSS())
    .pipe(rename("styles.min.css"))
    .pipe(dest(paths.css.dest))
    .pipe(server.stream());
};

// Rollup Scripts
const devScripts = async () => {
  const bundle = await rollup({
    input: "./assets/js/main.js",
    plugins: [nodeResolve(), commonjs(), babel({ babelHelpers: "bundled" })],
    cache: cache,
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
    [paths.css.watch, paths.js.src],
    {
      interval: 1000,
      usePolling: true,
      ignored: [
        paths.css.dest + "styles.min.css",
        paths.js.dest + "main.bundle.js",
      ],
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
