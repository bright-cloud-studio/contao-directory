// When page is loaded
$(document).ready(function() {

    // store our options
    var countries = [];
    var states = [];
    var providences = [];
    

    // loop through all listings
    $('.listings_wrapper').find('.item_listing').each(function(){

        // Add Country option if it doesnt exist
        var listingCountry = $(this).attr('data-country');
        var csv_countries = listingCountry.split(",");
        csv_countries.forEach(function(country) {
            if(jQuery.inArray('<option value="'+ country +'">'+ country +'</option>', countries) == -1) {
            countries.push('<option value="'+ country +'">'+ country +'</option>');
        }
        });

        
        
        
        // Add option to State if USA is country, add option to Providence if Canada is country
        var listingState = $(this).attr('data-state');
        if(listingCountry === 'USA') {
            if(jQuery.inArray('<option value="'+ listingState +'">'+ listingState +'</option>', states) == -1) {
                states.push('<option value="'+ listingState +'">'+ listingState +'</option>');
            }
        } else if(listingCountry === 'Canada') {
            if(jQuery.inArray('<option value="'+ listingState +'">'+ listingState +'</option>', providences) == -1) {
                providences.push('<option value="'+ listingState +'">'+ listingState +'</option>');
            }
        }
        
    });

    countries.sort();
    
    countries = countries.filter(item => item !== '<option value="USA">USA</option>');
    countries.unshift('<option value="USA">United States</option>');
    
    states.sort();
    providences.sort();
    
    // add our default options
    countries.unshift('<option value="" disabled selected hidden> </option>');
    states.unshift('<option value="" disabled selected hidden> </option>');
    providences.unshift('<option value="" disabled selected hidden> </option>');


    // add our arrays to our selects
    $('#filter_country').html(countries.join(''));
    $('#filter_state').html(states.join(''));
    $('#filter_providence').html(providences.join(''));
        
    
    // Options have been built, initialize Select2
    $('.filter_country').select2({ width: '100%' });
    $('.filter_state_prov').select2({ width: '100%' });
    $('.filter_state').select2({ width: '100%' });
    $('.filter_providence').select2({ width: '100%' });
    $('.filter_professions').select2({ width: '100%' });

    // trigger filter if anything is changed
    $(".filter_country").change(function() { filterListings(); });
    $(".filter_state").change(function() { filterListings(); });
    $(".filter_providence").change(function() { filterListings(); });
    $(".filter_professions").change(function() { filterListings(); });
    $(".filter_rc").change(function() { filterListings(); });
    $(".filter_mm").change(function() { filterListings(); });
    $(".filter_cs").change(function() { filterListings(); });
    
});


function filterListings() {
    
    // change the State dropdown based on the Country dropdown
    setStateProvidence();
    
    // collect our filter's desired values
    var desiredCountry = $(".filter_country").val();
    var desiredState = $(".filter_state").val();
    var desiredProvidence = $(".filter_providence").val();
    var desiredProfessions = $(".filter_professions").val();
    var desiredRC = document.getElementById('filter_rc').checked;
    var desiredMM = document.getElementById('filter_mm').checked;
    var desiredCS = document.getElementById('filter_cs').checked;
    

    var noListings = true;
    
    // loop through all listings
    $('.listings_wrapper').find('.item_listing').each(function(){
        
        // set our flag to hide by default, change to 1 to show
        var flagHide = 0;
        
        // COUNTRY
        if(desiredCountry !== null) {
            var listingCountry = $(this).attr('data-country');
            if(listingCountry != desiredCountry) {
                flagHide = 1;
            } else {
                flagHide = 0;
            }
        }
        
        // STATE / PROVIDENCE
        var selectedCountry = $(".filter_country").val();
        if(selectedCountry === "USA") {
            if(desiredState !== null) {
                var listingState = $(this).attr('data-state');
                if(listingState != desiredState) {
                    flagHide = 1;
                } else {
                    if(listingCountry == 'Other') {
                        flagHide = 1;
                    } else
                        flagHide = 0;
                }
            }
        } else if(selectedCountry === "Canada") {
            if(desiredProvidence !== null) {
                var listingProvidence = $(this).attr('data-state');
                if(listingProvidence != desiredProvidence) {
                    flagHide = 1;
                } else {
                    if(listingCountry == 'Other') {
                        flagHide = 1;
                    } else
                        flagHide = 0;
                }
            }
        }
        
        
        // PROFESSIONS
        if(desiredProfessions.length !== 0) {
            
            console.log("TEST");
            
            var listingProfessions = $(this).attr('data-professions');
            
            console.log("TEST: " . listingProfessions);
            
            var listingArray = listingProfessions.split('|');
            // we have no match so far
            var hasMatch = 0;
            // loop through each listing entry
            $.each(listingArray, function(index, value){
                // if our desired professions includes on of the listing's professions
                if(desiredProfessions.includes(value) === true) {
                    // we have a match
                    hasMatch = 1;
                }
            });
            // if we have no match, hide this
            if(hasMatch === 0) {
                flagHide = 1;
            }
        }
        
        
        // CHECKBOXES
        if(desiredRC === true) {
            var listingRC = $(this).attr('data-rc');
            if(listingRC === "no") {
                flagHide = 1;
            }
        }
        if(desiredMM === true) {
            var listingMM = $(this).attr('data-mm');
            if(listingMM === "no") {
                flagHide = 1;
            }
        }
        if(desiredCS === true) {
            var listingCS = $(this).attr('data-cs');
            if(listingCS === "no") {
                flagHide = 1;
            }
        }
        

        // if flagged then hide if not then show
        if(flagHide == 1) {
            $(this).hide();
        } else {
            $(this).show();
            noListings = false;
        }
        
    });
    
    if(noListings) {
        $('.no_results').show();
    } else {
        $('.no_results').hide();
    }
    
}


function setStateProvidence() {
    // get country value
    var selectedCountry = $(".filter_country").val();
    
    if(selectedCountry == "USA") {
        $(".option_providence").hide();
        $(".option_state_prov").hide();
        $(".option_state").show();
        $('#filter_providence').val(null).trigger('change.select2');
    } else if(selectedCountry == "Canada") {
        
        $(".option_state_prov").hide();
        $(".option_state").hide();
        $(".option_providence").show();
        $('#filter_state').val(null).trigger('change.select2');
    } else {
        $(".option_state_prov").show();
        $(".option_state").hide();
        $(".option_providence").hide();
        $('#filter_state').val(null).trigger('change.select2');
        $('#filter_providence').val(null).trigger('change.select2');
    }
}

function resetFilter() {
    $(".filter_rc").prop('checked',false).trigger('change');
    $(".filter_mm").prop('checked',false).trigger('change');
    $(".filter_cs").prop('checked',false).trigger('change');
    $(".filter_professions").val(null).trigger('change');
    
    $(".filter_providence").val(null).trigger('change');
    $(".filter_state").val(null).trigger('change');
    $(".option_providence").hide();
    $(".option_state").hide();
    $(".option_state_prov").show();
    
    $('.filter_country').val(null).trigger('change');
}
