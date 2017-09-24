<?php
/**
 * Frontend-Backend controller for photos page
 * 
 * @author Litkovskiy
 * @copyright 2010
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Photos extends MY_Controller
{
	public $data_arr, $urlArr;

	public function __construct()
	{
		parent::MY_Controller();
		$this->data_arr['title'] = 'Фотографии';
		$this->urlArr            = explode('/',$_SERVER['REQUEST_URI']);
	}
//$this->firephp->fb($this->data_arr);
	public function index()
	{
		$this->data_arr['uri'] = $this->urlArr;
		$data = array(
                'menu'    => $this->load->view(MENU, '', true), 
                'content' => $this->load->view('photos/show', $this->data_arr, true));

		$this->load->view('layout', $data);
	}
    
//---------------------------------------------------------------    
    public function ajax_sortable ()
    {
        $arrData = $_POST['ids'];

        foreach($arrData as $number => $id)
        {
          $result = $this->photos_model->updateInTable($id, array('number' => $number+1), 'images') ? MESS_SUCCES : MESS_ERROR;
        }
        print $result;
        exit;
        
    }

//---------------------------------------------------------------	
	/**
	 * Creating kids page
	 */
	public function kids()
	{
	   $this->data_arr['result']    = $this->photos_model->getListJoin('kids');
       foreach($this->data_arr['result'] as $key => $arr){
            $this->data_arr['result'][$key]['count_comment'] = count($this->photos_model->getCountComments($arr['id']));
       }
       $this->data_arr['title']     = 'Фотографии&nbsp;&bull;&nbsp;Дети';
	   $this->data_arr['uri'] 		= $this->urlArr;
	   $data = array(
                'menu'    => $this->load->view(MENU, '', true), 
                'content' => $this->load->view('photos/show', $this->data_arr, true));

	   $this->load->view('layout', $data);
	}

	/**
	 * Creating people page
	 */
	public function people()
	{
	   $this->data_arr['result']    = $this->photos_model->getListJoin('people');
       foreach($this->data_arr['result'] as $key => $arr){
            $this->data_arr['result'][$key]['count_comment'] = count($this->photos_model->getCountComments($arr['id']));
       }
       $this->data_arr['title']     = 'Фотографии&nbsp;&bull;&nbsp;Люди';
	   $this->data_arr['uri']       = $this->urlArr;
	   $data = array(
                'menu'    => $this->load->view(MENU, '', true), 
                'content' => $this->load->view('photos/show', $this->data_arr, true));

	   $this->load->view('layout', $data);
	}

	/**
	 * Creating kiev page
	 */
	public function kiev()
	{
	   $this->data_arr['result']    = $this->photos_model->getListJoin('kiev');
       foreach($this->data_arr['result'] as $key => $arr){
            $this->data_arr['result'][$key]['count_comment'] = count($this->photos_model->getCountComments($arr['id']));
       }
       $this->data_arr['title']     = 'Фотографии&nbsp;&bull;&nbsp;Киев';
	   $this->data_arr['uri']       = $this->urlArr;
	   $data = array(
                'menu'    => $this->load->view(MENU, '', true), 
                'content' => $this->load->view('photos/show', $this->data_arr, true));

	   $this->load->view('layout', $data);
	}

	/**
	 * Creating landscapes page
	 */
	public function ukraine()
	{
	   $this->data_arr['result']    = $this->photos_model->getListJoin('ukraine');
       foreach($this->data_arr['result'] as $key => $arr){
            $this->data_arr['result'][$key]['count_comment'] = count($this->photos_model->getCountComments($arr['id']));
       }
       $this->data_arr['title']     = 'Фотографии&nbsp;&bull;&nbsp;Украина';
	   $this->data_arr['uri'] 		= $this->urlArr;
	   $data = array(
                'menu'    => $this->load->view(MENU, '', true), 
                'content' => $this->load->view('photos/show', $this->data_arr, true));

	   $this->load->view('layout', $data);
	}

	/**
	 * Creating medicine page
	 */
	public function medicine()
	{
	   $this->data_arr['result']    = $this->photos_model->getListJoin('medicine');
       foreach($this->data_arr['result'] as $key => $arr){
            $this->data_arr['result'][$key]['count_comment'] = count($this->photos_model->getCountComments($arr['id']));
       }
       $this->data_arr['title']     = 'Фотографии&nbsp;&bull;&nbsp;Медицина';
	   $this->data_arr['uri'] 		= $this->urlArr;
	   $data = array(
                'menu'    => $this->load->view(MENU, '', true), 
                'content' => $this->load->view('photos/show', $this->data_arr, true));

	   $this->load->view('layout', $data);
	}
    
