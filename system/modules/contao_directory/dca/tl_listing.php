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

 
/* Table tl_listing */
$GLOBALS['TL_DCA']['tl_listing'] = array
(
 
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' 	=> 	'primary',
                'alias' =>  'index'
            )
        )
    ),
 
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 1,
            'fields'                  => array('last_name', 'first_name'),
            'flag'                    => 1,
            'panelLayout'             => 'filter;search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('country', 'first_name', 'last_name'),
            'format'                  => '%s (%s %s)'
        ),
        'global_operations' => array
        (
            'export' => array
            (
                'label'               => 'Export Listings CSV',
                'href'                => 'key=exportListings',
                'icon'                => 'system/modules/contao_directory/assets/icons/file-export-icon-16.png'
            ),
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )

        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_listing']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
			
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_listing']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_listing']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_listing']['toggle'],
                'icon'                => 'visible.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('Bcs\Backend\ListingsBackend', 'toggleIcon')
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_listing']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),
 
    // Palettes
    'palettes' => array
    (
        'default'                     => '{listing_legend},first_name,last_name;{address_legend},city,state,country;{details_legend},credentials,profession;{publish_legend},published;'
    ),
 
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                       => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                       => "int(10) unsigned NOT NULL default '0'"
        ),
		'sorting' => array
		(
            'sql'                       => "int(10) unsigned NOT NULL default '0'"
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_listing']['alias'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('unique'=>true, 'rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array
			(
                array('Bcs\Backend\ListingsBackend', 'generateAlias')
			),
			'sql'                     => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
		),
		'first_name' => array
		(
			'label'                     => &$GLOBALS['TL_LANG']['tl_listing']['first_name'],
			'inputType'                 => 'text',
			'default'                   => '',
			'search'                    => true,
			'eval'                      => array('mandatory'=>true, 'tl_class'=>'w50'),
			'sql'                       => "varchar(255) NOT NULL default ''"
		),
        'last_name' => array
		(
			'label'                     => &$GLOBALS['TL_LANG']['tl_listing']['last_name'],
			'inputType'                 => 'text',
			'default'                   => '',
			'search'                    => true,
			'eval'                      => array('mandatory'=>true, 'tl_class'=>'w50'),
			'sql'                       => "varchar(255) NOT NULL default ''"
		),
        'city' => array
		(
			'label'                     => &$GLOBALS['TL_LANG']['tl_listing']['city'],
			'inputType'                 => 'text',
			'default'                   => '',
			'search'                    => true,
			'eval'                      => array('mandatory'=>true, 'tl_class'=>'w50'),
			'sql'                       => "varchar(255) NOT NULL default ''"
		),
        'state' => array
		(
			'label'                     => &$GLOBALS['TL_LANG']['tl_listing']['state'],
			'inputType'                 => 'text',
			'default'                   => '',
			'search'                    => true,
			'eval'                      => array('mandatory'=>true, 'tl_class'=>'w50'),
			'sql'                       => "varchar(255) NOT NULL default ''"
		),
        'country' => array
		(
			'label'                     => &$GLOBALS['TL_LANG']['tl_listing']['country'],
			'inputType'                 => 'text',
			'default'                   => '',
			'search'                    => true,
			'eval'                      => array('mandatory'=>true, 'tl_class'=>'w50'),
			'sql'                       => "varchar(255) NOT NULL default ''"
		),
        'credentials' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_quote_request']['credentials'],
            'inputType'               => 'select',
            'options'                 => array('md' => 'MD', 'rd' => 'RD', 'np' => 'NP', 'rn' => 'RN', 'licsw' => 'LICSW'),
            'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
        'profession' => array
		(
			'label'                     => &$GLOBALS['TL_LANG']['tl_listing']['profession'],
			'inputType'                 => 'text',
			'default'                   => '',
            'options_callback'          => array('Bcs\Backend\ListingsBackend', 'getProfessions'),
			'search'                    => true,
			'eval'                      => array('mandatory'=>true, 'tl_class'=>'w50'),
			'sql'                       => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'exclude'                 => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_listing']['published'],
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		)		
    )
);
