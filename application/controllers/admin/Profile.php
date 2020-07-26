<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

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
        $data['page_title'] = 'Profile';
        $data['user'] = $this->admin_model->get_user_info();
        $data['payment'] = $this->admin_model->get_my_payment();
        $data['fonts'] = $this->admin_model->select('google_fonts');
        $data['main_content'] = $this->load->view('admin/user/profile', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    //site layouts
    public function layouts()
    {   
        $data = array();
        $data['page_title'] = 'Layouts';
        $data['fonts'] = $this->admin_model->select('google_fonts');
        $data['user'] = $this->admin_model->get_user_info();
        $data['main_content'] = $this->load->view('admin/layouts', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //update user profile
    public function update_fonts(){
        
        if ($_POST) {

            $data = array(
                'site_color' => str_replace('#', '', $this->input->post('site_color', true)),
                'site_font' => $this->input->post('site_font', true)
            );
            
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, user()->id, 'users');
            $this->session->set_flashdata('msg', 'Updated Successfully'); 
            redirect(base_url('admin/profile/layouts'));
        }
    }



    //set layout
    public function change_layout($value)
    {   
        $data = array(
            'layouts' => $value
        );
        $data = $this->security->xss_clean($data);
        if ($value != '') {
            $this->admin_model->edit_option($data, user()->id, 'users');
        }
        $url = base_url('admin/profile/layouts');
        echo json_encode(array('st' => 1)); 
    }



    //upload file
    public function upload()
    {
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if ($ext != 'pdf') {
            $this->session->set_flashdata('error', 'You can upload only PDF files, Try again');
            redirect($_SERVER['HTTP_REFERER']);
            exit();
        }
     
        $data=array(
            'cv' => 'uploads/files/'.str_replace(' ', '_', $_FILES['file']['name'])
        );
        
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, user()->id,'users');
        $this->session->set_flashdata('msg', 'File Uploaded Successfully'); 
    
        $config['upload_path']          = './uploads/files'; //file save path
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 10000;


        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error);
        }else
        {
            $data = array('upload_data' => $this->upload->data());
            $this->session->set_flashdata('success', $error);
        }

        redirect($_SERVER['HTTP_REFERER']);
        
    }

    public function upload_cv(){
        $data = array();
        $data['page_title'] = 'Upload';
        $data['user'] = $this->admin_model->get_user_info();
        $data['main_content'] = $this->load->view('admin/user/upload_cv', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    //update user profile
    public function update(){
        
        if ($_POST) {

            if(!empty($this->input->post('enable_portfolio', true))){ $enable_portfolio = 1;}else{$enable_portfolio = 0;}
            if(!empty($this->input->post('enable_blog', true))){ $enable_blog = 1;}else{$enable_blog = 0;}
            if(!empty($this->input->post('enable_appointment', true))){ $enable_appointment = 1;}else{$enable_appointment = 0;}
            if(!empty($this->input->post('enable_service', true))){ $enable_service = 1;}else{$enable_service = 0;}
            if(!empty($this->input->post('enable_followers', true))){ $enable_followers = 1;}else{$enable_followers = 0;}

            $data = array(
                'name' => $this->input->post('name', true),
                'designation' => $this->input->post('designation', true),
                'address' => $this->input->post('address', true),
                'skype' => $this->input->post('skype', true),
                'whatsapp' => $this->input->post('whatsapp', true),
                'phone' => $this->input->post('phone', true),
                'about_me' => $this->input->post('about_me', true),
                'email' => $this->input->post('email', true),
                'facebook' => $this->input->post('facebook', true),
                'twitter' => $this->input->post('twitter', true),
                'linkedin' => $this->input->post('linkedin', true),
                'instagram' => $this->input->post('instagram', true),
                'google_analytics' => base64_encode($this->input->post('google_analytics')),
                'site_color' => str_replace('#', '', $this->input->post('site_color', true)),
                'site_font' => $this->input->post('site_font', true),
                'enable_blog' => $enable_blog,
                'enable_portfolio' => $enable_portfolio,
                'enable_appointment' => $enable_appointment,
                'enable_service' => $enable_service,
                'enable_service' => $enable_followers
            );
            
           // insert photos
            if($_FILES['photo']['name'] != ''){
                $up_load = $this->admin_model->upload_image('800');
                $data_img = array(
                    'image' => $up_load['images'],
                    'thumb' => $up_load['thumb']
                );
                $this->admin_model->edit_option($data_img, user()->id, 'users');   
            }

            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, user()->id, 'users');
            $this->session->set_flashdata('msg', 'Information Updated Successfully'); 
            redirect(base_url('admin/profile'));
        }
    }


    public function change_password()
    {
        $data = array();
        $data['page_title'] = 'Change Password';
        $data['main_content'] = $this->load->view('admin/user/change_password', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    

    //change password
    public function change()
    {   
        if($_POST){
            
            $id = user()->id;
            $user = $this->admin_model->get_by_id($id, 'users');

            if(password_verify($this->input->post('old_pass', true), $user->password)){
                if ($this->input->post('new_pass', true) == $this->input->post('confirm_pass', true)) {
                    $data=array(
                        'password' => hash_password($this->input->post('new_pass', true))
                    );
                    $data = $this->security->xss_clean($data);
                    $this->admin_model->edit_option($data, $id, 'users');
                    echo json_encode(array('st'=>1));
                } else {
                    echo json_encode(array('st'=>2));
                }
            } else {
                echo json_encode(array('st'=>0));
            }
        }
    }


}