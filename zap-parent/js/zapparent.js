	jQuery(document).ready(function() {
 
    jQuery(".upvote").click(function(){
     
        zapvote = jQuery(this);
     
        // Retrieve post ID from data attribute
		zapID = zapvote.data("zap-id");

        
        // Ajax call
        jQuery.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=zap_vote&nonce="+ajax_var.nonce+"&vote=1&zapid="+zapID,
            success: function(response){
                console.log(response);
            }
        });
    })
	    jQuery(".downvote").click(function(){
     
        zapvote = jQuery(this);
     
        // Retrieve post ID from data attribute
		zapID = zapvote.data("zap-id");

        
        // Ajax call
        jQuery.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=zap_vote&nonce="+ajax_var.nonce+"&vote=-1&zapid="+zapID,
            success: function(response){
                console.log(response);
            }
        });
    })

})