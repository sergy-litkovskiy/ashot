<?php
/**
 * Frontend-Backend controller for about page
 * 
 * @author Litkovskiy
 * @copyright 2010
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class About extends MY_Controller
{
	public $data_arr;
	public $menu;

	function __construct()
	{
	   parent::MY_Controller();
	   $this->data_arr['title'] = 'Об авторе';
	   $this->data_arr['uri']   = explode('/',$_SERVER['REQUEST_URI']);
	   //set_magic_quotes_runtime(false);
		//ini_set('magic_quotes_gpc', "0");
        //ini_set('magic_quotes_sybase', "0");
        //ini_set('magic_quotes_runtime', "0");
	}

	public function index()
	{
       $this->data_arr['result'] = $this->about_model->getListJoin();
       //get list of links for current page
       $this->data_arr['about_link'] = $this->about_model->getArrWhere('about_links',array('status' => 'on'), null, null, 'id DESC');
       $this->data_arr['about_contact'] = $this->about_model->getArrWhere('contacts',array(), null, null);
       $data = array(
                'menu'    => $this->load->view(MENU, '', true), 
                'content' => $this->load->view('about/show', $this->data_arr, true));

	   $this->load->view('layout', $data);
	}
    
//---------------------------------------------------------------    
    /**
     * Show content of link about author
     */
	public function link($id)
	{
           $result = $this->data_arr['result'] = $this->about_model->getArrWhere('about_links',array('id' => $id), null, null);
           $this->data_arr['title'] = 'СМИ об авторе';
           $this->data_arr['name']  = $result[0]['name'];
    	   $data = array(
                    'menu'    => $this->load->view(MENU, '', true), 
                    'content' => $this->load->view('about/show_link', $this->data_arr, true));
    
    	   $this->load->view('layout', $data);
	}    

//---------------------------------------------------------------  
    public function admin()
	{
	   if($this->session->userdata('username'))
        {
    	   //gete main text about author
    	   $this->data_arr['message'] = 'Добро пожаловать в раздел для администрирования сайта!';
    	   $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true), 
                    'content' => $this->load->view('about/admin', $this->data_arr, true));
    
    	   $this->load->view('layout', $data);
        }
        else
        {
            $this->login_model->logOut();
        }
	}
    
//---------------------------------------------------------------	
	
	/**
     * Check validation of data about_page. If vaid - do update action?, else show form whith message error
     */
	public function check_valid_text()
	{
	   if($this->session->userdata('username'))
        {

            $rules = array(
    		    	array(
    		        'field'	=> 'text_short',
    		    	'label'	=> '<Текст>',
    		    	'rules'	=> 'required'));
        
            $this -> form_validation -> set_rules($rules);
                  
            if ($this -> form_validation -> run() === FALSE)
    		{
                $this -> edit_text($_REQUEST['id']);
            }
    		else
    		{
                $data ['id']           = $_REQUEST['id'];
                $data ['text_short']   = $_REQUEST['text_short'];
                $this -> _update($data);
    		}
        }
        else
        {
            $this->login_model->logOut();
        }
	}	
    
//---------------------------------------------------------------	
	
	/**
     * Check validation of contacts information
     */
	public function check_valid_contacts()
	{
	   if($this->session->userdata('username'))
        {

            $rules = array(
    		    	array(
    		        'field'	=> 'mobile_phone',
    		    	'label'	=> '<Телефоны>',
    		    	'rules'	=> 'required'),
                    array(
    		        'field'	=> 'email',
    		    	'label'	=> '<E-mail>',
    		    	'rules'	=> 'required'));
        
            $this -> form_validation -> set_rules($rules);
                  
            if ($this -> form_validation -> run() === FALSE)
    		{
                $this -> edit_contacts($_REQUEST['id']);
            }
    		else
    		{
                $data ['id']           = $_REQUEST['id'];
                $data ['mobile_phone'] = $_REQUEST['mobile_phone'];
                $data ['email']        = $_REQUEST['email'];
                $this -> _update($data, 'contacts', 'about/edit_contacts');
    		}
        }
        else
        {
            $this->login_model->logOut();
        }
	}	
