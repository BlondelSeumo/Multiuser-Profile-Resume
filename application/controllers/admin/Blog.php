<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

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
        $data['page_title'] = 'Blog Posts';      
        $data['page'] = 'Blog';   
        $data['blog'] = FALSE;
        $data['categories'] = $this->admin_model->get_blog_categories();
        $data['posts'] = $this->admin_model->select_by_user('blog_posts');
        $data['main_content'] = $this->load->view('admin/blog/post',$data,TRUE);
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
                redirect(base_url('admin/blog'));
            } else {
               
                $data=array(
                    'category_id' => $this->input->post('category', true),
                    'title' => $this->input->post('title', true),
                    'slug' => str_slug(trim($this->input->post('title', true))),
                    'details' => $this->input->post('details'),
                    'status' => $this->input->post('status', true),
                    'user_id' => $this->session->userdata('id'),
                    'created_at' => my_date_now()
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->delete_tags($id, 'tags');
                    $this->admin_model->edit_option($data, $id, 'blog_posts');
                    $this->session->set_flashdata('msg', 'Blog post edited Successfully'); 
                } else {
                    $id = $this->admin_model->insert($data, 'blog_posts');
                    $this->session->set_flashdata('msg', 'Blog post added Successfully'); 
                }

                // insert tags
                foreach ($this->input->post('tags', true) as $tag) {
                    $tags = explode(",", $tag);
                    for ($i=0; $i < count($tags); $i++) { 

                        $tags_data = array(
                            'post_id' => $id,
                            'tag' => $tags[$i],
                            'tag_slug' => str_slug(trim($tags[$i]))
                        );
                        $this->admin_model->insert($tags_data, 'tags');
                    }
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('1200');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'blog_posts');   
                }

                redirect(base_url('admin/blog'));

            }
        }      
        
    }


    public function edit($id)
    {  
        //combine post tags
        $tags = "";
        $count = 0;
        $tags_array = $this->admin_model->get_tags($id); 
        foreach ($tags_array as $item) {
            if ($count > 0) {
                $tags .= ",";
            }
            $tags .= $item->tag;
            $count++;
        }
        
        $data = array();
        $data['tags'] = $tags;
        $data['page_title'] = 'Edit';   
        $data['categories'] = $this->admin_model->get_blog_categories();
        $data['blog'] = $this->admin_model->select_option($id, 'blog_posts');
        $data['main_content'] = $this->load->view('admin/blog/post',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'blog_posts');
        $this->session->set_flashdata('msg', 'Blog post activate Successfully'); 
        redirect(base_url('admin/blog'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'blog_posts');
        $this->session->set_flashdata('msg', 'Blog post deactivate Successfully'); 
        redirect(base_url('admin/blog'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'blog_posts'); 
        echo json_encode(array('st' => 1));
    }

}
	

