$(document).ready(function () {

    initPage();

    function initPage() {

        if ($(window).width() < 768) {
            $("#collapsibleNavbar").removeClass("d-flex");
        } else {
            $("#collapsibleNavbar").addClass("d-flex");
        }

        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            topDistance: '300', // Distance from top before showing element (px)
            topSpeed: 600, // Speed back to top (ms)
            animation: 'fade', // Fade, slide, none
            animationInSpeed: 200, // Animation in speed (ms)
            animationOutSpeed: 200, // Animation out speed (ms)
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
        });
    }

    var sticky = $("#navbar").offset().top;

    $(window).scroll(function () {

        if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    });

    $(window).on('resize', function () {
        if ($(window).width() < 768) {
            $("#collapsibleNavbar").removeClass("d-flex");
        } else {
            $("#collapsibleNavbar").addClass("d-flex");
        }
    });


});

