    $(document).ready(function () {
	
    $('.toggle').on('click', function(event) {
        event.preventDefault();
        $('.takip-box').toggleClass('open');
		$('.toggle').toggleClass('open');
		
		if($('.takip-box').hasClass('open')){
		$('.result-form').toggleClass('isOpen');
		}else{
		$('.result-form').toggleClass('isOpen');
		}
    });
   
	
	});
	
	
        
      