$(window).scroll(function () {
    if ($(window).scrollTop() <= 250) {
        $(".navbar").removeClass("fixed-top");
    } else {
        $(".navbar").addClass("fixed-top");
    }
});