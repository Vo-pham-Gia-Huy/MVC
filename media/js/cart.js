$(document).ready(function () {
  $(".deleteSession").click(function() {
    let url =
      "http://localhost/php-oop-mvc-2021/index.php?ctl=menu&act=deleteAjax";
    let a = $(this).attr("value");
    let tc = $(this);
    console.log(tc);
    var cf = confirm("Are you sure!");
    if (cf == true) {
      $.ajax({
        url: url,
        method: "post",
        data: {
          value: a,
        },
      }).done(function (response) {
        console.log(response);
        if (response == "successful") {
          console.log(tc.parent().parent());
          tc.parent().parent().remove();
        }
      });
    }
  });
  $('button.btn').click(function(){
    let amount =$('.amount').val();
    amount=parseInt(amount)+parseInt($(this).attr("value"));
    $('.amount').val(amount?amount:1)
  })
  $("#addCart").click(function () {
    let url = $(location).attr("href");
    let a = $("#addCart").attr("value");
    console.log(a);
    $.ajax({
      url: url + "&act=addAjax",
      method: "post",
      data: {
        value: a,
        amount: $('.amount').val()
      },
    }).done(function (response) {
      console.log(response);
      alert("Add cart successful");
    });
  });
});
