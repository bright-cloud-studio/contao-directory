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

use Contao\Config;
use Contao\Date;
use Contao\FrontendTemplate;
use Contao\System;
use Contao\StringUtil;

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
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
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
        
        // add js file for filter functions
	    $GLOBALS['TL_BODY'][] = '<script src="system/modules/contao_directory/assets/js/directory_list.js"></script>';
        
        // Sort our Listings based on the 'last_name' field
        $options = [
            'order' => 'last_name ASC'
        ];
        
		$objListing = Listing::findBy('published', '1', $options);
		
		// Return if no pending items were found
		if (!$objListing)
		{
			$this->Template->empty = 'No Listings Found';
			return;
		}
        
        $arrListings = array();
        
		
        foreach ($objListing as $listing)
		{
		    
            // if the listing is 'Approved'
            if($listing->approved == "approved") {
                // initialize
                $strListingKey = $listing->name;
                if (!array_key_exists($strListingKey, $arrListings)) {
                    $arrListings[$strListingKey] = array(
                        "name" 			=> $listing->name,
                        'id'		    => StringUtil::deserialize($listing->id),
                        'alias'		    => $listing->alias,
                        'tstamp'	    => $listing->tstamp,
                        'timetamp'	    => Date::parse(Config::get('datimFormat'), $listing->tstamp),
                        'published'     => $listing->published,
                        "listings"		=> array()
                    );
                }

                // Set values for template
                $arrListing['id']                       = $listing->id;
                $arrListing['photo']                    = $listing->photo;
                $arrListing['first_name']               = $listing->first_name;
                $arrListing['last_name']                = $listing->last_name;
                $arrListing['phone']                    = $listing->phone;
                $arrListing['email_public']             = $listing->email_public;
                $arrListing['website']                  = $listing->website;

                $arrListing['address_1']                = $listing->address_1;
                $arrListing['address_2']                = $listing->address_2;
                $arrListing['city']                     = $listing->city;
                $arrListing['zip']                      = $listing->zip;
                
                $arrListing['state']                    = $listing->state;
                $arrListing['country']                  = $listing->country;
                
                
                // Multiple choise State/Country into CSV
                if($listing->service_area_state) {
                    $state_csv = implode(",", unserialize($listing->service_area_state));
                    $arrListing['service_state']                    = $state_csv;
                } else
                $arrListing['service_state']                    = '';
                
                // Multiple choise State/Country into CSV
                if($listing->service_area_province) {
                    $province_csv = implode(",", unserialize($listing->service_area_province));
                    $arrListing['service_province']                    = $province_csv;
                } else
                $arrListing['service_province']                    = '';
                
                if($listing->service_area_country) {
                    $country_csv = implode(",", unserialize($listing->service_area_country));
                    $arrListing['service_country']                  = $country_csv;
                } else
                $arrListing['service_country']                    = '';
                
                
                $arrListing['worldwide'] = $listing->service_area_worldwide;

                

                $arrListing['credentials']              = $listing->credentials;
                $arrListing['profession']               = $listing->profession;
                $arrListing['remote_consultations']     = $listing->remote_consultations;
                $arrListing['training_program']         = $listing->training_program;
                $arrListing['describe_practice']        = $listing->describe_practice;

                $arrListing['language']                 = $listing->language;
                
                $arrListing['specialties_1']            = $listing->specialties_1;
                $arrListing['specialties_2']            = $listing->specialties_2;
                $arrListing['specialties_3']            = $listing->specialties_3;
                $arrListing['specialties_4']            = $listing->specialties_4;

                $arrListing['provide_mms']              = $listing->provide_mms;
                $arrListing['provide_cas']              = $listing->provide_cas;

                $arrListing['how_to_contact']           = $listing->how_to_contact;


                $strItemTemplate = ($this->listings_customItemTpl != '' ? $this->listings_customItemTpl : 'item_listing');
                $objTemplate = new FrontendTemplate($strItemTemplate);
                $objTemplate->setData($arrListing);
                $arrListings[$strListingKey]['listings'][] = $objTemplate->parse();
            }
		}
        
        $this->Template->listings = $arrListings;

	}
} 
