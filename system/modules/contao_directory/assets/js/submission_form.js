// this is the call to save to cart
function submitListing(){

    // store our quote request values
    var user_first_name = $("#firstname").val();
    var user_last_name = $("#lastname").val();
    var user_email = $("#email").val();
    var user_phone = $("#phone").val();
    var user_address_1 = $("#address_1").val();
    var user_address_2 = $("#address_2").val();
    var user_state = $("#state").val();
    var user_city = $("#city").val();
    var user_zip = $("#zip").val();
    var user_tell_us = $("#tell_us").val();

	  
    // trigger this function when our form runs
    $.ajax({
        url:'/system/modules/panel_pricing_calculator/assets/php/action.send.email.php',
        type:'POST',
        data:"user_first_name="+user_first_name+"&user_last_name="+user_last_name+"&user_email="+user_email+"&user_phone="+user_phone+"&user_address_1="+user_address_1+"&user_address_2="+user_address_2+"&user_state="+user_state+"&user_city="+user_city+"&user_zip="+user_zip+"&user_tell_us="+user_tell_us+"",
        success:function(result){
        	//$("#send_email_notification").html(result);
        	//$("#request_form").hide();
        	
        	// redirect us to the success page
        	window.location.replace("https://ampersandart.com/custom-calculator-success-message");
        	
        },
        error:function(result){
			$("#send_email_notification").html("SEND EMAIL FAIL");
        }
    });
	
}
