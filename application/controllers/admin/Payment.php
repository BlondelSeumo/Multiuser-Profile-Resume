<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Payment';      
        $data['page'] = 'Payment'; 
        $payment = $this->admin_model->get_my_payment();
        $data['payment_id'] = $payment->puid;
        $data['my_payment'] = $payment;
        $data['package'] = $this->common_model->get_package_by_slug($payment->package);
        $data['main_content'] = $this->load->view('admin/payment',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function offline()
    {   
        $data = array();
        $data['page_title'] = 'Offline Payment';      
        $data['page'] = 'Payment';   
        $data['packages'] = $this->admin_model->select_asc('package');
        $data['users'] = $this->admin_model->get_all_users();
        $data['main_content'] = $this->load->view('admin/offline_payment',$data,TRUE);
        $this->load->view('admin/index',$data);

        if($_POST)
        {   
            $package = $this->admin_model->get_by_id($this->input->post('package'), 'package');
            $payment = $this->admin_model->check_user_payment($this->input->post('user'));
            
            //validate inputs
            $this->form_validation->set_rules('user', "User", 'required');
            $this->form_validation->set_rules('package', "Package", 'required');
            $this->form_validation->set_rules('status', "Payment status", 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('errors', validation_errors());
                redirect(base_url('admin/payment'));
            } else {
                
                $data=array(
                    'user_id' => $this->input->post('user', true),
                    'package' => $package->slug,
                    'amount' => $package->price,
                    'status' => $this->input->post('status', true)
                );
                $data = $this->security->xss_clean($data);

                if (empty($payment)) {
                    $this->admin_model->insert($data, 'payment');
                } else {
                    $this->admin_model->update_payment($data, $this->input->post('user'), 'payment');
                }

                $this->session->set_flashdata('msg', 'Payment added successfully'); 
                redirect(base_url('admin/payment/offline'));

            }
        }      
        
    }





    public function upgrade()
    {
        $data = array();
        $data['page_title'] = 'Upgrade';      
        $data['page'] = 'Payment'; 
        $payment = $this->admin_model->get_my_payment();
        $data['payment_id'] = $payment->puid;
        $data['package'] = $this->common_model->get_package_by_slug($payment->package);
        $data['main_content'] = $this->load->view('admin/upgrade',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function upgrade_operation() 
    {
        $data = array(
            'account_type' => 'pro'
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, user()->id, 'users');

        $pkg = $this->common_model->get_package_price('pro');
        $payment = $this->common_model->get_user_payment(user()->id);

        //create payment
        $pay_data=array(
            'package' => 'pro',
            'amount' => $pkg->price,
            'status' => 'pending',
            'created_at' => my_date_now()
        );
        $pay_data = $this->security->xss_clean($pay_data);
        $this->admin_model->update($pay_data, $payment->id, 'payment');

        if (get_settings()->enable_paypal == 1) {
            redirect(base_url('admin/payment'));
        } else {
            redirect(base_url('admin/profile'));
        }
        
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
	

