$(document).ready(function () {

    $('.bar ').click(function () {
        $('.display-block-btn').show()
        $('body').css('overflow', 'hidden')
        $('.navbar-sm').css({
            left: '0'
        })

    });
    $('.display-block-btn').click(function () {
        $(this).hide();
        $('.navbar-sm').css({
            left: '-310px'
        })
        $('body').css('overflow', 'auto')
    })
    $("#header-section").load("header.html");

    $(".slideshow-area .fa-bars").click(function () {
        $(".slideshow-wrapper").toggleClass("show")
    })



    const fileSelect = document.querySelector('.file-select-from-device');
    inputFile = document.querySelector('.file-select-from-device input');
    fileSelect.addEventListener("click", () => {
        inputFile.click()
    })

    // carousel for theme area
    $(".owl-carousel").owlCarousel({
        items: 5,
        loop: false,
        nav: true,
        mouseDrag: true,
        touchDrag: true,
        center: false,
        smartSpeed: 600,
        responsive: {
            0: {
                items: 1,
                stagePadding: 30

            },
            300: {
                items: 2,
                stagePadding: 0

            },
            480: {
                items: 3
            },
            640: {
                items: 4
            },
            768: {
                items: 4,
                stagePadding: 30,
                nav: false
            },
            992: {
                items: 3,
                stagePadding: 30,
                nav: true
            },
            1100: {
                items: 4
            },
            1300: {
                items: 5
            }
        }
    });



    let x = document.getElementsByClassName('single-theme')
    for (let i = 0; i < x.length; i++) {
        x[i].addEventListener("click", function () {

            let selectedEl = document.querySelector(".selected");
            if (selectedEl) {
                selectedEl.classList.remove("selected");
            }
            this.classList.add("selected");

        }, false);
    }

    document.addEventListener('mouseup', function (e) {
        let container = document.querySelector('.slideshow-wrapper');
        if (!container.contains(e.target)) {
            container.classList.remove('show');
        }
    });
    $(".slideshow-bar").click(function () {
        $(".slideshow-wrapper").addClass("show");
    });

    $(".create-memorial-step .fa-bars").click(function () {
        $('.create-memorial-step .nav-tabs').toggleClass('show')
    });
    $('.themes').click(function () {
        $('.theme-wrapper').addClass('show')
    });
    $('.close-btn').click(function () {
        $('.theme-wrapper').removeClass('show')
    })
    document.addEventListener('mouseup', function (e) {
        let container = document.querySelector('.theme-wrapper');
        if (!container.contains(e.target)) {
            container.classList.remove('show');
        }
    });
    $('.visitors').click(function () {
        let navlink = $('.create-memorial-step .nav-link');
        if (navlink.hasClass('active')) {
            $(navlink).removeClass('active');
            $('.tab-pane.fade').removeClass('active show');
        }
        $('.manage-visitors-area').addClass('show')
        navlink.click(function () {
            $('.manage-visitors-area').removeClass('show')
        })
    })


});