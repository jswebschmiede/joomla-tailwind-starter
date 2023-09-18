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

const { src, dest, watch, series, parallel } = pkg;

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
      ignored: "./assets/css/styles.min.css",
    },
    series(parallel(devStyles), previewReload),
  );
};

// Dev Task
export const dev = series(
  parallel(devStyles),
  livePreview, // Live Preview Build
  watchFiles, // Watch for Live Changes
);

// Default task
export default dev;
