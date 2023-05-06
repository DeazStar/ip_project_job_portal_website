const realFileBtn = document.querySelector(".resume-upload");
const customFIleBtn = document.querySelector(".upload-file-btn");
const output = document.querySelector('.file-name');

customFIleBtn.addEventListener("click", () => {
    realFileBtn.click();
})

realFileBtn.addEventListener("change", () => {
    if (realFileBtn.value) {
        output.textContent = "";
        let fileName = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/);
        output.innerHTML =  '<i class="bi bi-check2-circle pe-3"></i>' + fileName;
    }
})