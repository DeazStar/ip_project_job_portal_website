const hamburgerBtn = document.querySelector(".hamburger");
const mobileNaviagtion = document.querySelector(".mobile-link-container");
const closeBtn = document.querySelector(".close-btn");

hamburgerBtn.addEventListener("click", () => {
    mobileNaviagtion.classList.add("is-active");
});

closeBtn.addEventListener("click", () => {
    mobileNaviagtion.classList.remove("is-active");
})
