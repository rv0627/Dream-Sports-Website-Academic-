function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("navbar").style.padding = "25px 10px";
    document.getElementById("navbar").style.transitionDuration = "1s";
    document.getElementById("navbar").style.top = "0";
    document.getElementById("searchScroll1").style.position = "fixed";
    document.getElementById("searchScroll1").style.top = "40px";

    
    document.getElementById("searchScroll2").style.position = "fixed";
    document.getElementById("searchScroll2").style.top = "40px";
  } else {
    document.getElementById("navbar").style.padding = "10px 10px";
    document.getElementById("navbar").style.top = "";
    document.getElementById("navbar").style.transitionDuration = "1s";
    document.getElementById("searchScroll1").style.position = "";
    document.getElementById("searchScroll1").style.top = "";

    
    document.getElementById("searchScroll2").style.position = "";
    document.getElementById("searchScroll2").style.top = "";
  }
}

function dash() {
  // document.getElementById("searchScroll1").className = "d-none"
  var searchScroll1 = document.getElementById("searchScroll1");

  searchScroll1.classList.toggle("d-none");
  
}

function signUpProcess() {
  var fname = document.getElementById("f");
  var lname = document.getElementById("l");
  var email = document.getElementById("e");
  var password = document.getElementById("p");
  var mobile = document.getElementById("m");
  var gender = document.getElementById("g");

  var form = new FormData();
  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("m", mobile.value);
  form.append("g", gender.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        window.location = "home.php";

        // document.getElementById("error").innerHTML = text;
        // document.getElementById("erroralertdiv").className = "alert alert-success fs-6";
        // document.getElementById("error").className = "bi bi-check2-circle";
        // document.getElementById("errordiv").className = "d-block";

        // document.getElementById("f").style.borderColor = "";
        // document.getElementById("l").style.borderColor = "";
        // document.getElementById("e").style.borderColor = "";
        // document.getElementById("p").style.borderColor = "";
        // document.getElementById("m").style.borderColor = "";

        // document.getElementById("f").value = "";
        // document.getElementById("l").value = "";
        // document.getElementById("e").value = "";
        // document.getElementById("p").value = "";
        // document.getElementById("m").value = "";
      } else if (
        text == "Please enter your First Name !!!" ||
        text == "First Name must have less than 50 characters."
      ) {
        document.getElementById("f").style.borderColor = "red";
        document.getElementById("error").innerHTML = text;
        document.getElementById("errordiv").className = "d-block";

        document.getElementById("l").style.borderColor = "";
        document.getElementById("e").style.borderColor = "";
        document.getElementById("p").style.borderColor = "";
        document.getElementById("m").style.borderColor = "";
      } else if (
        text == "Please enter your Last Name !!!" ||
        text == "Last Name must have less than 50 characters."
      ) {
        document.getElementById("l").style.borderColor = "red";
        document.getElementById("error").innerHTML = text;
        document.getElementById("errordiv").className = "d-block";

        document.getElementById("f").style.borderColor = "";
        document.getElementById("e").style.borderColor = "";
        document.getElementById("p").style.borderColor = "";
        document.getElementById("m").style.borderColor = "";
      } else if (
        text == "Please enter your Email !!!" ||
        text == "Email must have less than 100 characters." ||
        text == "Invalid Email !!!"
      ) {
        document.getElementById("e").style.borderColor = "red";
        document.getElementById("error").innerHTML = text;
        document.getElementById("errordiv").className = "d-block";

        document.getElementById("f").style.borderColor = "";
        document.getElementById("l").style.borderColor = "";
        document.getElementById("p").style.borderColor = "";
        document.getElementById("m").style.borderColor = "";
      } else if (
        text == "Please enter your Password !!!" ||
        text == "Password must be between 5 - 20 characters."
      ) {
        document.getElementById("p").style.borderColor = "red";
        document.getElementById("error").innerHTML = text;
        document.getElementById("errordiv").className = "d-block";

        document.getElementById("f").style.borderColor = "";
        document.getElementById("l").style.borderColor = "";
        document.getElementById("e").style.borderColor = "";
        document.getElementById("m").style.borderColor = "";
      } else if (
        text == "Please enter your Mobile Number !!!" ||
        text == "Mobile Number must have 10 characters." ||
        text == "Invalid Mobile Number !!!"
      ) {
        document.getElementById("m").style.borderColor = "red";
        document.getElementById("error").innerHTML = text;
        document.getElementById("errordiv").className = "d-block";

        document.getElementById("f").style.borderColor = "";
        document.getElementById("l").style.borderColor = "";
        document.getElementById("e").style.borderColor = "";
        document.getElementById("p").style.borderColor = "";
      } else if (
        text == "User with the same Email or Mobile Number already exists."
      ) {
        document.getElementById("error").innerHTML = text;
        document.getElementById("errordiv").className = "d-block";

        document.getElementById("e").style.borderColor = "red";
        document.getElementById("m").style.borderColor = "red";

        document.getElementById("f").style.borderColor = "";
        document.getElementById("l").style.borderColor = "";
        document.getElementById("p").style.borderColor = "";
      }
    }
  };

  request.open("POST", "signUpProcess.php", true);
  request.send(form);
}

