<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class portfolio extends CI_Controller {

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
        $data['page_title'] = 'Portfolio Category';      
        $data['page'] = 'Portfolio';   
        $data['portfolio'] = FALSE;
        $data['categories'] = $this->admin_model->get_portfolio_categories();
        $data['portfolios'] = $this->admin_model->select_by_user('portfolio');
        $data['main_content'] = $this->load->view('admin/portfolio/portfolio',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('title', "Title ", 'required|max_length[100]');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/portfolio'));
            } else {
               
                $data=array(
                    'user_id' => user()->id,
                    'category_id' => $this->input->post('category', true),
                    'title' => $this->input->post('title', true),
                    'link' => $this->input->post('link', true),
                    'details' => $this->input->post('details'),
                    'status' => 1
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'portfolio');
                    $this->session->set_flashdata('msg', 'Portfolio Edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'portfolio');
                    $this->session->set_flashdata('msg', 'Portfolio added Successfully'); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('1200');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'portfolio');   
                }

                redirect(base_url('admin/portfolio'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['categories'] = $this->admin_model->get_portfolio_categories();
        $data['portfolio'] = $this->admin_model->select_option($id, 'portfolio');
        $data['main_content'] = $this->load->view('admin/portfolio/portfolio',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'portfolio');
        $this->session->set_flashdata('msg', 'Portfolio activate Successfully'); 
        redirect(base_url('admin/portfolio'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'portfolio');
        $this->session->set_flashdata('msg', 'Portfolio deactivate Successfully'); 
        redirect(base_url('admin/portfolio'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'portfolio'); 
        echo json_encode(array('st' => 1));
    }

}
	

