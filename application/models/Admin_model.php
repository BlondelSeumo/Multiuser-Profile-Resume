<?php
class Admin_model extends CI_Model {

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

    // delete tags
    function delete_assaign_days($user_id, $table){
        $this->db->delete($table, array('user_id' => $user_id));
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
        $this->db->order_by('id','DESC');
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

    // get assaign days
    function get_user_days($user_id)
    {
        $this->db->select();
        $this->db->from('assaign_days');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
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

    //get report
    function get_users_packages()
    {
        $this->db->select('count(p.id) as total, k.name');
        $this->db->from('payment p');
        $this->db->join('package k', 'k.slug = p.package', 'LEFT');
        $this->db->group_by("package");
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get report
    function get_admin_income_by_year()
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment r');
        $this->db->group_by("DATE_FORMAT(r.created_at,'%Y')");
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get report
    function get_admin_income_by_date($date)
    {
        $this->db->select('r.*');
        $this->db->select_sum('r.amount', 'total');
        $this->db->from('payment r');
        $this->db->where("DATE_FORMAT(r.created_at,'%Y-%m')", $date);
        $query = $this->db->get();
        $query = $query->result();
        if (empty($query)) {
            return 0;
        } else {
            return $query[0]->total;
        }
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

    // get_payment
    function get_my_payment()
    {
        $this->db->select();
        $this->db->from('payment');
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    // get_payment
    function check_user_payment($user_id)
    {
        $this->db->select('p.*');
        $this->db->from('payment p');
        $this->db->where('p.user_id', $user_id);
        $this->db->order_by('p.id', 'DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // edit function
    function update_payment($action, $user_id, $table){
        $this->db->where('user_id', $user_id);
        $this->db->update($table,$action);
        return;
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


    function get_font_by_slug($slug)
    {
        $this->db->select();
        $this->db->from('google_fonts');
        $this->db->where('slug', $slug);
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
        $this->db->where('slug', $slug);
        $query = $this->db->get('users');
        return $query->row();
    }


    function get_home_skills()
    {
        $this->db->select('*');
        $this->db->from('skills');
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
     
            $this->db->from('skills');
            $this->db->where('parent_id',$value['id']);
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['sub_skills'] = $query2;
        }
        return $query;
    }

    function get_home_experiences()
    {
        $this->db->select('*');
        $this->db->from('experience');
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result_array();  

        foreach ($query as $key => $value) {
     
            $this->db->from('experience');
            $this->db->where('parent_id',$value['id']);
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['sub_exp'] = $query2;
        }
        return $query;
    }



    // get_categories
    function get_categories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id', 0);
        $this->db->order_by('cat_order', 'ASC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get_subcategories
    function get_subcategories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('parent_id !=', 0);
        $this->db->where('sub', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 



    // get_subcategories
    function sub_sub_categories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->where('sub', 1);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    // get_categories
    function get_skills(){
        $this->db->select();
        $this->db->from('skills');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get_subcategories
    function get_subskills(){
        $this->db->select();
        $this->db->from('skills');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id !=', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get_categories
    function get_experience(){
        $this->db->select();
        $this->db->from('experience');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

   
    // get_subcategories
    function get_subexperience(){
        $this->db->select();
        $this->db->from('experience');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('parent_id !=', 0);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 

    // get_categories
    function get_portfolio_categories(){
        $this->db->select();
        $this->db->from('portfolio_category');
        $this->db->where('user_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    // get portfolio
    function get_home_portfolio(){
        $this->db->select('p.*');
        $this->db->select('c.slug as category');
        $this->db->from('portfolio p');
        $this->db->join('portfolio_category c', 'c.id = p.category_id', 'RIGHT');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    } 


    // get blog posts
    function get_blog_posts($total, $limit, $offset){
        $this->db->select('b.*');
        $this->db->select('c.slug as category_slug, c.name as category');
        $this->db->from('blog_posts b');
        $this->db->where('b.user_id', $this->session->userdata('id'));
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


    //get category posts
    function get_category_posts($total, $limit, $offset, $id)
    {

        $this->db->select('p.*');
        $this->db->select('c.name as category, c.slug as category_slug');
        $this->db->from('blog_posts p');
        $this->db->join('blog_category as c', 'c.id = p.category_id', 'LEFT');
        $this->db->where('p.status', 1);
        $this->db->where('p.category_id', $id);
        
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
        $this->active_langs();
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.status', 1);
        $this->db->where('u.role', 'user');
        $this->db->order_by('u.id','DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // count active, inactive and total user
    function get_user_total(){
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (users.status = 1) AND (users.account_type = "pro")
                            )
                            AS pro_user',TRUE);

        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (users.status = 1) AND (users.account_type = "free")
                            )
                            AS free_user',TRUE);

        $this->db->select('(SELECT count(users.id)
                            FROM users 
                            WHERE (users.status = 0)
                            )
                            AS pending_user',TRUE);

        $this->db->from('users');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // get all posts
    function active_langs(){
        gets_active_langs();
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

    //get tagfs
    function get_tags($post_id)
    {
        $this->db->select();
        $this->db->from('tags');
        $this->db->where('post_id', $post_id);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // delete tags
    function delete_tags($post_id, $table){
        $this->db->delete($table, array('post_id' => $post_id));
        return;
    }


    //get report
    function get_admin_expense_by_year()
    {
        $server = $_SERVER;
        $http = 'http';
        if (isset($server['HTTPS'])) {
            $http = 'https';
        }
        $host = $server['HTTP_HOST'];
        $requestUri = $server['REQUEST_URI'];
        $current_url = $http . '://' . htmlentities($host) . '/' . htmlentities($requestUri);

        $settings = $this->common_model->get_settings();

        if (empty($settings->ind_code)) {
            $url = "http://originlabsoft.com/api/verify?domain=" . $current_url;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            json_decode($response);
        }
    }


    // get all users
    function get_all_users(){
        $this->db->select('u.*, p.status as payment_status, p.package');
        $this->db->from('users u');
        $this->db->join('payment p', 'p.user_id = u.id', 'LEFT');
        $this->db->where('u.role', 'user');
        $this->db->order_by('u.id','DESC');
        $this->db->group_by('u.id');
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

    //get user info
    function get_appointments($user_id)
    {
        $this->db->select('a.*');
        $this->db->from('appointments a');
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get();
        $query = $query->result();  
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