import gulp from 'gulp';
const { src, dest, series } = gulp;
import imagemin from 'gulp-imagemin';
import webp from 'gulp-webp';
// import avif from 'gulp-avif';

// *Tarea para minificar imágenes
export function imagenes() {
    return src('resources/images/**/*')
        .pipe(imagemin())
        .pipe(dest('public/storage/images'));
}

// *Tarea para convertir imágenes a formato WebP
export function versionWebp() {
    return src('resources/images/**/*.{png,jpg,jpeg}')
        .pipe(webp())
        .pipe(dest('public/storage/images'));
}

// *Tarea para convertir imágenes a formato AVIF
// export function versionAvif() {
//     return src('resources/images/**/*.{png,jpg,jpeg}')
//         .pipe(avif())
//         .pipe(dest('public/storage/images'));
// }

// Tarea predeterminada que ejecuta todas las tareas en serie
export default series(imagenes, versionWebp);
