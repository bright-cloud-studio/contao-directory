<?php

/**
 * Contao Directory - Users can make submissions to a directory with a module to display and filter the results.
 *
 * Copyright (C) 2022 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/contao-directory
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

 
namespace Bcs\Backend;

use Contao\DataContainer;
use Bcs\Model\Listing;

class ListingsBackend extends \Backend
{

	public function getItemTemplates()
	{
		return $this->getTemplateGroup('item_listing');
	}

	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(\Input::get('tid')))
		{
			$this->toggleVisibility(\Input::get('tid'), (\Input::get('state') == 1), (@func_get_arg(12) ?: null));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.\Image::getHtml($icon, $label).'</a> ';
	}	
	

	public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
	{
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_listing']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_listing']['fields']['published']['save_callback'] as $callback)
			{
				if (is_array($callback))
				{
					$this->import($callback[0]);
					$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
				}
				elseif (is_callable($callback))
				{
					$blnVisible = $callback($blnVisible, ($dc ?: $this));
				}
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_listing SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")->execute($intId);
		$this->log('A new version of record "tl_listing.id='.$intId.'" has been created'.$this->getParentEntries('tl_listing', $intId), __METHOD__, TL_GENERAL);
	}
	
	public function exportListings()
	{
		$objListing = Listing::findAll();
		$strDelimiter = ',';
	
		if ($objListing) {
			$strFilename = "listings_" .(date('Y-m-d_Hi')) ."csv";
			$tmpFile = fopen('php://memory', 'w');
			
			$count = 0;
			while($objListing->next()) {
				$row = $objListing->row();
				if ($count == 0) {
					$arrColumns = array();
					foreach ($row as $key => $value) {
						$arrColumns[] = $key;
					}
					fputcsv($tmpFile, $arrColumns, $strDelimiter);
				}
				$count ++;
				fputcsv($tmpFile, $row, $strDelimiter);
			}
			
			fseek($tmpFile, 0);
			
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $strFilename . '";');
			fpassthru($tmpFile);
			exit();
		} else {
			return "Nothing to export";
		}
	}
	
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;
		
		// Generate an alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = standardize(\StringUtil::restoreBasicEntities($dc->activeRecord->name));
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_listing WHERE id=? OR alias=?")->execute($dc->id, $varValue);

		// Check whether the page alias exists
		if ($objAlias->numRows > 1)
		{
			if (!$autoAlias)
			{
				throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
			}

			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}
	
    public function getProfessions() {
        return array(
            'Psychiatrist, adult' => 'Psychiatrist, adult',
            'Psychiatrist, child and adolescent' => 'Psychiatrist, child and adolescent',
            'Psychiatric, Nurse Practitioner' => 'Psychiatric, Nurse Practitioner',
            'Psychologist' => 'Psychologist',
            'Social Worker' => 'Social Worker',
            'Counselor (LCPC, LMHC, etc.)' => 'Counselor (LCPC, LMHC, etc.)',
            'Marriage and Family Therapist' => 'Marriage and Family Therapist',
            'Health Coach' => 'Health Coach',
            'Medical Nurse Practitioner' => 'Medical Nurse Practitioner',
            'Family Physician' => 'Family Physician',
            'Internal Medicine Physician' => 'Internal Medicine Physician',
            'Naturopathic Physician' => 'Naturopathic Physician',
            'Physician Assistant' => 'Physician Assistant',
            'Registered Nurse' => 'Registered Nurse',
            'Registered Dietitian' => 'Registered Dietitian',
            'Nutrition Therapist' => 'Nutrition Therapist',
            'Neurologist' => 'Neurologist',
            'Peer Support Specialist' => 'Peer Support Specialist',
            'Food Addiction Specialist' => 'Food Addiction Specialist',
            'Obesity Medicine Specialist' => 'Obesity Medicine Specialist'
        );
    }
    
    public function optionsStates() {
		return array(
			'United States' => array(
				'Alabama' => 'Alabama',
				'Alaska' => 'Alaska',
				'Arizona' => 'Arizona',
				'Arkansas' => 'Arkansas',
				'California' => 'California',
				'Colorado' => 'Colorado',
				'Connecticut' => 'Connecticut',
				'Delaware' => 'Delaware',
				'Florida' => 'Florida',
				'Georgia' => 'Georgia',
				'Hawaii' => 'Hawaii',
				'Idaho' => 'Idaho',
				'Illinois' => 'Illinois',
				'Indiana' => 'Indiana',
				'Iowa' => 'Iowa',
				'Kansas' => 'Kansas',
				'Kentucky' => 'Kentucky',
				'Louisiana' => 'Louisiana',
				'Maine' => 'Maine',
				'Maryland' => 'Maryland',
				'Massachusetts' => 'Massachusetts',
				'Michigan' => 'Michigan',
				'Minnesota' => 'Minnesota',
				'Mississippi' => 'Mississippi',
				'Missouri' => 'Missouri',
				'Montana' => 'Montana',
				'Nebraska' => 'Nebraska',
				'Nevada' => 'Nevada',
				'New Hampshire' => 'New Hampshire',
				'New Jersey' => 'New Jersey',
				'New Mexico' => 'New Mexico',
				'New York' => 'New York',
				'North Carolina' => 'North Carolina',
				'North Dakota' => 'North Dakota',
				'Ohio' => 'Ohio',
				'Oklahoma' => 'Oklahoma',
				'Oregon' => 'Oregon',
				'Pennsylvania' => 'Pennsylvania',
				'Rhode Island' => 'Rhode Island',
				'South Carolina' => 'South Carolina',
				'South Dakota' => 'South Dakota',
				'Tennessee' => 'Tennessee',
				'Texas' => 'Texas',
				'Utah' => 'Utah',
				'Vermont' => 'Vermont',
				'Virginia' => 'Virginia',
				'Washington' => 'Washington',
				'West Virginia' => 'West Virginia',
				'Wisconsin' => 'Wisconsin',
				'Wyoming' => 'Wyoming',
				'American Samoa' => 'American Samoa',
				'District of Columbia' => 'District of Columbia',
				'Federated States of Micronesia' => 'Federated States of Micronesia',
				'Guam' => 'Guam',
				'Marshall Islands' => 'Marshall Islands',
				'Northern Mariana Islands' => 'Northern Mariana Islands',
				'Palau' => 'Palau',
				'Puerto Rico' => 'Puerto Rico',
				'Virgin Islands' => 'Virgin Islands'),
			'Canada' => array(
				'Alberta' => 'Alberta',
				'British Columbia' => 'British Columbia',
				'Manitoba' => 'Manitoba',
				'New Brunswick' => 'New Brunswick',
				'Newfoundland and Labrador' => 'Newfoundland and Labrador',
				'Nova Scotia' => 'Nova Scotia',
				'Northwest Territories' => 'Northwest Territories',
				'Nunavut' => 'Nunavut',
				'Ontario' => 'Ontario',
				'Prince Edward Island' => 'Prince Edward Island',
				'Quebec' => 'Quebec',
				'Saskatchewan' => 'Saskatchewan',
				'Yukon' => 'Yukon')
			);
	}
    
    public function optionsCountries() {
		return array(
				'USA'       => 'United States',
				'Canada'    => 'Canada',
                'Other'     => 'Other');
	}
    
    public function getDateCreated($varValue, DataContainer $dc) {
       $todaysDate = date("Y/m/d");
        return $todaysDate;
    }
    
    public function getDateApproved($varValue, DataContainer $dc) {
        $todaysDate = date("Y/m/d");
        return $todaysDate;
    }
    
}
