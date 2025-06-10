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

/* Add a palette to tl_module */
$GLOBALS['TL_DCA']['tl_module']['palettes']['directory_list'] 		= '{title_legend},name,headline,type;{template_legend:hide},customTpl,listings_customItemTpl;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['fields']['listings_customItemTpl'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['customItemTpl'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('Bcs\Backend\ListingsBackend', 'getItemTemplates'),
    'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
    'sql'                     => "varchar(64) NOT NULL default ''"
);
