// When page is loaded
$(document).ready(function() {

    // Initialize Select2
    $('.filter_country').select2({ width: '100%' });
    $('.filter_state').select2({ width: '100%' });
    $('.filter_professions').select2({ width: '100%' });


    // Filter by Country
    $( ".filter_country" ).change(function() {


        console.log("Changed: Country");

        var desiredCountry = $(this).val();

        // loop through listings
        $('.listings_wrapper').find('div').each(function(){
            console.log($(this).attr('data-country'));

            var listingCountry = $(this).attr('data-country');

            if(desiredCountry != listingCountry) {
                $(this).hide();
            } else {
                $(this).show();
            }

        });

    });

    // Filter by State
    $( ".filter_state" ).change(function() {
        console.log("Changed: State");
    });

    // Filer by Professions
    $( ".filter_professions" ).change(function() {
        console.log("Changed: Professions");
    });

    // Filter by Remote Consultation
    $( ".filter_rc" ).change(function() {
        console.log("Changed: Remote Consultation");
    });

    // Filter by Medication Management
    $( ".filter_mm" ).change(function() {
        console.log("Changed: Medication Management");
    });

    // Filter by Child/Adolescence Services
    $( ".filter_cs" ).change(function() {
        console.log("Changed: Child/Adolescence Services");
    });

});
