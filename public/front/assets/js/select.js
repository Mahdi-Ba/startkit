
/*=======================================================================
Append the Box && Setting Default colors Dynamic
======================================================================*/
(function () {


    // Setting the Colors


    var colorMain_default = $(":root").css('--color-main'),
        colorSecondary_default = $(":root").css('--color-secondary'),
        gradientDirection_default = $(":root").css('--gradient-direction').split(' ');
    gradientDirection_default = gradientDirection_default[1] + ' ' + gradientDirection_default[2];

    // Check existing of the main Vairbales
    // Run Plugin
    $('.color-picker').colorpicker();

    //  Set the default values
    $("#main-color-select").find(".color-picker").attr("value", colorMain_default);
    $("#main-color-select .color-preview").css("background-color", colorMain_default)
    $("#secondary-color-select").find(".color-picker").attr("value", colorSecondary_default);
   $("#secondary-color-select .color-preview").css("background-color", colorSecondary_default)
    $("#gradient-direction select [value='" + gradientDirection_default + "']").attr("selected", "selected").siblings().removeAttr("selected");


})();
/*=======================================================================
    Color Picker Actions Scripts
======================================================================*/

(function () {

    var colorCode = '';
    var colorMain = $("#main-color-select").find(".color-picker").val();
    var colorSecondary = $("#secondary-color-select").find(".color-picker").val();
    var gradientDirection = $("#gradient-direction select").find(":selected").val();
    var gradientDegree = $(".degree").val();

    $("#get-style").on('click', function () {
        $(".color-main-code ").text(colorMain);
        $(".color-secondary-code").text(colorSecondary);
        $(".color-gradient-code").text("linear-gradient(" + gradientDirection + ", " + colorMain + ", " + colorSecondary + ")");
        $(".demo-name").text($(".demos .active img").attr("alt"));
        $('#style-modal').modal();
    });
    $("#toggle-btn").on('click', function () {
        $(this).toggleClass("hide");
        $("#option-box").toggleClass("show");
    });

    $("#main-color-select .color-picker").on('change', function () {
        colorCode = $(this).val();
        $("#main-color-select .color-preview").css("background-color", colorCode);
        colorMain = colorCode;
        $(":root").css('--color-main', colorMain);//set
    });
    $("#secondary-color-select .color-picker").on('change', function () {
        colorCode = $(this).val();
        $("#secondary-color-select .color-preview").css("background-color", colorCode);
        colorSecondary = colorCode;
        $(":root").css('--color-secondary', colorSecondary);//set
    });
    $("#gradient-direction select").on("change", function () {
        var selected = $(this).find(":selected").val();
        if (selected == "degree") {
            gradientDegree = $(".degree").val();
            gradientDirection = gradientDegree + "deg";
            $(":root").css('--gradient-direction', gradientDirection);//set

            $(".degree-form").slideDown();

        } else {
            gradientDirection = selected;

            $(".degree-form").slideUp();

            $(":root").css('--gradient-direction', gradientDirection);//set
        }
    });
    $("#gradient-direction .degree").on('change', function () {
        gradientDegree = $(".degree").val();
        gradientDirection = gradientDegree + "deg";
        $(":root").css('--gradient-direction', gradientDirection);//set

    });
    $("#close-btn").on('click', function () {
        $("#option-box").removeClass("show");
        $("#toggle-btn").removeClass("hide");
    });
    $("#demos-box .demos li").on("click", function () {

        var demo_name = $(this).find("img").attr("alt");
        $("body").removeClass(function (index, className) {
            return (className.match(/(^|\s)demo-\S+/g) || []).join(' ');
        }).addClass(demo_name);
        $(this).addClass("active").siblings().removeClass("active");

    });

    function GetFilename(url) {
        if (url) {
            var m = url.toString().match(/.*\/(.+?)\./);
            if (m && m.length > 1) {
                return m[1];
            }
        }
        return "";
    }

    if ($("body").is("[dir=rtl]")) {
        $("#rtl-page span").text("LTR");
    } else {
        $("#rtl-page span").text("RTL");
    }
    $("#rtl-page ").on('click', function () {

        var fileHostName = document.location.href;
        var newPath = '';
        if (document.location.href.includes("rtl")) {
            newPath = fileHostName.replace('rtl', 'ltr');

        } else if (document.location.href.includes("ltr")) {
            newPath = fileHostName.replace('ltr', 'rtl');
        }


        window.location.href = newPath;

    });


})();