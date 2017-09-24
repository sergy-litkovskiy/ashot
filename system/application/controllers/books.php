<?php
/**
 * Frontend-Backend controller for books page
 * 
 * @author Litkovskiy
 * @copyright 2010
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Books extends MY_Controller
{
	public $data_arr;

	public function __construct()
	{
	   parent::MY_Controller();
	   $this->data_arr['title'] = 'Книги, фотоальбомы';
	   $this->data_arr['uri']   = explode('/',$_SERVER['REQUEST_URI']);
	}

	public function index()
	{
       //$this->firephp->fb($this->data_arr);
	   $this->data_arr['result']  = $this->books_model->getListJoin();
       $this->data_arr['dirread'] = directory_map('./img/books/');

       $data = array(
                'menu'    => $this->load->view(MENU, '', true), 
                'content' => $this->load->view('books/show', $this->data_arr, true));

	   $this->load->view('layout', $data);
	}
    
//---------------------------------------------------------------
	/**
	 * Content of book for edit
	 */
	public function edit_text()
	{
	   if($this->session->userdata('username'))
        {
            $this->data_arr['result'] = $this->books_model->getArrWhere('category', array('cat_name' => 'books'), null, null);
            $data = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true),
                'content' => $this->load->view('books/edit_text', $this->data_arr, true)
                );
            $this ->load->view('layout_admin', $data);
        }
        else
        {
            $this->login_model->logOut();
        }
    }
    
//---------------------------------------------------------------	
	
	/**
     * Check validation of data books_page and do update
     */
	public function check_valid_text()
	{
	   if($this->session->userdata('username'))
        {
            $rules = array(
                    array(
    		        'field'	=> 'text_short',
    		    	'label'	=> '<Текст>',
    		    	'rules'	=> 'required')
                    );
        
            $this->form_validation->set_rules($rules);
                  
            if ($this->form_validation->run() === false)
    		{
                $this->edit_text();//back to edit page
            }
            else
    		{
                $data['text_short']  = $_POST['text_short'];
                $this ->_update($data, 'category');
            }
        }
        else
        {
            $this->login_model->logOut();
        }
     }    
    
//---------------------------------------------------------------	
	
	/**
     * Check validation of data books_page. If vaid - do update or add action?, else show form whith message error
     * 
     * @param string $action (add action or update action)
     */
	public function check_valid($action)
	{
	   if($this->session->userdata('username'))
        {
            $rules = array(
    		    	array(
    		        'field'	=> 'title',
    		    	'label'	=> '<Название>',
    		    	'rules'	=> 'required'),
                    array(
    		        'field'	=> 'text',
    		    	'label'	=> '<Текст>',
    		    	'rules'	=> 'required')
                    );
        
            $this->form_validation->set_rules($rules);
                  
            if ($this->form_validation->run() === false)
    		{
    			//if add new book and form is not valid - reload add form whith massage error
                if($action == 'add')
    			{
        			$data = array(
        			   'menu'    => $this->load->view(MENU_ADMIN, '', true),
        			   'content' => $this->load->view('books/new', $this->data_arr, true)
    			  );
                    $this->load->view('layout_admin', $data);
                }
    
    		    //if edit books and form is not valid - reload edit form whith massage error
                if($action == 'update')
    			{
    			     //back to edit page with id
                    $this->edit_text($_POST['id']);
    			}
            }
            else
    		{
                //if fileupload form was sent
                if(isset($_FILES['img_path']['name']))
                {
                    //if add new or update form and file lield of form was not empty
                    if(!empty($_FILES['img_path']['name']))
                    {
        			    $upload_path = base_url()."img/books/";
                        $img_arr     = array();
                        $img_arr     = $_FILES['img_path']['name'];
                        $img_arr_tmp = $_FILES['img_path']['tmp_name'];

                        ($filename = $this->imgloader->loadImg($img_arr, $upload_path, $img_arr_tmp)) ? $data ['img_path'] = "books/".$filename : false;
                    }
                    
                    //if file_upload form was empty - my upload_path
                    elseif($action == 'add' && empty($_FILES['img_path']['name']) && $action !== 'update')
                    {
                        $data ['img_path'] = "unknown.png";
                    }
        			  
                    //array for adding or updating
    			    $data ['title']    = $_POST['title'];
                    $data ['text']     = $_POST['text'];
        			  
                    if($action == 'add')
                        {
                            $dataArr              = $this->books_model->getIdCatAndMaxNum();
                            $data ['id_category'] = $dataArr[0]['id_category'];
                            $data ['number']      = $dataArr[0]['number']+1;
                            $data ['status']      = 'on';
                            list($name, $format) = explode('.',$filename);
                            //if add action was saccess - create new dir for images of new book
                            $this ->_add($data, $name);
                        }
                        
                    if($action == 'update')
                        {
                            $data ['status'] = $_POST['status'];
                            $this ->_update($data);
                        }
            }
        
         }
    }
    else
    {
        $this->login_model->logOut();
    }
	}	

