$(window).scroll(function () {
    if ($(window).scrollTop() <= 200) {
        $(".navbar").removeClass("fixed-top");
    } else {
        $(".navbar").addClass("fixed-top");
    }
});