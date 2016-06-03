// to show the loading page
function show_loading() {
	$.blockUI({
		css: {
			border: 'none',
			padding: '15px',
			backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
			opacity: .5,
			color: '#fff'
		}
	});
}

// to hide loading page
function hide_loading() {
	$.unblockUI({});
}


function show_element_loading(element){
	$(element).block({ 
		/*css: {
			border: 'none',
			padding: '15px',
			backgroundColor: '#000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
			opacity: .5,
			color: '#fff'
		}*/
		message: '<h2>Please wait</h2>', 
		css: { border: 'none' ,
			opacity: .5,
			backgroundColor: '#000',
			'-webkit-border-radius': '10px',
			'-moz-border-radius': '10px',
			color: '#fff'
			} 
    }); 
}

function hide_element_loading(element){
	 $(element).unblock(); 
}

