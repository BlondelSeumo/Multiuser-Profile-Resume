<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index($slug){
        $this->user($slug);
    }


    public function user($slug)
    {   
        $data = array();
        $slug = $this->security->xss_clean($slug);
        $data['user'] = $this->common_model->get_user_by_slug($slug);

        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);
        $data['page_title'] = 'Home';
        $data['services'] = $this->common_model->get_services($user_id);
        $data['skills'] = $this->common_model->get_home_skills($user_id);

        if ($data['user']->account_type == 'free') {
            $data['main_content'] = $this->load->view($data['user']->layouts.'/home_free', $data, TRUE);
        } else {
            $data['main_content'] = $this->load->view($data['user']->layouts.'/home', $data, TRUE);
        }
        $this->load->helper('cookie');
        $this->common_model->increase_user_hit($user_id);
        $this->load->view($data['user']->layouts.'/index', $data);
    }


    public function about_me($slug)
    {   
        $data = array();
        $slug = $this->security->xss_clean($slug);
        $data['user'] = $this->common_model->get_user_by_slug($slug);
        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);
        $data['page_title'] = 'About me';
        $data['services'] = $this->common_model->get_services($user_id);
        $data['skills'] = $this->common_model->get_home_skills($user_id);
        $data['followers'] = $this->common_model->get_follower_following($user_id, 1);
        $data['followings'] = $this->common_model->get_follower_following($user_id, 2);
        $data['main_content'] = $this->load->view($data['user']->layouts.'/about_me', $data, TRUE);
        $this->load->view($data['user']->layouts.'/index', $data);
    }


    public function resume($slug)
    {   
        $data = array();
        $data['page_title'] = 'Resume';
        $slug = $this->security->xss_clean($slug);
        $data['user'] = $this->common_model->get_user_by_slug($slug);
        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);
        $data['experiences'] = $this->common_model->get_home_experiences($user_id);
        $data['testimonials'] = $this->common_model->get_testimonials($user_id);
        $data['main_content'] = $this->load->view($data['user']->layouts.'/resume', $data, TRUE);
        $this->load->view($data['user']->layouts.'/index', $data);
    }


    public function portfolio($slug)
    {   
        $data = array();
        $data['page_title'] = 'Portfolio';
        $slug = $this->security->xss_clean($slug);
        $data['user'] = $this->common_model->get_user_by_slug($slug);
        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);

        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('profile/portfolio/'.$slug);
        $total_row = $this->common_model->get_home_portfolio(1 , 0, 0, $user_id);
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

        
        $data['categories'] = $this->common_model->get_portfolio_category($user_id);
        $data['portfolios'] = $this->common_model->get_home_portfolio(0, $config['per_page'], $page * $config['per_page'], $user_id);
        $data['main_content'] = $this->load->view($data['user']->layouts.'/portfolio', $data, TRUE);
        $this->load->view($data['user']->layouts.'/index', $data);
    }


    public function portfolio_details($slug, $id)
    {   
        $data = array();
        $data['page_title'] = 'Portfolio Details';
        $slug = $this->security->xss_clean($slug);
        $data['user'] = $this->common_model->get_user_by_slug($slug);
        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);
        $data['post'] = $this->common_model->get_by_id($id, 'portfolio');
        $data['main_content'] = $this->load->view($data['user']->layouts.'/portfolio_details', $data, TRUE);
        $this->load->view($data['user']->layouts.'/index', $data);
    }

    public function blog($slug)
    {   
        $data = array();
        $slug = $this->security->xss_clean($slug);
        $data['user'] = $this->common_model->get_user_by_slug($slug);
        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);
        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('home/blog');
        $total_row = $this->common_model->get_blog_posts(1 , 0, 0, $user_id);
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
        $data['blog_posts'] = $this->common_model->get_blog_posts(0 , $config['per_page'], $page * $config['per_page'], $user_id);
        $data['main_content'] = $this->load->view($data['user']->layouts.'/blog', $data, TRUE);
        $this->load->view($data['user']->layouts.'/index', $data);
    }


    public function category($slug, $cat_slug)
    {   
        $data = array();
        $slug = $this->security->xss_clean($slug);
        $cat_slug = $this->security->xss_clean($cat_slug);
        $data['user'] = $this->common_model->get_user_by_slug($slug);
        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);

        $cat_slug = $this->security->xss_clean($cat_slug);
        $category = $this->common_model->get_category_by_slug($cat_slug);
        
        if (empty($category)) {
            redirect(base_url());
        }

        //initialize pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('category/'.$slug.'/'.$category->slug);
        $total_row = $this->common_model->get_category_posts(1 , 0, 0, $category->id, $user_id);
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
        $data['blog_posts'] = $this->common_model->get_category_posts(0, $config['per_page'], $page * $config['per_page'], $category->id, $user_id);
        $data['main_content'] = $this->load->view($data['user']->layouts.'/blog', $data, TRUE);
        $this->load->view($data['user']->layouts.'/index', $data);
    }


    public function details($slug, $post_slug)
    {   

        $data = array();
        $slug = $this->security->xss_clean($slug);
        $post_slug = $this->security->xss_clean($post_slug);

        $data['user'] = $this->common_model->get_user_by_slug($slug);
        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);

        $data['page_title'] = 'Post details';
        $data['page'] = 'Post';
        $data['post'] = $this->common_model->get_post_details($post_slug);

        if (empty($data['post'])) {
            redirect(base_url());
        }
        $category_id = $data['post']->category_id;
        $post_id = $data['post']->id;
        $data['post_id'] = $post_id;

        $data['comments'] = $this->common_model->get_comments_by_post($data['post']->id);
        $data['total_comment'] = count($data['comments']);

        $data['related_posts'] = $this->common_model->get_related_post($category_id, $post_id, $user_id);
        $data['categories'] = $this->common_model->get_blog_category($user_id);
        $data['tags'] = $this->common_model->get_random_tags($user_id);
        $data['tags'] = $this->common_model->get_post_tags($post_id);
        //echo"<pre>"; print_r($data['tags']); exit();
        $data['main_content'] = $this->load->view($data['user']->layouts.'/blog_post', $data, TRUE);
        $this->load->view($data['user']->layouts.'/index', $data);
    }


    //send comment
    public function send_comment($post_id)
    {     
        if ($_POST) {
            $data = array(
                'post_id' => $post_id,
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'message' => $this->input->post('message', true),
                'created_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->insert($data, 'comments');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function contact($slug)
    {   
        $data = array();
        $slug = $this->security->xss_clean($slug);
        $data['user'] = $this->common_model->get_user_by_slug($slug);
        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);
        $data['page_title'] = 'Contact';
        $data['main_content'] = $this->load->view($data['user']->layouts.'/contact', $data, TRUE);
        $this->load->view($data['user']->layouts.'/index', $data);
    }


    //send contact message
    public function send_message()
    {   
        if ($_POST) {
            $data = array(
                'name' => $this->input->post('name', true),
                'email' => $this->input->post('email', true),
                'message' => $this->input->post('message', true),
                'user_id' => $this->input->post('user_id', true),
                'created_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->insert($data, 'contacts');
            $this->session->set_flashdata('msg', 'Message Sent Successfully'); 
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function appointment($slug)
    {   
        $data = array();
        $data['page_title'] = 'Appointment';
        $slug = $this->security->xss_clean($slug);
        $data['user'] = $this->common_model->get_user_by_slug($slug);
        if (empty($data['user'])) {
            redirect(base_url('error-404'));
        }
        
        $user_id =  $data['user']->id;
        check_user_payment($user_id);
        
        $data['my_days'] =$this->admin_model->get_user_days($user_id);
        
        $data['appointments'] = $this->common_model->get_home_experiences($user_id);
        $data['main_content'] = $this->load->view($data['user']->layouts.'/appointment', $data, TRUE);
        $this->load->view($data['user']->layouts.'/index', $data);
    }

    //send comment
    public function book_appointment($slug)
    {     

        $slug = $this->security->xss_clean($slug);
        $user = $this->common_model->get_user_by_slug($slug);

        if ($_POST) {
            $data = array(
                'user_id' => $user->id,
                'title' => $this->input->post('title', true),
                'book_time' => $this->input->post('book_time', true),
                'email' => $this->input->post('email', true),
                'created_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->insert($data, 'appointments');
            $this->session->set_flashdata('msg', 'Appointment booked Successfully'); 
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function download($id)
    {
        $this->load->helper('download');
        $file = $this->common_model->get_by_id($id, 'users');

        $file_name = basename($file->cv);
        $data = file_get_contents($file->cv);
        $name = $file_name;

        force_download($name, $data); 
        $this->session->set_flashdata('msg', $file.' Downloaded Successfully');
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