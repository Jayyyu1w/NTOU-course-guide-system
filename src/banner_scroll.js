$(window).scroll(function () {
    if ($(window).scrollTop() <= 230) {
        $("#navbar").removeClass("fixed-top");
        $("#fixpos").css("height", "0px");
    } else {
        $("#navbar").addClass("fixed-top");
        $("#fixpos").css("height", "76px");
    }
});