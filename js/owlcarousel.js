jQuery(document).ready(function ($) {
    $(".owl-carousel").owlCarousel({
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            1140: {
                items: 3
            }
        }
    });
});