// menu page search bar
document.getElementById("search").addEventListener("input", function () {
  let filter = this.value.toUpperCase().replace(/\s+/g, "");

  document.querySelectorAll(".menus").forEach((div) => {
    if (
      div
        .querySelector("h3")
        .textContent.toUpperCase()
        .replace(/\s+/g, "")
        .indexOf(filter) === -1
    )
      div.classList.add("ghost");
    else div.classList.remove("ghost");
  });

  document.querySelectorAll(".menu-wrap").forEach((itm) => {
    if (
      itm.querySelectorAll(".menus").length ===
      itm.querySelectorAll(".ghost").length
    )
      itm.classList.add("freak");
    else itm.classList.remove("freak");
  });
});
