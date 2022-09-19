<?php
    
    // turn the form values into $vars
	$vars = $_POST;
	
    
    
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=framework_contao_4_13", 'framework_user', 'fjE2NQ&[4c19hc!#th', array(
        PDO::ATTR_PERSISTENT => true
    ));
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    $sArray = serialize(json_decode($vars['professions']));
  
    
    $query = "INSERT INTO `tl_listing` (`published`, `country`, `state`, `profession`, `credentials`, `last_name`, `first_name`, `approved`, `specific_services`, `contact_details`, `how_to_contact`, `describe_practice`, `specialties_4`, `specialties_3`, `specialties_2`, `specialties_1`, `provide_cas`, `provide_mms`, `training_program`, `remote_consultations`) VALUES (1, '".$vars['country']."', '".$vars['state']."', '".$sArray."', '".$vars['credentials']."', '".$vars['last_name']."', '".$vars['first_name']."', 'unapproved', '".$vars['specific_services']."', '".$vars['contact_details']."', '".$vars['contact_method']."', '".$vars['desc_practice']."', '".$vars['specialties_4']."', '".$vars['specialties_3']."', '".$vars['specialties_2']."', '".$vars['specialties_1']."', '".$vars['child_services']."', '".$vars['medication_management']."', '".$vars['finished_training']."', '".$vars['remote_consultation']."')";
    $result = $dbh->prepare($query);
    $result->execute();


	echo "Email Sent!";
