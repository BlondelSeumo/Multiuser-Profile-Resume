<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    
    public function index()
    {
        //check auth
        if (!is_admin()) {
            redirect(base_url());
        }
        $data = array();
        $data['page_title'] = 'Dashboard';

        $data['currency'] = '$';
        for ($i = 1; $i <= 13; $i++) {
            $months[] = date("Y-m", strtotime( date('Y-m-01')." -$i months"));
        }

        for ($i = 0; $i <= 11; $i++) {
            $income = $this->admin_model->get_admin_income_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
            $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
            $incomes[] = array("total" => $income);
        }

        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $data['income_data'] = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $data['net_income'] = $this->admin_model->get_admin_income_by_year();
        $data['net_expense'] = $this->admin_model->get_admin_expense_by_year();
        $data['upackages'] = $this->admin_model->get_users_packages();
        
        $data['settings'] = $this->admin_model->get('settings');
        $data['users'] = $this->admin_model->get_latest_users();
        $data['user'] = $this->admin_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function change_password()
    {
        $data = array();
        $data['page_title'] = 'Change Password';
        $data['main_content'] = $this->load->view('admin/change_password', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    //update password
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