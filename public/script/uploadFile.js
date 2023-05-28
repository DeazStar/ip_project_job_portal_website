const realFIleUploadInput = document.querySelector(".resume-upload");
const realFileUploadBtn = document.querySelector(".resume-upload-button");
const fileUploadInput = document.querySelector(".upload-file-btn");
const fileNameDisplay = document.querySelector(".file-name");
const fileUploadBtn = document.querySelector(".resume-btn");
const profileImage = document.querySelector(".profile-image");
const profileImageUploadInput = document.querySelector(".profile-picture-input");
const profileImageUploadBtn = document.querySelector(".profile-picture-upload-btn");

fileUploadInput.addEventListener("click", () => {
    realFIleUploadInput.click();
})


realFIleUploadInput.addEventListener("change", () => {
    let fileName = realFIleUploadInput.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/);
    fileNameDisplay.innerHTML = '<i class="bi bi-check2-circle pe-3"></i>' + fileName[1];
})


fileUploadBtn.addEventListener("click", (e) => {
    e.preventDefault();
    realFileUploadBtn.click();
})


profileImage.addEventListener("click", () => {
    profileImageUploadInput.click();
});

profileImageUploadInput.addEventListener("change", () => {
    profileImageUploadBtn.click();
})

