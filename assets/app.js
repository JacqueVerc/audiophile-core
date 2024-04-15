/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.scss";

console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");

// const headerMenu = document.querySelector('.header-menu');

// headerMenu.addEventListener('click', () => {
//   console.log('header menu clicked');
// });

const menu = document.querySelector(".header-menu");
const showMenu = document.querySelector(".header-menu-bg");

menu.addEventListener("click", () => {
  menu.classList.toggle("active");
  showMenu.classList.toggle("active");
});

// Get the modal (nécessite une meilleure organisation du code)
const modal = document.getElementById("myModal");
const btn = document.getElementById("myBtn");
const span = document.querySelector(".close");

//  Open the modal
btn.onclick = () => {
  modal.style.display = "block";
};

// Close the modal
span.onclick = () => {
  modal.style.display = "none";
};

window.onclick = (event) => {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
