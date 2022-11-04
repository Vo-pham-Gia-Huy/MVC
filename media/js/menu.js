$(document).ready(function () {
  let page = 1;
  url = $(location).attr("search");
  let urlSplit = url.split("&");
  let b = urlSplit[1] ? urlSplit[1].split("=") : "";
  page = b[0] == "page" ? parseInt(b[1]) : 1;
  $(".page-item").eq(page).addClass("active");
  if (page == 1) {
    $(".page-item").eq(0).addClass("disabled");
  }
  if (page == $(".page-item").length - 2) {
    $(".page-item")
      .eq(length - 1)
      .addClass("disabled");
  }
  const hamburger = document.querySelector(".hamburger");
  hamburger.addEventListener("click", function () {
    this.classList.toggle("close");
  });
  var width = $(window).width();
  var heighthMenu = $(".menu").height();
  if (width < 720) {
    var a = $(".menu").find(".arrow");
    $(".arrow").click(function (e) {
      e.preventDefault();
    });
  }
  $(".submenu").click(function (e) {
    a = $(this).height();
    console.log(a);
  });
  $('#logout').click(function(e){
    e.stopPropagation();
    var cf = confirm("Are you sure logout!");
    if (cf == false) {
      e.preventDefault();
    }
  })
});
