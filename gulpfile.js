const { src, dest, watch, parallel } = require("gulp");

// CSS
const sass = require("gulp-sass")(require("sass"));
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");

// Images
const cache = require("gulp-cache");
const imagemin = require("gulp-imagemin");
const webp = require("gulp-webp");
const avif = require("gulp-avif");

// JS
const terser = require("gulp-terser-js");
const concat = require("gulp-concat");
const rename = require("gulp-rename");

//Webpack
const webpack = require("webpack-stream");

const paths = {
  scss: "sources/scss/**/*.scss",
  js: "sources/js/**/*.js",
  images: "sources/images/**/*",
};

function css() {
  return (
    src(paths.scss)
      .pipe(sourcemaps.init())
      .pipe(sass())
      //.pipe( sass({outputStyle: 'expanded'}))
      .pipe(postcss([autoprefixer(), cssnano()]))
      .pipe(sourcemaps.write("."))
      .pipe(dest("public/build/css"))
  );
}

function javascript() {
  return (
    src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(
        webpack({
          module: {
            rules: [
              {
                test: /\.css$/i,
                use: ["style-loader", "css-loader"],
              },
            ],
          },
          mode: "production",
          entry: "./sources/js/main.js",
          watch: true,
        })
      )
      //.pipe(concat("bundle.js"))
      .pipe(terser())
      .pipe(sourcemaps.write("."))
      //.pipe(rename({ suffix: ".min" }))
      .pipe(dest("./public/build/js"))
  );
}

function images() {
  return src(paths.images)
    .pipe(
      cache(
        imagemin({
          optimizationLevel: 3,
        })
      )
    )
    .pipe(dest("public/build/images"));
}

function imagesWebp() {
  return src(paths.images)
    .pipe(
      webp({
        quality: 50,
      })
    )
    .pipe(dest("public/build/images"));
}

function imagesAvif() {
  return src(paths.images)
    .pipe(
      avif({
        quality: 50,
      })
    )
    .pipe(dest("public/build/images"));
}

function dev(done) {
  watch(paths.scss, css);
  watch(paths.js, javascript);
  watch(paths.images, images);
  watch(paths.images, imagesWebp);
  watch(paths.images, imagesAvif);
  done();
}

exports.default = parallel(
  css,
  javascript,
  images,
  imagesWebp,
  imagesAvif,
  dev
);
