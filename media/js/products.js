$(document).ready(function () {
  $(".delete").on("click", function (event) {
    event.stopPropagation();
    tc = $(this);
    var cf = confirm("Are you sure!");
    if (cf == true) {
      url = tc.attr("href");
      $.ajax({
        url: url,
        method: "post",
        success: function (data) {
          if (data) tc.parent().parent().remove();
        },
      });
    }
    return false;
  });
  var toggler = document.getElementsByClassName("caret");
  var i;
  for (i = 0; i < toggler.length; i++) {
    toggler[i].addEventListener("click", function () {
      this.parentElement.querySelector(".nested").classList.toggle("active");
      this.classList.toggle("caret-down");
    });
  }
});
