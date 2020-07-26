<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $this->all_users('all');
    }


    //all users list
    public function all_users($type)
    {
        $data = array();
        $data['page_title'] = 'Users';
        $data['users'] = $this->admin_model->get_all_users($type);
        $data['main_content'] = $this->load->view('admin/user/admin_users', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //all pro users list
    public function pro($type = 'pro')
    {
        $data = array();
        $data['page_title'] = 'Users';
        $data['users'] = $this->admin_model->get_all_users($type);
        $data['main_content'] = $this->load->view('admin/user/admin_users', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //active or deactive post
    public function status_action($type, $id) 
    {
        $data = array(
            'status' => $type
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'users');

        if($type ==1):
            $this->session->set_flashdata('msg', 'Activate Successfully'); 
        else:
            $this->session->set_flashdata('msg', 'Deactivate Successfully'); 
        endif;
        redirect(base_url('admin/users'));
    }

    //change user role
    public function change_account($id) 
    {
        $data = array(
            'account_type' => $this->input->post('type', false)
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $id, 'users');
        $this->session->set_flashdata('msg', 'Updated Successfully');
        redirect(base_url('admin/users'));
    }

    public function edit($id='')
    {  
        if($_POST)
        {   
            $id = $this->input->post('id', true);
            $data=array(
                'name' => $this->input->post('name', true),
                'slug' => str_slug(trim($this->input->post('name', true))),
                'email' => $this->input->post('email', true),
                'phone' => $this->input->post('phone', true),
                'designation' => $this->input->post('designation', true),
                'address' => $this->input->post('address', true),
                'account_type' => $this->input->post('type', true)
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, $id, 'users');

            $payment = $this->common_model->get_user_payment($id);
            if (!empty($payment)) {
                $pay_data=array(
                    'package' => $this->input->post('type'),
                    'created_at' => my_date_now()
                );
                $pay_data = $this->security->xss_clean($pay_data);
                $this->admin_model->update($pay_data, $payment->id, 'payment');
            }


            $this->session->set_flashdata('msg', 'User Edited Successfully');
            redirect(base_url('admin/users'));
        }

        $data = array();
        $data['page_title'] = 'Edit';   
        $data['user'] = $this->admin_model->get_by_id($id, 'users');
        $data['main_content'] = $this->load->view('admin/user/edit',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'category');
        $this->session->set_flashdata('msg', 'Category activate Successfully'); 
        redirect(base_url('admin/category'));
    }


    public function delete($id)
    {
        $this->admin_model->delete($id,'users'); 
        echo json_encode(array('st' => 1));
        
    }


}