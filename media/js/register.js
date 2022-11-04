$(document).ready(function () {
  $("#photo").change(function () {
    const file = this.files[0];
    console.log(file);
    if (file) {
      let reader = new FileReader();
      reader.onload = function (event) {
        $("#label-photo").attr("src", event.target.result);
      };
      reader.readAsDataURL(file);
    }
  });
  var pass;
  var repeatPass;
  $("#password").keyup(function () {
    pass = $(this).val();
  });
  $("#repeat-password").keyup(function () {
    repeatPass = $(this).val();
  });
  $("#register").click(function (e) {
    var formInvalid = false;
    if (pass != repeatPass) {
      $('#repeat-password')
        .parent()
        .append(
          '<p class="warning px-2 mt-2">This field cannot have special characters</p>'
        );
      formInvalid = true;
    }
    $("#register_form").find(".warning").remove();
    $("#register_form input").each(function () {
      if (
        $(this).val() === "" &&
        $(this).attr("id") != "photo" &&
        $(this).attr("id") != "agree"
      ) {
        let a = $(this).parent().find("p").hasClass("warning");
        if (!a) {
          $(this)
            .parent()
            .append('<p class="warning px-2 mt-2" >Please fill this field</p>');
        }
        formInvalid = true;
      }
      if ($(this).val().includes("'") || $(this).val().includes('"')) {
        $(this)
          .parent()
          .append(
            '<p class="warning px-2 mt-2">This field cannot have special characters</p>'
          );
        formInvalid = true;
      }
    });

    if (formInvalid) {
      e.preventDefault();
    }
  });
});
