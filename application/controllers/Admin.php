<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('admin_model');
    }
    
    function index(){
        $this->dashboard();
    }
    
    function dashboard(){
        $data['header'] = $this->page_model->setTitle('Dashboard');
        $data['number'] = array(//The number stats
          'hostels'=>  $this->table_model->countAll('hostels'),
          'users'=>  $this->table_model->countAll('users')  
        );
        $data['graph'] = $this->admin_model->dashboardGraph();
        
        $this->load->view('templates/admin/admin-header',$data);
        $this->load->view('admin/admin-home');
        $this->load->view('templates/admin/admin-footer');
    }
    
    function users(){
        $data['header'] = $this->page_model->setTitle('Users');
        $data['users'] = $this->admin_model->getUsers();
        
        $this->load->view('templates/admin/admin-header',$data);
        $this->load->view('admin/admin-users-test');
        $this->load->view('templates/admin/admin-footer');
    }
    
    function hostels(){
        $cols = array('hostel_name', 'description', 'location', 'hostel_no', 'type');
        
        $data['header'] = $this->page_model->setTitle('Hostels');
        $data['hostels'] = $this->table_model->getRowQuery('hostels', $cols);
        
        $this->load->view('templates/admin/admin-header',$data);
        $this->load->view('admin/admin-hostels');
        $this->load->view('templates/admin/admin-footer');
    }
    
    
    /**********Start: Javascript helpers**********/
   //Used in the various js files in the assets folder 
    
    //Show the users table 
    function show_users(){
        $this->admin_model->showUsers();
    }
    
    function show_suspended_users(){
        $this->admin_model->showSuspendedUsers();
    }
    
    function user_delete(){
        $this->admin_model->userDelete();
    }
    
    function user_suspend($id){
        $this->admin_model->userSuspend($id);
    }
    
    function user_restore($id){
        $this->admin_model->userRestore($id);
    }
    
    function hostel_delete($id){
        $this->admin_model->hostelDelete($id);
    }


    /**********End: Javascript helpers**********/
}
