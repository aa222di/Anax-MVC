enquire.register("screen and (max-width: 960px)", {
    match : function() {
       console.log('hello');
       jQuery('.navbar>ul').hide();
       jQuery('.navbar').addClass('respond');

		jQuery('.respond').click(function() {
	    console.log('click');
		
		jQuery('.respond').toggleClass('active');
		jQuery('.active>ul').show();  
		jQuery('.respond:not(".active")>ul').hide();
});
    },  
    unmatch : function() {
     jQuery('.navbar.respond').removeClass('respond');
     jQuery('.navbar>ul').show();
    }
});