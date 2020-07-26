<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        load_settings_data();
        get_header_info();expire_payments();
    }


    public function index()
    {   
        get_active_pages();
        $data = array();
        $data['page_title'] = 'Home';
        $data['services'] = $this->common_model->select('product_services');
        $data['posts'] = $this->common_model->get_home_blog_posts();
        $data['features'] = $this->common_model->gets_home_features();
        $data['main_content'] = $this->load->view('home', $data, TRUE);
        $this->load->view('index', $data);
    }

    //features
    public function features()
    {   
        $data = array();
        $data['page_title'] = 'Features';
        $data['features'] = $this->common_model->select('features');
        $data['main_content'] = $this->load->view('features', $data, TRUE);
        $this->load->view('index', $data);
    }

    //pricing
    public function pricing()
    {   
        $data = array();
        $data['page_title'] = 'Pricing';
        $data['packages'] = $this->common_model->get_pricing();
        $data['main_content'] = $this->load->view('price', $data, TRUE);
        $this->load->view('index', $data);
    }

    //features
    public function users()
    {   
        $data = array();
        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('home/users');
        $total_row = $this->common_model->get_home_users(1 , 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 9;
        $this->pagination->initialize($config);
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['page_title'] = 'Users';
        $data['users'] = $this->common_model->get_home_users(0 , $config['per_page'], $page * $config['per_page']);
        $data['pro'] = $this->common_model->get_total_user_by_type('pro');
        $data['free'] = $this->common_model->get_total_user_by_type('free');
        $data['skills'] = $this->common_model->get_common_skills();
        $data['main_content'] = $this->load->view('users', $data, TRUE);
        $this->load->view('index', $data);
    }


    //follow user
    public function follow($id)
    {   
        $data = array(
            'follower_id' => $id,
            'action_id' => $this->session->userdata('id'),
            'status' => 1,
            'created_at' => my_date_now()
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->insert($data, 'follower');
        echo json_encode(array('st' => 1));
    }


    //unfollow user
    public function unfollow($id){
        $this->common_model->remove_follower($id, 'follower');
        echo json_encode(array('st' => 1));
    }

    //purchase page
    public function purchase($payment_id)
    {   
        $data = array();
        $data['payment'] = $this->common_model->get_payment($payment_id);
        $data['payment_id'] = $payment_id;
        $data['package'] = $this->common_model->get_package_by_slug($data['payment']->package);
        $this->load->view('purchase', $data);
    }


    //payment success
    public function payment_success($payment_id)
    {   
        $payment = $this->common_model->get_payment($payment_id);
        $data = array(
            'status' => 'verified',
            'expire_on' => date('Y-m-d', strtotime('+12 month')),
            'created_at' => my_date_now()
        );
        $data = $this->security->xss_clean($data);

        $user_data = array(
            'status' => 1
        );
        $user_data = $this->security->xss_clean($user_data);

        if (!empty($payment)) {
            $this->common_model->edit_option($user_data, $payment->user_id,'users');
            $this->common_model->edit_option($data, $payment->id,'payment');
        }
        $data['success_msg'] = 'Success';
        $this->load->view('purchase', $data);

    }

    //payment cancel
    public function payment_cancel($payment_id)
    {   
        $payment = $this->common_model->get_payment($payment_id);
        $data = array(
            'status' => 'pending'
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->edit_option($data, $payment->id,'payment');
        $data['error_msg'] = 'Error';
        $this->load->view('purchase', $data);
    }


    //create profile
    public function create_profile($package = '')
    {   
        $data = array();
        $data['page_title'] = 'Create Profile';
        $data['main_content'] = $this->load->view('create_profile', $data, TRUE);
        $this->load->view('index', $data);
    }


    //check username using ajax
    public function check_username($value)
    {   
        $result = $this->common_model->check_username($value);
        if (!empty($result)) {
            echo json_encode(array('st' => 2));
        } else {
            echo json_encode(array('st' => 1));
        }
    }



    //send contact message
    public function send_message()
    {     
        if ($_POST) {
            $data = array(
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'message' => $this->input->post('message', true),
                'created_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);
            
            //check reCAPTCHA status
            if (!$this->recaptcha_verify_request()) {
                $this->session->set_flashdata('error', 'Recaptcha is required'); 
            } else {
                $this->common_model->insert($data, 'site_contacts');
                $this->session->set_flashdata('msg', 'Message send Successfully');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    //blogs
    public function blogs()
    {   
        $data = array();
        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('blog');
        $total_row = $this->common_model->get_site_blog_posts(1 , 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 9;
        $this->pagination->initialize($config);
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }
        
        $data['page_title'] = 'Blog Posts';
        $data['posts'] = $this->common_model->get_site_blog_posts(0 , $config['per_page'], $page * $config['per_page']);
        $data['categories'] = $this->common_model->get_blog_categories();
        $data['main_content'] = $this->load->view('blog_posts', $data, TRUE);
        $this->load->view('index', $data);
    }

    //category
    public function category($slug)
    {   
        $data = array();
        $slug = $this->security->xss_clean($slug);
        $category = $this->common_model->get_category_by_slug($slug);
        
        if (empty($category)) {
            redirect(base_url('blog'));
        }

        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('category/'.$slug);
        $total_row = $this->common_model->get_site_category_posts(1 , 0, 0, $category->id);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 9;
        $this->pagination->initialize($config);
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }
        
        $data['page_title'] = 'Category Posts';
        $data['title'] = $category->name;
        $data['posts'] = $this->common_model->get_site_category_posts(0, $config['per_page'], $page * $config['per_page'], $category->id);
        $data['categories'] = $this->common_model->get_blog_categories();
        $data['main_content'] = $this->load->view('blog_posts', $data, TRUE);
        $this->load->view('index', $data);
    }

    //post details
    public function post_details($slug)
    {   
        $data = array();
        $slug = $this->security->xss_clean($slug);
        $data['page_title'] = 'Post details';
        $data['page'] = 'Post';
        $data['post'] = $this->common_model->get_post_details($slug);

        if (empty($data['post'])) {
            redirect(base_url());
        }
        $category_id = $data['post']->category_id;
        $post_id = $data['post']->id;
        $data['post_id'] = $post_id;

        $data['related_posts'] = $this->common_model->get_site_related_post($category_id, $post_id);
        $data['categories'] = $this->common_model->get_blog_category();
        $data['tags'] = $this->common_model->get_post_tags($post_id);
        $data['main_content'] = $this->load->view('single_post', $data, TRUE);
        $this->load->view('index', $data);
    }

  
    public function contact()
    {   
        $data = array();
        $data['page_title'] = 'Contact';
        $data['settings'] = $this->common_model->get('settings');
        $data['main_content'] = $this->load->view('contact', $data, TRUE);
        $this->load->view('index', $data);
    }

    //show pages
    public function page($slug)
    {   
        $data = array();
        $data['page_title'] = 'Page';
        $data['page'] = $this->common_model->get_single_page($slug);
        $data['page_name'] = $data['page']->title;
        $data['main_content'] = $this->load->view('page', $data, TRUE);
        $this->load->view('index', $data);
    }

    //show pages
    public function terms()
    {   
        $data = array();
        $data['page_title'] = 'Terms & Condition';
        $data['main_content'] = $this->load->view('page', $data, TRUE);
        $this->load->view('index', $data);
    }


    // not found page
    public function error_404()
    {
        $data['page_title'] = "Error 404";
        $data['description'] = "Error 404";
        $data['keywords'] = "error,404";
        $this->load->view('error_404');
    }


}