function signInProcess() {
  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberme = document.getElementById("rememberme");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (
        text == "Please enter your Email!" ||
        text == "Email must have less than 100 characters." ||
        text == "Invalid Email !!!"
      ) {
        document.getElementById("msg1").innerHTML = text;
        document.getElementById("email2").style.borderColor = "red";

        document.getElementById("msg3").innerHTML = "";
      } else if (
        text == "Please enter your Password!" ||
        text == "Password must have between 5-20 characters."
      ) {
        document.getElementById("msg2").innerHTML = text;
        document.getElementById("password2").style.borderColor = "red";

        document.getElementById("msg3").innerHTML = "";
        document.getElementById("msg1").innerHTML = "";
        document.getElementById("email2").style.borderColor = "";
      } else if (text == "Invalid Username or Password") {
        document.getElementById("msg3").innerHTML = text;
        document.getElementById("msg3").className = "text-danger";
      } else {
        window.location = "home.php";

        // document.getElementById("msg3").innerHTML = text;
        // document.getElementById("msg3").className = "text-success";

        document.getElementById("email2").style.borderColor = "";
        document.getElementById("password2").style.borderColor = "";
        document.getElementById("msg1").innerHTML = "";
        document.getElementById("msg2").innerHTML = "";
      }
    }
  };

  request.open("POST", "signInProcess.php", true);
  request.send(form);
}

var bm;
function forgotPasswordModal() {
  var email = document.getElementById("email2");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        document.getElementById("msg1").innerHTML = "";
        document.getElementById("email2").style.borderColor = "";

        document.getElementById("verificationCodeSend").innerHTML =
          "Verification code has sent to your email. Please check your inbox";

        // alert("Verification code has sent to your email. Please check your inbox");

        var m = document.getElementById("forgotPasswordModal");
        bm = new bootstrap.Modal(m);
        bm.show();
      } else {
        document.getElementById("msg1").innerHTML = text;
        document.getElementById("email2").style.borderColor = "red";
        // alert(text);
      }
    }
  };

  request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  request.send();
}

function showPassword() {
  var newPassword = document.getElementById("newPassword");
  var eye = document.getElementById("eye1");

  if (newPassword.type == "password") {
    newPassword.type = "text";
    eye.className = "bi bi-eye-fill";
  } else {
    newPassword.type = "password";
    eye.className = "bi bi-eye-slash-fill";
  }
}

function reTypePasswordShow() {
  var reTypePassword = document.getElementById("reTypePassword");
  var eye = document.getElementById("eye2");

  if (reTypePassword.type == "password") {
    reTypePassword.type = "text";
    eye.className = "bi bi-eye-fill";
  } else {
    reTypePassword.type = "password";
    eye.className = "bi bi-eye-slash-fill";
  }
}

