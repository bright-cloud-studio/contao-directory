<?php

namespace Bcs;

use Contao\Database;

class Handler
{
    protected static $arrUserOptions = array();

    public function onProcessForm($submittedData, $formData, $files, $labels, $form)
    {
        
        if($formData['formID'] == 'directory_submission') {
            
            $img = \FilesModel::findByUuid($files['photo']['uuid']);
            $bin = \StringUtil::uuidToBin($files['photo']['uuid']);
            
            // insert form data into tl_listing
            //\Database::getInstance()->prepare("INSERT INTO tl_listing (`published`, `approved`, `photo`, `first_name`, `last_name`, `credentials`, `phone`, `email_internal`, `email_public`, `website`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `profession`, `remote_consultations`, `training_program`, `describe_practice`, `provide_mms`, `provide_cas`, `specialties_1`, `specialties_2`, `specialties_3`, `specialties_4`, `how_to_contact`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute(1, 'unapproved', $bin, $submittedData['first_name'], $submittedData['last_name'], $submittedData['credentials'], $submittedData['phone'], $submittedData['email_internal'], $submittedData['email_public'], $submittedData['website'], $submittedData['address_1'], $submittedData['address_2'], $submittedData['city'], $submittedData['state'], $submittedData['zip'], $submittedData['country'], $submittedData['profession'], $submittedData['remote_consultations'], $submittedData['training_program'], $submittedData['describe_practice'], $submittedData['provide_mms'], $submittedData['provide_cas'], $submittedData['specialties_1'], $submittedData['specialties_2'], $submittedData['specialties_3'], $submittedData['specialties_4'], $submittedData['how_to_contact']);
            
            if($submittedData['country'] == 'USA')
                Database::getInstance()->prepare("INSERT INTO tl_listing (`published`, `approved`, `photo`, `first_name`, `last_name`, `credentials`, `phone`, `email_internal`, `email_public`, `website`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `profession`, `remote_consultations`, `training_program`, `describe_practice`, `provide_mms`, `provide_cas`, `specialties_1`, `specialties_2`, `specialties_3`, `specialties_4`, `how_to_contact`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute(1, 'unapproved', $bin, $submittedData['first_name'], $submittedData['last_name'], $submittedData['credentials'], $submittedData['phone'], $submittedData['email_internal'], $submittedData['email_public'], $submittedData['website'], $submittedData['address_1'], $submittedData['address_2'], $submittedData['city'], $submittedData['state'], $submittedData['zip'], $submittedData['country'], $submittedData['profession'], $submittedData['remote_consultations'], $submittedData['training_program'], $submittedData['describe_practice'], $submittedData['provide_mms'], $submittedData['provide_cas'], $submittedData['specialties_1'], $submittedData['specialties_2'], $submittedData['specialties_3'], $submittedData['specialties_4'], $submittedData['how_to_contact']);
            else if($submittedData['country'] == 'Canada')
                Database::getInstance()->prepare("INSERT INTO tl_listing (`published`, `approved`, `photo`, `first_name`, `last_name`, `credentials`, `phone`, `email_internal`, `email_public`, `website`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `profession`, `remote_consultations`, `training_program`, `describe_practice`, `provide_mms`, `provide_cas`, `specialties_1`, `specialties_2`, `specialties_3`, `specialties_4`, `how_to_contact`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute(1, 'unapproved', $bin, $submittedData['first_name'], $submittedData['last_name'], $submittedData['credentials'], $submittedData['phone'], $submittedData['email_internal'], $submittedData['email_public'], $submittedData['website'], $submittedData['address_1'], $submittedData['address_2'], $submittedData['city'], $submittedData['providence'], $submittedData['zip'], $submittedData['country'], $submittedData['profession'], $submittedData['remote_consultations'], $submittedData['training_program'], $submittedData['describe_practice'], $submittedData['provide_mms'], $submittedData['provide_cas'], $submittedData['specialties_1'], $submittedData['specialties_2'], $submittedData['specialties_3'], $submittedData['specialties_4'], $submittedData['how_to_contact']);
            else
                Database::getInstance()->prepare("INSERT INTO tl_listing (`published`, `approved`, `photo`, `first_name`, `last_name`, `credentials`, `phone`, `email_internal`, `email_public`, `website`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `profession`, `remote_consultations`, `training_program`, `describe_practice`, `provide_mms`, `provide_cas`, `specialties_1`, `specialties_2`, `specialties_3`, `specialties_4`, `how_to_contact`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute(1, 'unapproved', $bin, $submittedData['first_name'], $submittedData['last_name'], $submittedData['credentials'], $submittedData['phone'], $submittedData['email_internal'], $submittedData['email_public'], $submittedData['website'], $submittedData['address_1'], $submittedData['address_2'], $submittedData['city'], '', $submittedData['zip'], $submittedData['country'], $submittedData['profession'], $submittedData['remote_consultations'], $submittedData['training_program'], $submittedData['describe_practice'], $submittedData['provide_mms'], $submittedData['provide_cas'], $submittedData['specialties_1'], $submittedData['specialties_2'], $submittedData['specialties_3'], $submittedData['specialties_4'], $submittedData['how_to_contact']);
        
        
            // SEND EMAIL
            $to = "mark@brightcloudstudio.com";
            $to = "web@brightcloudstudio.com,suzatonic@gmail.com";
            $subject = "[DD] New Directory Submission";

            $message_start = "
            <html>
            <head>
            <title>[DD] New Directory Submission</title>
            </head>
            <body>
            <h2>Listing Details:</h2>
            ";

            $message_user_contents = "";

            $message_end = "
            </body>
            </html>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <webmaster@example.com>' . "\r\n";
            $headers .= 'Cc: mark@brightcloudstudio.com' . "\r\n";


            // build the html for the users contents
            $message_user_contents = $message_user_contents . '<p>First Name: '.$submittedData['first_name'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Last Name: '.$submittedData['last_name'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Credentials: '.$submittedData['credentials'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Phone: '.$submittedData['phone'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Internal Email: '.$submittedData['email_internal'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Public Email: '.$submittedData['email_public'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Website: '.$submittedData['website'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Address 1: '.$submittedData['address_1'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Address 2: '.$submittedData['address_2'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Country: '.$submittedData['country'].'</p>';
            $message_user_contents = $message_user_contents . '<p>State: '.$submittedData['state'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Providence: '.$submittedData['providence'].'</p>';
            $message_user_contents = $message_user_contents . '<p>City: '.$submittedData['city'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Zip: '.$submittedData['zip'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Preferred Contact Method: '.$submittedData['how_to_contact'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Profession: '.$submittedData['profession'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Specialties_1: '.$submittedData['specialties_1'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Specialties_2: '.$submittedData['specialties_2'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Specialties_3: '.$submittedData['specialties_3'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Specialties_4: '.$submittedData['specialties_4'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Describe Practice: '.$submittedData['describe_practice'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Offer Remote Services: '.$submittedData['remote_consultations'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Offer Medication Management: '.$submittedData['provide_mms'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Offer Child Services: '.$submittedData['provide_cas'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Completed Training: '.$submittedData['training_program'].'</p>';
            $message_user_contents = $message_user_contents . '<p>Specific Services: '.$submittedData['specific_services'].'</p>';
            
            // send the mail
	        mail($to,$subject,($message_start . $message_user_contents . $message_end),$headers);
	
        
        }
    }
}
