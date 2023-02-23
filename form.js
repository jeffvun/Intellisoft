function calculateAge() {
    var today = new Date();
    var birthDate = new Date(document.getElementById("dob").value);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    document.getElementById("age").value = age;
    console.log(age);
}

$(function () {
    $('form').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: 'form.php',
        data: $('form').serialize(),
        success: function () {
          alert('form was submitted');
        }
      });
    });
  });