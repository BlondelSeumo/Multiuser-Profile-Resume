<?php
class Email_model extends CI_Model {
    
    function send_email($email_to, $subject, $message){
        if ($this->settings->mail_protocol == 'smtp') {

            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => $this->settings->mail_host,
                'smtp_port' => $this->settings->mail_port,
                'smtp_user' => $this->settings->mail_username,
                'smtp_pass' => base64_decode($this->settings->mail_password),
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from($this->settings->admin_email, $this->settings->site_name);
            $this->email->to($email_to);
            $this->email->subject($subject);
            $this->email->message($message);

            // Set to, from, message, etc.
            $result = $this->email->send();
            if(!$result){
                //echo $this->email->print_debugger();
                return false;
            }else{
                //echo 'Message has been sent';
                return true;
            }


        } else {
            $this->load->library('email');
            $this->load->library('encryption');
            $this->email->set_mailtype('html');
            
            $this->email->from($this->settings->admin_email, $this->settings->site_name);
            $this->email->to($email_to);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            if($this->email->send()){
               //Success email Sent
               return true;
            }else{
               //Email Failed To Send
               return $this->email->print_debugger();
            }
        }
    }

}