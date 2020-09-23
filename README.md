# Web Scrapper

## Details
This is Image Scrapping PHP command line app build using [Laravel Zero](https://github.com/laravel-zero/laravel-zero) and [spekulatius/phpscraper](https://github.com/spekulatius/phpscraper) Laravel package.

## Usage

- Download build file __image-scrapper__ from releases
- Run __`php image-scrapper scrap [images-url]`__ will show list of images.
- Run __`php image-scrapper scrap [images-url] -D`__ will download all images into the scrapper dir in the current direcotory.

### Example

__`php image-scrapper scrap https://www.w3schools.com/css/css_image_gallery.asp -D`__ will download all images into __./scrapper/httpswwww3schoolscomcsscss-image-galleryasp[random-string]/__