function resetPassword() {
  var email = document.getElementById("email2");
  var newPassword = document.getElementById("newPassword");
  var reTypePassword = document.getElementById("reTypePassword");
  var vCode = document.getElementById("vCode");

  var form = new FormData();
  form.append("email", email.value);
  form.append("newPassword", newPassword.value);
  form.append("reTypePassword", reTypePassword.value);
  form.append("vCode", vCode.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (
        text == "Please insert a New Password" ||
        text == "New Password must have between 5-20 characters."
      ) {
        document.getElementById("npMsg").innerHTML = text;
        document.getElementById("newPassword").style.borderColor = "red";

        document.getElementById("rtpMsg").innerHTML = "";
        document.getElementById("reTypePassword").style.borderColor = "";
        document.getElementById("vCodeMsg").innerHTML = "";
        document.getElementById("vCode").style.borderColor = "";
      } else if (
        text == "Please Re-Type your New Password" ||
        text == "Your Password does not matched."
      ) {
        document.getElementById("rtpMsg").innerHTML = text;
        document.getElementById("reTypePassword").style.borderColor = "red";

        document.getElementById("npMsg").innerHTML = "";
        document.getElementById("newPassword").style.borderColor = "";
        document.getElementById("vCodeMsg").innerHTML = "";
        document.getElementById("vCode").style.borderColor = "";
      } else if (
        text == "Please enter your Verification Code" ||
        text == "Invalid Email or Verification Code"
      ) {
        document.getElementById("vCodeMsg").innerHTML = text;
        document.getElementById("vCode").style.borderColor = "red";

        document.getElementById("npMsg").innerHTML = "";
        document.getElementById("newPassword").style.borderColor = "";
        document.getElementById("rtpMsg").innerHTML = "";
        document.getElementById("reTypePassword").style.borderColor = "";
      } else {
        bm.hide();
        alert("Password reset Success.");
      }
    }
  };

  request.open("POST", "resetPassword.php", true);
  request.send(form);
}

function profile() {
  var profile = document.getElementById("profile");

  profile.show(profile);
}

function signout() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if ((text = "Success")) {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "signoutProcess.php", true);
  request.send();
}

function updateProfileImage() {
  var profileimg = document.getElementById("profileimg");
  var viewImg = document.getElementById("viewImg");

  profileimg.onchange = function () {
    var file1 = this.files[0];
    var url = window.URL.createObjectURL(file1);

    viewImg.src = url;
  };
}

function updateProfile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pcode");
  var image = document.getElementById("profileimg");

  var form = new FormData();
  form.append("fn", fname.value);
  form.append("ln", lname.value);
  form.append("m", mobile.value);
  form.append("l1", line1.value);
  form.append("l2", line2.value);
  form.append("p", province.value);
  form.append("d", district.value);
  form.append("c", city.value);
  form.append("pcode", pcode.value);

  if (image.files.length == 0) {
    var confirmation = confirm(
      "Are you sure You don't want to update Profile Image?"
    );

    if (confirmation) {
      alert("You have not selected any image");
    }
  } else {
    form.append("image", image.files[0]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if (text == "success") {
        window.location = "home.php";
      } else {
        alert(text);
      }
    }
  };

  request.open("POST", "userProfileProcess.php", true);
  request.send(form);
}

function sort1(x) {
  var search = document.getElementById("s");

  var time = "0";

  if (document.getElementById("n").checked) {
    time = "1";
  } else if (document.getElementById("o").checked) {
    time = "2";
  }

  var qty = "0";

  if (document.getElementById("h").checked) {
    qty = "1";
  } else if (document.getElementById("l").checked) {
    qty = "2";
  }

  var condition = "0";

  if (document.getElementById("b").checked) {
    condition = "1";
  } else if (document.getElementById("u").checked) {
    condition = "2";
  }

  var form = new FormData();
  form.append("s", search.value);
  form.append("t", time);
  form.append("q", qty);
  form.append("c", condition);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      document.getElementById("sort").innerHTML = text;
    }
  };

  request.open("POST", "sortProcess.php", true);
  request.send(form);
}

function clearSort() {
  window.location.reload();
}

function sendId(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.readyState == 4) {
          var text = request.responseText;
          if (text == "Success") {
              window.location = "updateProduct.php";
          } else {
              alert(text);
          }
      }
  }

  request.open("GET", "sendProductIdProcess.php?id=" + id, true);
  request.send();

}

