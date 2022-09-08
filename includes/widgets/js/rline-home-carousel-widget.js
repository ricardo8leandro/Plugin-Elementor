const homeCarousel = document.getElementById("homeCarousel");
const homeCarouselIndicators = homeCarousel.querySelectorAll(
    ".home-carousel-indicators button span"
);
let hIntervalID;

const hCarousel = new bootstrap.Carousel(homeCarousel);

window.addEventListener("load", function () {
    fillHomeCarouselIndicator(1);
});

homeCarousel.addEventListener("slide.bs.carousel", function (e) {
    let index = e.to;
    fillHomeCarouselIndicator(++index);
});

function fillHomeCarouselIndicator(index) {
    let i = 0;
    for (const carouselIndicator of homeCarouselIndicators) {
        carouselIndicator.style.width = 0;
    }
    clearInterval(hIntervalID);
    hCarousel.pause();

    hIntervalID = setInterval(function () {
        i++;

        homeCarousel.querySelector(".home-carousel-indicators .active span").style.width =
            i + "%";

        if (i >= 100) {
            // i = 0; -> just in case
            if(homeCarouselIndicators.length > 1){
                hCarousel.next();
            } else{
                clearInterval(hIntervalID);
            }
        }
    }, 50);
}