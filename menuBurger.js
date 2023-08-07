// Menu burger

const mobileMenuButton = document.getElementById("mobile-menu");
const navList = document.querySelector(".mobile-nav-list");

mobileMenuButton.addEventListener("click", () => {
    navList.classList.toggle("active");
});