function changeStatus(id) {
  var product_id = id;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Deactivated") {
        alert("Product Deactivated");
        window.location.reload();
      } else if (text == "Activated") {
        alert("Product Activated");
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "changeStatusProcess.php?p=" + product_id, true);
  request.send();
}

window.addEventListener("load", function () {
  document.querySelector(".loder").classList.add("hidden");
});

// var avm;
function adminVerification() {
  var admin_email = document.getElementById("e");
  var loder = document.getElementById("loder");
  

  var form = new FormData();
  form.append("e", admin_email.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      
      if (text == "This Email address is Invalid") {
        document.getElementById("e").style.borderBottomColor = "red";
        document.getElementById("msg").style.color = "red";
        document.getElementById("msg").innerHTML = text;
      } else if (text == "Email field should not be empty") {
        document.getElementById("e").style.borderBottomColor = "red";
        document.getElementById("msg").style.color = "red";
        document.getElementById("msg").innerHTML = text;
      } else {
        document.getElementById("msg").innerHTML = "";
        document.getElementById("e").style.borderBottomColor =
          "rgb(0, 250, 250)";
        document.getElementById("msg").style.color = "";

        alert(
          "Verification code has sent to your email. Please check your inbox."
        );
        document.getElementById("msg").innerHTML =
          "Verification code has sent to your email. Please check your inbox.";
        document.getElementById("msg").style.color = "green";

        // var adminVerificationModal = document.getElementById("verificationModal");
        // avm = new bootstrap.Modal(adminVerificationModal);
        // avm.show();

        document.getElementById("verificationModal").innerHTML = text;
      }
    }
  };

  request.open("POST", "adminVerificationProcess.php", true);
  request.send(form);
}

function verify() {
  var verification = document.getElementById("vcode");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        // avm.hide();
        window.location = "adminPanel.php";
      } else if (text == "Invalid Verification Code") {
        document.getElementById("msgv").innerHTML = text;
        document.getElementById("vcode").style.borderColor = "red";
        document.getElementById("msgv").style.color = "red";
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "verifyAdminProcess.php?v=" + verification.value, true);
  request.send();
}

function load_brand() {
  var category = document.getElementById("category").value;
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("brand").innerHTML = text;
    }
  };

  request.open("GET", "loadBrand.php?c=" + category, true);
  request.send();
}

function load_model() {
  var brand = document.getElementById("brand").value;
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("model").innerHTML = text;
    }
  };

  request.open("GET", "loadModel.php?b=" + brand, true);
  request.send();
}

function changeProductImage() {
  var image = document.getElementById("imageuploader");
  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert("Please select 3 or less than 3 images.");
    }
  };
}

function updateProduct() {
  var title = document.getElementById("t");
  var qty = document.getElementById("qty");
  var delivery_cost_within_colombo = document.getElementById("dwc");
  var delivery_cost_out_of_colombo = document.getElementById("doc");
  var description = document.getElementById("desc");
  var images = document.getElementById("imageuploader");

  var form = new FormData();
  form.append("t", title.value);
  form.append("qty", qty.value);
  form.append("dwc", delivery_cost_within_colombo.value);
  form.append("doc", delivery_cost_out_of_colombo.value);
  form.append("desc", description.value);

  var image_count = images.files.length;

  for (var x = 0; x < image_count; x++) {
      form.append("i" + x, images.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.readyState == 4) {
          var text = request.responseText;
          if (text == "File type not allowed!" && text=="Invalid Image Count") {
              alert(text);
          } else {
            window.location = "myProduct.php";
          }
      }
  }

  request.open("POST", "updateProcess.php", true);
  request.send(form);

}

