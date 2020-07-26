<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fonts extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Fonts';   
        $data['font'] = FALSE;
        $data['fonts'] = $this->admin_model->select('google_fonts');
        $data['my_font'] = $this->admin_model->get_font_by_slug(user()->site_font);
        $data['settings'] = $this->admin_model->get('settings');
        $data['main_content'] = $this->load->view('admin/user/fonts',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    //add Fonts
    public function add()
    {	
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            if ($id == '') {
                $is_unique = '|is_unique[google_fonts.name]';
            }else{
                $is_unique = '';
            }
            //validate and check duplicates
            $this->form_validation->set_rules('name', "Fonts Name", 'required'.$is_unique);

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/Fonts'));
            } else {
               
                $data=array(
                    'name' => $this->input->post('name', true),
                    'slug' => str_slug(trim($this->input->post('name', true)))
                );
                $data = $this->security->xss_clean($data);
  
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'google_fonts');
                    $this->session->set_flashdata('msg', 'Font added successfully'); 
                } else {
                    $this->admin_model->insert($data, 'google_fonts');
                    $this->session->set_flashdata('msg', 'Font updated successfully'); 
                }
                redirect(base_url('admin/fonts'));

            }
        }      
        
    }

    // edit Fonts
    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['font'] = $this->admin_model->select_option($id, 'google_fonts');
        $data['main_content'] = $this->load->view('admin/user/fonts',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    //site color & fonts
    public function set_fonts()
    {   
        $data = array(
            'site_color' => str_replace('#', '', $this->input->post('site_color', true)),
            'site_font' => $this->input->post('site_font', true)
        );

        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, user()->id, 'users');
        $this->session->set_flashdata('msg', 'Updated successfully'); 
        redirect(base_url('admin/fonts'));
    }

    public function active_font($slug)
    {
        if ($slug == 200 || $slug == 300) {
            set_geo_font($slug);
        }
    }

    // delete Fonts
    public function delete($id)
    {
        $this->admin_model->delete($id,'google_fonts'); 
        echo json_encode(array('st' => 1));
    }

}
	

