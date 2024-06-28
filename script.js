const { Modal } = require("./bootstrap");

function register() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var password = document.getElementById("pass");
  var mobile = document.getElementById("mob");
  var gender = document.getElementById("gen");

  var f = new FormData();
  f.append("fname", fname.value);
  f.append("lname", lname.value);
  f.append("email", email.value);
  f.append("pass", password.value);
  f.append("mob", mobile.value);
  f.append("gen", gender.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert("Registration Complete.");
        window.location = "index.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "registerprocess.php", true);
  r.send(f);
}
function signin() {
  var email = document.getElementById("floatingInput");
  var pass = document.getElementById("floatingPassword");
  var check = document.getElementById("check");

  var f = new FormData();
  f.append("email", email.value);
  f.append("pass", pass.value);
  f.append("check", check.checked);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        window.location = "home.php";
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "signinProcess.php", true);
  r.send(f);
}

function signOut() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location.reload();
      }
    }
  };

  r.open("GET", "signoutProcess.php", true);
  r.send();
}

var pm;
function verification() {
  var email = document.getElementById("passemail");

  var f = new FormData();
  f.append("email", email.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert(
          "Verification code has sent to your Email. Please check your inbox"
        );
        var m = document.getElementById("resetPassModal");
        pm = new bootstrap.Modal(m);
        pm.show();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "verification.php", true);
  r.send(f);
}

function resetPass() {
  var veri = document.getElementById("veri");
  var pass1 = document.getElementById("pass1");
  var pass2 = document.getElementById("pass2");
  var email = document.getElementById("em");

  var f = new FormData();
  f.append("veri", veri.value);
  f.append("pass1", pass1.value);
  f.append("pass2", pass2.value);
  f.append("email", email.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert("Password Change success.");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "resetProcess.php", true);
  r.send(f);
}

function changeProductImage() {
  // alert("OK");
  var img = document.getElementById("imgup");

  img.onchange = function () {
    var fileCo = img.files.length;
    if (fileCo <= 4) {
      for (var x = 0; x < fileCo; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(fileCo + "File Limit Exceeded. You can upload only 4 Images.");
    }
  };
}

function sell() {
  var title = document.getElementById("title");
  var qty = document.getElementById("qty");
  var price = document.getElementById("price");
  var cat = document.getElementById("cat");
  var loc = document.getElementById("loc");
  var con = document.getElementById("con");
  var speci = document.getElementById("speci");
  var reason = document.getElementById("reason");
  var war = document.getElementById("war");
  var del = document.getElementById("del");
  var img = document.getElementById("imgup");

  var f = new FormData();
  f.append("title", title.value);
  f.append("qty", qty.value);
  f.append("price", price.value);
  f.append("cat", cat.value);
  f.append("loc", loc.value);
  f.append("con", con.value);
  f.append("speci", speci.value);
  f.append("reason", reason.value);
  f.append("war", war.value);
  f.append("del", del.value);
  f.append("img", img.value);

  var file_count = img.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("img" + x, img.files[x]);
  }
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert("Congratulations, Your post is now Live.");
        window.location = "home.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "sellProcess.php", true);
  r.send(f);
}

function proImgSelect() {
  var img = document.getElementById("proImg");

  img.onchange = function () {
    var fileCo = img.files.length;
    if (fileCo <= 1) {
      for (var x = 0; x < fileCo; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("p" + x).src = url;
      }
    } else {
      alert(fileCo + "File Limit Exceeded. You can upload only 4 Images.");
    }
  };
}

function updatePro() {
  var profname = document.getElementById("profname");
  var prolname = document.getElementById("prolname");
  var promob = document.getElementById("promob");
  var proImg = document.getElementById("proImg");

  var f = new FormData();
  f.append("profname", profname.value);
  f.append("prolname", prolname.value);
  f.append("promob", promob.value);
  f.append("proImg", proImg.value);

  var file_count = proImg.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("img" + x, proImg.files[x]);
  }
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  };

  r.open("POST", "updateProfileProcess.php", true);
  r.send(f);
}