function addProduct() {
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var title = document.getElementById("title");

  var condition = 0;
  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 2;
  }

  var color = document.getElementById("cl");
  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var description = document.getElementById("desc");
  var image = document.getElementById("imageuploader");

  var form = new FormData();
  form.append("c", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("t", title.value);
  form.append("con", condition);
  form.append("cl", color.value);
  form.append("qty", qty.value);
  form.append("cost", cost.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("desc", description.value);

  $img = image.file.length;

  var request = new XMLHttpRequest;

  if(request.onreadystatechange.readyState == 4){
    var response = request.responseText;
  }

  request.open("POST", "addProductProcess.php", true);
  request.send(form);
}

function loadMainImg(id) {
  var img = document.getElementById("productImg" + id).src;
  var main = document.getElementById("main-img");

  main.src = img;
}

function checkValue(qty) {
  var input = document.getElementById("qty");
  if (input.value <= 0) {
    alert("Quantity must be 1 or more");
    input.value = 1;
  } else if (input.value > qty) {
    alert("Maximum Quantity achieved");
    input.value = qty;
  }
}

function qty_inc(qty) {
  var input = document.getElementById("qty");
  if (input.value < qty) {
    var newValue = parseInt(input.value) + 1;
    input.value = newValue.toString();
  } else {
    alert("Maximum quantity has achieved");
    input.value = qty;
  }
}

function qty_dec() {
  var input = document.getElementById("qty");
  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue.toString();
  } else {
    alert("Minimum quantity has achieved");
    input.value = 1;
  }
}

var cm;
function addCart(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("viewCart").innerHTML = text;

      var viewCartModel = document.getElementById("viewCart");
      cm = new bootstrap.Modal(viewCartModel);
      cm.show();
    }
  };

  request.open("GET", "addCartProcess.php?id=" + id, true);
  request.send();
}

function cartNum() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "0") {
        document.getElementById("cartNum").innerHTML = "0";
      } else {
        document.getElementById("cartNum").innerHTML = text;
      }
    }
  };

  request.open("GET", "cartnum.php", true);
  request.send();
}
cartNum();

function deleteFromCart(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
  request.send();
}

// function selectAll() {
//     var sAll = document.getElementById("sAll");

//     var request = new XMLHttpRequest();

//     request.onreadystatechange = function () {
//         if (request.readyState == 4) {
//             var text = request.responseText;
//             if (document.getElementById("sAll").checked) {
//                 document.getElementById("searchScroll2").innerHTML = text;
//             } else {
//                 window.location.reload();
//             }

//         }
//     }

//     request.open("GET", "selectAllCartProcess.php?sall=" + sAll, true);
//     request.send();
// }

// function selectP(id) {
//     var selectP = document.getElementById("select" + id);

//     var request = new XMLHttpRequest();

//     request.onreadystatechange = function () {
//         if (request.readyState == 4) {
//             var text = request.responseText;
//             if (document.getElementById("select" + id).checked) {
//                 document.getElementById("searchScroll2").innerHTML = text;
//             } else {
//             }
//         }
//     }

//     request.open("GET", "selectCartProcess.php?select=" + selectP + "&pid=" + id, true);
//     request.send();
// }

var wm;
function addToWatchlist(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "removed") {
        document.getElementById("heart" + id).style.className = "text-dark";
        window.location.reload();
      } else {
        document.getElementById("heart" + id).style.className = "text-danger";

        document.getElementById("viewWatchlist").innerHTML = text;

        var vieWatchlistModel = document.getElementById("viewWatchlist");
        wm = new bootstrap.Modal(vieWatchlistModel);
        wm.show();
      }
    }
  };

  request.open("GET", "addToWatchlistProcess.php?id=" + id, true);
  request.send();
}

function refresh() {
  window.location.reload();
}

function watchlistSearch() {
  var txt = document.getElementById("text").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "no") {
        window.location.reload();
      } else {
        document.getElementById("view").innerHTML = text;
      }
    }
  };

  request.open("GET", "watchlistSearchProcess.php?t=" + txt, true);
  request.send();
}

function removeFromWatchlist(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "removeWatchlistProcess.php?id=" + id, true);
  request.send();
}

