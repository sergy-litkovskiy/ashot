<?php
/**
 * Frontend-Backend controller for messanger
 * 
 * @author Litkovskiy
 * @copyright 2010
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Messages extends MY_Controller
{
	public $data_arr;
	public $menu;

	function __construct()
	{
	   parent::MY_Controller();
	}

	public function index()
	{
       redirect('about');
	}
    

//---------------------------------------------------------------	
	
	/**
     * Check validation of form. If vaid - insert into DB and do send action else show form whith message error
     */
	public function send()
	{
         $rules = array(
                array(
		        'field'	=> 'name',
		    	'label'	=> '<Ваше имя>',
		    	'rules'	=> 'required|trim|xss_clean|stripslashes'),
       	        array(
		        'field'	=> 'email',
		    	'label'	=> '<E-mail>',
		    	'rules'	=> 'valid_email'),
               	array(
		        'field'	=> 'text',
		    	'label'	=> '<Сообщение>',
		    	'rules'	=> 'required|trim|xss_clean|stripslashes'));
    
        $this -> form_validation -> set_rules($rules);
		
        $notValidResult = false;
		if(preg_match("/href/i", $_REQUEST['text'])){
			$notValidResult = true;
		}
		
        if ($this -> form_validation -> run() === FALSE || $notValidResult)
		{
            $this->data_arr['title']         = 'Об авторе';
            $this->data_arr['result']        = $this->about_model->getListJoin();
            $this->data_arr['about_link']    = $this->about_model->getArrWhere('about_links',array('status' => 'on'), null, null, 'id DESC');
            $this->data_arr['about_contact'] = $this->about_model->getArrWhere('contacts',array(), null, null);
            $data = array(
                    'menu'    => $this->load->view(MENU, '', true), 
                    'content' => $this->load->view('about/show', $this->data_arr, true));
            redirect('about');
            //$this->load->view('layout', $data);
        }
        
		else
		{
            $data ['name_sender']   = $_REQUEST['name'];
            $data ['text']          = $_REQUEST['text'];
            $data ['date']          = date('Y-m-d H:m:s');
            $data ['email_sender']  = $_REQUEST['email'];
            $this -> send_mess($data);
		}
	}	

//---------------------------------------------------------------
    /**
	 * add the data
     * 
     * @param array $data (array of data for insert)
	 */
	public function send_mess($data)
	{
        if($this->messages_model->add($data))
        {
            $this->sendMailMess($data) ? print 'send_true': print 'send_false' ;
            exit;
        }
    }
    
//---------------------------------------------------------------
    /**
	 * send message
     * 
     * @param array $data (array of data for send)
	 */
	public function sendMailMess($data)
	{
        $author       = $data['name_sender'];
		$text         = $data['text'];
        $email        = "ashot56@bigmir.net, ashot56@mail.ru";
		$email_from   = $data['email_sender'];
		$date         = $data['date'];
        $subject      = "Сообщение с сайта ashot.kiev.ua";
		$message      = "Дата создания: ".$date.".\r\n На сайте для вас появилось сообщение от посетителя ' ".$author." ' (email отправителя : ".$email_from.").\r\n
		Текст сообщения: \r\n".$text;
		$headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=cp1251\r\n";
        $headers .= "From: ASHOT.KIEV.UA<ashot56@bigmir.net> \r\n";
        
        mail($email, $subject, $message, $headers);
        
        redirect('about');
    }
}
