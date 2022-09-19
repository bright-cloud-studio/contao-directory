// When page is loaded
$(document).ready(function() {

    $(".s_country").change(function() { countryChanges(); });

});

// makes changes to Country, State, Providence and City based on selections
function countryChanges() {
    
    var selectedCountry = $(".s_country").val();
    $(".s_providence").val(null);
    $(".s_state").val(null);
    $("#s_city").val("");
    
    if(selectedCountry === "USA") {
        $(".option_state_prov").hide();
        $(".option_providence").hide();
        $(".option_state").show();
        $(".option_city").show();
    } else if (selectedCountry === "Canada") {
        $(".option_state_prov").hide();
        $(".option_state").hide();
        $(".option_city").hide();
        $(".option_providence").show();
    }

}

// this is the call to save to cart
function submitListing(){
    

    // store our quote request values
    
    var first_name = $("#s_first_name").val();
    var last_name = $("#s_last_name").val();
    var photo = $("#s_photo").val();
    
    var country = $("#s_country").val();
    var state = 'none';
    
    // if country is usa get state, if canada get providence
    if(country === "USA")
        state = $("#s_state").val();
    else if (country === "Canada")
        state = $("#s_providence").val();
    
    
    var credentials = $("#s_credentials").val();
    
    var professions = [];
    $("input:checkbox[name=professions]:checked").each(function() {
        professions.push($(this).val());
    });

    
    var remote_consultation = $("input[name='rc']:checked").val();
    var finished_training = $("input[name='tp']:checked").val();
    
    var desc_practice = $("#describe_practice").val();
    var specific_services = $("#specific_services").val();
    
    var specialties_1 = $("#specialties_1").val();
    var specialties_2 = $("#specialties_2").val();
    var specialties_3 = $("#specialties_3").val();
    var specialties_4 = $("#specialties_4").val();
    
    var medication_management = $("input[name='mm']:checked").val();
    var child_services = $("input[name='cs']:checked").val();
    
    var contact_method = $("#contact_method").val();
    var contact_details = $("#contact_details").val();
    
    
    
    // Testing Values to make sure we grabbed them correctly
    /*
    console.log("first_name: " + first_name);
    console.log("last_name: " + last_name);
    console.log("photo: " + photo);
    console.log("country: " + country);
    console.log("state: " + state);
    console.log("credentials: " + credentials);
    console.log("professions: " + professions);
    console.log("remote_consultation: " + remote_consultation);
    console.log("finished_training: " + finished_training);
    console.log("desc_practice: " + desc_practice);
    console.log("specific_services: " + specific_services);
    console.log("specialties_1: " + specialties_1);
    console.log("specialties_2: " + specialties_2);
    console.log("specialties_3: " + specialties_3);
    console.log("specialties_4: " + specialties_4);
    console.log("medication_management: " + medication_management);
    console.log("child_services: " + child_services);
    console.log("contact_method: " + contact_method);
    console.log("contact_details: " + contact_details);
    */
    

    
    // trigger this function when our form runs
    $.ajax({
        url:'/system/modules/contao_directory/assets/php/action.submit.listing.php',
        type:'POST',
        data:"first_name="+first_name+"&last_name="+last_name+"&photo="+photo+"&country="+country+"&state="+state+"&credentials="+credentials+"&professions="+JSON.stringify(professions)+"&remote_consultation="+remote_consultation+"&finished_training="+finished_training+"&desc_practice="+desc_practice+"&specific_services="+specific_services+"&specialties_1="+specialties_1+"&specialties_2="+specialties_2+"&specialties_3="+specialties_3+"&specialties_4="+specialties_4+"&medication_management="+medication_management+"&child_services="+child_services+"&contact_method="+contact_method+"&contact_details="+contact_details+"",
        success:function(result){
            console.log("SUCCESS");
            
        	// redirect us to the success page
        	//window.location.replace("https://ampersandart.com/custom-calculator-success-message");
        },
        error:function(result){
			console.log("ERROR");
        }
    });
    
    

	
}
