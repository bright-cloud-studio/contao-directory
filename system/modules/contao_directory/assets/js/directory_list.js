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
    
    // Track if we have any listings or not
    var noListings = true;
    
    // Loop through all listings
    $('.listings_wrapper').find('.item_listing').each(function(){
        
        // Tracks if this listing should be hidden or not at the end
        var hideListing = false;
        
        // Hide if need be
        if(hideListing) { $(this).hide(); } else {
            $(this).show();
            noListings = false;
        }
        
    });
    
    // Show our 'no listings' message if need be
    if(noListings) {
        $('.no_results').show();
    } else {
        $('.no_results').hide();
    }
    
}





// When page is loaded
$(document).ready(function() {

    // store our options
    var states = [];
    var providences = [];
    var countries = [
		'<option value="USA">United States</option>',
		'<option value="Afghanistan">Afghanistan</option>',
		'<option value="Albania">Albania</option>',
		'<option value="Algeria">Algeria</option>',
		'<option value="Andorra">Andorra</option>',
		'<option value="Angola">Angola</option>',
		'<option value="Antigua and Barbuda">Antigua and Barbuda</option>',
		'<option value="Argentina">Argentina</option>',
		'<option value="Armenia">Armenia</option>',
		'<option value="Australia">Australia</option>',
		'<option value="Austria">Austria</option>',
		'<option value="Azerbaijan">Azerbaijan</option>',
		'<option value="Bahamas">Bahamas</option>',
		'<option value="Bahrain">Bahrain</option>',
		'<option value="Bangladesh">Bangladesh</option>',
		'<option value="Barbados">Barbados</option>',
		'<option value="Belarus">Belarus</option>',
		'<option value="Belgium">Belgium</option>',
		'<option value="Belize">Belize</option>',
		'<option value="Benin">Benin</option>',
		'<option value="Bhutan">Bhutan</option>',
		'<option value="Bolivia">Bolivia</option>',
		'<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>',
		'<option value="Botswana">Botswana</option>',
		'<option value="Brazil">Brazil</option>',
		'<option value="Brunei">Brunei</option>',
		'<option value="Bulgaria">Bulgaria</option>',
		'<option value="Burkina Faso">Burkina Faso</option>',
		'<option value="Burundi">Burundi</option>Burundi',
		'<option value="Cabo Verde">Cabo Verde</option>',
		'<option value="Cambodia">Cambodia</option>',
		'<option value="Cameroon">Cameroon</option>',
		'<option value="Canada">Canada</option>',
		'<option value="Central African Republic">Central African Republic</option>',
		'<option value="Chad">Chad</option>',
		'<option value="Chile">Chile</option>',
		'<option value="China">China</option>',
		'<option value="Colombia">Colombia</option>',
		'<option value="Comoros">Comoros</option>',
		'<option value="Congo (Congo-Brazzaville)">Congo (Congo-Brazzaville)</option>',
		'<option value="Costa Rica">Costa Rica</option>',
		'<option value="Croatia">Croatia</option>',
		'<option value="Cuba">Cuba</option>',
		'<option value="Cyprus">Cyprus</option>',
		'<option value="Czechia (Czech Republic)">Czechia (Czech Republic)</option>',
		'<option value="Democratic Republic of the Congo">Democratic Republic of the Congo</option>',
		'<option value="Denmark">Denmark</option>',
		'<option value="Djibouti">Djibouti</option>',
		'<option value="Dominica">Dominica</option>',
		'<option value="Dominican Republic">Dominican Republic</option>',
		'<option value="Ecuador">Ecuador</option>',
		'<option value="Egypt">Egypt</option>',
		'<option value="El Salvador">El Salvador</option>',
		'<option value="Equatorial Guinea">Equatorial Guinea</option>',
		'<option value="Eritrea">Eritrea</option>',
		'<option value="Estonia">Estonia</option>',
		'<option value="Eswatini">Eswatini</option>',
		'<option value="Ethiopia">Ethiopia</option>',
		'<option value="Fiji">Fiji</option>',
		'<option value="Finland">Finland</option>',
		'<option value="France">France</option>',
		'<option value="Gabon">Gabon</option>',
		'<option value="Gambia">Gambia</option>',
		'<option value="Georgia">Georgia</option>',
		'<option value="Germany">Germany</option>',
		'<option value="Ghana">Ghana</option>',
		'<option value="Greece">Greece</option>',
		'<option value="Grenada">Grenada</option>',
		'<option value="Guatemala">Guatemala</option>',
		'<option value="Guinea">Guinea</option>',
		'<option value="Guinea-Bissau">Guinea-Bissau</option>',
		'<option value="Guyana">Guyana</option>',
		'<option value="Haiti">Haiti</option>',
		'<option value="Holy See">Holy See</option>',
		'<option value="Honduras">Honduras</option>',
		'<option value="Hungary">Hungary</option>',
		'<option value="Iceland">Iceland</option>',
		'<option value="India">India</option>',
		'<option value="Indonesia">Indonesia</option>',
		'<option value="Iran">Iran</option>',
		'<option value="Iraq">Iraq</option>',
		'<option value="Ireland">Ireland</option>',
		'<option value="Israel">Israel</option>',
		'<option value="Italy">Italy</option>',
		'<option value="Jamaica">Jamaica</option>',
		'<option value="Japan">Japan</option>',
		'<option value="Jordan">Jordan</option>',
		'<option value="Kazakhstan">Kazakhstan</option>',
		'<option value="Kenya">Kenya</option>',
		'<option value="Kiribati">Kiribati</option>',
		'<option value="Kuwait">Kuwait</option>',
		'<option value="Kyrgyzstan">Kyrgyzstan</option>',
		'<option value="Laos">Laos</option>',
		'<option value="Latvia">Latvia</option>',
		'<option value="Lebanon">Lebanon</option>',
		'<option value="Lesotho">Lesotho</option>',
		'<option value="Liberia">Liberia</option>',
		'<option value="Libya">Libya</option>',
		'<option value="Liechtenstein">Liechtenstein</option>',
		'<option value="Lithuania">Lithuania</option>',
		'<option value="Luxembourg">Luxembourg</option>',
		'<option value="Madagascar">Madagascar</option>',
		'<option value="Malawi">Malawi</option>',
		'<option value="Malaysia">Malaysia</option>',
		'<option value="Maldives">Maldives</option>',
		'<option value="Mali">Mali</option>',
		'<option value="Malta">Malta</option>',
		'<option value="Marshall Islands">Marshall Islands</option>',
		'<option value="Mauritania">Mauritania</option>',
		'<option value="Mauritius">Mauritius</option>',
		'<option value="Mexico">Mexico</option>',
		'<option value="Micronesia">Micronesia</option>',
		'<option value="Moldova">Moldova</option>',
		'<option value="Monaco">Monaco</option>',
		'<option value="Mongolia">Mongolia</option>',
		'<option value="Montenegro">Montenegro</option>',
		'<option value="Morocco">Morocco</option>',
		'<option value="Mozambique">Mozambique</option>',
		'<option value="Myanmar">Myanmar</option>',
		'<option value="Namibia">Namibia</option>',
		'<option value="Nauru">Nauru</option>',
		'<option value="Nepal">Nepal</option>',
		'<option value="Netherlands">Netherlands</option>',
		'<option value="New Zealand">New Zealand</option>',
		'<option value="Nicaragua">Nicaragua</option>',
		'<option value="Niger">Niger</option>',
		'<option value="Nigeria">Nigeria</option>',
		'<option value="North Korea">North Korea</option>',
		'<option value="North Macedonia">North Macedonia</option>',
		'<option value="Norway">Norway</option>',
		'<option value="Oman">Oman</option>',
		'<option value="Pakistan">Pakistan</option>',
		'<option value="Palau">Palau</option>',
		'<option value="Palestine State">Palestine State</option>',
		'<option value="Panama">Panama</option>',
		'<option value="Papua New Guinea">Papua New Guinea</option>',
		'<option value="Paraguay">Paraguay</option>',
		'<option value="Peru">Peru</option>',
		'<option value="Philippines">Philippines</option>',
		'<option value="Poland">Poland</option>',
		'<option value="Portugal">Portugal</option>',
		'<option value="Qatar">Qatar</option>',
		'<option value="Romania">Romania</option>',
		'<option value="Russia">Russia</option>',
		'<option value="Rwanda">Rwanda</option>',
		'<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>',
		'<option value="Saint Lucia">Saint Lucia</option>',
		'<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>',
		'<option value="Samoa">Samoa</option>',
		'<option value="San Marino">San Marino</option>',
		'<option value="Sao Tome and Principe">Sao Tome and Principe</option>',
		'<option value="Saudi Arabia">Saudi Arabia</option>',
		'<option value="Senegal">Senegal</option>',
		'<option value="Serbia">Serbia</option>',
		'<option value="Seychelles">Seychelles</option>',
		'<option value="Sierra Leone">Sierra Leone</option>',
		'<option value="Singapore">Singapore</option>',
		'<option value="Slovakia">Slovakia</option>',
		'<option value="Slovenia">Slovenia</option>',
		'<option value="Solomon Islands">Solomon Islands</option>',
		'<option value="Somalia">Somalia</option>',
		'<option value="South Africa">South Africa</option>',
		'<option value="South Korea">South Korea</option>',
		'<option value="South Sudan">South Sudan</option>',
		'<option value="Spain">Spain</option>',
		'<option value="Sri Lanka">Sri Lanka</option>',
		'<option value="Sudan">Sudan</option>',
		'<option value="Suriname">Suriname</option>',
		'<option value="Sweden">Sweden</option>',
		'<option value="Switzerland">Switzerland</option>',
		'<option value="Syria">Syria</option>',
		'<option value="Tajikistan">Tajikistan</option>',
		'<option value="Tanzania">Tanzania</option>',
		'<option value="Thailand">Thailand</option>',
		'<option value="Timor-Leste">Timor-Leste</option>',
		'<option value="Togo">Togo</option>',
		'<option value="Tonga">Tonga</option>',
		'<option value="Trinidad and Tobago">Trinidad and Tobago</option>',
		'<option value="Tunisia">Tunisia</option>',
		'<option value="Turkey">Turkey</option>',
		'<option value="Turkmenistan">Turkmenistan</option>',
		'<option value="Tuvalu">Tuvalu</option>',
		'<option value="Uganda">Uganda</option>',
		'<option value="Ukraine">Ukraine</option>',
		'<option value="United Arab Emirates">United Arab Emirates</option>',
		'<option value="United Kingdom">United Kingdom</option>',
		'<option value="Uruguay">Uruguay</option>',
		'<option value="Uzbekistan">Uzbekistan</option>',
		'<option value="Vanuatu">Vanuatu</option>',
		'<option value="Venezuela">Venezuela</option>',
		'<option value="Vietnam">Vietnam</option>',
		'<option value="Yemen">Yemen</option>',
		'<option value="Zambia">Zambia</option>',
		'<option value="Zimbabwe">Zimbabwe</option>'];
    
    var usa_states = [
		'Alabama',
		'Alaska',
		'Arizona',
		'Arkansas',
		'California',
		'Colorado',
		'Connecticut',
		'Delaware',
		'Florida',
		'Georgia',
		'Hawaii',
		'Idaho',
		'Illinois',
		'Indiana',
		'Iowa',
		'Kansas',
		'Kentucky',
		'Louisiana',
		'Maine',
		'Maryland',
		'Massachusetts',
		'Michigan',
		'Minnesota',
		'Mississippi',
		'Missouri',
		'Montana',
		'Nebraska',
		'Nevada',
		'New Hampshire',
		'New Jersey',
		'New Mexico',
		'New York',
		'North Carolina',
		'North Dakota',
		'Ohio',
		'Oklahoma',
		'Oregon',
		'Pennsylvania',
		'Rhode Island',
		'South Carolina',
		'South Dakota',
		'Tennessee',
		'Texas',
		'Utah',
		'Vermont',
		'Virginia',
		'Washington',
		'West Virginia',
		'Wisconsin',
		'Wyoming',
		'American Samoa',
		'District of Columbia',
		'Federated States of Micronesia',
		'Guam',
		'Marshall Islands',
		'Northern Mariana Islands',
		'Palau',
		'Puerto Rico',
		'Virgin Islands'];


    // loop through all listings
    $('.listings_wrapper').find('.item_listing').each(function(){
        // Add option to State if USA is country, add option to Providence if Canada is country
        var listingState = $(this).attr('data-state');
        var csv_states = listingState.split(',');
         csv_states.forEach(function(state) {
            if(state != '') {
                if(arrayContains(state, usa_states)) {
                    if(jQuery.inArray('<option value="'+ state +'">'+ state +'</option>', states) == -1) {
                        states.push('<option value="'+ state +'">'+ state +'</option>');
                    }
                } else {
                    if(jQuery.inArray('<option value="'+ state +'">'+ state +'</option>', providences) == -1) {
                        providences.push('<option value="'+ state +'">'+ state +'</option>');
                    }
                }
            }
        });
    });
    
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




function arrayContains(needle, arrhaystack)
{
    return (arrhaystack.indexOf(needle) > -1);
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
