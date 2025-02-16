// upload image
let imageInput = "";

document.getElementById("uimagetag").addEventListener("change", function () {
  const render = new FileReader();
  render.addEventListener("load", () => {
    imageInput = render.result;
    document.getElementById("uimage").style.backgroundImage =
      "url(" + imageInput + ")";
  });
  render.readAsDataURL(this.files[0]);
});
