<?php
/**
 * @author Litkovskiy
 * @copyright 2010
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends MY_Controller 
    {
    
    public function __construct()
	{
        parent::MY_Controller();
    }
    
	function index()
	{
       $this->data_arr['title'] = 'Àøîò Àðóòþíÿí';
       $data = array(
                  'content' => $this->load->view('index/show',$this->data_arr, true));

	   $this->load->view('layout_index', $data);
       parent::MY_Controller();
	}
	}