//---------------------------------------------------------------
	/**
	 * Books list for edit or if (isset $id) - content book information for edit
	 */
	public function edit_booklist($id = false)
	{
	   if($this->session->userdata('username'))
        {
    		if(!$id)
    		{
                $this->data_arr['result'] = $this->books_model->getList();
                $data = array(
                   'menu'    => $this->load->view(MENU_ADMIN, '', true),
                   'content' => $this->load->view('books/edit_booklist', $this->data_arr, true)
                  );
                  
                $this ->load->view('layout_admin', $data);
    		}
    		elseif($id)
            {
                $this->data_arr['result'] = $this->books_model->get($id);
                $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('books/edit', $this->data_arr, true)
                    );
                $this ->load->view('layout_admin', $data);
            }
        }
        else
        {
            $this->login_model->logOut();
        }
	}
    
//---------------------------------------------------------------    
    /**
	 * show form for new the book
	 */
	public function new_books()
	{
	   if($this->session->userdata('username'))
        {
    		$data_arr = array(
    	        'menu'    => $this->load->view(MENU_ADMIN, '', true),
    	        'content' => $this->load->view('books/new', $this->data_arr, true),
                'title'   => $this->data_arr['title']
    	    );
    	  
    	    $this->load->view('layout_admin',$data_arr);
        }
        else
        {
            $this->login_model->logOut();
        }
	}

//---------------------------------------------------------------    
    /**
	 * update the books information
     * 
     * @param array $data
	 */
	private function _update($data, $table = null)
	{
	   if(!$table)
       {
	       $this->data_arr['message'] = ($this->books_model->update($_POST['id'], $data)) ? MESS_SUCCES : MESS_ERROR;
	   }
       else{
           $this->data_arr['message'] = ($this->books_model->updateInTable($_POST['id'], $data, $table)) ? MESS_SUCCES : MESS_ERROR;
       }
		
        
        $this->data_arr['result'] = $this->books_model->getList(); 
		$data_arr = array(
	        'menu'    => $this->load->view(MENU_ADMIN, '', true),
	        'content' => $this->load->view('books/edit_booklist', $this->data_arr, true),
            'title'   => $this->data_arr['title']
	    );
	  
	    $this->load->view('layout_admin',$data_arr);
	}
    
//--------------------------------------------------------------------------------	  
    /**
	 * add the new book information
	 */
	private function _add($data, $imgname = null)
	{ 
		$this->data_arr['message'] = $this ->books_model->add($data) ? MESS_SUCCES : MESS_ERROR;
        $imgname ? mkdir(base_url().'img/books/'.$imgname, 0777) : false;
		$this->data_arr['result'] = $this->books_model->getList();
        $data = array(
		   'menu'    => $this -> load -> view(MENU_ADMIN, '', true),
    	   'content' => $this->load->view('books/edit_booklist', $this->data_arr, true),
           'title'   => $this->data_arr['title']
		  );
		  
		  $this->load->view('layout_admin',$data);
    }
//--------------------------------------------------------------------------------		
	/**
	 * show book list for del
	 */
	public function del_booklist()
	{
	   if($this->session->userdata('username'))
        {
            $this->data_arr['result'] = $this->books_model->getList();
            $data = array(
               'menu'    => $this->load->view(MENU_ADMIN, '', true),
               'content' => $this->load->view('books/del_booklist', $this->data_arr, true)
              );
              
            $this->load->view('layout_admin',$data);
        }
        else
        {
            $this->login_model->logOut();
        }
	}    
//--------------------------------------------------------------------------------		
	/**
     * book del by $id
	 */
	public function del($id)
	{
	   if($this->session->userdata('username'))
        {
            $img_path = $this->books_model->getArrWhere('books', array('id' => $id), null, null);
            $this->data_arr['message'] = $this->books_model->del($id) ? MESS_SUCCES : MESS_ERROR;
            if($this->data_arr['message'] == MESS_SUCCES)
            {
                if(unlink(base_url().'img/'.$img_path[0]['img_path']))
                {
                    list($name, $type) = explode('.', $img_path[0]['img_path']);
                    RemoveDir(base_url().'img/'.$name.'/');
                }
            } 
            $this->data_arr['result']  = $this->books_model->getList();
            $data = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true),
                'content' => $this->load->view('books/del_booklist', $this->data_arr, true),
                'title'   => $this->data_arr['title']
               );
            $this->load->view('layout_admin',$data);
        }
        else
        {
            $this->login_model->logOut();
        }
	}
}
