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
 
class DirectoryList extends \Contao\Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_directory_list';
 
	/**
	 * Initialize the object
	 *
	 * @param \ModuleModel $objModule
	 * @param string       $strColumn
	 */
	public function __construct($objModule, $strColumn='main')
	{
		parent::__construct($objModule, $strColumn);
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
		
		// Return if no pending items were found
		if (!$objListing)
		{
			$this->Template->empty = 'No Listings Found';
			return;
		}
		
		// Generate List
		//while ($objListing->next())
        foreach ($objListing as $objListing)
		{
			
			$objListing = array(
				'id'		=> $objListing->id,
				'pid'		=> $objListing->pid,
				'alias'		=> $objListing->alias,
				'tstamp'	=> $objListing->tstamp,
				'timetamp'	=> \Date::parse(\Config::get('datimFormat'), $objListing->tstamp),
				'published' => $objListing->published
			);
			
			$arrListing['pid']                 = \StringUtil::deserialize($objListing->pid);
			$arrListing['name']                = $objListing->name;
			$arrListing['city']                = $objListing->city;
			$arrListing['state']               = $objListing->state;
			$arrListing['country']             = $objListing->country;

			$strItemTemplate = ($this->listings_customItemTpl != '' ? $this->listings_customItemTpl : 'item_listing');
			$objTemplate = new \FrontendTemplate($strItemTemplate);
			$objTemplate->setData($arrListing);
			$objTemplate->parse();
		}

	}

} 
