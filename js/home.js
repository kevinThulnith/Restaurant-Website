//navbar configuration
document.getElementById("user").addEventListener("click", () => {
  document.getElementById("userbar").classList.add("active");
});

document.getElementById("asd").addEventListener("click", () => {
  document.getElementById("userbar").classList.remove("active");
});

// add buttons, funtionality to food items,
document.querySelectorAll(".menus").forEach((fd) => {
  let btt = document.createElement("button");
  btt.innerHTML = "<i class='fa-solid fa-angles-up'>";
  fd.appendChild(btt);
  btt.addEventListener("click", () => {
    document.querySelector(".contrt").querySelector("h1").innerHTML =
      fd.querySelector("h3").innerHTML;
    document.querySelector(".contrt").querySelector("h3").innerHTML =
      fd.querySelector(".price").innerHTML;
    document.querySelector(".contrt").querySelector("p").innerHTML =
      fd.querySelector("p").innerHTML;
    let rt = document.querySelector(".contrt").querySelector(".image");
    let tr = fd.querySelector(".img");
    rt.style.backgroundImage = tr.style.backgroundImage;
    document.querySelector(".contrt").classList.remove("hide");
    document.getElementById("form-id").value = fd.querySelector(".p-id").value;
    document.getElementById("form-name").value =
      fd.querySelector("h3").innerHTML;
    document.getElementById("form-price").value = parseFloat(
      fd.querySelector(".price").innerHTML.replace(/[^0-9.-]+/g, "")
    ).toFixed(2);
    console.log(document.getElementById("form-price").value);
  });
});

let noi = document.getElementById("noi");
let form_noi = document.getElementById("form-noi");

// reset values and hide popup
document.querySelector(".xmark").addEventListener("click", () => {
  document.querySelector(".contrt").classList.add("hide");
  noi.value = 1;
  form_noi.value = 1;
});

// decrease values
document.getElementById("mnsBtt").addEventListener("click", () => {
  if (parseInt(noi.value) > 1) {
    noi.value = parseInt(noi.value) - 1;
    form_noi.value = parseInt(form_noi.value) - 1;
  } else alert("Minimum number of items is 1");
});

// increse values
document.getElementById("plsBtt").addEventListener("click", () => {
  if (parseInt(noi.value) < 20) {
    noi.value = parseInt(noi.value) + 1;
    form_noi.value = parseInt(form_noi.value) + 1;
  } else alert("Cant add mor than 20");
});

// disable hyperlink
function disableLink(event) {
  event.preventDefault();
  // onclick="disableLink(event)"
}
