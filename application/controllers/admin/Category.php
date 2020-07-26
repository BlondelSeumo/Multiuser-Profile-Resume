<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

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
        $data['page_title'] = 'Category';      
        $data['page'] = 'Category';   
        $data['category'] = FALSE;
        $data['categories'] = $this->admin_model->get_categories();
        $data['main_content'] = $this->load->view('admin/category/category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', "Category Name", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/category'));
            } else {
               
                $data=array(
                    'name' => $this->input->post('name', true),
                    'slug' => str_slug(trim($this->input->post('name', true))),
                    'description' => $this->input->post('description', true),
                    'keywords' => $this->input->post('keywords', true),
                    'cat_order' => $this->input->post('cat_order', true),
                    'status' => $this->input->post('status', true),
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'category');
                    $this->session->set_flashdata('msg', 'Category Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'category');
                    $this->session->set_flashdata('msg', 'Category added Successfully'); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('600');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'category');   
                }
                redirect(base_url('admin/category'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['category'] = $this->admin_model->select_option($id, 'category');
        $data['main_content'] = $this->load->view('admin/category/category',$data,TRUE);
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

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'category');
        $this->session->set_flashdata('msg', 'Category deactivate Successfully'); 
        redirect(base_url('admin/category'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'category'); 
        echo json_encode(array('st' => 1));
    }

}
	

