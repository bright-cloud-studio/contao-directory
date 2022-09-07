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

/* Back end modules */
$GLOBALS['BE_MOD']['content']['contao_directory'] = array(
	'tables' => array('tl_listing'),
	'icon'   => 'system/modules/contao_directory/assets/icons/location.png',
	'exportLocations' => array('Bcs\Backend\ContaoDirectoryBackend', 'exportLocations')
);

/* Front end modules */
$GLOBALS['FE_MOD']['contao_directory']['directory_listing'] 	= 'Bcs\Module\LocationsList';

/* Models */
$GLOBALS['TL_MODELS']['contao_directory'] = 'Bcs\Model\Listing';
