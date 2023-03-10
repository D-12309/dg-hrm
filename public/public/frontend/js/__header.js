// Sticky Header

$(window).on('scroll',function() {
    let scroll = $(window).scrollTop();
    if (scroll < 445) {
        $(".ltn__header-sticky").removeClass("sticky-active");
    } else {
        $(".ltn__header-sticky").addClass("sticky-active");
    }
});


// Language Dropdwon Toggle

$(function() {
    $('.dropdown-toggle').on("click", function() { $(this).next('.dropdown-menu').slideToggle();
    });

    $(document).on("click", function(e)
    {
    var target = e.target;
    if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle'))
    //{ $('.dropdown').hide(); }
      { $('.dropdown-menu').slideUp(); }
    });
    });



