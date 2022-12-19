$(window).scroll(function () {
    if ($(window).scrollTop() <= 230) {
        $("#navbar").removeClass("fixed-top");
    } else {
        $("#navbar").addClass("fixed-top");
    }
});