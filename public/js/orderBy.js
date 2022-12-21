$(document).ready(function () {
    $("select").change(function () {
        $("select option:selected").each(function () {
            if ($(this).attr("value") == "orderbyName") {
                $("#nameorder").show();
                $("#price").hide();
            }
            if ($(this).attr("value") == "orderbyPrice") {
                $("#nameorder").hide();
                $("#price").show();
            }
            if ($(this).attr("value") == "chon") {
                $("#nameorder").hide();
                $("#price").hide();
                $('#tab1').show();
                $('#tab2').hide();
                $('#tab3').hide();
                $('#tab4').hide();
                $('#tab5').hide();
            }

        });
    }).change();
    $("#nameorder").change(function () {
        $("select option:selected").each(function () {
            if ($(this).attr("value") == "atoz") {
                $('#tab1').hide();
                $('#tab2').show();
                $('#tab3').hide();
                $('#tab4').hide();
                $('#tab5').hide();
            }
            if ($(this).attr("value") == "ztoa") {
                $('#tab1').hide();
                $('#tab2').hide();
                $('#tab3').show();
                $('#tab4').hide();
                $('#tab5').hide();
            }
        })
    })
    $("#price").change(function () {
        $("select option:selected").each(function () {
            if ($(this).attr("value") == "maxprice") {
                $('#tab1').hide();
                $('#tab2').hide();
                $('#tab3').hide();
                $('#tab4').show();
                $('#tab5').hide();
            }
            if ($(this).attr("value") == "minprice") {
                $('#tab1').hide();
                $('#tab2').hide();
                $('#tab3').hide();
                $('#tab4').hide();
                $('#tab5').show();
            }
        })
    })
    // let lazyimages = [].slice.call(document.querySelectorAll("img"));
    // if ("IntersectionObserver" in window) {
    //     let observer = new IntersectionObserver((entries, observer) => {
    //         entries.forEach(function (entry) {
    //             if (entry.isIntersecting) {
    //                 let lazyimage = entry.target;
    //                 console.log(lazyimage.src);
    //             }
    //         })
    //     });
    //     lazyimages.forEach((lazyimage) => {
    //         observer.observe(lazyimage);
            
    //     })
    // }
});
