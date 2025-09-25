	handleSizingResponse = function(e) {		
		try	{
			var msg=JSON.parse(e.data);
			
			switch(msg.type)
			{
				case 'email_duplication':
					// do something like open a login/forgot login widget break; 
				case 'WIDGET_POPUP_SIZE':
				
					console.log(msg.body.widget + ': ' + msg.body.height);
				
					if(msg.body.height > 0)
					{
						var iframeHeight = msg.body.height + 50;
						var elementAddress = '.resizableIframe';
						var widgetID = '#' + msg.body.widget;
					
						if(jQuery(widgetID).length > 0)
						{		
							elementAddress = widgetID;
						}

						jQuery(elementAddress).attr("height", iframeHeight + "px");		
					}
					
					break;
				case 'accountdetails_success':
					// do something like display auto login or deposit buttons/ links break; 
			}	
		}
		catch(err){
		}		
	}
	
	window.addEventListener('message', handleSizingResponse, false); 