function updateAddress() {
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var zip = document.getElementById("zip");
  var locup = document.getElementById("locup");

  var f = new FormData();
  f.append("line1", line1.value);
  f.append("line2", line2.value);
  f.append("zip", zip.value);
  f.append("locup", locup.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
      window.location.reload();
    }
  };

  r.open("POST", "updateAddressProcess.php", true);
  r.send(f);
}

function changeProductImage2() {
  // alert("OK");
  var img = document.getElementById("imgup2");

  img.onchange = function () {
    var fileCo = img.files.length;
    if (fileCo <= 4) {
      for (var x = 0; x < fileCo; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("u" + x).src = url;
      }
    } else {
      alert(fileCo + "File Limit Exceeded. You can upload only 4 Images.");
    }
  };
}

function updateItem(id) {
  var title = document.getElementById("title2");
  var qty = document.getElementById("qty2");
  var price = document.getElementById("price2");
  var cat = document.getElementById("cat2");
  var loc = document.getElementById("loc2");
  var con = document.getElementById("con2");
  var speci = document.getElementById("speci2");
  var reason = document.getElementById("reason2");
  var war = document.getElementById("war2");
  var del = document.getElementById("del2");
  var img = document.getElementById("imgup2");

  var f = new FormData();
  f.append("title", title.value);
  f.append("qty", qty.value);
  f.append("price", price.value);
  f.append("cat", cat.value);
  f.append("loc", loc.value);
  f.append("con", con.value);
  f.append("speci", speci.value);
  f.append("reason", reason.value);
  f.append("war", war.value);
  f.append("del", del.value);

  var file_count = img.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("img" + x, img.files[x]);
  }
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert("Product Updated Successfully.");
        window.location = "listedItems.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "updateItemProcess.php?id=" + id, true);
  r.send(f);
}

function categorySearch(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("categorysearch").innerHTML = t;
      // alert(t);
    }
  };
  r.open("GET", "categorySearch.php?id=" + id, true);
  r.send();
}
function categorySearch2(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("categorysearch2").innerHTML = t;
      // alert(t);
    }
  };
  r.open("GET", "categorySearch2.php?id=" + id, true);
  r.send();
}

function loadImg(imgPath) {
  // alert(id);
  document.getElementById("mainImg").src = imgPath;
}

function addtoCart(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert("Item Added to cart Successfully.");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "addtoCart.php?id=" + id, true);
  r.send();
}

function calculateTotal() {
  var checkboxes = document.querySelectorAll(".item-checkbox");
  var subTotal = 0;
  var deliveryTotal = 0;

  checkboxes.forEach((checkbox) => {
    if (checkbox.checked) {
      var id = checkbox
        .closest(".row")
        .querySelector("input[type='text']")
        .id.replace("qty_input", "");
      var quantity = parseInt(document.getElementById("qty_input" + id).value);
      var price = parseFloat(checkbox.getAttribute("data-price"));
      var delivery = parseFloat(checkbox.getAttribute("data-delivery"));

      subTotal += price * quantity;
      deliveryTotal += delivery * quantity;
    }
  });

  document.getElementById("sub-total").innerText = "Rs." + subTotal + "/=";
  document.getElementById("delivery-total").innerText =
    "Rs." + deliveryTotal + "/=";
  document.getElementById("grand-total").innerText =
    "Rs." + (subTotal + deliveryTotal) + "/=";
}

document.querySelectorAll(".item-checkbox").forEach((checkbox) => {
  checkbox.addEventListener("change", calculateTotal);
});

function qty_dec(id) {
  let qtyInput = document.getElementById("qty_input" + id);
  let quantity = parseInt(qtyInput.value);
  if (quantity > 1) {
    quantity--;
    qtyInput.value = quantity;
    calculateTotal();
  }
}

function qty_inc(maxQuantity, id) {
  let qtyInput = document.getElementById("qty_input" + id);
  let quantity = parseInt(qtyInput.value);
  if (quantity < maxQuantity) {
    quantity++;
    qtyInput.value = quantity;
    calculateTotal();
  }
}

