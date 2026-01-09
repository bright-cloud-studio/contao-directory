<?php

namespace Bcs;

use Contao\Database;
use Contao\FilesModel;
use Contao\StringUtil;

use Bcs\Model\Listing;

class Handler
{
    protected static $arrUserOptions = array();

    public function onProcessForm($submittedData, $formData, $files, $labels, $form)
    {
        
        if($formData['formID'] == 'directory_submission') {
            
            if($submittedData['first_name']) {
            
                // Get Bin of our uploaded image
                $img = FilesModel::findByUuid($files['photo']['uuid']);
                $bin = StringUtil::uuidToBin($files['photo']['uuid']);

                // Create our Listing
                $listing = new Listing();
                $listing->tstamp = time();
                $listing->published = 1;
                $listing->approved = 'unapproved';
                $listing->photo = $bin;
                $listing->first_name = $submittedData['first_name'];
                $listing->last_name = $submittedData['last_name'];
                $listing->credentials = $submittedData['credentials'];
                $listing->phone = $submittedData['phone'];
                $listing->email_internal = $submittedData['email_internal'];
                $listing->email_public = $submittedData['email_public'];
                $listing->website = $submittedData['website'];
                $listing->address_1 = $submittedData['address_1'];
                $listing->address_2 = $submittedData['address_2'];
                $listing->city = $submittedData['city'];
                $listing->state = $submittedData['state'];
                $listing->zip = $submittedData['zip'];
                $listing->country = $submittedData['country'];
                $listing->profession = $submittedData['profession'];
                $listing->remote_consultations = $submittedData['remote_consultations'];
                $listing->training_program = $submittedData['training_program'];
                $listing->describe_practice = $submittedData['describe_practice'];
                $listing->provide_mms = $submittedData['provide_mms'];
                $listing->provide_cas = $submittedData['provide_cas'];
                $listing->language = $submittedData['language'];
                $listing->specialties_1 = $submittedData['specialties_1'];
                $listing->specialties_2 = $submittedData['specialties_2'];
                $listing->specialties_3 = $submittedData['specialties_3'];
                $listing->specialties_4 = $submittedData['specialties_4'];
                $listing->how_to_contact = $submittedData['how_to_contact'];
                $listing->specific_services = $submittedData['specific_services'];
                $listing->service_area_state = $submittedData['service_area_state'];
                $listing->service_area_province = $submittedData['service_area_province'];
                $listing->service_area_country = $submittedData['service_area_country'];
                $listing->service_area_worldwide = $submittedData['service_area_worldwide'];
                $listing->date_created = time();
                $listing->save();
                
                // Create a log of this submission
                $myfile = fopen($_SERVER['DOCUMENT_ROOT'] . '/../files/content/directory/logs/directory_submission_'.strtolower(date('m_d_y_H:m:s')).".txt", "w") or die("Unable to open file!");
                fwrite($myfile, "Listing ID: " . $listing->id . "\n");
                foreach($submittedData as $key => $val) {
                    fwrite($myfile, "Key: " . $key . "  | Value: " . $val . "\n");
                }
                fclose($myfile);

                
                // Setup strings for our email
                $service_area_worldwide = $submittedData['service_area_worldwide'];
                
                $service_area_country = '';
                if(is_array($submittedData['service_area_country'])) {
                    $service_area_country = implode(',', $submittedData['service_area_country']);
                } else {
                    $service_area_country = $submittedData['service_area_country'];
                }
                
                $service_area_state = '';
                if(is_array($submittedData['service_area_state'])) {
                    $service_area_state = implode(',', $submittedData['service_area_state']);
                } else {
                    $service_area_state = $submittedData['service_area_state'];
                }
                
                $service_area_province = '';
                if(is_array($submittedData['service_area_province'])) {
                    $service_area_province = implode(',', $submittedData['service_area_province']);
                } else {
                    $service_area_province = $submittedData['service_area_province'];
                }

                // Create our email message
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
    
                // build the html for the users contents
                $message_user_contents = $message_user_contents . '<p>First Name: '.$submittedData['first_name'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Last Name: '.$submittedData['last_name'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Photo: <img src="https://diagnosisdiet.com/'.$img->path.'"></p>'. "\r\n";
    
                $message_user_contents = $message_user_contents . '<p>Credentials: '.$submittedData['credentials'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Phone: '.$submittedData['phone'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Internal Email: '.$submittedData['email_internal'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Public Email: '.$submittedData['email_public'].'</p>'. "\r\n";;
                $message_user_contents = $message_user_contents . '<p>Website: '.$submittedData['website'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Address 1: '.$submittedData['address_1'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Address 2: '.$submittedData['address_2'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Country: '.$submittedData['country'].'</p>'. "\r\n";
                
                // if USA, add State
                if($submittedData['country'] == 'USA')
                    $message_user_contents = $message_user_contents . '<p>State: '.$submittedData['state'].'</p>'. "\r\n";
                    
                // if Canada, add Providence
                if($submittedData['country'] == 'Canada')
                    $message_user_contents = $message_user_contents . '<p>Providence: '.$submittedData['providence'].'</p>'. "\r\n";
                
                $message_user_contents = $message_user_contents . '<p>City: '.$submittedData['city'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Zip: '.$submittedData['zip'].'</p>'. "\r\n";
                
                if($submittedData['how_to_contact'])
                    $message_user_contents = $message_user_contents . '<p>Preferred Contact Method: '.implode(',', $submittedData['how_to_contact']).'</p>'. "\r\n\r\n";
                
                $message_user_contents = $message_user_contents . '<p>Service Area Worldwide: '.$service_area_worldwide.'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Service Area Country: '.$service_area_country.'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Service Area State: '.$service_area_state.'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Service Area Province: '.$service_area_province.'</p>'. "\r\n\r\n";
                
                if($submittedData['profession'])
                    $message_user_contents = $message_user_contents . '<p>Profession: '.implode(',', $submittedData['profession']).'</p>'. "\r\n";
                
                $message_user_contents = $message_user_contents . '<p>Practice\'s Preferred Language: '.$submittedData['language'].'</p>'. "\r\n";
                
                $message_user_contents = $message_user_contents . '<p>Specialties_1: '.$submittedData['specialties_1'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Specialties_2: '.$submittedData['specialties_2'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Specialties_3: '.$submittedData['specialties_3'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Specialties_4: '.$submittedData['specialties_4'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Describe Practice: '.$submittedData['describe_practice'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Offer Remote Services: '.$submittedData['remote_consultations'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Offer Medication Management: '.$submittedData['provide_mms'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Offer Child Services: '.$submittedData['provide_cas'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Completed Training: '.$submittedData['training_program'].'</p>'. "\r\n";
                $message_user_contents = $message_user_contents . '<p>Specific Services: '.$submittedData['specific_services'].'</p>'. "\r\n";
    
                $to = "web@brightcloudstudio.com, suzismith@diagnosisdiet.com";
                $subject = "[DD] New Directory Submission";
    
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                mail($to,$subject,$message_start . $message_user_contents . $message_end, $headers);
    
            }
        }
    }

}