//---------------------------------------------------------------	
    /**
     * Check validation of data links. If vaid - do update or add action?, else show form whith message error
     * 
     * @param string $action (add action or update action)
     */
	public function check_valid($action)
	{  
	   if($this->session->userdata('username'))
        {
    	    $rules = array(
                    array(
    		        'field'	=> 'name',
    		    	'label'	=> '<Название>',
    		    	'rules'	=> 'required'),
                    array(
    		        'field'	=> 'source',
    		    	'label'	=> '<Источник>',
    		    	'rules'	=> 'required'),
    		    	array(
    		        'field'	=> 'text',
    		    	'label'	=> '<Текст>',
    		    	'rules'	=> 'required'));
        
            $this -> form_validation -> set_rules($rules);
            if($action == 'add')
    		{
    		  if($this->form_validation->run() === false)
              {
                $this -> add_link();
              }
              else
              {
                $data ['name']   = $_REQUEST['name'];
                $data ['source'] = $_REQUEST['source'];
                $data ['text']   = $_REQUEST['text'];
                $data ['status'] = 'on';
                
                $this ->_add($data, 'about_links');
              }
            }          
            if($action == 'update')
    		{
    		  if($this->form_validation->run() === false)
              {
                $this -> edit_link($_REQUEST['id']);
              }
              else
              {
                $data ['name']   = $_REQUEST['name'];
                $data ['source'] = $_REQUEST['source'];
                $data ['text']   = $_REQUEST['text'];
                $data ['status'] = $_REQUEST['status'];

                $this ->_update($data, 'about_links');
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
     * Show for edit action whith data
     */    
    public function edit_text()
	{
	   if($this->session->userdata('username'))
        {
            //gete main text about author
            $this->data_arr['result'] = $this->about_model->getArrWhere('category',array('cat_name' => 'about'), null, null);
            $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true), 
                    'content' => $this->load->view('about/edit_text', $this->data_arr, true));
            
            $this->load->view('layout_admin', $data);
        }
        else
        {
            $this->login_model->logOut();
        }
	}
//---------------------------------------------------------------	    
    /**
     * Show for edit action whith data
     */    
    public function edit_contacts()
	{
	   if($this->session->userdata('username'))
        {
            //gete main text about author
            $this->data_arr['result'] = $this->about_model->getArrWhere('contacts',array(), null, null);
            $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true), 
                    'content' => $this->load->view('about/edit_contacts', $this->data_arr, true));
            
            $this->load->view('layout_admin', $data);
        }
        else
        {
            $this->login_model->logOut();
        }
	}
