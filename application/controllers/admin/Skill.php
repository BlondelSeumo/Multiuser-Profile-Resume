<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skill extends CI_Controller {

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
        $data['page_title'] = 'Skills';      
        $data['page'] = 'Skills';   
        $data['skill'] = FALSE;
        $data['skills'] = $this->admin_model->get_skills();
        $data['sub_skills'] = $this->admin_model->get_subskills();
        $data['main_content'] = $this->load->view('admin/skill',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "skill Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/skill'));
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
                    $this->admin_model->edit_option($data, $id, 'skills');
                    $this->session->set_flashdata('msg', 'skill Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'skills');
                    $this->session->set_flashdata('msg', 'skill added Successfully'); 
                }
                redirect(base_url('admin/skill'));

            }
        }      
        
    }


    public function add_subskill()
    {   
        if($_POST)
        {   
            $id = $_POST['id'];

            //validate inputs
            $this->form_validation->set_rules('name', "skill Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/skill'));
            } else {

                if(!empty($this->input->post('orders', true))){ $orders = $this->input->post('orders', true);}else{$orders = 0;}
               
                $data=array(
                    'user_id' => user()->id,
                    'parent_id' => $this->input->post('skill', true),
                    'name' => $this->input->post('name', true),
                    'orders' => $orders,
                    'skill_level' => $this->input->post('skill_level', true),
                    'status' => 1
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != 0) {
                    $this->admin_model->edit_option($data, $id, 'skills');
                    $this->session->set_flashdata('msg', 'skill Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'skills');
                    $this->session->set_flashdata('msg', 'skill added Successfully'); 
                }
                redirect(base_url('admin/skill'));

            }
        }      
        
    }
    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'skills');
        $this->session->set_flashdata('msg', 'skill activate Successfully'); 
        redirect(base_url('admin/skill'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'skills');
        $this->session->set_flashdata('msg', 'skill deactivate Successfully'); 
        redirect(base_url('admin/skill'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'skills'); 
        echo json_encode(array('st' => 1));
    }

}
	

