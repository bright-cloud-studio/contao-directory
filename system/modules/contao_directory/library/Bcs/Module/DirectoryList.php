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

  
namespace Bcs\Module;
 
use Bcs\Model\Listing;
use Bcs\Listings; 
 
class DirectoryList extends \Contao\Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_directory_list';
 
	protected $arrStates = array();
 
	/**
	 * Initialize the object
	 *
	 * @param \ModuleModel $objModule
	 * @param string       $strColumn
	 */
	public function __construct($objModule, $strColumn='main')
	{
		parent::__construct($objModule, $strColumn);
		$this->arrStates = Listings::getStates();
	}
	
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['directory_list'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&table=tl_module&act=edit&id=' . $this->id;
 
            return $objTemplate->parse();
        }
 
        return parent::generate();
    }
 
 
    /**
     * Generate the module
     */
    protected function compile()
    {
		$objListing = Listing::findBy('published', '1');
		
		//if (!in_array('system/modules/locations/assets/js/locations.js', $GLOBALS['TL_JAVASCRIPT'])) { 
		//	$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/locations/assets/js/locations.js';
		//}
		
		// Return if no pending items were found
		if (!$objListing)
		{
			$this->Template->empty = 'No Listings Found';
			return;
		}

		$arrStates = array();
		
		// Generate List
		while ($objListing->next())
		{
			$strStateKey = $objListing->state;
			$strStateName = ($this->arrStates["United States"][$objListing->state] != '' ? $this->arrStates["United States"][$objListing->state] : $this->arrStates["Canada"][$objListing->state]);
			if (in_array($objLocation->state, array('AB','BC','MB','NB','NL','NS','NT','NU','ON','PE','QC','SK','YT'))) {
				$strStateKey = 'CAN';
				$strStateName = 'Canada - All Provinces';
			}
			
			if (!array_key_exists($strStateKey, $arrStates)) {
				$arrStates[$strStateKey] = array(
					"name" 			=> $strStateName,
					'pid'			=> $objListing->pid,
					"abbr"			=> $strStateKey,
					"listings"		=> array()
				);
			}
			
			$objListing = array(
				'id'		=> $objListing->id,
				'pid'		=> $objListing->pid,
				'alias'		=> $objListing->alias,
				'tstamp'	=> $objListing->tstamp,
				'timetamp'	=> \Date::parse(\Config::get('datimFormat'), $objListing->tstamp),
				'published' => $objListing->published
			);
			
			if ($this->jumpTo) {
				$objTarget = $this->objModel->getRelated('jumpTo');
				$arrListing['link'] = $this->generateFrontendUrl($objTarget->row()) .'?alias=' .$objListing->alias;
			}
			
			//$this->Template->categories = \StringUtil::deserialize(YOUR_VARIABLE_HERE);
			
			$arrListing['pid']                 = \StringUtil::deserialize($objListing->pid);
			$arrListing['name']                = $objListing->name;
			$arrListing['city']                = $objListing->city;
			$arrListing['state']               = $objListing->state;
			$arrListing['country']             = $objListing->country;

			$strItemTemplate = ($this->listings_customItemTpl != '' ? $this->listings_customItemTpl : 'item_listing');
			$objTemplate = new \FrontendTemplate($strItemTemplate);
			$objTemplate->setData($arrListing);
			$arrStates[$strStateKey]['listings'][] = $objTemplate->parse();
		}

		$arrTemp = $arrStates;
		unset($arrTemp['CAN']);
		uasort($arrTemp, array($this,'sortByState'));
		$arrTemp['CAN'] = $arrStates['CAN'];
		$arrStates = $arrTemp;
		
		$this->Template->stateOptions = $this->generateSelectOptions();
		$this->Template->states = $arrStates;
		
	}

	public function generateSelectOptions($blank = TRUE) {
		$strUnitedStates = '<optgroup label="United States">';
		$strCanada = '<optgroup label="Canada"><option value="CAN">All Provinces</option></optgroup>';
		foreach ($this->arrStates['United States'] as $abbr => $state) {
			if (!in_array($objListing->state, array('AB','BC','MB','NB','NL','NS','NT','NU','ON','PE','QC','SK','YT'))) {
				$strUnitedStates .= '<option value="' .$abbr .'">' .$state .'</option>';
			}
		}
		$strUnitedStates .= '</optgroup>';
		return ($blank ? '<option value="">Select Location...</option>' : '') .$strUnitedStates .$strCanada;
	}
	
	function sortByState($a, $b) {
		if ($a['Name'] == $b['Name']) {
			return 0;
		}
		return ($a['Name'] < $b['Name']) ? -1 : 1;
	}

} 
