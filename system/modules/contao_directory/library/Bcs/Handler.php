<?php

namespace Bcs;

use Contao\Database;

class Handler
{
    protected static $arrUserOptions = array();

    public function onProcessForm($submittedData, $formData, $files, $labels, $form)
    {
        $img = \FilesModel::findByUuid($files['photo']['uuid']);
        $bin = \StringUtil::uuidToBin($files['photo']['uuid']);

        
        // insert form data into tl_listing
        \Database::getInstance()->prepare("INSERT INTO tl_listing (`published`, `country`, `state`, `city`, `profession`, `credentials`, `last_name`, `first_name`, `photo`, `approved`, `specific_services`, `contact_details`, `how_to_contact`, `describe_practice`, `specialties_4`, `specialties_3`, `specialties_2`, `specialties_1`, `provide_cas`, `provide_mms`, `training_program`, `remote_consultations`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")->execute(1, $submittedData['country'], $submittedData['state'], $submittedData['city'], $submittedData['profession'], $submittedData['credentials'], $submittedData['last_name'], $submittedData['first_name'], $bin, 'unapproved', $submittedData['specific_services'], $submittedData['contact_details'], $submittedData['contact_method'], $submittedData['describe_practice'], $submittedData['specialties_4'], $submittedData['specialties_3'], $submittedData['specialties_2'], $submittedData['specialties_1'], $submittedData['child_services'], $submittedData['medication_management'], $submittedData['training_program'], $submittedData['remote_consultation']);

        // "INSERT INTO `tl_listing` (`published`, `country`, `state`, `profession`, `credentials`, `last_name`, `first_name`, `approved`, `specific_services`, `contact_details`, `how_to_contact`, `describe_practice`, `specialties_4`, `specialties_3`, `specialties_2`, `specialties_1`, `provide_cas`, `provide_mms`, `training_program`, `remote_consultations`) VALUES (1, '".$vars['country']."', '".$vars['state']."', '".$sArray."', '".$vars['credentials']."', '".$vars['last_name']."', '".$vars['first_name']."', 'unapproved', '".$vars['specific_services']."', '".$vars['contact_details']."', '".$vars['contact_method']."', '".$vars['desc_practice']."', '".$vars['specialties_4']."', '".$vars['specialties_3']."', '".$vars['specialties_2']."', '".$vars['specialties_1']."', '".$vars['child_services']."', '".$vars['medication_management']."', '".$vars['finished_training']."', '".$vars['remote_consultation']."')"
        //$query = "INSERT INTO `tl_listing` (`published`, `country`, `state`, `profession`, `credentials`, `last_name`, `first_name`, `approved`, `specific_services`, `contact_details`, `how_to_contact`, `describe_practice`, `specialties_4`, `specialties_3`, `specialties_2`, `specialties_1`, `provide_cas`, `provide_mms`, `training_program`, `remote_consultations`) VALUES (1, '".$vars['country']."', '".$vars['state']."', '".$sArray."', '".$vars['credentials']."', '".$vars['last_name']."', '".$vars['first_name']."', 'unapproved', '".$vars['specific_services']."', '".$vars['contact_details']."', '".$vars['contact_method']."', '".$vars['desc_practice']."', '".$vars['specialties_4']."', '".$vars['specialties_3']."', '".$vars['specialties_2']."', '".$vars['specialties_1']."', '".$vars['child_services']."', '".$vars['medication_management']."', '".$vars['finished_training']."', '".$vars['remote_consultation']."')";
    }
}
