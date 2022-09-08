document.addEventListener("DOMContentLoaded", function (e) {
    const imageModalEl = document.getElementById('imageModal')
    const imageModal = new bootstrap.Modal(imageModalEl);
    const modalTrigger = document.querySelectorAll(".image-modal-trigger");
    for (const trigger of modalTrigger) {
        trigger.addEventListener('click', function (e) {
            imageModalEl.querySelector("img").setAttribute("src", trigger.getAttribute("src"))
            imageModal.show();
        });
    }
});
const galleryCarousel = document.getElementById("galleryCarousel");
const galleryCarouselIndicators = galleryCarousel.querySelectorAll(
    ".gallery-carousel-indicators button span"
);
let gIntervalID;

const gCarousel = new bootstrap.Carousel(galleryCarousel);

window.addEventListener("load", function () {
    fillGalleryCarouselIndicator(1);
});

galleryCarousel.addEventListener("slide.bs.carousel", function (e) {
    let index = e.to;
    fillGalleryCarouselIndicator(++index);
});

function fillGalleryCarouselIndicator(index) {
    let i = 0;
    for (const carouselIndicator of galleryCarouselIndicators) {
        carouselIndicator.style.width = 0;
    }
    clearInterval(gIntervalID);
    gCarousel.pause();

    gIntervalID = setInterval(function () {
        i++;

        galleryCarousel.querySelector(".gallery-carousel-indicators .active span").style.width = i +
            "%";

        if (i >= 100) {
            // i = 0; -> just in case
            if(galleryCarouselIndicators.length > 1){
                gCarousel.next();
            } else{
                clearInterval(gIntervalID);
            }
        }
    }, 50);
}