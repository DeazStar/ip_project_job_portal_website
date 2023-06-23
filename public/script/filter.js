const button = document.querySelectorAll(".btn-lf");
const options = document.querySelectorAll(".opt");
const logOutBtn = document.querySelector(".logout-btn");

logOutBtn.addEventListener('click', () => {
    window.location.href = "../src/controller/logoutController.php";
});

function filter(catagories) {
    options.forEach(opt => {
        opt.classList.remove("is-visible");
    })
    options.forEach(opt => {
        if (opt.classList.contains(catagories)) {
            opt.classList.add("is-visible");
        }
    });
}


button.forEach(btn => {
    btn.addEventListener("click", () => {
        let clikedBtn = document.querySelector(".is-clicked");
        clikedBtn.classList.remove("is-clicked");

        btn.classList.add("is-clicked");
        filter(btn.dataset.filter);
    })
})