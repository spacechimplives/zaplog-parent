	jQuery(document).ready(function() {
 
    jQuery(".zapvote").click(function(){
     
        zapvote = jQuery(this);
     
        // Retrieve post ID from data attribute
		voteType = zapvote.data("vote-type");
		zapID = zapvote.data("zap-id");

        
        // Ajax call
        jQuery.ajax({
            type: "post",
            url: ajaxData.url,
            data: "action=zap_vote&nonce="+ajaxData.nonce+"&vote="+voteType+"&zapid="+zapID,
            success: function(response){
                console.log(response);
            }
	
        });

        console.log(ajaxData);
		console.log(zapvote.data);
    })
        console.log("wtf");
})