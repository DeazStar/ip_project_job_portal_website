document.addEventListener('DOMContentLoaded', () => {
    const dropDown = document.getElementById('country');
    fetch('https://restcountries.com/v3.1/all?fields=name').then(response => {
        return response.json();
    }).then(data => {
        let output = '';
        console.log(data);
        data.forEach(country => {
            output += `<option>${country.name.common}</option>`;
        });

        dropDown.innerHTML = output;


    }).catch(err => {
        console.log(err);
    })
  
});

