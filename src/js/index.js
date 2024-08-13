$(document).ready(function () {
  $.ajax({
    type: "POST",
    url: "../database/crud.php",
    dataType: "json",
    success: function (response) {
      $("#date").html(response[0].date);
      $("#value").html(response[0].value + " Bs.");
    },
  });
});
