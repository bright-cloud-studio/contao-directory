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
$GLOBALS['BE_MOD']['content']['locations'] = array(
	'tables' => array('tl_location'),
	'icon'   => 'system/modules/rep_finder/assets/icons/location.png',
	'exportLocations' => array('Bcs\Backend\Locations', 'exportLocations')
);

/* Front end modules */
$GLOBALS['FE_MOD']['rep_finder']['locations_list'] 	= 'Bcs\Module\LocationsList';

/* Models */
$GLOBALS['TL_MODELS']['tl_location'] = 'Bcs\Model\Location';
