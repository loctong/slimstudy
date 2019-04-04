$(document).ready(function () {

    initPage();

    function initPage() {
        fixHeaderLogic();
        srollUpLogic();
        menuLogic();
        // sliderLogic();
    }

    function fixHeaderLogic() {

        if ($(window).width() < 768) {
            $("#collapsibleNavbar").removeClass("d-flex");
        } else {
            $("#collapsibleNavbar").addClass("d-flex");
        }

    }

    function srollUpLogic() {
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

        var sticky = $("#navbar").offset().top;

        $(window).scroll(function () {

            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        });
    }

    function menuLogic() {
        $(window).on('resize', function () {
            if ($(window).width() < 768) {
                $("#collapsibleNavbar").removeClass("d-flex");
            } else {
                $("#collapsibleNavbar").addClass("d-flex");
            }
        });
    }

    function sliderLogic() {
        // Slide Logic start
        var jssor_1_options = {
            $AutoPlay: 0,
            $AutoPlaySteps: 1,
            $SlideDuration: 1,
            $SlideWidth: 200,
            $SlideSpacing: 5,
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 5
            },
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
            }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        /*#region responsive code begin*/

        var MAX_WIDTH = 1024;

        function ScaleSlider() {
            var containerElement = jssor_1_slider.$Elmt.parentNode;
            var containerWidth = containerElement.clientWidth;

            if (containerWidth) {

                var expectedWidth = Math.max(MAX_WIDTH || containerWidth, containerWidth);

                jssor_1_slider.$ScaleWidth(expectedWidth);
            } else {
                window.setTimeout(ScaleSlider, 30);
            }
        }

        ScaleSlider();

        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        /*#endregion responsive code end*/

        // Slide Logic end
    }
});

