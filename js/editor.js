"use strict"


let image = document.getElementById("image");
let filterControls = document.querySelectorAll('input[type=range]');

/**
 * Apply Adjustment
 */
function applyFilter() {

    let computedFilters = "";
    filterControls.forEach(function (item, index) {
        computedFilters += item.getAttribute('data-filter') + '(' + item.value + item.getAttribute('data-scale') + ') ';
    });

    image.style.filter = computedFilters;

    image.setAttribute("style","filter: "+computedFilters);

}

/**
 *  Filter Effect
 */
function applyOriginal(){
    let image = document.getElementById("image");
    image.style.filter = "";
}
function applyGrayscale(){
    let image = document.getElementById("image");
    image.style.filter = "grayscale(1)";
}
function applySepia(){
    let image = document.getElementById("image");
    image.style.filter = "sepia(100%)";
}
function applyInvert(){
    let image = document.getElementById("image");
    image.style.filter = "invert(100%)";
}

/**
 *  Save Image
 */
function saveImage(){
    let image  = document.getElementById("image");
    let canvas = document.createElement("canvas");
    canvas.width  = image.width;
    canvas.height = image.height;

    let context = canvas.getContext("2d");
    context.drawImage(image, 0, 0);

    var img = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");  // here is the most important part because if you dont replace you will get a DOM 18 exception.


    window.location.href=img;

}

function Rotate(deg) {
    let element = document.getElementById('image');

    switch (deg) {

        case 0:
            element.className = "rotate-" + deg;
            console.log(deg)
            console.log(element.className)
            break;
        case 30:
            element.className = "rotate-" + deg;
            console.log(deg)
            console.log(element.className)
            break;
        case 60:
            element.className = "rotate-" + deg;
            console.log(deg)
            console.log(element.className)
            break;
        case 90:
            element.className = "rotate-" + deg;
            console.log(deg)
            console.log(element.className)
            break;
        case 180:
            element.className = "rotate-" + deg;
            console.log(deg)
            console.log(element.className)
            break;
        default:
            element.className = "rotate-" + deg;
            console.log(element.className)
            console.log(0)

    }


}

const imageURL = image.src;

// crop the source image at various aspect ratios

function makeCrop(aspectRatio){
    crop(imageURL, aspectRatio).then(canvas => {
        editor.appendChild(canvas);
    });
}

/**
 * @url - Source of the image to use
 * @aspectRatio - The aspect ratio to apply
 */
function crop(url, aspectRatio) {

    return new Promise(resolve => {

        // this image will hold our source image data
        const inputImage = new Image();

        // we want to wait for our image to load
        inputImage.onload = () => {

            // let's store the width and height of our image
            const inputWidth = inputImage.naturalWidth;
            const inputHeight = inputImage.naturalHeight;

            // get the aspect ratio of the input image
            const inputImageAspectRatio = inputWidth / inputHeight;

            // if it's bigger than our target aspect ratio
            let outputWidth = inputWidth;
            let outputHeight = inputHeight;
            if (inputImageAspectRatio > aspectRatio) {
                outputWidth = inputHeight * aspectRatio;
            } else if (inputImageAspectRatio < aspectRatio) {
                outputHeight = inputWidth / aspectRatio;
            }

            // calculate the position to draw the image at
            const outputX = (outputWidth - inputWidth) * .5;
            const outputY = (outputHeight - inputHeight) * .5;

            // create a canvas that will present the output image
            const outputImage = document.createElement('canvas');

            // set it to the same size as the image
            outputImage.width = outputWidth;
            outputImage.height = outputHeight;

            // draw our image at position 0, 0 on the canvas
            const ctx = outputImage.getContext('2d');
            ctx.drawImage(inputImage, outputX, outputY);
            resolve(outputImage);
        };

        // start loading our image
        inputImage.src = url;
    });

};