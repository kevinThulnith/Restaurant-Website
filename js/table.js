// table search bar
document.getElementById("search").addEventListener("input", function () {
  let filter = this.value.toLowerCase().replace(/\s+/g, "");

  const tableRows = document
    .querySelector(".table-data")
    .querySelectorAll(".table-row")
    .forEach((row) => {
      // Find the cell with the brand name
      const cell1 = row.querySelector(".table-cell:nth-child(1)");
      const cell1Value = cell1
        ? cell1.innerText.toLowerCase().replace(/\s+/g, "")
        : "";

      const cell2 = row.querySelector(".table-cell:nth-child(2)");
      const cell2Value = cell2
        ? cell2.innerText.toLowerCase().replace(/\s+/g, "")
        : "";

      // Check if both cells include the search term
      if (cell1Value.includes(filter) || cell2Value.includes(filter))
        row.classList.remove("blow");
      else row.classList.add("blow");
    });

  if (
    document.querySelector(".table-data").querySelectorAll(".table-row")
      .length == document.querySelectorAll(".blow").length
  )
    document.querySelector(".table-row-mt").classList.remove("freak");
  else document.querySelector(".table-row-mt").classList.add("freak");
});

// form controll
document.getElementById("btt1").addEventListener("click", () => {
  document.querySelector(".popup").classList.remove("hide");
});

document.querySelector(".xmark").addEventListener("click", () => {
  document.querySelector(".popup").classList.add("hide");
  document.querySelector(".message").classList.add("pop");
});

// show uploaded photo
let input = document.getElementById("image_input");
let inputDisplay = document.querySelector(".display");
let imageInput = "";

input.addEventListener("change", function () {
  const render = new FileReader();
  render.addEventListener("load", () => {
    imageInput = render.result;
    inputDisplay.src = imageInput;
  });
  render.readAsDataURL(this.files[0]);
});
