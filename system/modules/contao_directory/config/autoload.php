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
    'Asc\Module\LocationsList' 	=> 'system/modules/locations/library/Asc/Module/LocationsList.php',
	'Asc\Backend\Locations' 	=> 'system/modules/locations/library/Asc/Backend/Locations.php',
	'Asc\Model\Location' 		=> 'system/modules/locations/library/Asc/Model/Location.php',
	'Asc\Locations'		 		=> 'system/modules/locations/library/Asc/Locations.php'
));

/* Register the templates */
TemplateLoader::addFiles(array
(
   	'mod_directory_list' 		=> 'system/modules/contao_directory/templates/modules',
	'item_listing' 		            => 'system/modules/contao_directory/templates/items',
));
