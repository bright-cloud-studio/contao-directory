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
    
    // contains our listings
    protected $arrListings = array();
 
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
        
        $arrListings = array();
        
		
		// Generate List
		//while ($objListing->next())
        foreach ($objListing as $listing)
		{
		    $strListingKey = $listing->name;
		    
		    if (!array_key_exists($strListingKey, $arrListings)) {
				$arrListings[$strListingKey] = array(
					"name" 			=> $listing->name,
					"abbr"			=> 'tst',
					"listings"		=> array()
				);
			}
		    	
			$objListing = array(
				'id'		=> $listing->id,
				'pid'		=> $listing->pid,
				'alias'		=> $listing->alias,
				'tstamp'	=> $listing->tstamp,
				'timetamp'	=> \Date::parse(\Config::get('datimFormat'), $listing->tstamp),
				'published' => $listing->published
			);
			
			$arrListing['pid']                 = \StringUtil::deserialize($listing->pid);
			$arrListing['name']                = $listing->name;
			$arrListing['city']                = $listing->city;
			$arrListing['state']               = $listing->state;
			$arrListing['country']             = $listing->state;

			$strItemTemplate = ($this->listings_customItemTpl != '' ? $this->listings_customItemTpl : 'item_listing');
			$objTemplate = new \FrontendTemplate($strItemTemplate);
			$objTemplate->setData($arrListing);
            $arrListings[$strListingKey]['listings'][] = $objTemplate->parse();
		}
        
        $this->Template->listings = $arrListings;

	}

} 
