$(function ($) {
    var curr = 1;
    var nmbreImg = 4;

    $(".slider_li").css('display', 'none');
    $(".slider_li#img" + curr).css('display', 'block');


    $("a.control_next").click(function () {

        curr++;
        if (curr == nmbreImg + 1) {
            curr = 1;
        }
        $(".slider_li").css('display', 'none');
        $(".slider_li#img" + curr).css('display', 'block')
    });

    $("a.control_prev").click(function () {
        curr--;
        if (curr == 0) {
            curr = nmbreImg;
        }
        $(".slider_li").css('display', 'none');
        $(".slider_li#img" + curr).css('display', 'block')
    });

    function myLoop() {
        setTimeout(function () {

            curr++;
            if (curr == nmbreImg + 1) {
                curr = 1;
            }
            $(".slider_li").css('display', 'none');
            $(".slider_li#img" + curr).css('display', 'block')

            myLoop(); // restart the function
        }, 3000);
    }
    myLoop(); // don't forget to run the function the first time

});