<?php

/**
 * @author Litkovskiy
 * @copyright 2010
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends MY_Controller 
    {
        public $log;
        public $pass;
	
	function _construct()
	{
		parent::MY_Controller();
	}
		
	public function index()
	{

	   $this->log  = (isset($_REQUEST['login'])) ?  $_REQUEST['login'] : '';
       $this->pass = (isset($_REQUEST['pass']))  ?  $_REQUEST['pass']  : '';
	   if(!empty($this->log) && !empty($this->pass))
       {
          $this->login_model->checkLogPass($this->log, $this->pass);
       }
       else
       {
           $this->data_arr['err_message'] = "<p style='color:red; font-size:11pt; border: solid 1px red'>Ошибка! Вы не заполнили одно из полей</p>";
           $this->data_arr['title']       = 'Об авторе';
    	   $this->data_arr['result']      = $this->about_model->getArrWhere('category',array('cat_name' => 'about'), null, null);
           $this->data_arr['about_link']  = $this->about_model->getArrWhere('about_links',array('status' => 'on'), null, null);
    	   $data = array(
                    'menu'    => $this->load->view(MENU, '', true), 
                    'content' => $this->load->view('about/show', $this->data_arr, true));
    
    	   $this->load->view('layout', $data);
       }
	}
    }