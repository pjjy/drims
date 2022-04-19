<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class drimscontroller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct(){
        parent::__construct();
        	$this->load->helper('url');
            $this->load->model('drimsmodel');
    }

    public function log_in_check_ctrl(){
    	$sideData['first_name'] = $this->session->userdata('user')['first_name'];
    	if($this->session->userdata('user') && $this->session->userdata('user')['status'] == 0){
    		$this->load->view('header/header');
			$this->load->view('login/log_in_check', $sideData);
		}else{
			redirect('/');
		}
   	
		// $this->load->view('footer/footer');
    }

    public function login_ctrl(){
		//superadmin
		if($this->session->userdata('user')['role'] == '1' && $this->session->userdata('user')['status'] == '1'){
			redirect('super_admin_r');
		}
     	//drmd
     	if($this->session->userdata('user')['role'] == '3' && $this->session->userdata('user')['status'] == '1'){
     		redirect('drmd_request_r');
     	}
     	//drrs
     	if($this->session->userdata('user')['role'] == '4' && $this->session->userdata('user')['status'] == '1'){
     		redirect('drrs_request_r');
     	}
     	//rros
     	if($this->session->userdata('user')['role'] == '5' && $this->session->userdata('user')['status'] == '1'){
     		redirect('rros_request_r');
     	}
     	//drims
     	if($this->session->userdata('user')['role'] == '6' && $this->session->userdata('user')['status'] == '1'){
     		redirect('drims_request_r');
     	}
      	if($this->session->userdata('user')['role'] == 1 || $this->session->userdata('user')['role'] == 2 || $this->session->userdata('user')['role'] == 3 || $this->session->userdata('user')['role'] == 4 || $this->session->userdata('user')['role'] == 5 || $this->session->userdata('user')['role'] == 6  && $this->session->userdata('user')['status'] == 0){
     		redirect('log_in_check_r');
     	}
     	else{
     		$this->load->library('session');
	    	$this->load->view('header/header');
			$this->load->view('login/login');
			$this->load->view('footer/footer');
     	}
    }

    public function login_auth_ctrl(){
    	// $this->drimsmodel->login_auth_mod('12345','12345');
  		$this->load->library('session');
		$data =	$this->drimsmodel->login_auth_mod($this->input->post('username'),$this->input->post('password'));
		// print_r($data);
		if($data){
			if($data['role'] == '1'){
				if($data['status'] == 0){
					$this->session->set_userdata('user', $data);
					redirect('log_in_check_r');
				}else{
					$this->session->set_userdata('user', $data);
					redirect('super_admin_r');
				}
			}//SU ADMIN
			if($data['role'] == '3'){
				if($data['status'] == 0){
					$this->session->set_userdata('user', $data);
					redirect('log_in_check_r');
				}else{
					$this->session->set_userdata('user', $data);
					redirect('drmd_request_r');
				}
			}//DRMD
			if($data['role'] == '4'){
				if($data['status'] == 0){
					$this->session->set_userdata('user', $data);
					redirect('log_in_check_r');
				}else{
					$this->session->set_userdata('user', $data);
					redirect('drrs_request_r');
				}	
			}//DRRS
			if($data['role'] == '5'){
				if($data['status'] == 0){
					$this->session->set_userdata('user', $data);
					redirect('log_in_check_r');
				}else{
					$this->session->set_userdata('user', $data);
					redirect('rros_request_r');
				}	
			}//RROS
			if($data['role'] == '6'){
				if($data['status'] == 0){
					$this->session->set_userdata('user', $data);
					redirect('log_in_check_r');
				}else{
					$this->session->set_userdata('user', $data);
					redirect('dashboard_r');
				}	
			}//drims
			
			//DIVISION CHIEF
		}else{
			header('location:'.base_url());
			$this->session->set_flashdata('error','Invalid login. User not found');
		}
    }

    public function login_auth_update_ctrl(){
	    	$this->drimsmodel->login_auth_update_mod($this->session->userdata('user')['usr_id'],$this->session->userdata('user')['user_id'],$this->input->post('new_password'),$this->input->post('email'));
   			$this->load->library('session');
			$this->session->unset_userdata('user');
			header('location:'.base_url());
    }

    public function drmd_details_ctrl(){
	    if(isset($_POST['drmd_id'])){
	 		$this->drimsmodel->drmd_details_mod($this->input->post('drmd_id'));
	    }
    	    // $this->drimsmodel->drmd_details_mod('1');
    }

    public function btn_drmd_disapp_details_ctrl(){
    	if(isset($_POST['drmd_id'])){
    		$this->drimsmodel->btn_drmd_disapp_details_mod($this->input->post('drmd_id')); 
    	}
    }

    public function drmd_remove_ctrl(){
    	if(isset($_POST['drid'])){
    		$this->drimsmodel->drmd_remove_mod($_POST['drid']);
    	}
    }

    public function search_ctrl(){
    	if(isset($_POST['search'])){
    		$this->drimsmodel->search_mod($_POST['search']);
    	}
    }

