<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimonial extends CI_Controller {

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
        $data['page_title'] = 'Testimonial';      
        $data['page'] = 'Testimonial';   
        $data['testimonial'] = FALSE;
        $data['testimonials'] = $this->admin_model->select_by_user('testimonials');
        $data['main_content'] = $this->load->view('admin/testimonial',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Testimonial Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/testimonial'));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'name' => $this->input->post('name', true),
                    'feedback' => $this->input->post('feedback', true)
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'testimonials');
                    $this->session->set_flashdata('msg', 'Testimonial Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'testimonials');
                    $this->session->set_flashdata('msg', 'Testimonial added Successfully'); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('600');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'testimonials');   
                }
                redirect(base_url('admin/testimonial'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['testimonial'] = $this->admin_model->select_option($id, 'testimonials');
        $data['main_content'] = $this->load->view('admin/testimonial',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'testimonials');
        $this->session->set_flashdata('msg', 'Testimonial activate Successfully'); 
        redirect(base_url('admin/testimonial'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'testimonials');
        $this->session->set_flashdata('msg', 'Testimonial deactivate Successfully'); 
        redirect(base_url('admin/testimonial'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'testimonials'); 
        echo json_encode(array('st' => 1));
    }

}
	

