window.addEventListener("DOMContentLoaded", () => {
  let btn = document.querySelector(".btn");
  let panel = document.querySelector(".container");
  let close = document.querySelector(".close");

  btn.addEventListener("click", () => {
    panel.classList.add("active");
  });

  close.addEventListener("click", () => {
    panel.classList.remove("active");
  });
});
