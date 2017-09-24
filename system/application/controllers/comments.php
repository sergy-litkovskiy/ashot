<?php
/**
 * Frontend-Backend controller for painting page
 * 
 * @author Litkovskiy
 * @copyright 2010
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Comments extends MY_Controller
{
	public $data_arr;

	function __construct()
	{
	   parent::MY_Controller();
	   $this->data_arr['title'] = 'Комментарии';
	}
//$this->firephp->fb($this->data_arr);
	/**
	 * Creating portrets page
	 */
	public function edit_comments()
	{
	   $resultArr    = $this->comments_model->getListJoin('images');
       foreach($resultArr as $result){
             $resultList[$result['image_id']][] = $result;
       }
       $this->data_arr['result']    = $resultList;
       $this->data_arr['title']     = 'Редактировать&nbsp;&bull;&nbsp;Комментарии';
 //$this->firephp->fb($this->data_arr['result']);
       $data = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true), 
                'content' => $this->load->view('other/edit_comments', $this->data_arr, true));

	   $this->load->view('layout', $data);
	}
//---------------------------------------------------------------
    public function edit_comments_ajax()
	{
        $data['text'] = iconv("UTF-8", "windows-1251//IGNORE", $_POST['text']);
        $id = $_POST['id'];
        $result['success'] = $this->comments_model->update($id, $data) ? 'true' : 'false';
        print json_encode($result);
	}
 //---------------------------------------------------------------
    public function delite_comments_ajax()
	{
        $id = $_POST['id'];
        $result['success'] = $this->comments_model->del($id) ? 'true' : 'false';
        print json_encode($result);
	}
//---------------------------------------------------------------	
	/**
     * Check validation of data cinemaplacards_page and do update
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
                
                if(isset($_POST['part_name'])){
                    $data['id_category'] = $_POST['id'];
                    $this ->_update($data, $_POST['part_name']);
                } else {
                    $data['id'] = $_POST['id'];
                    $this ->painting_model->update($_POST['id'], $data);
                    redirect(base_url().'painting/edit_other_text/'.$_POST['cat_name']);
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
	 * update the text about placards or images information
     * 
     * @param array $data
     * @param string name of table
	 */
	private function _update($data, $part, $table=null)
	{
	   $id_category = $data['id_category'];
	   if($table)
       {
            ($this->painting_model->updateInTable($_POST['id'], $data, $table)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
       }
       else
       {
            //update text
            unset($data['id_category']);
            ($this->painting_model->update($_POST['id'], $data)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
       }
        $this->data_arr['result'] = $this->painting_model->getArrWhere('images',array('id_category' => $id_category), null, null, 'number');
		$this->data_arr['part']   = $part;
        $data_arr = array(
	        'menu'    => $this->load->view(MENU_ADMIN,'',true),
	        'content' => $this->load->view('painting/edit_list', $this->data_arr, true),
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
    	    $this->data_arr['title'] = 'Удалить '.translate_painting($part);
            $this->data_arr['part']  = $part;
            if(!$id)
    		{
    		    $resultArr                = $this->painting_model->getArrWhere('category',array('part_name' => $part), null, null);
                $this->data_arr['result'] = $this->painting_model->getArrWhere('images',array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data = array(
                   'menu'    => $this->load->view(MENU_ADMIN, '', true),
                   'content' => $this->load->view('painting/del_list', $this->data_arr, true)
                  );
                  
                $this ->load->view('layout_admin', $data);
    		}
    		else
            {
                $img_path = $this->painting_model->getArrWhere('images', array('id' => $id), null, null);
                $del_done = $this->painting_model->delFromTable($id, 'images') ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
                $del_done ? unlink('img/'.$img_path[0]['img_path']) : false;
                
                $resultArr                = $this->painting_model->getArrWhere('category',array('part_name' => $part), null, null);
                $this->data_arr['result'] = $this->painting_model->getArrWhere('images',array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('painting/del_list', $this->data_arr, true),
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
