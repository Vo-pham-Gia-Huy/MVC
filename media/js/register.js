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
  $("#register").click(function (e) {
    var formInvalid = false;
    $("#register_form input").each(function () {
      if (
        $(this).val() === "" &&
        $(this).attr("id") != "photo" &&
        $(this).attr("id") != "agree" 
      ) {
        $(this)
          .parent()
          .append('<br><p style="color:red;">Please fill this field</p>');
        formInvalid = true;
      }
    });
    if (formInvalid) {
        $('#register').addClass('disabled');
        e.preventDefault();
    }
  });
});
