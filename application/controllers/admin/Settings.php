<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

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
        $data = array();
        $data['page_title'] = 'Settings';
        $data['settings'] = $this->admin_model->get('settings');
        $data['countries'] = $this->admin_model->select('country');
        $data['main_content'] = $this->load->view('admin/settings', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    
    //update settings
    public function update(){

        if ($_POST) {

            if(!empty($this->input->post('enable_registration'))){$enable_registration = $this->input->post('enable_registration', true);}
            else{$enable_registration = 0;}

            if(!empty($this->input->post('enable_captcha'))){$enable_captcha = $this->input->post('enable_captcha', true);}
            else{$enable_captcha = 0;}

            if(!empty($this->input->post('enable_email_verify'))){$enable_email_verify = $this->input->post('enable_email_verify', true);}
            else{$enable_email_verify = 0;}
            
            if(!empty($this->input->post('enable_paypal'))){$enable_paypal = $this->input->post('enable_paypal', true);}
            else{$enable_paypal = 0;}

            if(!empty($this->input->post('enable_blog'))){$enable_blog = $this->input->post('enable_blog', true);}
            else{$enable_blog = 0;}
            
            $data = array(
                'site_name' => $this->input->post('site_name', true),
                'site_title' => $this->input->post('site_title', true),
                'keywords' => $this->input->post('keywords', true),
                'description' => $this->input->post('description', true),
                'footer_about' => $this->input->post('footer_about', true),
                'admin_email' => $this->input->post('admin_email', true),
                'copyright' => $this->input->post('copyright', true),
                'pagination_limit' => 0,
                'facebook' => $this->input->post('facebook', true),
                'twitter' => $this->input->post('twitter', true),
                'instagram' => $this->input->post('instagram', true),
                'linkedin' => $this->input->post('linkedin', true),
                'enable_registration' => $enable_registration,
                'enable_captcha' => $enable_captcha,
                'enable_paypal' => $enable_paypal,
                'enable_blog' => $enable_blog,
                'enable_email_verify' => $enable_email_verify,
                'google_analytics' => base64_encode($this->input->post('google_analytics')),
                'site_color' => $this->input->post('site_color', true),
                'site_font' => $this->input->post('site_font', true),
                'terms_condition' => $this->input->post('terms_condition', true),
                'paypal_email' => $this->input->post('paypal_email', true),
                'country' => $this->input->post('country', true),
                'captcha_site_key' => $this->input->post('captcha_site_key', true),
                'captcha_secret_key' => $this->input->post('captcha_secret_key', true),
                'mail_protocol' => $this->input->post('mail_protocol', true),
                'mail_title' => $this->input->post('mail_title', true),
                'mail_host' => $this->input->post('mail_host', true),
                'mail_port' => $this->input->post('mail_port', true),
                'mail_username' => $this->input->post('mail_username', true),
                'mail_password' => base64_encode($this->input->post('mail_password')) 
            );
            
            // upload favicon image
            $data_img = $this->admin_model->do_upload('photo1');
            if($data_img){

                $data_img = array(
                    'favicon' => $data_img['thumb']
                );
                $this->admin_model->edit_option($data_img, 1, 'settings'); 
             }

             // upload logo
            $data_img2 = $this->admin_model->do_upload('photo2');
            if($data_img2){
                $data_img = array(
                    'logo' => $data_img2['medium']
                );            
                $this->admin_model->edit_option($data_img, 1, 'settings');
            }

            $user_data = array(
                'email' => $this->input->post('admin_email', true)
            );
            $this->admin_model->edit_option($user_data, 1, 'users');

            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            $this->session->set_flashdata('msg', 'Information Updated Successfully'); 
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


}