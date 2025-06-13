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

 
namespace Bcs\Model;

use Contao\Model;

class Listing extends Model
{
	
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_listing';
    
}
