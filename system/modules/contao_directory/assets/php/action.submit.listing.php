<?php
// Starts the session and connects to the database
include_once("prepend.cart.endpoint.php");

	// turn the form values into $vars
	$vars = $_POST;
	

  $vars['user_first_name']

    
    
    
  try {
  $dbh = new PDO("mysql:host=localhost;dbname=ampersan_cms49", 'ampersan_dbadmin', 'Y06ZCg9BiAh2Uv#@', array(
  PDO::ATTR_PERSISTENT => true
  ));
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
  echo 'ERROR: ' . $e->getMessage();
  }
    
  $query = "INSERT INTO `tl_quote_request` (`id`, `tstamp`, `sorting`, `alias`, `panel_type`, `thickness`, `cradle`, `width`, `height`, `quantity`, `discount`, `price`, `published`, `tell_us`, `zip`, `state`, `city`, `address_2`, `address_1`, `phone`, `email`, `last_name`, `reviewed`, `first_name`, `created`) VALUES (NULL, '0', '".$sorting_number."', '', '".getPanelNameByID($clean['panel_id'])."', '".getPanelThicknessFromID($clean['flat_id'])."', '".getPanelCradleFromID($clean['cradle_id'])."', '".$clean['width']."', '".$clean['height']."', '".$clean['quantity']."', '0', '".$clean['price']."', '1', '".$vars['user_tell_us']."', '".$vars['user_zip']."', '".$vars['user_state']."', '".$vars['user_city']."', '".$vars['user_address_2']."', '".$vars['user_address_1']."', '".$vars['user_phone']."', '".$vars['user_email']."', '".$vars['user_last_name']."', 'unreviewed', '".$vars['user_first_name']."', '".date('F j, Y, g:i a')."')";
  $result = $dbh->prepare($query);
  $result->execute();


	echo "Email Sent!";
