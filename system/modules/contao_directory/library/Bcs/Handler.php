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
            \Database::getInstance()->prepare("INSERT INTO tl_listing (`published`, `country`, `state`, `city`, `profession`, `credentials`, `last_name`, `first_name`, `photo`, `approved`, `specific_services`, `contact_details`, `how_to_contact`, `describe_practice`, `specialties_4`, `specialties_3`, `specialties_2`, `specialties_1`, `provide_cas`, `provide_mms`, `training_program`, `remote_consultations`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute(1, $submittedData['country'], $submittedData['state'], $submittedData['city'], $submittedData['profession'], $submittedData['credentials'], $submittedData['last_name'], $submittedData['first_name'], $bin, 'unapproved', $submittedData['specific_services'], $submittedData['contact_details'], $submittedData['contact_method'], $submittedData['describe_practice'], $submittedData['specialties_4'], $submittedData['specialties_3'], $submittedData['specialties_2'], $submittedData['specialties_1'], $submittedData['child_services'], $submittedData['medication_management'], $submittedData['training_program'], $submittedData['remote_consultation']);
        }
    }
}
