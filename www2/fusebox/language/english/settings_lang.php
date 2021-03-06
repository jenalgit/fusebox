<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	/*
		Down here is going to be the title for each setting category
	*/
	
	$lang['settingcategory_general_title'] = "General";
	$lang['settingcategory_support_title'] = "Support";
	$lang['settingcategory_users_title'] = "Users";
	
	/*
		Down here is going to be the title & description for each setting
	*/
	
    $lang['setting_general_display_name_title'] = "Display Name";
    $lang['setting_general_display_name_desc'] = "What name should be shown on the panel?";
	
    $lang['setting_general_language_title'] = "Language";
    $lang['setting_general_language_desc'] = "What lanaguge do you want to use?";
	$lang['setting_general_language_option_en'] = "English";
    $lang['setting_general_language_option_fr'] = "French";
	
	$lang['setting_users_allow_namechange_title'] = "Change Name";
	$lang['setting_users_allow_namechange_desc'] = "Are users allowed to change their first and last names?";
	$lang['setting_users_allow_namechange_option_firstname'] = "Firstname Only";
	$lang['setting_users_allow_namechange_option_lastname'] = "Lastname Only";
	$lang['setting_users_allow_namechange_option_neither'] = "Neither";
	$lang['setting_users_allow_namechange_option_both'] = "Firstname & Lastname";
	
	$lang['setting_users_allow_emailchange_title'] = "Can email";
	$lang['setting_users_allow_emailchange_desc'] = "Are users allowed to change their email address?";
	
	$lang['setting_support_users_canclose_title'] = "Can users close?";
	$lang['setting_support_users_canclose_desc'] = "Are users allowed to close their own support tickets?";
	
	$lang['setting_support_users_canopen_title'] = "Can users open?";
	$lang['setting_support_users_canopen_desc'] = "Are users allowed to open their own support tickets?";

	$lang['setting_users_allow_signature_bb_title'] = "Allow Signatures";
	$lang['setting_users_allow_signature_bb_desc'] = "Are users allowed to have signatures?";
	$lang['setting_users_allow_signature_bb_option_enabled'] = "Enabled";
	$lang['setting_users_allow_signature_bb_option_staff'] = "Staff Only";
	$lang['setting_users_allow_signature_bb_option_disabled'] = "Disabled";