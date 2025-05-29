window.addEventListener("scroll", function () {
    // ヘッダーを変数の中に格納する
    const header = document.querySelector("header");
    // 100px以上スクロールしたらヘッダーに「scroll-nav」クラスをつける
    header.classList.toggle("scroll-head", window.scrollY > 5);
});

$(".openbtn1").click(function () {
    //ボタンがクリックされたら
    $(this).toggleClass("active");
    $("#g-nav").toggleClass("panelactive");
    $(".circle-bg").toggleClass("circleactive");
});

$("#g-nav-list").click(function () {
    $(".openbtn1").removeClass("active");
    $("#g-nav").removeClass("panelactive");
    $(".circle-bg").removeClass("circleactive");
});

$(".news-open").click(function () {
    $(".news").toggleClass("display");
});

$(".news").click(function () {
    $(this).removeClass("display");
});