//---------------------------------------------------------------    
    /**
	 * show form for new link
	 */
	public function add_link()
	{
	   if($this->session->userdata('username'))
        {
    		$data_arr = array(
    	        'menu'    => $this->load->view(MENU_ADMIN, '', true),
    	        'content' => $this->load->view('about/new', $this->data_arr, true),
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
	 * list for edit or (if isset $id) content links for edit
	 */
	public function edit_link($id = false)
	{
	   if($this->session->userdata('username'))
        {
    	    $this->data_arr['title'] = 'Редактировать статью';
            if(!$id)
    		{
                $this->data_arr['result'] = $this->about_model->getArrWhere('about_links', null, null, null);
                $data = array(
                   'menu'    => $this->load->view(MENU_ADMIN, '', true),
                   'content' => $this->load->view('about/edit_linklist', $this->data_arr, true)
                  );
                  
                $this ->load->view('layout_admin', $data);
    		}
    		else
            {
                $this->data_arr['result'] = $this->about_model->getArrWhere('about_links', array('id' => $id), null, null);
                $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('about/edit_link', $this->data_arr, true)
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
	 * list for delete or delete(if isset $id)
	 */
	public function del_link($id = false)
	{
	    if($this->session->userdata('username'))
        {
    	    $this->data_arr['title'] = 'Удалить статью';
            if(!$id)
    		{
    		    $this->data_arr['result'] = $this->about_model->getArrWhere('about_links', null, null, null);
                $data = array(
                   'menu'    => $this->load->view(MENU_ADMIN, '', true),
                   'content' => $this->load->view('about/del_linklist', $this->data_arr, true)
                  );
                  
                $this ->load->view('layout_admin', $data);
    		}
    		else
            {
                $this->about_model->delFromTable($id, 'about_links') ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
                $this->data_arr['result'] = $this->about_model->getArrWhere('about_links', null, null, null);
                $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('about/del_linklist', $this->data_arr, true)
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
	 * show form for new photo
	 */
	public function add_about_image()
	{
	   if($this->session->userdata('username'))
        {
    		$data_arr = array(
    	        'menu'    => $this->load->view(MENU_ADMIN, '', true),
    	        'content' => $this->load->view('about/new_image', $this->data_arr, true),
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
	 * list for edit or (if isset $id) content photo for edit
	 */
	public function edit_about_image($id = false)
	{
	   if($this->session->userdata('username'))
        {
    	    $this->data_arr['title'] = 'Редактировать фото автора с известными людьми';
            if(!$id)
    		{
    		    $resultArr = $this->about_model->getArrWhere('category', array('cat_name' => 'about'), null, null);
                $this->data_arr['result'] = $this->about_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data = array(
                   'menu'    => $this->load->view(MENU_ADMIN, '', true),
                   'content' => $this->load->view('about/edit_imagelist', $this->data_arr, true)
                  );
                  
                $this ->load->view('layout_admin', $data);
    		}
    		else
            {
                $this->data_arr['result'] = $this->about_model->getArrWhere('images', array('id' => $id), null, null);
                
                $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('about/edit_image', $this->data_arr, true)
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
	 * list for delete or delete(if isset $id)
	 */
	public function del_image($id)
	{
	    if($this->session->userdata('username'))
        {
    	    $this->data_arr['title'] = 'Удалить фото автора с известными людьми';
            
            $img_path = $this->about_model->getArrWhere('images', array('id' => $id), null, null);
            $del_done = $this->about_model->delFromTable($id, 'images') ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
            $del_done ? unlink('img/'.$img_path[0]['img_path']) : false;
            
            $resultArr = $this->about_model->getArrWhere('category', array('cat_name' => 'about'), null, null);
            $this->data_arr['result'] = $this->about_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
            $data = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true),
                'content' => $this->load->view('about/edit_imagelist', $this->data_arr, true),
                'title'   => $this->data_arr['title']
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
     * Check validation of images about page
     * 
     * @param string $action (add action or update action)
     */
	public function check_valid_image($action)
	{
	   if($this->session->userdata('username'))
        {
            $countArr = 0;
            $count = 0;
            if($_FILES['img_path']['name'] !== '')
            {
                $countArr = count($_FILES['img_path']['name']);
                for($i=0; $i<=$countArr; $i++)
                {
                    !empty($_FILES['img_path']['name'][$i]) ? $count ++: null;//check if empty array and count of file's number
                }
            } 
            if($action == 'add')
    		{
    		  $category_arr = $this->about_model->getArrWhere('category',array('cat_name' => 'about'), null, null);
    		  //if add new cinemaplacard and any files was not attached - reload add form whith massage error
    		  if($count < 1)
              {
                $this->data_arr['message'] = "<h2 class='mess_bad'>ВНИМАНИЕ! Вы не выбрали файл для загрузки. Попробуйте еще раз.";
    			$data = array(
    			   'menu'    => $this->load->view(MENU_ADMIN,'',true),
    			   'content' => $this->load->view('about/new_image',$this->data_arr,true)
    		  );
                $this->load->view('layout_admin',$data);
              }
              //if array of file fields of form was not empty
              elseif($count > 0)
              {
                $count_false = 0;//counter for error insert action
                for($k=0; $k<=$countArr; $k++)
                {
                    //if a file field of form was not empty - load the file
                    if(!empty($_FILES['img_path']['name'][$k]))
                    {
        			    $upload_path = "img/about/";
                        $img_arr     = array();
                        $img_arr     = $_FILES['img_path']['name'][$k];
                        $img_arr_tmp = $_FILES['img_path']['tmp_name'][$k];
                        //if image was successfully loaded into server - to create array of data  for insert to DB 
                        if($filename = $this->imgloader->loadImg($img_arr, $upload_path, $img_arr_tmp))
                        {
                            $max_number = $this->about_model->getMaxNumByIdCat('images', $category_arr[0]['id']);
                           
                            $data ['id_category']  = $category_arr[0]['id'];
                            $data ['number']       = $max_number[0]['number']+1;
                            $data ['img_path']     = "about/".$filename;
                            $data ['img_name']     = $_REQUEST['img_name'][$k];
                            $data ['img_year']     = $_REQUEST['img_year'][$k];
                            $data ['img_material'] = '';
                            $data ['img_size']     = '';
                            $data ['img_comment']  = $_REQUEST['img_comment'][$k];
                            $data ['status']       = 'on';
                            
                            $this ->_add_image($data, 'images', true) ? $this->data_arr['message'] = MESS_SUCCES  : $count_false++;//if after inset action return true - set success message  or if return false - to do count
                        }
                    }
                }
                ($count_false > 0) ? $this->data_arr['message'] = "<h2 class='mess_bad'>Некоторые из файлов НЕ были загружены! Пожалуйста, проверьте, какие файлы не загрузились, и повторите попытку.</h2>" : $this->data_arr['message'];
                
                $this->data_arr['result'] = $this->about_model->getArrWhere('images', array('id_category' => $category_arr[0]['id']), null, null, 'number');
                $data = array(
        		   'menu'    => $this -> load -> view(MENU_ADMIN,'',true),
            	   'content' => $this->load->view('about/edit_imagelist', $this->data_arr, true),
                   'title'   => $this->data_arr['title']
                    );
    		  
                $this->load->view('layout_admin',$data);
              }
            }
    
            if($action == 'update')
    		{
                $data ['id_category']  = $_REQUEST['id_category'];
                $data ['number']       = $_REQUEST['number'];
                $data ['img_name']     = $_REQUEST['img_name'];
                $data ['img_year']     = $_REQUEST['img_year'];
                $data ['img_comment']  = $_REQUEST['img_comment'];
                $data ['status']       = $_REQUEST['status'];
    		  //if update the cinemaplacard and new file was not attached - to update only text fields
    		  if($count < 1)
              {
                $this ->_update_image($data, 'images');
              }
              //if file field of form was not empty
              elseif($count > 0)
              {
    		    $upload_path = "img/about/";
                $img_arr     = array();
                $img_arr     = $_FILES['img_path']['name'];
                $img_arr_tmp = $_FILES['img_path']['tmp_name'];
                //if image was successfully loaded into server - to create array of data  for insert to DB 
                if(unlink('img/'.$_REQUEST['img_path_old']))
                {
                    if($filename = $this->imgloader->loadImg($img_arr, $upload_path, $img_arr_tmp))
                    {
                        $data ['img_path']     = "about/".$filename;
                        $this ->_update_image($data, 'images');
                    }
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
	 * add the new data
     * 
     * @param array $data (array of data for insert)
     * @param string $table
	 */
	private function _add($data, $table)
	{
	   ($this->about_model->addInTable($data, $table)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
        $this->data_arr['result'] = $this->about_model->getArrWhere($table, array('status' => 'on'), null, null);
        $data = array(
    		   'menu'    => $this -> load -> view(MENU_ADMIN,'',true),
        	   'content' => $this->load->view('about/edit_linklist', $this->data_arr, true),
               'title'   => $this->data_arr['title']
    		  );
		  
        $this->load->view('layout_admin',$data);
     }
    
        
//---------------------------------------------------------------    
    /**
	 * update the text about information
     * 
     * @param array $data
     * @param string name of table
	 */
	private function _update($data, $table=null, $path_page = null)
	{
	   if($table)
       {
            $page = $path_page ? $path_page : 'about/edit_linklist';
            ($this->about_model->updateInTable($_POST['id'], $data, $table)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
            $this->data_arr['result'] = $this->about_model->getArrWhere($table, null, null, null);
	        $data_arr = array(
	        'menu'    => $this->load->view(MENU_ADMIN,'',true),
	        'content' => $this->load->view($page, $this->data_arr, true),
            'title'   => $this->data_arr['title']
	    );
	  
	    $this->load->view('layout_admin',$data_arr);
       }
       else
       {
            $id = $data['id'];
            unset ($data['id']);
            ($this->about_model->update($id, $data)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
            $this -> edit_text($id);
       }
	}
    
    //---------------------------------------------------------------
    /**
	 * add the new image about 
     * 
     * @param array $data (array of data for insert)
     * @param string $table name of table for insert
     * @param bool $plural (sets true if needs to insert data in cycle) - return bool
	 */
	private function _add_image($data, $table, $plural = false)
	{  
	    if($plural)
        {
		   if($this ->about_model->addInTable($data, $table))
           {
                return true;
           }
           else
           {
                return false;
           }
        }
		else
        {
            ($this ->about_model->addInTable($data, $table)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
            
            $this->data_arr['result'] = $this->about_model->getArrWhere('images', array('id_category' => $data['id_category']), null, null, 'number');
            $data = array(
    		   'menu'    => $this -> load -> view(MENU_ADMIN,'',true),
        	   'content' => $this->load->view('about/edit_imagelist', $this->data_arr, true),
               'title'   => $this->data_arr['title']
    		  );
		  
		  $this->load->view('layout_admin',$data);
        }
     }
    
        
//---------------------------------------------------------------    
    /**
	 * update the image
     * 
     * @param array $data
     * @param string name of table
	 */
	private function _update_image($data, $table=null)
	{
	   $id_category = $data['id_category'];
	   if($table)
       {
            ($this->about_model->updateInTable($_POST['id'], $data, $table)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
       }
       else
       {
            //update text
            unset($data['id_category']);
            ($this->about_model->update($_POST['id'], $data)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
       }
        $this->data_arr['result'] = $this->about_model->getArrWhere('images', array('id_category' => $id_category), null, null, 'number');
		$data_arr = array(
	        'menu'    => $this->load->view(MENU_ADMIN,'',true),
	        'content' => $this->load->view('about/edit_imagelist', $this->data_arr, true),
            'title'   => $this->data_arr['title']
	    );
	  
	    $this->load->view('layout_admin',$data_arr);
	}
}
