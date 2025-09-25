window.addEventListener('message', widget_comunicator_callback, false);
	
	//jQuery('#mte_course_demo').hide();
	//jQuery('#mte_course_live').hide();
	
	if (window.location.search){
		var url_params = "SESSurl_params="+window.location.search.replace("?", "")+";";
		var now = new Date();
		var time = now.getTime();
		var expireTime = time + 1000*36000;
		now.setTime(expireTime);
		document.cookie= url_params+"expires="+now.toGMTString()+"path=/;";		
	}
	

	 function widget_comunicator_callback(event){	  
	  try
	  {
		  if(event === undefined || event === null)
		  {
			  return false;
		  }
		  
		  if(event.data !== null)
		  {
			if(event.data.indexOf("{") > -1)
			{
			  var msg=JSON.parse(event.data);
			  
			  switch(msg.type)
			  {
			   case 'email_duplication':
				// do something like open a login/forgot login widget 
				break; 
			   case 'WIDGET_POPUP_SIZE':
				// setting the widget iframe height
				jQuery('#main_iframe').height((msg.body.height+200) + 'px');
				break;
			   case 'accountdetails_success':
				// do something like display auto login or deposit buttons/ links 
				break; 
			  }				
			}  
		  }
	  }
	  catch(err)
	  {
		  
	  }	  
  }