function checkout(id) {
  var qty = document.getElementById("qty_input").value;
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      var obj = JSON.parse(response);

      var mail = obj["umail"];
      var amount = obj["amount"];
      var uid = obj["uid"];

      if (response == 1) {
        alert("Please Login.");
        window.location = "home.php";
      } else if (response == 2) {
        alert("Please update your profile.");
        window.location = "profile.php";
      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          // alert("Payment completed. OrderID:" + orderId);
          saveInvoice(orderId, id, mail, uid, amount, qty);
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
          merchant_id: obj["mid"], // Replace your Merchant ID
          return_url: "http://localhost/eshop/singleProductView.php?id=" + id, // Important
          cancel_url: "http://localhost/eshop/singleProductView.php?id=" + id, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount + ".00",
          currency: "LKR",
          hash: obj["hash"], // *Replace with generated hash retrieved from backend
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

function cartRemove(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if ((t = "Success")) {
        alert("Product Removed Successfuly.");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };
  r.open("GET", "cartRemove.php?id=" + id, true);
  r.send();
}

function pending() {
  var pen = document.getElementById("pending");
  var fin = document.getElementById("finished");

  pen.classList = "col-lg-8 col-md-8 col-12 p-3";
  fin.classList = "col-lg-8 col-md-8 col-12 p-3 d-none";
}
function finished() {
  var pen = document.getElementById("pending");
  var fin = document.getElementById("finished");

  pen.classList = "col-lg-8 col-md-8 col-12 p-3 d-none";
  fin.classList = "col-lg-8 col-md-8 col-12 p-3";
}

function payNow(id) {
  var qty = document.getElementById("qty_input").value;
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      var obj = JSON.parse(response);

      var mail = obj["umail"];
      var amount = obj["amount"];
      var uid = obj["uid"];

      if (response == 1) {
        alert("Please Login.");
        window.location = "home.php";
      } else if (response == 2) {
        alert("Please update your profile.");
        window.location = "profile.php";
      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          // alert("Payment completed. OrderID:" + orderId);
          saveInvoice(orderId, id, mail, uid, amount, qty);
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
          merchant_id: obj["mid"], // Replace your Merchant ID
          return_url: "http://localhost/eshop/singleProductView.php?id=" + id, // Important
          cancel_url: "http://localhost/eshop/singleProductView.php?id=" + id, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount + ".00",
          currency: "LKR",
          hash: obj["hash"], // *Replace with generated hash retrieved from backend
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

function saveInvoice(orderId, id, mail, uid, amount, qty) {
  var form = new FormData();
  form.append("o", orderId);
  form.append("i", id);
  form.append("m", mail);
  form.append("a", amount);
  form.append("q", qty);
  form.append("u", uid);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "saveInvoiceProcess.php", true);
  request.send(form);
}

function printInvoice() {
  var restorePage = document.body.innerHTML;
  var page = document.getElementById("invoice").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorePage;
}

var vm;
function adminsignin() {
  var email = document.getElementById("floatingInput");

  var f = new FormData();
  f.append("email", email.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert("Verification Code sent to your email.");
        var m = document.getElementById("verify");
        vm = new bootstrap.Modal(m);
        vm.show();
      }
    }
  };
  r.open("POST", "adminSignin.php", true);
  r.send(f);
}

function adminverification() {
  var code = document.getElementById("vericode");

  var f = new FormData();
  f.append("code", code.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        alert("Login Success");
        window.location = "adminHome.php";
      }
    }
  };
  r.open("POST", "adminSigninProcess.php", true);
  r.send(f);
}

function logout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "admin.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "adminSignoutProcess.php", true);
  r.send();
}

function loadDashboardContent(page) {
  var r = new XMLHttpRequest();
  r.open("GET", page + ".php", true);
  r.onreadystatechange = function () {
    if (r.readyState == 4 && r.status == 200) {
      document.getElementById("dashboard-content").innerHTML = r.responseText;
    }
  };
  r.send();
}

function deliveryStatus(order_id, x) {
  var select = document.getElementById("deliState" + x);

  var f = new FormData();
  f.append("select", select.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("Delivery Status Update Successful.");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "updateDeliStaus.php?id=" + order_id, true);
  r.send(f);
}

