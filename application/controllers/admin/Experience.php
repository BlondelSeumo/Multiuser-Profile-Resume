<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Experience extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin() && !is_pro_user()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Experience';      
        $data['page'] = 'Experience';   
        $data['experience'] = FALSE;
        $data['experiences'] = $this->admin_model->get_experience();
        $data['sub_experience'] = $this->admin_model->get_subexperience();
        $data['main_content'] = $this->load->view('admin/experience',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "experience Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/experience'));
            } else {

                if(!empty($this->input->post('orders', true))){ $orders = $this->input->post('orders', true);}else{$orders = 0;}
               
                $data=array(
                    'user_id' => user()->id,
                    'parent_id' => 0,
                    'name' => $this->input->post('name', true),
                    'orders' => $orders,
                    'slug' => str_slug(trim($this->input->post('name', true))),
                    'status' => 1
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != 0) {
                    $this->admin_model->edit_option($data, $id, 'experience');
                    $this->session->set_flashdata('msg', 'Experience Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'experience');
                    $this->session->set_flashdata('msg', 'Experience added Successfully'); 
                }
                redirect(base_url('admin/experience'));

            }
        }      
        
    }


    public function add_subexperience()
    {   
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Experience Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/experience'));
            } else {

                if(!empty($this->input->post('orders', true))){ $orders = $this->input->post('orders', true);}else{$orders = 0;}
               
                $data=array(
                    'user_id' => user()->id,
                    'parent_id' => $this->input->post('experience', true),
                    'name' => $this->input->post('name', true),
                    'company' => $_POST['company'],
                    'date' => $this->input->post('date', true),
                    'details' => $this->input->post('details', true),
                    'orders' => $orders,
                    'status' => 1
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != 0) {
                    $this->admin_model->edit_option($data, $id, 'experience');
                    $this->session->set_flashdata('msg', 'Experience Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'experience');
                    $this->session->set_flashdata('msg', 'Experience added Successfully'); 
                }
                redirect(base_url('admin/experience'));

            }
        }      
        
    }
    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'experience');
        $this->session->set_flashdata('msg', 'Experience activate Successfully'); 
        redirect(base_url('admin/experience'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'experience');
        $this->session->set_flashdata('msg', 'Experience deactivate Successfully'); 
        redirect(base_url('admin/experience'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'experience'); 
        echo json_encode(array('st' => 1));
    }

}
	

