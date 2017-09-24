<?php

/**
 * @author Litkovsky
 * @copyright 2010
 * model for object profile
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login_model extends Crud{
	
	var $table = 'userlist';
	var $logkey = 'log';
    var $paskey = 'pass';
	
	function __construct()
    {
        parent::Model();
    }
    
    /**
     * Check login and password
     */
	public function checkLogPass($log, $pass) 
    {
        $this->db->where($this->logkey, $log);
        $this->db->where($this->paskey, md5($pass));
        $query = $this->db->get($this->table);
	    $numr  = $query->num_rows();  
		if($numr == 0){
		   $this->data_arr['err_message'] = "<p style='color:red; font-size:11pt; border: solid 1px red'>Ошибка! Неверный логин или пароль</p>";
           $this->data_arr['title']       = 'Об авторе';
    	   $this->data_arr['result']      = $this->about_model->getArrWhere('category',array('cat_name' => 'about'), null, null);
           $this->data_arr['about_link']  = $this->about_model->getArrWhere('about_links',array('status' => 'on'), null, null);
    	   $data = array(
                    'menu'    => $this->load->view(MENU, '', true), 
                    'content' => $this->load->view('about/show', $this->data_arr, true));
    
    	   $this->load->view('layout', $data);
		}
        else
        {
          $this->_logIn($log, $pass);
	    }
   }
   
    /**
     * Start session width data array
     */
	private function _logIn($log, $pass) 
    {
        $newdata = array(
                   'username' => $log,
                   'loggedIn' => TRUE
               );

        //start session and redirect to admin page
        $this->session->set_userdata($newdata);
        
        if($this->session->userdata('username'))
        {
            redirect('about/admin');
        }
        else
        {
            $this->logOut();
            redirect('about');
        }
    }
    
    /**
     * Unset session
     */
	public function logOut() 
    {
        $this->session->sess_destroy();
        redirect('about');
    }
}