//https://restcountries.com/v3.1/all?fields=languages

async function getLanguageData() {
    const languageList = await fetch("https://restcountries.com/v3.1/all?fields=languages");
    const languageUnfiltered = await languageList.json();


    console.log(languageUnfiltered);
}

getLanguageData();

console.log('it works');