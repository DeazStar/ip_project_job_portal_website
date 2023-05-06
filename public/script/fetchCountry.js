document.addEventListener('DOMContentLoaded', ()=> {
    var dropdown = document.getElementById('country');
    var output = '';
    getData().then(response => {
        for (let i = 0; i < response.length; i++) {
            output += `<option value=${response[i].name.common}>${response[i].name.common}</option>`;
        }

        dropdown.innerHTML =  output;
    }).catch(error => {
        console.log("Server Error")
    })

});


async function getData() {
    const url = 'https://restcountries.com/v3.1/all?fields=name';
    let data;
    try {
        const response = await fetch(url);
        data = await response.json();
    } catch (err) {
        console.log('server error');
    }

    return data;
}