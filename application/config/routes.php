<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['default_controller'] = 'drimscontroller/login_ctrl';
$route['default_controller'] = 'drimscontroller/dashboard_ctrl';
$route['login_r'] = 'drimscontroller/login_ctrl';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//hudleboard
$route['hudleboard_r']	= 'drimscontroller/hudleboard_ctrl';
// $route['chart_r']	= 'drimscontroller/chart_ctrl';
$route['dash_view_det_r'] = 'drimscontroller/dash_view_det_ctrl';
$route['dash_get_city_r'] = 'drimscontroller/dash_get_city_ctrl';
$route['my_profile_r']	= 'drimscontroller/my_profile_ctrl';
$route['search_r']	= 'drimscontroller/search_ctrl';
//hudleboard

//drmd
$route['log_in_check_r'] = 'drimscontroller/log_in_check_ctrl';
$route['login_auth_update_r'] = 'drimscontroller/login_auth_update_ctrl';
$route['login_auth_r'] = 'drimscontroller/login_auth_ctrl';
$route['logout_r'] = 'drimscontroller/logout_ctrl';
$route['dashboard_r'] = 'drimscontroller/dashboard_ctrl';

$route['dashboard_home_r'] = 'drimscontroller/dashboard_home_ctrl';

$route['drmd_request_r'] = 'drimscontroller/drmd_request_ctrl';
$route['drmd_pending_r'] = 'drimscontroller/drmd_pending_ctrl';
$route['get_city_r'] = 'drimscontroller/get_city_ctrl';
$route['save_drmd_r'] = 'drimscontroller/save_drmd_ctrl';
$route['drmd_view_details_r'] = 'drimscontroller/drmd_view_details_ctrl';
$route['drmd_add_date_r'] = 'drimscontroller/drmd_add_date_ctrl';
$route['drmd_entries_r'] = 'drimscontroller/drmd_entries_ctrl';
$route['drmd_disapproved_r'] = 'drimscontroller/drmd_disapproved_ctrl';
$route['drmd_details_r'] = 'drimscontroller/drmd_details_ctrl';
$route['drmd_details_dash_r'] = 'drimscontroller/drmd_details_dash_ctrl';
$route['btn_drmd_disapp_details_r']	= 'drimscontroller/btn_drmd_disapp_details_ctrl';
$route['drmd_ris_repo_r'] = 'drimscontroller/drmd_ris_repo_ctrl';
$route['drmd_details_edit_item_r'] = 'drimscontroller/drmd_details_edit_item_ctrl';
$route['drmd_details_edit_item_r_r'] = 'drimscontroller/drmd_details_edit_item_r_r_ctrl';
$route['drmd_details_edit_uom_r'] = 'drimscontroller/drmd_details_edit_uom_ctrl';
$route['drmd_remove_r']	= 'drimscontroller/drmd_remove_ctrl';
$route['drmd_add_response_letter_r'] = 'drimscontroller/drmd_response_letter_ctrl';
$route['drmd_save_response_letter_r'] = 'drimscontroller/drmd_save_response_letter_ctrl';
$route['drmd_view_response_letter_r'] = 'drimscontroller/drmd_view_response_letter_ctrl';

$route['get_barangay_r'] = 'drimscontroller/get_barangay_ctrl';
//drmd

//drrs
$route['drrs_myentry_r'] = 'drimscontroller/drrs_myentry_ctrl';
$route['drrs_disapproved_r'] = 'drimscontroller/drrs_disapproved_ctrl';
$route['drrs_request_r'] = 'drimscontroller/drrs_request_ctrl';
$route['drrs_distri_r'] = 'drimscontroller/drrs_distri_ctrl';
$route['save_drrs_r'] = 'drimscontroller/save_drrs_ctrl';
$route['drrs_distri_save_req_r'] = 'drimscontroller/drrs_distri_save_req_ctrl';
$route['drrs_disapprove_r'] = 'drimscontroller/drrs_disapprove_ctrl';
$route['drrs_undo_r'] = 'drimscontroller/drrs_undo_ctrl';
$route['drrs_cancelled_r'] = 'drimscontroller/drrs_cancelled_ctrl';
$route['ris_repo_r'] = 'drimscontroller/ris_repo_ctrl';
$route['add_distribution_r'] = 'drimscontroller/add_distribution_ctrl';
$route['update_add_distribution_r'] = 'drimscontroller/update_add_distribution_ctrl';
$route['save_drrs_disapprove_r'] = 'drimscontroller/save_drrs_disapprove_ctrl';
$route['drrs_get_item_r'] = 'drimscontroller/drrs_get_item_ctrl';
$route['drrs_update_quatity_r'] = 'drimscontroller/drrs_update_quatity_ctrl';
//drrs

