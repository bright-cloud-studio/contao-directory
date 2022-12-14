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

/* Register the classes */
ClassLoader::addClasses(array
(
    // This is the listing module
    'Bcs\Module\DirectoryList'          => 'system/modules/contao_directory/library/Bcs/Module/DirectoryList.php',
    // The Listings section in the back end
	'Bcs\Backend\ListingsBackend' 	    => 'system/modules/contao_directory/library/Bcs/Backend/ListingsBackend.php',
    // The individual listings themselves
	'Bcs\Model\Listing'                 => 'system/modules/contao_directory/library/Bcs/Model/Listing.php',
    // hook when processing form to enter our listing into db
    'Bcs\Handler'                       => 'system/modules/contao_directory/Lbrary/Bcs/Handler.php',
));

/* Register the templates */
TemplateLoader::addFiles(array
(
    // Template for front end modules
   	'mod_directory_list' 		    => 'system/modules/contao_directory/templates/modules',
    // Template for items in the front end module
	'item_listing' 		            => 'system/modules/contao_directory/templates/items',
));
