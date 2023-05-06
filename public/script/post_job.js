const labels=document.querySelectorAll('.form_control label')

        labels.forEach(label=>{
            label.innerHTML=label.innerText
            .split('')
            .map((letter, idx) => `<span 
            style="transition-delay: ${idx * 50}ms">${letter}</span>`)
            .join('')
          })
          $(function() {
            $( ".calendar" ).datepicker({
              dateFormat: 'dd/mm/yy',
              firstDay: 1
            });
            
            $(document).on('click', '.date-picker .input', function(e){
              var $me = $(this),
                  $parent = $me.parents('.date-picker');
              $parent.toggleClass('open');
            });
            
            
            $(".calendar").on("change",function(){
              var $me = $(this),
                  $selected = $me.val(),
                  $parent = $me.parents('.date-picker');
              $parent.find('.result').children('span').html($selected);
            });
          });