//---------------------------------------------------------------    
    /**
	 * show form for new
     * @param string $part
	 */
	public function add($part)
	{
	    if($this->session->userdata('username'))
        {
    	    $this->data_arr['part'] = $part;
    		$data_arr = array(
    	        'menu'    => $this->load->view(MENU_ADMIN, '', true),
    	        'content' => $this->load->view('photos/new', $this->data_arr, true),
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
	 * Content for edit
     * 
     * @param string get name of photos's part
	 */
	public function edit_text($param)
	{
	   if($this->session->userdata('username'))
        {
        	$param_ru                 = translate_photos($param);
            $this->data_arr['result'] = $this->photos_model->getArrWhere('category',array('cat_name' => 'photos', 'part_name' => $param), null, null);
            $this->data_arr['title']  = $param_ru;
            $data = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true),
                'content' => $this->load->view('photos/edit_text', $this->data_arr, true),
                'title'   => $param_ru
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
	 * list for edit or (if isset $id) content for edit
	 */
	public function edit($part, $id = false)
	{
	   if($this->session->userdata('username'))
        {
    	   $this->data_arr['title'] = 'Редактировать '.translate_photos($part);
           $this->data_arr['part']  = $part;
            if(!$id)
    		{
    		    $resultArr                = $this->photos_model->getArrWhere('category',array('part_name' => $part), null, null);
                $this->data_arr['result'] = $this->photos_model->getArrWhere('images',array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data = array(
                   'menu'    => $this->load->view(MENU_ADMIN, '', true),
                   'content' => $this->load->view('photos/edit_list', $this->data_arr, true)
                  );
                  
                $this ->load->view('layout_admin', $data);
    		}
    		else
            {
                $this->data_arr['result'] = $this->photos_model->getArrWhere('images',array('id' => $id), null, null);
                if($this->data_arr['result'][0]['img_size'] !== '')
                {
                     list($this->data_arr['result'][0]['width'], $this->data_arr['result'][0]['height']) = explode('x', $this->data_arr['result'][0]['img_size']);
                }
                else
                {
                    $this->data_arr['result'][0]['width'] = '';
                    $this->data_arr['result'][0]['height']= '';
                }
                $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('photos/edit_photos', $this->data_arr, true)
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
     * Check validation of data photos_page and do update
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
                //back to edit page with id
                $this->edit_text($_POST['id']);
            }
            else
    		{
                $data['text_short']  = $_POST['text_short'];
                $data['id_category'] = $_POST['id'];
                $this ->_update($data, $_POST['part_name']);
            }
        }
        else
        {
            $this->login_model->logOut();
        }
     }
     
//--------------------------------------------------------------------
    /**
     * Check validation of data photos_page. If vaid - do update or add action?, else show form whith message error
     * 
     * @param string $action (add action or update action)
     * @param string $part (name of category's part)
     */
	public function check_valid($action, $part = null)
	{
	   if($this->session->userdata('username'))
        {
            $countArr = 0;
            $count = 0;
            if(!empty($_FILES['img_path']['name']))
            {
                $countArr = count($_FILES['img_path']['name']);
    
                for($i=0; $i<=$countArr; $i++)
                {
                    !empty($_FILES['img_path']['name'][$i]) ? $count ++: null;//check if empty array and count of file's number
                }
            } 
            if($action == 'add')
    		{
    		  $category_arr = $this->photos_model->getArrWhere('category',array('part_name' => $part), null, null);
    		  //if add new photos and any files was not attached - reload add form whith massage error
    		  if($count < 1)
              {
                $this->data_arr['message'] = "<h2 class='mess_bad'>ВНИМАНИЕ! Вы не выбрали файл для загрузки. Попробуйте еще раз.<\h2>";
    			$data = array(
    			   'menu'    => $this->load->view(MENU_ADMIN, '', true),
    			   'content' => $this->load->view('photos/new', $this->data_arr, true)
    		  );
                $this->load->view('layout_admin', $data);
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
        			    $upload_path = base_url()."img/".$part."/";
                        $img_arr     = array();
                        $img_arr     = $_FILES['img_path']['name'][$k];
                        $img_arr_tmp = $_FILES['img_path']['tmp_name'][$k];
                        //if image was successfully loaded into server - to create array of data  for insert to DB 
                        if($filename = $this->imgloader->loadImg($img_arr, $upload_path, $img_arr_tmp))
                        {
                            $max_number = $this->photos_model->getMaxNumByIdCat('images', $category_arr[0]['id']);
                           
                            $data ['id_category']  = $category_arr[0]['id'];
                            $data ['number']       = $max_number[0]['number']+1;
                            $data ['img_path']     = $part."/".$filename;
                            $data ['img_name']     = $_REQUEST['img_name'][$k];
                            $data ['img_year']     = $_REQUEST['img_year'][$k];
                            $data ['img_material'] = $_REQUEST['img_material'][$k];
                            $data ['img_size']     = $_REQUEST['img_width'][$k].'x'.$_REQUEST['img_height'][$k];
                            $data ['img_comment']  = $_REQUEST['img_comment'][$k];
                            $data ['status']       = 'on';
                            
                            $this ->_add($data, 'images', true) ? $this->data_arr['message'] = MESS_SUCCES  : $count_false++;//if after insert action return true - set success message  or if return false - to do count
                        }
                    }
                }
                ($count_false > 0) ? $this->data_arr['message'] = "<h2 class='mess_bad'>Некоторые из файлов НЕ были загружены! Пожалуйста, проверьте, какие файлы не загрузились, и повторите попытку.</h2>" : $this->data_arr['message'];
                
                $resultArr                = $this->photos_model->getArrWhere('category',array('part_name' => $part), null, null);
                $this->data_arr['result'] = $this->photos_model->getArrWhere('images',array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $this->data_arr['part']   = $part;
                $data = array(
        		   'menu'    => $this -> load -> view(MENU_ADMIN, '', true),
            	   'content' => $this->load->view('photos/edit_list', $this->data_arr, true),
                   'title'   => $this->data_arr['title']
                    );
    		  
                $this->load->view('layout_admin', $data);
              }
            }
    
            if($action == 'update')
    		{
                $data ['id_category']  = $_REQUEST['id_category'];
                $data ['number']       = $_REQUEST['number'];
                $data ['img_name']     = $_REQUEST['img_name'];
                $data ['img_year']     = $_REQUEST['img_year'];
                $data ['img_material'] = $_REQUEST['img_material'];
                $data ['img_size']     = $_REQUEST['img_width'].'x'.$_REQUEST['img_height'];
                $data ['img_comment']  = $_REQUEST['img_comment'];
                $data ['status']       = $_REQUEST['status'];
    		  //if update the placards and new file was not attached - to update only text fields
    		  if($count < 1)
              {
                $this ->_update($data, $part, 'images');
              }
              //if file field of form was not empty
              elseif($count > 0)
              {
    		    $upload_path = base_url()."img/".$part."/";
                $img_arr     = array();
                $img_arr     = $_FILES['img_path']['name'];
                $img_arr_tmp = $_FILES['img_path']['tmp_name'];
                //if image was successfully loaded into server - to create array of data  for insert to DB 
                if(unlink(base_url().'img/'.$_REQUEST['img_path_old']))
                {
                    if($filename = $this->imgloader->loadImg($img_arr, $upload_path, $img_arr_tmp))
                    {
                        $data ['img_path']     = $part."/".$filename;
                        $this ->_update($data, $part, 'images');
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
	 * Content for sort
     * 
     * @param string get name of photos's part
	 */
	public function sort_list($part)
	{
	   if($this->session->userdata('username'))
        {
            $this->data_arr['title']  = 'Сортировать '.translate_photos($part);
            $this->data_arr['part']   = $part;
            $resultArr                = $this->photos_model->getArrWhere('category',array('part_name' => $part), null, null);
            $this->data_arr['result'] = $this->photos_model->getArrWhere('images',array('id_category' => $resultArr[0]['id']), null, null, 'number');
            $data = array(
               'menu'    => $this->load->view(MENU_ADMIN, '', true),
               'content' => $this->load->view('photos/edit_list_sortable', $this->data_arr, true)
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
	 * add the new information
     * 
     * @param array $data (array of data for insert)
     * @param string $table name of table for insert
     * @param bool $plural (sets true if needs to insert data in cycle) - return bool
	 */
    private function _add($data, $table, $plural = false)
	{  
	    if($plural)
        {
		   if($this ->photos_model->addInTable($data, $table))
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
            $this->data_arr['message'] = $this ->photos_model->addInTable($data, $table) ? MESS_SUCCES : MESS_ERROR;
            
            $this->data_arr['result'] = $this->photos_model->getArrWhere('images',array('id_category' => $data['id_category']), null, null, 'number');
            $part = explode('/', $data['img_path']);
            $this->data_arr['part']   = $part[0];
            $data = array(
    		   'menu'    => $this -> load -> view(MENU_ADMIN, '', true),
        	   'content' => $this->load->view('photos/edit_list', $this->data_arr, true),
               'title'   => $this->data_arr['title']
    		  );
		  
		  $this->load->view('layout_admin',$data);
        }
     }
    
        
//---------------------------------------------------------------    
    /**
	 * update the text about photos or images information
     * 
     * @param array $data
     * @param string name of table
	 */
	private function _update($data, $part, $table=null)
	{
	   $id_category = $data['id_category'];
	   if($table)
       {
            $this->data_arr['message'] = $this->photos_model->updateInTable($_POST['id'], $data, $table) ? MESS_SUCCES : MESS_ERROR;
       }
       else
       {
            //update text
            unset($data['id_category']);
            $this->data_arr['message'] = $this->photos_model->update($_POST['id'], $data) ? MESS_SUCCES : MESS_ERROR;
       }
        $this->data_arr['result'] = $this->photos_model->getArrWhere('images',array('id_category' => $id_category), null, null, 'number');
		$this->data_arr['part']   = $part;
        $data_arr = array(
	        'menu'    => $this->load->view(MENU_ADMIN,'',true),
	        'content' => $this->load->view('photos/edit_list', $this->data_arr, true),
            'title'   => $this->data_arr['title']
	    );
	  
	    $this->load->view('layout_admin',$data_arr);
	}
    
//---------------------------------------------------------------
	/**
	 * list for delete or delete(if isset $id)
	 */
	public function del($part, $id = false)
	{
	    if($this->session->userdata('username'))
        {
    	    $this->data_arr['title'] = 'Удалить '.translate_photos($part);
            $this->data_arr['part']  = $part;
            if(!$id)
    		{
    		    $resultArr                = $this->photos_model->getArrWhere('category',array('part_name' => $part), null, null);
                $this->data_arr['result'] = $this->photos_model->getArrWhere('images',array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data = array(
                   'menu'    => $this->load->view(MENU_ADMIN, '', true),
                   'content' => $this->load->view('photos/del_list', $this->data_arr, true)
                  );
                  
                $this ->load->view('layout_admin', $data);
    		}
    		else
            {
                $img_path = $this->photos_model->getArrWhere('images', array('id' => $id), null, null);
                $this->data_arr['message'] = $this->photos_model->delFromTable($id, 'images') ? MESS_SUCCES : MESS_ERROR;
                ($this->data_arr['message'] == MESS_SUCCES) ? unlink(base_url().'img/'.$img_path[0]['img_path']) : false;
                
                $resultArr                = $this->photos_model->getArrWhere('category',array('part_name' => $part), null, null);
                $this->data_arr['result'] = $this->photos_model->getArrWhere('images',array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('photos/del_list', $this->data_arr, true),
                    'title'   => $this->data_arr['title']
                    );
                $this ->load->view('layout_admin', $data);
            }
        }
        else
        {
            $this->login_model->logOut();
        }
   }
}
