/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import "./styles/app.scss";

console.log("This log comes from assets/app.js - welcome to AssetMapper! 🎉");

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
if (btn) {
  btn.onclick = () => {
    modal.style.display = "block";
  };
}

// Close the modal
if (span) {
  span.onclick = () => {
    modal.style.display = "none";
  };
}

if (modal) {
  window.onclick = (event) => {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
}

// Modal pour le panier
const modalCart = document.querySelector(".header-cart");
const showCart = document.querySelector(".modal-cart");
const parentCart = document.getElementById("cartModal");

modalCart.addEventListener("click", () => {
  modalCart.classList.toggle("show");
  showCart.classList.toggle("show");
});

parentCart.addEventListener("click", () => {
  if (modalCart.classList.contains("show")) {
    modalCart.classList.remove("show");
    showCart.classList.remove("show");
  }
});
