(function($){
 
  $(document).ready(function(){    
    $('a').click(function(e){
    	    e.preventDefault();
    	    var self = $(this);
    	        url = self.attr('href');
    	        target = self.data('target');
    	        group = self.data('group');
    	        aGroup = group.split('-');
    	        if (aGroup[0]=='active') {
    	        	activeLink(self);
    	        }
    	    $.ajax({
    	        url: url,
    	        cache : false,
    	        beforeSend: function() {
    	        	$('#'+target).html('');
    	        	$('#load-'+target).show();
    	        },
    	        success: function(data){ 
    	                       if (target !== 'undefined'){
    	                          $('#'+target).html( data );
    	                          $('#load-'+target).hide();
    	                       }
    	                 }
    	    });
        return false;
	});
    
  });
 
})(jQuery);


activeLink = function(link)
{
	console.debug('a[data-group="'+link.data('group')+'"]');
	$('a[data-group="'+link.data('group')+'"]').each(function() {
		$(this).parent().attr('class','')
	});
	link.parent().attr('class','active');
}