// $route['test_r'] = 'drimscontroller/test';

//rros
$route['rros_request_r'] = 'drimscontroller/rros_request_ctrl';
$route['rros_get_item_r'] = 'drimscontroller/rros_get_item_ctrl';
$route['rros_save_req_r'] = 'drimscontroller/rros_save_req_ctrl';
$route['rros_save_req_r1'] = 'drimscontroller/rros_save_req_ctrl1';
$route['rros_myentry_r'] = 'drimscontroller/rros_myentry_ctrl';
$route['rros_delinquent_r'] = 'drimscontroller/rros_delinquent_ctrl';
$route['rros_get_del_r'] = 'drimscontroller/rros_get_del_ctrl';
$route['standy_fund_r'] = 'drimscontroller/standy_fund_ctrl';
$route['rros_update_list_stand_fund_r'] = 'drimscontroller/rros_update_list_stand_fund_ctrl';
$route['rros_update_stand_fund_r'] = 'drimscontroller/rros_update_stand_fund_ctrl';
$route['rros_disapp_r'] = 'drimscontroller/rros_disapp_ctrl';
$route['view_distribution_r'] = 'drimscontroller/view_distribution_ctrl';
//rros

//drims
$route['drims_request_r'] = 'drimscontroller/drims_request_ctrl';
//drims


//warehouse
$route['wr_toreleas_r'] = 'drimscontroller/warehouse_ctrl';
$route['wr_stockpile_r'] = 'drimscontroller/wr_stockpile_ctrl';
$route['distri_id_r'] = 'drimscontroller/distri_id_ctrl';
$route['edit_distribution_r'] = 'drimscontroller/edit_distribution_ctrl';
$route['update_distribution_r'] = 'drimscontroller/update_distribution_ctrl';
$route['add_stockpile_form_r'] = 'drimscontroller/add_stockpile_form_ctrl';
$route['add_stockpile_r'] = 'drimscontroller/add_stockpile_ctrl';
$route['edit_stockpile_r'] = 'drimscontroller/edit_stockpile_ctrl';
$route['show_all_bohol_r'] = 'drimscontroller/show_all_bohol_ctrl';
//end of warehouse


//super admin
$route['super_admin_r'] = 'drimscontroller/super_admin_ctrl';
$route['su_saveuser_r'] = 'drimscontroller/su_saveuser_ctrl';
$route['add_directory_r'] = 'drimscontroller/add_directory_ctrl';
$route['su_reset_user_r'] = 'drimscontroller/su_reset_user_ctrl';
$route['su_add_item_r'] = 'drimscontroller/su_add_item_ctrl';
//end super admin

//reports
$route['eterato_r'] = 'drimscontroller/eterato_ctrl';
$route['fetch_report_r'] = 'drimscontroller/fetch_report_ctrl';
$route['fetch_more_r'] = 'drimscontroller/fetch_more_ctrl';
$route['add_pdf_file_data_r'] = 'drimscontroller/add_pdf_file_data_ctrl';

//end reports
$route['update_pass_r'] = 'drimscontroller/update_pass_ctrl';
//directories
$route['directories_r'] = 'drimscontroller/directories_ctrl';
$route['ris_edit_r'] = 'drimscontroller/ris_edit_ctrl';
$route['ris_edit_final_r'] = 'drimscontroller/ris_edit_final_ctrl';
$route['view_edit_history_r'] = 'drimscontroller/view_edit_history_ctrl';

$route['ris_get_reporting_r'] = 'drimscontroller/ris_reporting_ctrl'; 
$route['save_report_pdf_details_r'] = 'drimscontroller/save_report_pdf_details_ctr';