function payNow(id) {
  var qty = document.getElementById("qty_input").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      var obj = JSON.parse(text);

      var mail = obj["mail"];
      var amount = obj["amount"];

      if (text == "1") {
        alert("Please log in or sign up");
        window.location = "index.php";
      } else if (text == "2") {
        alert("Please update your profile first");
        window.location = "userProfile.php";
      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          saveInvoice(orderId, id, mail, amount, qty);
          // Note: validate the payment and show success or failure page to the customer
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: "1222542", // Replace your Merchant ID
          merchant_secret:
            "MzY0MjIzOTkxOTEwMDc0ODY1NTI2NjgxNjMxNjEyNzg3MDU4MDI4", // Replace your Mechant secret
          return_url:
            "http://localhost/Dream%20Sports/singleProductView.php?id" + id, // Important
          cancel_url:
            "http://localhost/Dream%20Sports/singleProductView.php?id" + id, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount,
          currency: "LKR",
          hash: obj["hash"],
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: mail,
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
        // };
      }
    }
  };

  request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
  request.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {
  var form = new FormData();
  form.append("o", orderId);
  form.append("i", id);
  form.append("m", mail);
  form.append("a", amount);
  form.append("q", qty);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "1") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(text);
      }
    }
  };

  request.open("POST", "saveInvoice.php", true);
  request.send(form);
}

function printInvoice() {
  var body = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = body;
}

var cs;
function contactSeller(email) {
  var request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      var text = request.responseText;
      alert(text);
      var contactSellerModel = document.getElementById("contactseller");
      cs = new bootstrap.Modal(contactSellerModel);
      cs.show();
    }
  };
  request.open("GET", "contactSeller.php?email=" + email, true);
  request.send();
}

var mm;
function msgModel() {
  var contactSellerModel = document.getElementById("msgModel");
  mm = new bootstrap.Modal(contactSellerModel);
  mm.show();
}

function viewMessages(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      document.getElementById("chat_box").innerHTML = text;
    }
  };

  request.open("GET", "viewMessagesProcess.php?e=" + email, true);
  request.send();
}

function send_msg() {
  var email = document.getElementById("rmail");
  var txt = document.getElementById("msg_txt");

  var form = new FormData();
  form.append("e", email.innerHTML);
  form.append("t", txt.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("POST", "sendMsgProcess.php", true);
  request.send(form);
}

function blocks(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "blocked") {
        document.getElementById("bs" + email).innerHTML = "Unblock";
        document.getElementById("bs" + email).classList = "btn text-success";
        window.location.reload();
      } else if (text == "Unblocked") {
        document.getElementById("bs" + email).innerHTML = "Block";
        document.getElementById("bs" + email).classList = "btn text-danger";
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "userBlockProcess.php?email=" + email, true);
  request.send();
}

function blockProducts(pid) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "blocked") {
        document.getElementById("bs" + pid).innerHTML = "Unblock";
        document.getElementById("bs" + pid).classList = "btn text-success";
        window.location.reload();
      } else if (text == "Unblocked") {
        document.getElementById("bs" + pid).innerHTML = "Block";
        document.getElementById("bs" + pid).classList = "btn text-danger";
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "productsBlockProcess.php?pid=" + pid, true);
  request.send();
}

var pm;
function viewProductModel(id) {
  var m = document.getElementById("viewProductModel" + id);
  pm = new bootstrap.Modal(m);
  pm.show();
}

function qty_inc(qty) {
  var input = document.getElementById("qty_input");
  if (input.value < qty) {
    var newValue = parseInt(input.value) + 1;
    input.value = newValue.toString();
  } else {
    alert("Maximum quantity has achieved");
    input.value = qty;
  }
}

function qty_dec() {
  var input = document.getElementById("qty_input");
  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue.toString();
  } else {
    alert("Minimum quantity has achieved");
    input.value = 1;
  }
}

function deleteProduct(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "deletePurchaseHistory.php?id=" + id, true);
  request.send();
}

function deleteAllProduct() {
  var request = new XMLHttpRequest();
roduct
  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;
      if (text == "Success") {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "deletePurchaseHistory.php", true);
  request.send();
}

function adminLogout() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var text = request.responseText;

      if ((text = "Success")) {
        window.location.reload();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "adminSignoutProcess.php", true);
  request.send();
}
