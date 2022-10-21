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
        }
    }
}
