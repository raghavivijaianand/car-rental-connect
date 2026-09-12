let details = new URLSearchParams(window.location.search);

let carName = details.get("car") || "Maruti Swift";
let perKmRate = Number(details.get("rate")) || 12;

let carInfo = document.getElementById("carInfo");

if (carInfo) {
  carInfo.innerHTML = carName + " - ₹" + perKmRate + " Per KM";
}

function calculatePrice() {
  let distance = Number(document.getElementById("distance").value);

  if (distance <= 0) {
    alert("Please enter distance in KM");
    return;
  }

  let total = 500 + (distance * perKmRate);

  document.getElementById("total").innerHTML =
    "Total Rental Amount: ₹" + total;
}

function adminLogin() {
  let username = document.getElementById("username").value;
  let password = document.getElementById("password").value;
  let loginMessage = document.getElementById("loginMessage");

  if (username === "admin" && password === "1234") {
    window.location.href = "admin.php";
  } else {
    loginMessage.innerHTML = "Wrong username or password!";
  }
}