$(document).ready(function () {
  $("form").submit(function (event) {
    $(".form-group").removeClass("has-error");
    $(".help-block").remove();
    var formData = {
      username: $("#username").val(),
      password: $("#password").val(),
      email: $("#email").val(),
      subdistrict: $("#subdistrict option:selected").text(),
      district: $("#district option:selected").text(),
      province: $("#province option:selected").text(),
      phone: $("#phone").val(),
      houseNumber: $("#houseNumber").val(),
      postalCode: $("#postalCode").val(),
      fname: $("#fname").val(),
      lname: $("#lname").val(),
    };

    $.ajax({
      type: "POST",
      url: "process.php",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      if (!data.success) {
        if (data.errors.username) {
          $("#username-group").addClass("has-error");
          $("#username-group").append(
            '<div class="help-block">' + data.errors.username + "</div>"
          );
        }
        if (data.errors.password) {
          $("#password-group").addClass("has-error");
          $("#password-group").append(
            '<div class="help-block">' + data.errors.password + "</div>"
          );
        }
        if (data.errors.province) {
          $("#province-group").addClass("has-error");
          $("#province-group").append(
            '<div class="help-block">' + data.errors.province + "</div>"
          );
        }
        if (!data.errors.province) {
          $("#province-group").removeClass("has-error");
        }
        if (!data.errors.district) {
          $("#district-group").removeClass("has-error");
        }
        if (!data.errors.subdistrict) {
          $("#subdistrict-group").removeClass("has-error");
        }
        if (data.errors.fname) {
          $("#fname-group").addClass("has-error");
          $("#fname-group").append(
            '<div class="help-block">' + data.errors.fname + "</div>"
          );
        }
        if (data.errors.lname) {
          $("#lname-group").addClass("has-error");
          $("#lname-group").append(
            '<div class="help-block">' + data.errors.lname + "</div>"
          );
        }

        if (data.errors.district) {
          $("#district-group").addClass("has-error");
          $("#district-group").append(
            '<div class="help-block">' + data.errors.district + "</div>"
          );
        }

        if (data.errors.subdistrict) {
          $("#subdistrict-group").addClass("has-error");
          $("#subdistrict-group").append(
            '<div class="help-block">' + data.errors.subdistrict + "</div>"
          );
        }

        if (data.errors.email) {
          $("#email-group").addClass("has-error");
          $("#email-group").append(
            '<div class="help-block">' + data.errors.email + "</div>"
          );
        }
        if (data.errors.phone) {
          $("#phone-group").addClass("has-error");
          $("#phone-group").append(
            '<div class="help-block">' + data.errors.phone + "</div>"
          );
        }

        if (data.errors.postalCode) {
          $("#postalCode-group").addClass("has-error");
          $("#postalCode-group").append(
            '<div class="help-block">' + data.errors.postalCode + "</div>"
          );
        }
        if (data.errors.houseNumber) {
          $("#houseNumber-group").addClass("has-error");
          $("#houseNumber-group").append(
            '<div class="help-block">' + data.errors.houseNumber + "</div>"
          );
        }
        if (!data.errors.houseNumber) {
          $("#houseNumber-group").removeClass("has-error");
        }
      } else {
        console.log(formData);
        console.log(data.state);
        if(!data.state){
          Swal.fire({
            title: "ชื่อผู้ใช้ซ้ำ!",
            text: `${data.message} กรุณาลงทะเบียนอีกครั้ง`,
            icon: "error",
            confirmButtonText: "ตกลง",
           
          });
        }else{
          Swal.fire({
            title: "ลงทะเบียนสำเร็จ!",
            text: `ลงทะเบียนสำเร็จ สถานะของคุณคือ member`,
            icon: "success",
            confirmButtonText: "ตกลง",
            timer:1500,
            
          }).then(()=>{

            window.location.href = "../Login/Form_Login.php";
          }
          );
        }
      }
    });

    event.preventDefault();
  });
});
