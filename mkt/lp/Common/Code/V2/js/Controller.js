	var _genericErrorMessage = "An error has occurred. Please try again later.";

	function setGenericErrorMessage(content) {
		_genericErrorMessage = content;
	}

	function getGenericErrorMessage() {
		return _genericErrorMessage;
	}

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
		
	function validateInput(formElement)
	{
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

			var url = "https://www.finq.com/mkt/lp/Common/Code/API/LeadSubmit.php";
			
			var formSerialize = $('form').serialize();
			
			$.ajax({
				   type: "POST",
				   url: url,
				   data: formSerialize,
				   success: function(response)
				   {
					   if(response.success === true)
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
						console.log(xhr.status);
						console.log(thrownError);
					}
				 });

			e.preventDefault(); // avoid to execute the actual submit of the form.
		});
		
		function redirectUser(url)
		{
			top.window.location = url;
		}		

		$("input").focusout(function(){
			validateFormElement($(this).attr("id"));
		});	
	});