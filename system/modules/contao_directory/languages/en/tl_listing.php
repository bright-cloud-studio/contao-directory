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


/* System Buttons */
$GLOBALS['TL_LANG']['tl_listing']['new']                        = array('New record', 'Add a new record');
$GLOBALS['TL_LANG']['tl_listing']['show']                       = array('Record details', 'Show the details of record ID %s');
$GLOBALS['TL_LANG']['tl_listing']['edit']                       = array('Edit record', 'Edit record ID %s');
$GLOBALS['TL_LANG']['tl_listing']['copy']                       = array('Copy record', 'Copy record ID %s');
$GLOBALS['TL_LANG']['tl_listing']['delete']                     = array('Delete record', 'Delete record ID %s');
$GLOBALS['TL_LANG']['tl_listing']['toggle']                     = array('Toggle record', 'Toggle record ID %s');

/* System Fields */
$GLOBALS['TL_LANG']['tl_listing']['publish_legend']             = 'Publish';
$GLOBALS['TL_LANG']['tl_listing']['alias']                      = array('Alias', 'Auto-generated alias.');
$GLOBALS['TL_LANG']['tl_listing']['published']                  = array('Published', 'Show this record on the front end.');

/* Approved Details */
$GLOBALS['TL_LANG']['tl_listing']['approved_legend']            = 'Approved Status';
$GLOBALS['TL_LANG']['tl_listing']['approved']                   = array('Approved', 'Select if this listing is Approved and live on the site');

/* Main Details */
$GLOBALS['TL_LANG']['tl_listing']['listing_legend']             = 'Main Details';
$GLOBALS['TL_LANG']['tl_listing']['first_name']                 = array('First Name', 'Enter the clinician\'s first name');
$GLOBALS['TL_LANG']['tl_listing']['last_name']                  = array('Last Name', 'Enter the clinician\'s last name');
$GLOBALS['TL_LANG']['tl_listing']['phone']                      = array('Phone Number', 'Enter the clinician\'s phone number');
$GLOBALS['TL_LANG']['tl_listing']['email_internal']             = array('Internal Email', 'This is a private email Diagnosis Diet will contact you at');
$GLOBALS['TL_LANG']['tl_listing']['email_public']               = array('Public Email', 'This is the email adress the listing will use if chosen as contact method');
$GLOBALS['TL_LANG']['tl_listing']['website']                    = array('Website', 'Enter the clinician\'s website');
$GLOBALS['TL_LANG']['tl_listing']['photo']                      = array('Photo', 'Upload clinician\'s photo');

/* Address Details */
$GLOBALS['TL_LANG']['tl_listing']['address_legend']             = array('Address Details', 'NOTE: Details will only show if that Contact Method is selected');
$GLOBALS['TL_LANG']['tl_listing']['address_1']                  = array('Address', 'Enter the clinician\'s first address line');
$GLOBALS['TL_LANG']['tl_listing']['address_2']                  = array('Addres 2', 'Enter the clinician\'s second address line');
$GLOBALS['TL_LANG']['tl_listing']['city']                       = array('City', 'Enter the clinician\'s city');
$GLOBALS['TL_LANG']['tl_listing']['state']                      = array('State/Providence', 'Enter State for United States, Providence for Canada');
$GLOBALS['TL_LANG']['tl_listing']['zip']                        = array('ZIP code', 'Enter the clinician\'s ZIP code');
$GLOBALS['TL_LANG']['tl_listing']['country']                    = array('Country', 'Enter the clinician\'s country');

/* Specific Details */
$GLOBALS['TL_LANG']['tl_listing']['details_legend']             = 'Specific Details';
$GLOBALS['TL_LANG']['tl_listing']['credentials']                = array('Credentials', 'Enter the clinician\'s credentials');
$GLOBALS['TL_LANG']['tl_listing']['profession']                 = array('Profession', 'Select the clinician\'s professions');
$GLOBALS['TL_LANG']['tl_listing']['remote_consultations']       = array('Remote Consultation', 'Select if remote consultation is provided');
$GLOBALS['TL_LANG']['tl_listing']['training_program']           = array('Training Program', 'Select if the clinician\'s has finished Dr. Ede\'s Training Program');
$GLOBALS['TL_LANG']['tl_listing']['describe_practice']          = array('Describe Practice', 'Enter a description of the clinician\'s practice');

/* Specialties */
$GLOBALS['TL_LANG']['tl_listing']['specialties_legend']         = 'Specialties';
$GLOBALS['TL_LANG']['tl_listing']['specialties_1']              = array('Specialties #1', 'List clinician\'s specialties');
$GLOBALS['TL_LANG']['tl_listing']['specialties_2']              = array('Specialties #2', 'List clinician\'s specialties');
$GLOBALS['TL_LANG']['tl_listing']['specialties_3']              = array('Specialties #3', 'List clinician\'s specialties');
$GLOBALS['TL_LANG']['tl_listing']['specialties_4']              = array('Specialties #4', 'List clinician\'s specialties');

/* Services Provided */
$GLOBALS['TL_LANG']['tl_listing']['provide_legend']             = 'Services Provided';
$GLOBALS['TL_LANG']['tl_listing']['provide_mms']                = array('Medication Management', 'Select if medication management is provided');
$GLOBALS['TL_LANG']['tl_listing']['provide_cas']                = array('Child/Adolescents Services', 'Select if child/adolescent services are provided');

/* Contact Details */
$GLOBALS['TL_LANG']['tl_listing']['contact_legend']             = 'Contact Details';
$GLOBALS['TL_LANG']['tl_listing']['how_to_contact']             = array('Contact Method', 'Select prefered method of contact');
$GLOBALS['TL_LANG']['tl_listing']['contact_details']            = array('Enter Details', 'Enter details for the selected contact method');

/* Internal Details */
$GLOBALS['TL_LANG']['tl_listing']['internal_legend']            = 'Internal Details';
$GLOBALS['TL_LANG']['tl_listing']['internal_notes']             = array('Internal Notes', 'INTERNAL - Notes');
$GLOBALS['TL_LANG']['tl_listing']['specific_services']          = array('Specific Services', 'INTERNAL - Specific Services');
$GLOBALS['TL_LANG']['tl_listing']['date_created']               = array('Date Created', 'INTERNAL - Date listing created');
$GLOBALS['TL_LANG']['tl_listing']['date_approved']              = array('Date Approved', 'INTERNAL - Date listing was approved');
