<?php
/**
 * @author Litkovskiy
 * @copyright 2010
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Index extends MY_Controller
{
    public $data_arr;

    public function __construct()
    {
        parent::MY_Controller();
        $this->data_arr['title'] = '';
        $this->data_arr['uri']   = explode('/',$_SERVER['REQUEST_URI']);
    }

    function index()
    {
//       $this->data_arr['title'] = '???? ????????';
//       $data = array(
//                  'content' => $this->load->view('index/show',$this->data_arr, true));
//
//	   $this->load->view('layout_index', $data);
//       parent::MY_Controller();
        $this->data_arr['result'] = $this->about_model->getListJoin();
        //get list of links for current page
        $this->data_arr['about_link'] = $this->about_model->getArrWhere('about_links',array('status' => 'on'), null, null, 'id DESC');
        $this->data_arr['about_contact'] = $this->about_model->getArrWhere('contacts',array(), null, null);
        $data = array(
            'menu'    => $this->load->view(MENU, '', true),
            'content' => $this->load->view('about/show', $this->data_arr, true));

        $this->load->view('layout', $data);
    }
}