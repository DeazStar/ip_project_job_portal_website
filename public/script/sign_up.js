
        // function handleCredentialResponse(response) {
        //   console.log("Encoded JWT ID token: " + response.credential);
        // }
        // window.onload = function () {
        //   google.accounts.id.initialize({
        //     client_id: "YOUR_GOOGLE_CLIENT_ID",
        //     callback: handleCredentialResponse
        //   });
        //   google.accounts.id.renderButton(
        //     document.getElementById("buttonDiv"),
        //     { theme: "outline", size: "large" }  // customization attributes
        //   );
        //   google.accounts.id.prompt(); // also display the One Tap dialog
        // }

        const labels=document.querySelectorAll('.form_control label')

        labels.forEach(label=>{
            label.innerHTML=label.innerText
            .split('')
            .map((letter, idx) => `<span 
            style="transition-delay: ${idx * 50}ms">${letter}</span>`)
            .join('')
          })
          // $(function() {
          //   $( ".calendar" ).datepicker({
          //     dateFormat: 'dd/mm/yy',
          //     firstDay: 1
          //   });
            
          //   $(document).on('click', '.date-picker .input', function(e){
          //     var $me = $(this),
          //         $parent = $me.parents('.date-picker');
          //     $parent.toggleClass('open');
          //   });
            
            
          //   $(".calendar").on("change",function(){
          //     var $me = $(this),
          //         $selected = $me.val(),
          //         $parent = $me.parents('.date-picker');
          //     $parent.find('.result').children('span').html($selected);
          //   });
          // });

          // var checkboxes = document.querySelectorAll('input[type="checkbox"]');
          
          // var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);



const form = document.getElementById('form');
const f_name = document.getElementById('f_name');
const l_name = document.getElementById('l_name');
const email = document.getElementById('email');
const remail = document.getElementById('remail');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const tel = document.getElementById('tel')

form.addEventListener('submit', e => {
    e.preventDefault();

    validateInputs();

    console.log("it works");
});

const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    // errorDisplay.innerHTML = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerHTML = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};

const isValidEmail = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
const isValidRemail = remail => {
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(remail).toLowerCase());
}

function validateInputs() {
    const f_nameValue = f_name.value.trim();
    const l_nameValue = l_name.value.trim();
    const emailValue = email.value.trim();
    const remailValue = remail.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    const telValue= tel.value.trim();
    var phoneno = /^\d{10}$/;

    // if(tel.value.match(phoneno))
    //     {
    //   setSuccess(tel);
    //     }
    //   else
    //     {
    //     alert("message");
    //     setError(tel,'Enter the right format')
    //     }

    if(f_nameValue === '') {
        setError(f_name, 'Name is required');
        // alert("Name is re")
    } else {
        setSuccess(f_name);
    }
    if(l_nameValue === '') {
      setError(l_name, 'Name is required');
  } else {
      setSuccess(l_name);
  }

    if(emailValue === '') {
        setError(email, 'Email is required');
    } else if (!isValidEmail(emailValue)) {
        setError(email, 'Provide a valid email address');
    } else {
        setSuccess(email);
    }

    if(remailValue === '') {
      setError(remail, 'Email is required');
  } else if (!isValidRemail(remailValue)) {
      setError(remail, 'Provide a valid email address');
  } else {
      setSuccess(remail);
  }

    if(passwordValue === '') {
        setError(password, 'Password is required');
    } else if (passwordValue.length < 8 ) {
        setError(password, 'Password must be at least 8 character.')
    } else {
        setSuccess(password);
    }

    if(password2Value === '') {
        setError(password2, 'Please confirm your password');
    } else if (password2Value !== passwordValue) {
        setError(password2, "Passwords doesn't match");
    } else {
        setSuccess(password2);
    }

};