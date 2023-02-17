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
           
          var email=document.forms['form'] ['email'];
          var password=document.forms['form'] ['password'];

          var email_error=document.getElementById('email_error');
          var pass_error=document.getElementById('pass_error');
function validate()
{
    if (email.value.length < 9) {
		email.style.border = "1px solid red";
		email_error.style.display = "block";
		email.focus();
		return false;
	}
	if (password.value.length < 6) {
		password.style.border = "1px solid red";
		pass_error.style.display = "block";
		password.focus();
		return false;
	}
}
function email_Verify(){
	if (email.value.length >= 8) {
		email.style.border = "1px solid silver";
		email_error.style.display = "none";
		return true;
	}
}
function pass_Verify(){
	if (password.value.length >= 5) {
		password.style.border = "1px solid silver";
		pass_error.style.display = "none";
		return true;
	}
}
