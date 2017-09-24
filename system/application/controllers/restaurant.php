<?php
/**
 * Frontend-Backend controller for restaurant page
 * 
 * @author Litkovskiy
 * @copyright 2010
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class restaurant extends MY_Controller
{
	public $data_arr, $urlArr;

	public function __construct()
	{
		parent::MY_Controller();
		$this->data_arr['title'] = '�������� ��������';
		$this->urlArr            = explode('/',$_SERVER['REQUEST_URI']);
	}
//$this->firephp->fb($this->data_arr);
	public function index()
	{
	   $this->data_arr['result'] = $this->restaurant_model->getListJoin();
	   $this->data_arr['uri'] = $this->urlArr;
       foreach($this->data_arr['result'] as $key => $arr){
            $this->data_arr['result'][$key]['count_comment'] = count($this->restaurant_model->getCountComments($arr['id']));
       }
       $data = array(
                'menu'    => $this->load->view(MENU, '', true), 
                'content' => $this->load->view('restaurant/show', $this->data_arr, true));

	   $this->load->view('layout', $data);
	}
    
//---------------------------------------------------------------    
    /**
	 * show form for new restaurant
	 */
	public function add_restaurant()
	{
	    if($this->session->userdata('username'))
        {
    		$data_arr = array(
    	        'menu'    => $this->load->view(MENU_ADMIN, '', true),
    	        'content' => $this->load->view('restaurant/new', $this->data_arr, true),
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
	 * Content of restaurant for edit
	 */
	public function edit_text()
	{
	   if($this->session->userdata('username'))
        {
            $this->data_arr['result'] = $this->restaurant_model->getArrWhere('category', array('cat_name' => 'restaurant'), null, null);
            $data = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true),
                'content' => $this->load->view('restaurant/edit', $this->data_arr, true)
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
	 * list for edit or (if isset $id) content restaurant for edit
	 */
	public function edit_restaurant($id = false)
	{
	    if($this->session->userdata('username'))
        {
    	    $this->data_arr['title'] = '�������������';
            if(!$id)
    		{
    		    $resultArr = $this->restaurant_model->getArrWhere('category', array('cat_name' => 'restaurant'), null, null);
                $this->data_arr['result'] = $this->restaurant_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data = array(
                   'menu'    => $this->load->view(MENU_ADMIN, '', true),
                   'content' => $this->load->view('restaurant/edit_restaurantlist', $this->data_arr, true)
                  );
                  
                $this ->load->view('layout_admin', $data);
    		}
    		else
            {
                $this->data_arr['result'] = $this->restaurant_model->getArrWhere('images', array('id' => $id), null, null);
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
                    'content' => $this->load->view('restaurant/edit_restaurant', $this->data_arr, true)
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
	public function del_restaurant($id = false)
	{
	    if($this->session->userdata('username'))
        {
    	    $this->data_arr['title'] = '������� ���� ���������';
            if(!$id)
    		{
    		    $resultArr = $this->restaurant_model->getArrWhere('category', array('cat_name' => 'restaurant'), null, null);
                $this->data_arr['result'] = $this->restaurant_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data = array(
                   'menu'    => $this->load->view(MENU_ADMIN, '', true),
                   'content' => $this->load->view('restaurant/del_restaurantlist', $this->data_arr, true)
                  );
                  
                $this ->load->view('layout_admin', $data);
    		}
    		else
            {
                $img_path = $this->painting_model->getArrWhere('images', array('id' => $id), null, null);
                $del_done = $this->painting_model->delFromTable($id, 'images') ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
                $del_done ? unlink(base_url().'img/'.$img_path[0]['img_path']) : false;
                
                $resultArr = $this->restaurant_model->getArrWhere('category', array('cat_name' => 'restaurant'), null, null);
                $this->data_arr['result'] = $this->restaurant_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('restaurant/del_restaurantlist', $this->data_arr, true),
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
           
//---------------------------------------------------------------	
	
	/**
     * Check validation of data restaurants_page and do update
     */
	public function check_valid_text()
	{
	   if($this->session->userdata('username'))
        {
            $rules = array(
                    array(
    		        'field'	=> 'text_short',
    		    	'label'	=> '<�����>',
    		    	'rules'	=> 'required')
                    );
        
            $this->form_validation->set_rules($rules);
                  
            if ($this->form_validation->run() === false)
    		{
                $this->edit_text($_POST['id']);//back to edit page with id
            }
            else
    		{
                $data['text_short']  = $_POST['text_short'];
                $data['id_category'] = $_POST['id'];
                $this ->_update($data);
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
    		  $category_arr = $this->restaurant_model->getArrWhere('category',array('cat_name' => 'restaurant'), null, null);
    		  //if add new restaurant and any files was not attached - reload add form whith massage error
    		  if($count < 1)
              {
                $this->data_arr['message'] = "<h2 class='mess_bad'>��������! �� �� ������� ���� ��� ��������. ���������� ��� ���.";
    			$data = array(
    			   'menu'    => $this->load->view(MENU_ADMIN,'',true),
    			   'content' => $this->load->view('restaurant/new',$this->data_arr,true)
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
        			    $upload_path = base_url()."img/restaurant/";
                        $img_arr     = array();
                        $img_arr     = $_FILES['img_path']['name'][$k];
                        $img_arr_tmp = $_FILES['img_path']['tmp_name'][$k];
                        //if image was successfully loaded into server - to create array of data  for insert to DB 
                        if($filename = $this->imgloader->loadImg($img_arr, $upload_path, $img_arr_tmp))
                        {
                            $max_number = $this->restaurant_model->getMaxNumByIdCat('images', $category_arr[0]['id']);
                           
                            $data ['id_category']  = $category_arr[0]['id'];
                            $data ['number']       = $max_number[0]['number']+1;
                            $data ['img_path']     = "restaurant/".$filename;
                            $data ['img_name']     = $_REQUEST['img_name'][$k];
                            $data ['img_year']     = $_REQUEST['img_year'][$k];
                            $data ['img_material'] = $_REQUEST['img_material'][$k];
                            $data ['img_size']     = $_REQUEST['img_width'][$k].'x'.$_REQUEST['img_height'][$k];
                            $data ['img_comment']  = $_REQUEST['img_comment'][$k];
                            $data ['status']       = 'on';
                            
                            $this ->_add($data, 'images', true) ? $this->data_arr['message'] = MESS_SUCCES  : $count_false++;//if after inset action return true - set success message  or if return false - to do count
                        }
                    }
                }
                ($count_false > 0) ? $this->data_arr['message'] = "<h2 class='mess_bad'>��������� �� ������ �� ���� ���������! ����������, ���������, ����� ����� �� �����������, � ��������� �������.</h2>" : $this->data_arr['message'];
                
                $this->data_arr['result'] = $this->restaurant_model->getArrWhere('images', array('id_category' => $category_arr[0]['id']), null, null, 'number');
                $data = array(
        		   'menu'    => $this -> load -> view(MENU_ADMIN,'',true),
            	   'content' => $this->load->view('restaurant/edit_restaurantlist', $this->data_arr, true),
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
                $data ['img_material'] = $_REQUEST['img_material'];
                $data ['img_size']     = $_REQUEST['img_width'].'x'.$_REQUEST['img_height'];
                $data ['img_comment']  = $_REQUEST['img_comment'];
                $data ['status']       = $_REQUEST['status'];
    		  //if update the restaurant and new file was not attached - to update only text fields
    		  if($count < 1)
              {
                $this ->_update($data, 'images');
              }
              //if file field of form was not empty
              elseif($count > 0)
              {
    		    $upload_path = base_url()."img/restaurant/";
                $img_arr     = array();
                $img_arr     = $_FILES['img_path']['name'];
                $img_arr_tmp = $_FILES['img_path']['tmp_name'];
                //if image was successfully loaded into server - to create array of data  for insert to DB 
                if(unlink(base_url().'img/'.$_REQUEST['img_path_old']))
                {
                    if($filename = $this->imgloader->loadImg($img_arr, $upload_path, $img_arr_tmp))
                    {
                        $data ['img_path']     = "restaurant/".$filename;
                        $this ->_update($data, 'images');
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
	 * add the new restaurant information
     * 
     * @param array $data (array of data for insert)
     * @param string $table name of table for insert
     * @param bool $plural (sets true if needs to insert data in cycle) - return bool
	 */
	private function _add($data, $table, $plural = false)
	{  
	    if($plural)
        {
		   if($this ->restaurant_model->addInTable($data, $table))
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
            ($this ->restaurant_model->addInTable($data, $table)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
            
            $this->data_arr['result'] = $this->restaurant_model->getArrWhere('images', array('id_category' => $data['id_category']), null, null, 'number');
            $data = array(
    		   'menu'    => $this -> load -> view(MENU_ADMIN,'',true),
        	   'content' => $this->load->view('restaurant/edit_restaurantlist', $this->data_arr, true),
               'title'   => $this->data_arr['title']
    		  );
		  
		  $this->load->view('layout_admin',$data);
        }
     }
    
        
//---------------------------------------------------------------    
    /**
	 * update the text about restaurant or images information
     * 
     * @param array $data
     * @param string name of table
	 */
	private function _update($data, $table=null)
	{
	   $id_category = $data['id_category'];
	   if($table)
       {
            ($this->restaurant_model->updateInTable($_POST['id'], $data, $table)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
       }
       else
       {
            //update text
            unset($data['id_category']);
            ($this->restaurant_model->update($_POST['id'], $data)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
       }
        $this->data_arr['result'] = $this->restaurant_model->getArrWhere('images', array('id_category' => $id_category), null, null, 'number');
		$data_arr = array(
	        'menu'    => $this->load->view(MENU_ADMIN,'',true),
	        'content' => $this->load->view('restaurant/edit_restaurantlist', $this->data_arr, true),
            'title'   => $this->data_arr['title']
	    );
	  
	    $this->load->view('layout_admin',$data_arr);
	}
}