function search() {
  var category = document.getElementById("category");
  var city = document.getElementById("city");
  var condition = document.getElementById("condition");
  var fromPrice = document.getElementById("fromPrice");
  var toPrice = document.getElementById("toPrice");
  var searchText = document.getElementById("searchText");

  var f = new FormData();
  f.append("category", category.value);
  f.append("city", city.value);
  f.append("condition", condition.value);
  f.append("fromPrice", fromPrice.value);
  f.append("toPrice", toPrice.value);
  f.append("searchText", searchText.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("categorysearch").innerHTML = t;
    }
  };

  r.open("POST", "advancedSearch.php", true);
  r.send(f);
}

function confirm(order_id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("Now you have Confirmed your Item has recived.");
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "confirmProcess.php?id=" + order_id, true);
  r.send();
}

function blockUser(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "blocked") {
        alert("User Blocked Successfully");
        document.getElementById("ub" + id).innerHTML = "Unblock";
        document.getElementById("ub" + id).classList =
          "btn btn-success rounded-0 col-12";
      } else if (t == "unblocked") {
        alert("User Released Successfully");
        document.getElementById("ub" + id).innerHTML = "Block";
        document.getElementById("ub" + id).classList =
          "btn btn-danger rounded-0 col-12";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "userBlockProcess.php?id=" + id, true);
  r.send();
}

function blockProduct(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "blocked") {
        alert("Product Blocked Successfully");
        document.getElementById("ub" + id).innerHTML = "Unblock";
        document.getElementById("ub" + id).classList =
          "btn btn-success rounded-0 col-12";
      } else if (t == "unblocked") {
        alert("Product Released Successfully");
        document.getElementById("ub" + id).innerHTML = "Block";
        document.getElementById("ub" + id).classList =
          "btn btn-danger rounded-0 col-12";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "productBlockProcess.php?id=" + id, true);
  r.send();
}

function userSearch() {
  var text = document.getElementById("searchUser");

  var f = new FormData();
  f.append("text", text.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t);
      document.getElementById("userRow").innerHTML = t;
    }
  };

  r.open("POST", "searchUserProcess.php", true);
  r.send(f);
}

function productSearch() {
  var text = document.getElementById("searchProduct");

  var f = new FormData();
  f.append("text", text.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      // alert(t);
      document.getElementById("productRow").innerHTML = t;
    }
  };

  r.open("POST", "searchProductProcess.php", true);
  r.send(f);
}

function changeAdminImage() {
  var img = document.getElementById("proImg");

  img.onchange = function () {
    var fileCo = img.files.length;
    if (fileCo <= 1) {
      for (var x = 0; x < fileCo; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("p" + x).src = url;
      }
    } else {
      alert(fileCo + "File Limit Exceeded. You can upload only 4 Images.");
    }
  };
}

function updateAdmin() {
  // alert("OK");
  var fname = document.getElementById("admf");
  var lname = document.getElementById("adml");
  var mob = document.getElementById("admm");
  var img = document.getElementById("proImg");

  var f = new FormData();
  f.append("admf", fname.value);
  f.append("adml", lname.value);
  f.append("admm", mob.value);

  var file_count = img.files.length;

  for (var x = 0; x < file_count; x++) {
    f.append("img" + x, img.files[x]);
  }
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
    }
  };
  r.open("POST", "adminProfileProcess.php", true);
  r.send(f);
}

function viewProductModal(productId) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t.error) {
        alert(t.error);
      } else {
        document.getElementById("promode").innerHTML = t;

        var modal = new bootstrap.Modal(document.getElementById("promodel"));
        modal.show();
      }
    }
  };
  r.open("GET", "productModel.php?id=" + productId, true);
  r.send();
}

// document.addEventListener("DOMContentLoaded", (event) => {
//   const stars = document.querySelectorAll(".star");
//   let rating = 0;

//   stars.forEach((star) => {
//     star.addEventListener("click", function () {
//       rating = this.getAttribute("data-value");
//       document.getElementById("rating").value = rating;

//       stars.forEach((s) => {
//         s.classList.remove("selected");
//       });

//       for (let i = 0; i < rating; i++) {
//         stars[i].classList.add("selected");
//       }
//     });
//   });
// });

function backup() {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
    }
  };
  r.open("POST", "backup.php", true);
  r.send();
}
