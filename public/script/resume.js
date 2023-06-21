import {fields, languageJson, skillJson, universities} from './data.js';

const realLanguageInput = document.querySelector(".language-input");
const realLanguageSubmitBtn = document.querySelector(".language-submit-btn");
const addLanguage = document.querySelector(".add-language");
const languageDialog = document.querySelector(".language-dialog");
const background = document.querySelector(".background");
const closeBtn = document.querySelector(".close-btn-container");
const languageInput = document.querySelector(".fake-language-input");
const languageContainer = document.querySelector(".language-input-container");
const selectedLanguageParent = document.querySelector(".lang-selected-items");
const saveLanguage = document.querySelector(".save-lng");

const realSkillInput = document.querySelector(".skill-input");
const realSkillSubmitBtn = document.querySelector(".skill-submit-btn");
const addSkill = document.querySelector(".add-skill");
const skillDialog = document.querySelector(".skill-dialog");
const skillCloseBtn = document.querySelector(".skill-close-btn-container");
const skillInput = document.querySelector(".fake-skill-input");
const skillContainer = document.querySelector(".skill-input-container");
const selectedSkillParent = document.querySelector(".skill-selected-items");
const saveSkill = document.querySelector(".save-skill");

const filedType = document.querySelector(".field");
const institute = document.querySelector(".institute-input-container");
const instituteInput = document.querySelector(".institute-input");
const educationForm = document.querySelector(".education-form");
const enrollDateContainer = document.querySelector(".enrolled-date");
const graduatedDateContainer = document.querySelector(".graduated-date");
const addEducation = document.querySelector(".add-education");
const educationCloseBtn = document.querySelector(".education-close-btn-container");
const educationDialog = document.querySelector(".education-dialog");

const educationEditBtn = document.querySelector(".education-edit-btn");
const educationOperationType = document.querySelector(".education-operation");
const educationLevel = document.querySelector(".education-level");
const degreeTypeSelect = document.querySelector(".degree-type");
const instituteText = document.querySelector(".institute");
const year = document.querySelectorAll(".year");

const startedDateContainer = document.querySelector(".started-date");
const endDateContainer = document.querySelector(".end-date");

const employmentCloseBtn = document.querySelector(".employment-close-btn-container");
const employmentDialog = document.querySelector(".employment-dialog");
const addEmployment = document.querySelector(".add-employment");

const employmentOperationType = document.querySelector(".employment-operation");
const employmentEditBtn = document.querySelector('.employment-edit-btn');
const position = document.querySelector('.position');
const company = document.querySelector('.company');
const positionInput = document.querySelector('.position-input');
const companyInput = document.querySelector('.company-input');
const startDate = document.querySelector('.started-date');
const endDate = document.querySelector('.end-date');


window.addEventListener("DOMContentLoaded", () => {
    fields.fields.forEach(field => {
        const selection = document.createElement("option");
        selection.textContent = field;
        selection.value = field;
        filedType.appendChild(selection);
    });

    for(let i = 1970; i < 2025; i++) {
        const enrolledDateSelect = document.createElement("option");
        enrolledDateSelect.textContent = i;
        enrolledDateSelect.value = i;

        const startedDateOption = enrolledDateSelect.cloneNode(true);
        const endDateOption = enrolledDateSelect.cloneNode(true);

        enrollDateContainer.appendChild(enrolledDateSelect);
        startedDateContainer.appendChild(startedDateOption);
        endDateContainer.appendChild(endDateOption);
    }

    for (let i = 1970; i < 2040; i++) {
        const graduatedDateSelect = document.createElement("option");
        graduatedDateSelect.textContent = i;
        graduatedDateSelect.value = i;
        graduatedDateContainer.append(graduatedDateSelect);

    }
});

addEducation.addEventListener("click", () => {
    educationDialog.classList.add("dialog-visible");
    background.classList.add("dialog-visible");
});

addEmployment.addEventListener("click", () => {
    employmentDialog.classList.add("dialog-visible");
    background.classList.add("dialog-visible");
})

if(educationEditBtn != null) {
    educationEditBtn.addEventListener("click", () => {
        educationDialog.classList.add("dialog-visible");
        background.classList.add("dialog-visible");
        educationOperationType.value = "update";
        let educationLevelArray = educationLevel.textContent.split(' ');
        let degreeType = educationLevelArray[0];
        degreeType = degreeType.charAt(0).toLowerCase() + degreeType.slice(1);
        let field = ""
        for (let i = 2; i < educationLevelArray.length; i++) {
            if (i === educationLevelArray.length - 1) {
                field += educationLevelArray[i];
            } else {
                field += educationLevelArray[i] + " ";
            }
        }
    
        let yearArray = year[0].textContent.split('-');
        degreeTypeSelect.value = degreeType;
        filedType.value = field;
        instituteInput.value = instituteText.textContent;
        enrollDateContainer.value = yearArray[0];
        graduatedDateContainer.value = yearArray[1];
    
    });
}

if (employmentEditBtn != null) {
    employmentEditBtn.addEventListener("click", () => {
        employmentDialog.classList.add("dialog-visible");
        background.classList.add("dialog-visible");
        employmentOperationType.value = "update";
        companyInput.value = company.textContent;
        positionInput.value = position.textContent;
        
        let yearArray = year[0].textContent.split('-');
        startDate.value = yearArray[0];
        endDate.value = yearArray[1];
    })
}

