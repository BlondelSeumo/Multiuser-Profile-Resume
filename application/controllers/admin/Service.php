<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin() && !is_user()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Service';      
        $data['page'] = 'Service';   
        $data['service'] = FALSE;
        $data['services'] = $this->admin_model->select_by_user('services');
        $data['main_content'] = $this->load->view('admin/service',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Service Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/service'));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'name' => $this->input->post('name', true),
                    'details' => $this->input->post('details')
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'services');
                    $this->session->set_flashdata('msg', 'Service Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'services');
                    $this->session->set_flashdata('msg', 'Service added Successfully'); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('600');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'services');   
                }
                redirect(base_url('admin/service'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['service'] = $this->admin_model->select_option($id, 'services');
        $data['main_content'] = $this->load->view('admin/service',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'services');
        $this->session->set_flashdata('msg', 'Service activate Successfully'); 
        redirect(base_url('admin/service'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'services');
        $this->session->set_flashdata('msg', 'Service deactivate Successfully'); 
        redirect(base_url('admin/service'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'services'); 
        echo json_encode(array('st' => 1));
    }

}
	

