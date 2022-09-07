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
    'Bcs\Module\DirectoryList' 		=> 'system/modules/contao_directory/library/Bcs/Module/DirectoryList.php',
	'Bcs\Backend\Locations' 		=> 'system/modules/contao_directory/library/Bcs/Backend/DirectoryListBackend.php',
	'Bcs\Model\Location' 			=> 'system/modules/contao_directory/library/Bcs/Model/ContactDirectory.php'
));

/* Register the templates */
TemplateLoader::addFiles(array
(
   	'mod_directory_list' 		=> 'system/modules/contao_directory/templates/modules',
	'item_listing' 		            => 'system/modules/contao_directory/templates/items',
));
