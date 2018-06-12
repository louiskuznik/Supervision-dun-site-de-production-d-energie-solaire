jQuery(function($){
	   
	$('a.modal_open').on('click', function() {
		var popID = $(this).data('rel');
		var popWidth = $(this).data('width');

		
		$('#' + popID).fadeIn().css({ 'width': popWidth}).prepend('<a href="#" class="close"><img src="close-green@2x.png" class="btn_close" title="Close Window" alt="Close" /></a>');
		
		
		var popMargTop = ($('#' + popID).height()) / 2;
		var popMargLeft = ($('#' + popID).width()) / 2;
		
		
		$('#' + popID).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		
		$('body').append('<div id="fade"></div>');
		$('#fade').css({'filter' : 'alpha(opacity=70)'}).fadeIn();
		
		return false;
	});
	
	
	
	$('body').on('click', 'a.close, #fade', function() {
		$('#fade , .popup_block').fadeOut(function() {
			$('#fade, a.close').remove();  
	});
		
		return false;
	});
	
});