//DRMD VIEWS
    
    public function dashboard_ctrl(){
    	$this->load->library('session');

    	$sideData['first_name']					= $this->session->userdata('user')['first_name'];
    	$sideData['user_id']					= $this->session->userdata('user')['user_id'];
		$sideData['last_name'] 					= $this->session->userdata('user')['last_name'];
		$sideData['count_pending'] 				= $this->drimsmodel->count_pending_mod();
		$sideData['count_disapproved']  		= $this->drimsmodel->count_disapproved();
		$sideData['count_processed'] 			= $this->drimsmodel->count_processed();
		$sideData['count_delinquent'] 			= $this->drimsmodel->count_delinquent();

		$sideData['count_pending_dr_mod'] 		= $this->drimsmodel->count_pending_dr_mod();
		$sideData['count_processed_dr_mod'] 	= $this->drimsmodel->count_processed_dr_mod();
		$sideData['count_ris_dr_mod'] 			= $this->drimsmodel->count_ris_dr_mod();


		$sideData['cound_drmd_entry']			= $this->drimsmodel->cound_drmd_entry_mod();
		$sideData['count_ris_dr_mod']			= $this->drimsmodel->count_ris_dr_mod();


    	$dashData['total_assistance']			= $this->drimsmodel->get_overall_ass_mod();
    	$dashData['total_ffp']			    	= $this->drimsmodel->get_overall_ffp_mod();
    	$dashData['total_to_distribute']		= $this->drimsmodel->get_overall_to_distri_ffp_mod();
    	$dashData['get_segregated_province']	= $this->drimsmodel->get_segregated_province_mod();
    	$dashData['get_running_data'] 			= $this->drimsmodel->get_running_data_mod();
    	$dashData['get_cost_food'] 				= $this->drimsmodel->get_cost_food();
    	$dashData['get_cost_non_food'] 			= $this->drimsmodel->get_cost_non_food();

    	$dashData['get_latest_fund'] = $this->drimsmodel->get_latest_fund_mod(); //standby fund


		$dashData['get_incident'] 	    	= $this->drimsmodel->get_incident_mod();
		$dashData['get_province'] 	    	= $this->drimsmodel->get_province_mod();
		$dashData['get_default_city']   	= $this->drimsmodel->get_default_city_mod('0712');
		$dashData['get_requester']	    	= $this->drimsmodel->get_requester();
		
    	if($this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');

			if($this->session->userdata('user')['role'] == '1'){
				$this->load->view('sidebar/susidebar', $sideData);
			}
			if($this->session->userdata('user')['role'] == '3'){
					$this->load->view('sidebar/drmdsidebar', $sideData);
			}
			if($this->session->userdata('user')['role'] == '4'){
				$this->load->view('sidebar/drrssidebar', $sideData);
			}
			if($this->session->userdata('user')['role'] == '5'){
				$this->load->view('sidebar/rrossidebar', $sideData);
			}
			if($this->session->userdata('user')['role'] == '6'){
				$this->load->view('sidebar/drimssidebar', $sideData);
				// $this->load->view('sidebar/rrossidebar', $sideData);
			}

			$this->load->view('dashboard/dashboard', $dashData);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
    	}
    	else if($this->session->userdata('user')['status'] == 0){
     		redirect('log_in_check_r');
     	}
    	else{
			redirect('/');
    	}
    }

    public function drmd_request_ctrl(){
    	$this->load->library('session');
    	$data['get_drmd_request']     = $this->drimsmodel->get_drmd_entries_mod();
    	$data['get_requester']	      = $this->drimsmodel->get_requester();
    	$data['get_incident'] 	      = $this->drimsmodel->get_incident_mod();
    	$data['get_province'] 	      = $this->drimsmodel->get_province_mod();
    	$data['get_default_city']     = $this->drimsmodel->get_default_city_mod('0712');

    	$data['get_food_items'] = $this->drimsmodel->get_item_mod();
		$data['get_non_food_items'] = $this->drimsmodel->get_non_food_item_mod();
		$data['get_food_item_uom']  = $this->drimsmodel->get_item_uom_mod();

		$sideData['first_name']       = $this->session->userdata('user')['first_name'];
		$sideData['user_id']		  = $this->session->userdata('user')['user_id'];
		$sideData['cound_drmd_entry'] = $this->drimsmodel->cound_drmd_entry_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_ris_dr_mod'] = $this->drimsmodel->count_ris_dr_mod();

		if($this->session->userdata('user')['role'] == 3 && $this->session->userdata('user')['status'] == 1){
    		$this->load->view('header/header');
			$this->load->view('sidebar/drmdsidebar',$sideData);
			$this->load->view('pages/drmd/drmd_request',$data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
    	}else{
    		redirect('/');
    	}
    	
    }

    public function get_city_ctrl(){
		$this->drimsmodel->get_city_mod($this->input->post('post_province_id'));
	}

	public function save_drmd_ctrl(){
		if(isset($_POST['incident'])){
			$this->drimsmodel->save_drmd_mod(
				$this->input->post('incident'),
				$this->input->post('province'),
				$this->input->post('municipality'),
				$this->input->post('requester'),
				$this->input->post('otherrequester'),
				$this->input->post('otherincident'),
				$this->input->post('remarks'),
				$this->input->post('datepicker'),
				$this->input->post('datepicker1'),
				$this->input->post('food_item'), 			//array
				$this->input->post('food_qty'),				//array
				$this->input->post('food_uom'),				//array
				$this->input->post('non_food_item'),		//array
				$this->input->post('non_food_qty'),			//array
				$this->input->post('non_food_uom'),			//array
				$this->session->userdata('user')['user_id']	
			);
		}
	}

	public function drmd_pending_ctrl(){
		$this->load->library('session');
		$data['get_drrs_request']  = $this->drimsmodel->get_drrs_request_mod();
		$sideData['first_name']    = $this->session->userdata('user')['first_name'];
		$sideData['user_id']	   = $this->session->userdata('user')['user_id'];
		if($this->session->userdata('user')['role'] == 3 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/drmdsidebar',$sideData);
			$this->load->view('pages/drmd/drmd_pending',$data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}	
	}
	
	public function drmd_entries_ctrl(){
		$this->load->library('session');
		$data['get_drmd_request']     = $this->drimsmodel->get_drmd_entries_mod();
		
		$sideData['first_name']       = $this->session->userdata('user')['first_name'];
		$sideData['user_id']		  = $this->session->userdata('user')['user_id'];
		$sideData['cound_drmd_entry'] = $this->drimsmodel->cound_drmd_entry_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_ris_dr_mod'] = $this->drimsmodel->count_ris_dr_mod();


		if($this->session->userdata('user')['role'] == 3 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/drmdsidebar',$sideData);
			$this->load->view('pages/drmd/drmd_entries',$data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}

	public function drmd_disapproved_ctrl(){
		$this->load->library('session');
		// $data['get_drmd_request']     = $this->drimsmodel->get_drmd_entries_mod();
		$data['get_drrs_disap_request'] = $this->drimsmodel->get_drrs_disap_request_mod();
		
		$sideData['first_name']         = $this->session->userdata('user')['first_name'];
		$sideData['user_id']		    = $this->session->userdata('user')['user_id'];
		$sideData['cound_drmd_entry']   = $this->drimsmodel->cound_drmd_entry_mod();
		$sideData['count_disapproved']  = $this->drimsmodel->count_disapproved();
		$sideData['count_ris_dr_mod']   = $this->drimsmodel->count_ris_dr_mod();


		if($this->session->userdata('user')['role'] == 3 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/drmdsidebar', $sideData);
			$this->load->view('pages/drmd/drmd_disapproved_entries', $data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}

	public function drmd_view_details_ctrl(){
		if(isset($_POST['drid'])){
			if($this->session->userdata('user')['role'] == 5 && $this->session->userdata('user')['status'] == 1){
				$this->drimsmodel->drrs_dristibution_mod($this->input->post('drid'));
			}else{
 				$this->drimsmodel->drmd_view_details_mod($this->input->post('drid'));
			}
		}
	}
	//END DRMD VIEWS

	//drrs
	public function add_distribution_ctrl(){
		if(isset($_POST['rosit'])){
			$this->drimsmodel->add_distribution_mod($_POST['rosit']);
		}
	}

	public function drrs_request_ctrl(){
		$this->load->library('session');
		$data['get_drmd_request'] = $this->drimsmodel->get_drmd_request_mod();
		$data['get_food_items'] = $this->drimsmodel->get_item_mod();
		$data['get_non_food_items'] = $this->drimsmodel->get_non_food_item_mod();
		$data['get_food_item_uom']  = $this->drimsmodel->get_item_uom_mod();

		$sideData['first_name'] = $this->session->userdata('user')['first_name'];
		$sideData['user_id'] = $this->session->userdata('user')['user_id'];
		$sideData['count_pending_dr_mod'] = $this->drimsmodel->count_pending_dr_mod();
		$sideData['count_processed_dr_mod'] = $this->drimsmodel->count_processed_dr_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_ris_dr_mod'] = $this->drimsmodel->count_ris_dr_mod();

		if($this->session->userdata('user')['role'] == 4 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/drrssidebar',$sideData);
			$this->load->view('pages/drrs/drrs_request', $data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}	

	public function drrs_myentry_ctrl(){
		$this->load->library('session');
		$data['get_rros_entries'] = $this->drimsmodel->get_rros_entries_mod();
		// $data['get_drmd_request'] = $this->drimsmodel->get_drmd_request_mod();
		// $data['get_cancelled_entry'] = $this->drimsmodel->drrs_cancelled_mod();
		$data['get_rros_request'] = $this->drimsmodel->get_drrs_done_request_mod();
		// $data['get_food_items'] = $this->drimsmodel->get_item_mod();
		// $data['get_non_food_items'] = $this->drimsmodel->get_non_food_item_mod();
		// $data['get_food_item_uom']  = $this->drimsmodel->get_item_uom_mod();

		$sideData['first_name'] = $this->session->userdata('user')['first_name'];
		$sideData['user_id']	= $this->session->userdata('user')['user_id'];
		$sideData['count_pending_dr_mod'] = $this->drimsmodel->count_pending_dr_mod();
		$sideData['count_processed_dr_mod'] = $this->drimsmodel->count_processed_dr_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_ris_dr_mod'] = $this->drimsmodel->count_ris_dr_mod();
		
		if($this->session->userdata('user')['role'] == 4 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/drrssidebar',$sideData);
			$this->load->view('pages/drrs/drrs_entries', $data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}	

	public function test_ctrl(){
		$this->drimsmodel->get_drrs_disap_request_mod();
	}

	public function drrs_disapproved_ctrl(){
		$this->load->library('session');
		// $data['get_rros_entries'] = $this->drimsmodel->get_rros_entries_mod();
		// $data['get_drmd_request'] = $this->drimsmodel->get_drmd_request_mod();
		// $data['get_cancelled_entry'] = $this->drimsmodel->drrs_cancelled_mod();
		// $data['get_rros_request'] = $this->drimsmodel->get_drrs_done_request_mod();
		// $data['get_food_items'] = $this->drimsmodel->get_item_mod();
		// $data['get_non_food_items'] = $this->drimsmodel->get_non_food_item_mod();
		// $data['get_food_item_uom']  = $this->drimsmodel->get_item_uom_mod();

		$data['get_drrs_disap_request'] = $this->drimsmodel->get_drrs_disap_request_mod();
		$sideData['first_name'] = $this->session->userdata('user')['first_name'];
		$sideData['user_id']	= $this->session->userdata('user')['user_id'];
		$sideData['count_pending_dr_mod'] = $this->drimsmodel->count_pending_dr_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_processed_dr_mod'] = $this->drimsmodel->count_processed_dr_mod();
		$sideData['count_ris_dr_mod'] = $this->drimsmodel->count_ris_dr_mod();
		
		if($this->session->userdata('user')['role'] == 4 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/drrssidebar',$sideData);
			$this->load->view('pages/drrs/drrs_disapproved_entries', $data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}

	public function drrs_disapprove_ctrl(){
		if(isset($_POST['drid'])){
			$this->drimsmodel->drrs_disapprove_mod($_POST['drid'], $this->session->userdata('user')['user_id']);
		}
	}

	public function ris_repo_ctrl(){
		if(isset($this->session->userdata('user')['user_id'])){
		
			$data['get_rros_entries'] = $this->drimsmodel->get_rros_entries_mod();
			$sideData['first_name'] = $this->session->userdata('user')['first_name'];
			$sideData['user_id']	= $this->session->userdata('user')['user_id'];
			$sideData['count_pending_dr_mod'] = $this->drimsmodel->count_pending_dr_mod();
			$sideData['count_processed_dr_mod'] = $this->drimsmodel->count_processed_dr_mod();
			$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
			$sideData['count_ris_dr_mod'] = $this->drimsmodel->count_ris_dr_mod();

			$this->load->view('header/header');
			$this->load->view('sidebar/drrssidebar', $sideData);
			$this->load->view('pages/drrs/drrs_ris_repo', $data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');	
		}else{
			redirect('/');
		}
	}

	public function drmd_ris_repo_ctrl(){
		if(isset($this->session->userdata('user')['user_id'])){
			$sideData['first_name']       = $this->session->userdata('user')['first_name'];
			$sideData['user_id']		  = $this->session->userdata('user')['user_id'];
			$sideData['cound_drmd_entry'] = $this->drimsmodel->cound_drmd_entry_mod();
			$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
			$sideData['count_ris_dr_mod'] = $this->drimsmodel->count_ris_dr_mod();
			
			$data['get_rros_entries'] = $this->drimsmodel->get_rros_entries_mod();
			$this->load->view('header/header');
			$this->load->view('sidebar/drmdsidebar', $sideData);
			$this->load->view('pages/drmd/drmd_ris_repo', $data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');	
		}else{
			redirect('/');
		}
	}

	public function drmd_details_edit_item_ctrl(){
		if(isset($_POST['drid'])){
			$this->drimsmodel->drmd_details_edit_item_mod($this->input->post('drid'));
		}
	}

	public function drmd_details_edit_item_r_r_ctrl(){
		if($_POST['drid']){
	
			$this->drimsmodel->drmd_details_edit_item_r_r_mod($_POST['drid'],$_POST['drmd_id'],$_POST['edit_items'],$_POST['edit_uom'],$_POST['remarks']);
		}
	}


	public function drrs_undo_ctrl(){
		if(isset($_POST['drid'])){
			$this->drimsmodel->drrs_undo_ctrl($_POST['drid']);
		}	
	}


	public function drmd_details_edit_uom_ctrl(){
		if(isset($_POST['drid'])){
			$this->drimsmodel->drmd_details_edit_uom_mod($_POST['drid']);
		}
	}

	public function save_drrs_ctrl(){
		if(isset($_POST['req_id'])){
		$this->load->library('session');
		$this->drimsmodel->save_drrs_mod(
				$this->input->post('req_id'),
				$this->input->post('date_letter_req_rec_from_drmd'),
				$this->input->post('date_approval_drmd'),
				$this->input->post('date_incident'),
				$this->input->post('num_beneficiaries'),
				$this->input->post('item_id_arr'),
				$this->input->post('cqty_uom_arr'),	
				$this->input->post('cqty_requested_arr'),	
				$this->input->post('cqty_release_arr'),	
				$this->session->userdata('user')['user_id']
		  );
		}
	}

		
	public function save_drrs_disapprove_ctrl(){

		if(isset($_POST['req_id'])){
			$this->drimsmodel->save_drrs_disapprove_mod($this->input->post('req_id'),$this->input->post('reasons'),);	
		}

	}

	public function drrs_distri_save_req_ctrl(){
		if(isset($_POST['req_id'])){
			$this->load->library('session');
			$this->drimsmodel->drrs_distri_save_req_mod(
				$this->input->post('req_id'),
			 	$this->input->post('no_affected_fam'),
				$this->input->post('qty_ffp_req'),
				$this->input->post('date_of_distribution'),
				$this->input->post('total_qty_distributed'),
				$this->input->post('balance'),
				$this->input->post('area_of_distribution'),
				$this->input->post('total_no_asper_rds'),
				$this->input->post('date_of_submission'),
				$this->input->post('date_received'),
				$this->input->post('doc_upload'),
				$this->session->userdata('user')['user_id']
			);
		}
	}

	public function drrs_distri_ctrl(){	
		$this->load->library('session');
		// $data['get_drrs_distri_liqui'] = $this->drimsmodel->get_drrs_distri_liqui_mod();
		$data['get_rros_entries'] = $this->drimsmodel->get_rros_entries_mod();
		$sideData['first_name'] = $this->session->userdata('user')['first_name'];
		$sideData['user_id']	= $this->session->userdata('user')['user_id'];
		$sideData['count_pending_dr_mod'] = $this->drimsmodel->count_pending_dr_mod();
		$sideData['count_processed_dr_mod'] = $this->drimsmodel->count_processed_dr_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_ris_dr_mod'] = $this->drimsmodel->count_ris_dr_mod();

		if($this->session->userdata('user')['role'] == 4 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/drrssidebar',$sideData);
			$this->load->view('pages/drrs/drrs_distri_liqui',$data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}

	public function logout_ctrl(){
		$this->load->library('session');
		$this->session->unset_userdata('user');
		redirect('/');
	}

	public function drrs_cancelled_ctrl(){
		$this->drimsmodel->drrs_cancelled_mod();
	}

	public function drrs_update_quatity_ctrl(){
		if(isset($_POST['drrsid'])){
			$this->drimsmodel->drrs_update_quatity_mod($_POST['drrsid'], $_POST['quantity']);	
		}
		
	}

	//rros
	public function rros_request_ctrl(){
		$this->load->library('session');
		$data['get_rros_request'] = $this->drimsmodel->get_rros_request_mod();
		$sideData['first_name'] = $this->session->userdata('user')['first_name'];
		$sideData['last_name'] = $this->session->userdata('user')['last_name'];
		$sideData['user_id']	= $this->session->userdata('user')['user_id'];
		$sideData['last_name'] = $this->session->userdata('user')['last_name'];
		$sideData['count_pending'] = $this->drimsmodel->count_pending_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_processed'] = $this->drimsmodel->count_processed();
		$sideData['count_delinquent'] = $this->drimsmodel->count_delinquent();
		// $sideData[''] = $this->
		if($this->session->userdata('user')['role'] == 5 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/rrossidebar', $sideData);
			$this->load->view('pages/rros/rros_request', $data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}

	public function rros_get_item_ctrl(){
		if(isset($_POST['id'])){
			$this->drimsmodel->rros_get_item_mod($_POST['id']);
		}
		
	}

	public function drrs_get_item_ctrl(){
		if(isset($_POST['id'])){
			$this->drimsmodel->drrs_get_item_mod($_POST['id']);
		}
	}

	public function rros_save_req_ctrl(){
		$this->load->library('session');
		// if(isset($_POST['req_id'])){	
			$this->drimsmodel->rros_save_req_mod(
				$this->input->post('req_id'),
				$this->input->post('date_let_aprv_drmd'),
				$this->input->post('date_crd_pull_fr_drmd'),
				$this->input->post('date_ris_frw_drmd'),
				$this->session->userdata('user')['user_id'],
				$this->input->post('item_uom'),
				$this->input->post('items'),
				$this->input->post('qty_requested'),
				$this->input->post('qty_approved'),
				$this->input->post('qty_released'),
				$this->input->post('qty_left'),
				$this->input->post('price'),
				$this->input->post('total')
				// $this->input->post('warehouse'),
				// $this->input->post('trucking')
			);
			
		// }	
	}

	public function rros_save_req_ctrl1(){
		$this->load->library('session');
		if(isset($_POST['req_id'])){	
			$this->drimsmodel->rros_save_req_mod1(
				$this->input->post('id'),
				$this->input->post('req_id'),
				$this->input->post('date_let_aprv_drmd'),
				$this->input->post('date_crd_pull_fr_drmd'),
				$this->input->post('date_ris_frw_drmd'),
				$this->session->userdata('user')['user_id'],
				$this->input->post('item_uom'),
				$this->input->post('items'),
				$this->input->post('qty_requested'),
				$this->input->post('qty_approved'),
				$this->input->post('qty_released'),
				$this->input->post('qty_left'),
				$this->input->post('price'),
				$this->input->post('total')
				// $this->input->post('warehouse'),
				// $this->input->post('trucking')
			);
			
		}	
	}

	

	public function rros_myentry_ctrl(){
		$this->load->library('session');
		$data['get_rros_request'] = $this->drimsmodel->get_rros_entries_mod();
		$sideData['first_name'] = $this->session->userdata('user')['first_name'];
		$sideData['user_id']	= $this->session->userdata('user')['user_id'];
		$sideData['last_name'] = $this->session->userdata('user')['last_name'];
		$sideData['count_pending'] = $this->drimsmodel->count_pending_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_processed'] = $this->drimsmodel->count_processed();
		$sideData['count_delinquent'] = $this->drimsmodel->count_delinquent();
		if($this->session->userdata('user')['role'] == 5 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/rrossidebar',$sideData);
			$this->load->view('pages/rros/rros_entries',$data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}

	public function rros_delinquent_ctrl(){
		$this->load->library('session');
		$data['get_delinquent'] = $this->drimsmodel->rros_delinquent_mod();
		$sideData['first_name'] = $this->session->userdata('user')['first_name'];
		$sideData['user_id']	= $this->session->userdata('user')['user_id'];
		$sideData['last_name'] = $this->session->userdata('user')['last_name'];
		$sideData['count_pending'] = $this->drimsmodel->count_pending_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_processed'] = $this->drimsmodel->count_processed();
		$sideData['count_delinquent'] = $this->drimsmodel->count_delinquent();
		if($this->session->userdata('user')['role'] == 5 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/rrossidebar',$sideData);
			$this->load->view('pages/rros/rros_delinquent',$data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}	

	}


	public function rros_get_del_ctrl(){
		$this->drimsmodel->rros_get_del_mod($this->input->post('id'));
	}

	public function rros_disapp_ctrl(){
		$sideData['first_name'] 		= $this->session->userdata('user')['first_name'];
		$sideData['user_id']			= $this->session->userdata('user')['user_id'];
		$sideData['last_name'] 			= $this->session->userdata('user')['last_name'];
		$sideData['count_pending']		= $this->drimsmodel->count_pending_mod();
		$sideData['count_disapproved']  = $this->drimsmodel->count_disapproved();
		$sideData['count_processed']    = $this->drimsmodel->count_processed();
		$sideData['count_delinquent']	= $this->drimsmodel->count_delinquent();
		// $data['get_drrs_disap_request'] = $this->drimsmodel->rros_get_disapproved_mod();
		$data['get_drrs_disap_request'] = $this->drimsmodel->get_drrs_disap_request_mod();
		if($this->session->userdata('user')['role'] == 5 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/rrossidebar', $sideData);
			$this->load->view('pages/rros/drrs_disapproved_entries', $data);
			$this->load->view('footer/footer'); 
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}
	//rros

	//drims

	public function drims_request_ctrl(){
		$sideData['first_name'] 		= $this->session->userdata('user')['first_name'];
		$sideData['user_id']			= $this->session->userdata('user')['user_id'];
		$sideData['last_name'] 			= $this->session->userdata('user')['last_name'];
		if($this->session->userdata('user')['role'] == 6 && $this->session->userdata('user')['status'] == 1){
			  $this->load->view('header/header');
			  $this->load->view('sidebar/drimssidebar', $sideData);
			  // $this->load->view('pages/rros/drrs_disapproved_entries', $data);
			  $this->load->view('footer/footer'); 
			  $this->load->view('js/js');
		}else{
			  redirect('/');
		}
	}

	//end drims

	//super user
	public function su_saveuser_ctrl(){
		$this->drimsmodel->su_saveuser_mod($this->input->post('first_name'), $this->input->post('last_name'),$this->input->post('user_name'),$this->input->post('usertype'));
	}

	public function super_admin_ctrl(){
		$this->load->library('session');
		$sideData['first_name']    = $this->session->userdata('user')['first_name'];
		$sideData['last_name']     = $this->session->userdata('user')['last_name'];
		$sideData['user_id']	   = $this->session->userdata('user')['user_id'];
		$data['get_sections'] 	   = $this->drimsmodel->get_sections_mod();
		$data['get_user_list']	   = $this->drimsmodel->get_user_list_mod();

		if($this->session->userdata('user')['role'] == 1 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/susidebar', $sideData);
			$this->load->view('pages/superadmin/su_add_user', $data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}

	public function drmd_add_date_ctrl(){
		$this->load->library('session');
		if(isset($_POST['date'])){
			$this->drimsmodel->drmd_add_date_mod($this->session->userdata('user')['user_id'],$this->input->post('date'),$this->input->post('drid'));
		}
	} 


	public function eterato_ctrl(){
		$this->load->library('session');
		$data['get_incident'] 	    	= $this->drimsmodel->get_incident_mod();
		$data['get_province'] 	    	= $this->drimsmodel->get_province_mod();
		$data['get_default_city']   	= $this->drimsmodel->get_default_city_mod('0712');
		$data['get_requester']	    	= $this->drimsmodel->get_requester();
		$sideData['first_name']     	= $this->session->userdata('user')['first_name'];
		$sideData['last_name']      	= $this->session->userdata('user')['last_name'];
		$sideData['user_id']			= $this->session->userdata('user')['user_id'];
		$sideData['last_name'] 			= $this->session->userdata('user')['last_name'];
		$sideData['count_pending']  	= $this->drimsmodel->count_pending_mod();
		$sideData['count_disapproved']  = $this->drimsmodel->count_disapproved();
		$sideData['count_processed'] 	= $this->drimsmodel->count_processed();
		$sideData['count_delinquent'] 	= $this->drimsmodel->count_delinquent();
		if($this->session->userdata('user')['role'] == 5 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/rrossidebar', $sideData);
			$this->load->view('pages/report/eterato',$data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}
		else if($this->session->userdata('user')['role'] == 6 && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/drimssidebar', $sideData);
			$this->load->view('pages/report/eterato',$data);
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}
		else{
			redirect('/');
		}
	}

	public function fetch_report_ctrl(){
		$this->drimsmodel->fetch_report_mod(
			$this->input->post('incident'),
			$this->input->post('province'),
			$this->input->post('municipality'),
			$this->input->post('requester'),
			$this->input->post('datepicker'),
			$this->input->post('datepicker1')
		);
	}

	public function fetch_more_ctrl(){
		$this->drimsmodel->fetch_more_mod('25'); //reports to be done later
	}


	public function hudleboard_ctrl(){
		$data['getallprovince'] = $this->drimsmodel->hudleboard_mod();
		$this->load->view('pages/huddleboard/huddleboard', $data);
	}

	public function chart_ctrl(){
		$this->drimsmodel->chart_mod();
	}

	public function directories_ctrl(){
		if(isset($this->session->userdata('user')['user_id'])){
			$sideData['first_name'] = $this->session->userdata('user')['first_name'];
			$sideData['user_id']	= $this->session->userdata('user')['user_id'];
			$data['get_directory_loc'] = $this->drimsmodel->get_directory_loc_mod();
			$this->load->view('header/header');
			$this->load->view('sidebar/rrossidebar', $sideData);
			$this->load->view('pages/directories/directories', $data); 
			$this->load->view('footer/footer');
			$this->load->view('js/js');	
		}
		else{
			redirect('/');
		}
	}

	public function standy_fund_ctrl(){
		$this->load->library('session');
		$data['get_rros_request'] = $this->drimsmodel->get_rros_request_mod();
		$sideData['first_name'] = $this->session->userdata('user')['first_name'];
		$sideData['last_name'] = $this->session->userdata('user')['last_name'];
		$sideData['user_id'] = $this->session->userdata('user')['user_id'];
		$sideData['last_name'] = $this->session->userdata('user')['last_name'];
		$sideData['count_pending'] = $this->drimsmodel->count_pending_mod();
		$sideData['count_disapproved'] = $this->drimsmodel->count_disapproved();
		$sideData['count_processed'] = $this->drimsmodel->count_processed();
		$sideData['count_delinquent'] = $this->drimsmodel->count_delinquent();
		$data['stand_by_funds_tbl'] = $this->drimsmodel->stand_by_funds_tbl_mod();
		$data['get_latest_fund'] = $this->drimsmodel->get_latest_fund_mod();
		if($this->session->userdata('user')['role'] == 5 && $this->session->userdata('user')['status'] == 1){
		   $this->load->view('header/header');
		   $this->load->view('sidebar/rrossidebar',$sideData);
		   $this->load->view('pages/rros/rros_standby',$data); 
		   $this->load->view('footer/footer');
		   $this->load->view('js/js');
		}else{
		   redirect('/');
		}
	}

	public function rros_update_stand_fund_ctrl(){
		$this->drimsmodel->rros_update_stand_fund_mod($_POST['amount']);
	}

	public function rros_update_list_stand_fund_ctrl(){
		$this->drimsmodel->rros_update_list_stand_fund_mod($this->input->post('id'),$this->input->post('fund'));
	}

	public function dash_view_det_ctrl(){
		$this->drimsmodel->dash_view_det_mod($this->input->post('rosb_id'));
	}

	public function my_profile_ctrl(){
		$sideData['first_name'] = $this->session->userdata('user')['first_name'];
		$sideData['user_id'] = $this->session->userdata('user')['user_id'];
		$data['profile_data'] = $this->drimsmodel->profile_data_mod();
		if(isset($this->session->userdata('user')['user_id']) && $this->session->userdata('user')['status'] == 1){
			$this->load->view('header/header');
			$this->load->view('sidebar/rrossidebar', $sideData);
			$this->load->view('pages/profile/my_profile'); 
			$this->load->view('footer/footer');
			$this->load->view('js/js');
		}else{
			redirect('/');
		}
	}

	public function update_add_distribution_ctrl(){
		if(isset($_POST['rosit'])){
			$this->drimsmodel->update_add_distribution_mod($_POST['rosit'],$_POST['warehouse_id'],$_POST['trucking_id']);
		}
	}

	public function view_distribution_ctrl(){
		if(isset($_POST['rosit'])){
			$this->drimsmodel->view_distribution_mod($_POST['rosit']);
		}
	}

	public function su_reset_user_ctrl(){
		if(isset($_POST['id'])){
			$this->drimsmodel->su_reset_user_mod($_POST['id']);
		}
	}

}