educationCloseBtn.addEventListener("click", () => {
    educationDialog.classList.remove("dialog-visible");
    background.classList.remove("dialog-visible");

    if(educationOperationType.value === "update") {
        degreeTypeSelect.selectedIndex = -1;
        filedType.selectedIndex = -1;
        instituteInput.value = "";
        enrollDateContainer.selectedIndex = -1;
        graduatedDateContainer.selectedIndex = -1;
    }
});

employmentCloseBtn.addEventListener("click", () => {
    employmentDialog.classList.remove("dialog-visible");
    background.classList.remove("dialog-visible");

    if (employmentOperationType.value = "update") {
        startDate.selectedIndex = -1;
        endDate.selectedIndex = -1;
        companyInput.value = "";
        positionInput.value = "";
        employmentOperationType.value = "insert";
    }
})

educationForm.addEventListener("submit", (event) => {
    if(event.target.classList.contains("institute-suggest")) {
        event.preventDefault();
        console.log("not sending");
    }
})
instituteInput.addEventListener("input", () => {
    removeInstitute();
    universities.universities.forEach((university) => {
        if(university.substring(0, instituteInput.value.length).toLowerCase() === instituteInput.value.toLowerCase() && instituteInput.value.length > 0) {
            let suggestBtn = document.createElement("button");
            suggestBtn.textContent = university;
            suggestBtn.classList.add("institute-suggest");
            institute.appendChild(suggestBtn);
        }

    });

    selectInstitute();
});

function selectInstitute() {
    const list = document.querySelectorAll(".institute-suggest");

    list.forEach((listElement) => {
        listElement.addEventListener("click", (event) => {
            event.preventDefault();
            instituteInput.value = "";
            instituteInput.value = listElement.textContent;
        })
    })
}


function removeInstitute() {
    const list = document.querySelectorAll(".institute-suggest");
    list.forEach((listElement) => {
        listElement.remove();
    });

    console.log("remove");
}

let languageArray = [];
let skillArray = [];

saveLanguage.addEventListener("click", () => {
    realLanguageInput.value = languageArray;
    realLanguageSubmitBtn.click();
})

saveSkill.addEventListener("click", () => {
    realSkillInput.value= skillArray;
    realSkillSubmitBtn.click();
});

addLanguage.addEventListener("click", () => {
    languageDialog.classList.add("dialog-visible");
    background.classList.add("dialog-visible");
});

addSkill.addEventListener("click", () => {
    skillDialog.classList.add("dialog-visible");
    background.classList.add("dialog-visible");
})


closeBtn.addEventListener("click" , () => {
    background.classList.remove("dialog-visible");
    languageDialog.classList.remove("dialog-visible");
});

skillCloseBtn.addEventListener("click", () => {
    background.classList.remove("dialog-visible");
    skillDialog.classList.remove("dialog-visible");
})

const language = Object.values(languageJson).map(lang => lang.name);

const skills = Object.values(skillJson).map(skill => skill.name);


languageInput.addEventListener("input", () => {
    removeDropDown();
    language.forEach((lang) => {
        if(lang.substring(0, languageInput.value.length).toLowerCase() === languageInput.value.toLowerCase() && languageInput.value.length > 0) {
            let suggestBtn = document.createElement("button");
            suggestBtn.textContent = lang;
            suggestBtn.classList.add("language-btn");
            suggestBtn.classList.add("select-btn");
            suggestBtn.classList.add("text-start");
            languageContainer.appendChild(suggestBtn);
        }
    });

    selectSuggestedLanguage();
});


skillInput.addEventListener("input", () => {
    removeSkillDropDown();

    skills.forEach((skill) => {
        if(skill.substring(0, skillInput.value.length).toLowerCase() === skillInput.value.toLowerCase() && skillInput.value.length > 0) {
            let suggestBtn = document.createElement("button");
            suggestBtn.textContent = skill;
            suggestBtn.classList.add("skill-btn");
            suggestBtn.classList.add("select-btn");
            suggestBtn.classList.add("text-start");
            skillContainer.appendChild(suggestBtn);
        }
    });

    selectSuggestedSkill();
});


function removeDropDown() {
    const list = document.querySelectorAll(".language-btn");
    list.forEach((listElement) => {
        listElement.remove();
    });
}

function removeSkillDropDown() {
    const list = document.querySelectorAll(".skill-btn");
    list.forEach((listElement) => {
        listElement.remove();
    })
}


function selectSuggestedLanguage() {
    const suggestLanguage = document.querySelectorAll(".language-btn");

    suggestLanguage.forEach((lang) => {
        lang.addEventListener("click", () => {
            let selectedLanguage = document.createElement("div");
            selectedLanguage.textContent = lang.textContent;
            selectedLanguage.classList.add("col-2");
            selectedLanguage.classList.add("pin");
            selectedLanguage.classList.add("text-center");
            selectedLanguage.classList.add("rounded");
            selectedLanguageParent.appendChild(selectedLanguage);
            languageArray.push(lang.textContent);
        });
    });
}

function selectSuggestedSkill() {
    const suggestSkill = document.querySelectorAll(".skill-btn");

    suggestSkill.forEach((skill) => {
        skill.addEventListener("click" , () => {
            let selectedSkill = document.createElement("div");
            selectedSkill.textContent = skill.textContent;
            selectedSkill.classList.add("col-2");
            selectedSkill.classList.add("pin");
            selectedSkill.classList.add("text-center");
            selectedSkill.classList.add("rounded");
            selectedSkillParent.appendChild(selectedSkill);
            skillArray.push(skill.textContent);
        })
    })
}

