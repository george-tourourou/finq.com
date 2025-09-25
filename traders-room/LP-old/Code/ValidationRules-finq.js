 function formValidation() {		
		var isValid = true;
		var domElementID = "";
		
		var domElements = ['fname', 'lname', 'email', 'phone', 'phone2'];
		
		var len = domElements.length;
		
		for(var i = 0; i < len; i++)
		{
			var ans = validateFormElement(domElements[i]);
			
			if(ans === false)
			{
				isValid = false;
			}
		}
		
		return isValid;
	}
		
function validateInput(formElement){
		var element = document.getElementById(formElement);
		var hasError = false;
		if (element.validity.valueMissing || element.validity.patternMismatch) 
		{
			hasError = true;
		}

        if( formElement == "email"  && navigator.userAgent.match(/Trident/i)){
            if (element.value.indexOf('@.') > 0 || element.value.indexOf('@.') > 0 || element.value.indexOf('.@') > 0){
                hasError = true;
            }
        }else {
            if (formElement == "email" && (element.value.includes("..") || element.value.includes("@.") || element.value.includes(".@"))) {
                hasError = true;
            }
        }
		return hasError;
	}
		
	function validateFormElement(formElement)
	{			
		var hasError = validateInput(formElement);

		if(hasError)
		{
			showError(formElement);				
			return false;
		}
		else
		{
			hideError(formElement);
		}
		
		return true;
		
		function showError(formElement)
		{
			$('#' + formElement + "Error").show(200);
		}
		
		function hideError(formElement)
		{
			$('#' + formElement + "Error").hide(200);
		}
	}
		
	$(document).ready(function(){
		$("a.smoothScroll").on('click', function(event) 
		{			
			if (this.hash !== "") 
			{
				var hash = this.hash;

				$('html, body').animate(
				{
					scrollTop: $(hash).offset().top
				}, 
				800, 
				function(){
					window.location.hash = hash;
				});
			}
		});

		$('#submitForm').click(function(e)
		{	
			var isFormValid = formValidation();						
			
			if(!isFormValid)
			{
				return false;
			}
			
			$('html, body').animate({
				scrollTop: 0
			}, 800);
			
			$('#popup-proccess-window').show();

			var url = "https://www.finq.com/traders-room/LP/Code/SubmitFormV2.php"; // the script where you handle the form input. 
			
			$.ajax({
				   type: "POST",
				   url: url,
				   data: $('form').serialize(), // serializes the form's elements.
				   success: function(response)
				   {					   
					   if(response.hasError == "false")
					   {
						   setTimeout(redirectUser(response.redirect), 5000);
					   }
					   else
					   {
						    $('#apiError').text(response.error).show();
							$('#popup-proccess-window').hide();
					   }
				   },
				  error: function (xhr, ajaxOptions, thrownError) {
					$('#apiError').show();
					$('#popup-proccess-window').hide();
				  }
				 });

			e.preventDefault(); // avoid to execute the actual submit of the form.
		});
		
		function redirectUser(url)
		{
			window.location = url;
		}		

		
		$("input").focusout(function(){
			validateFormElement($(this).attr("id"));
		});	
	});