<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exhibition extends MY_Controller
{
    public $data_arr;

    function __construct()
    {
        parent::MY_Controller();
        $this->data_arr['title'] = 'Выставка';
    }

//$this->firephp->fb($this->data_arr);

    public function smile()
    {
        $this->data_arr['result'] = $this->exhibition_model->getListJoin('smile');
        foreach ($this->data_arr['result'] as $key => $arr) {
            $comments                                        = $this->exhibition_model->getComments($arr['id']);
            $this->data_arr['result'][$key]['comments']      = $comments;
            $this->data_arr['result'][$key]['count_comment'] = count($comments);
        }

        $this->data_arr['title']      = 'Выставка&nbsp;&bull;&nbsp;Улыбайтесь, господа!';
        $this->data_arr['order_form'] = $this->load->view('other/order_form', '', true);

        $data = array(
            'menu'    => $this->load->view(MENU, '', true),
            'content' => $this->load->view('exhibition/show', $this->data_arr, true));

        $this->load->view('layout', $data);
    }


    public function ajax_sortable()
    {
        $arrData = $_POST['ids'];

        foreach ($arrData as $number => $id) {
            $result = $this->photos_model->updateInTable($id, array('number' => $number + 1), 'images') ? MESS_SUCCES : MESS_ERROR;
        }
        print $result;
        exit;

    }


    public function order_add()
    {
        $data['customer_name']  = iconv("UTF-8", "windows-1251//IGNORE", $_POST['customer_name']);
        $data['customer_email'] = iconv("UTF-8", "windows-1251//IGNORE", $_POST['customer_email']);
        $data['customer_phone'] = iconv("UTF-8", "windows-1251//IGNORE", $_POST['customer_phone']);
        $data['text']           = iconv("UTF-8", "windows-1251//IGNORE", $_POST['text']);
        $data['date']           = date('Y-m-d');
        $data['time']           = date('H:i:s');

        if ($this->exhibition_model->addInTable($data, 'order')) {
            $dataArr['name_sender']  = $data['customer_name'];
            $dataArr['text']         = $data['text'];
            $dataArr['email_sender'] = $data['customer_email'];
            $dataArr['date']         = $data['date'];
            $dataArr['phone']        = $data['customer_phone'];
            $this->sendMailMess($dataArr);
            print 'add_true';
        } else {
            print 'add_false';
        }

        exit;

    }


    public function add($part)
    {
        if ($this->session->userdata('username')) {
            $this->data_arr['part'] = $part;
            $data_arr               = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true),
                'content' => $this->load->view('exhibition/new', $this->data_arr, true),
                'title'   => $this->data_arr['title']
            );

            $this->load->view('layout_admin', $data_arr);
        } else {
            $this->login_model->logOut();
        }
    }


    public function edit_text($param)
    {
        if ($this->session->userdata('username')) {
            $param_ru                 = translate_painting($param);
            $this->data_arr['result'] = $this->exhibition_model->getArrWhere('category', array('cat_name' => 'exhibition', 'part_name' => $param), null, null);

            $this->data_arr['title']  = $param_ru;
            $data                     = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true),
                'content' => $this->load->view('exhibition/edit_text', $this->data_arr, true),
                'title'   => $param_ru
            );
            $this->load->view('layout_admin', $data);
        } else {
            $this->login_model->logOut();
        }
    }


    public function edit($part, $id = false)
    {
        if ($this->session->userdata('username')) {
            $this->data_arr['title'] = 'Редактировать ' . translate_painting($part);
            $this->data_arr['part']  = $part;
            if (!$id) {
                $resultArr                = $this->exhibition_model->getArrWhere('category', array('part_name' => $part), null, null);
                $this->data_arr['result'] = $this->exhibition_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data                     = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('exhibition/edit_list', $this->data_arr, true)
                );

                $this->load->view('layout_admin', $data);
            } else {
                $result = $this->exhibition_model->getArrWhere('images', array('id' => $id), null, null);

                $this->data_arr['result'] = isset($result[0]) ? $result[0] : array();
                $this->_makeWidthAndHeight();

                $data = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('exhibition/edit_exhibition', $this->data_arr, true)
                );
                $this->load->view('layout_admin', $data);
            }
        } else {
            $this->login_model->logOut();
        }
    }


    private function _makeWidthAndHeight()
    {
        if (!empty($this->data_arr['result']['img_size']) && $this->data_arr['result']['img_size'] !== '') {
            list($this->data_arr['result']['width'], $this->data_arr['result']['height']) = explode('x', $this->data_arr['result']['img_size']);
        } else {
            $this->data_arr['result']['width']  = '';
            $this->data_arr['result']['height'] = '';
        }
    }


    public function check_valid_text()
    {
        if ($this->session->userdata('username')) {
            $rules = array(
                array(
                    'field' => 'text_short',
                    'label' => '<Короткий текст>',
                    'rules' => 'required')
            );

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() === false) {
                //back to edit page with id
                $this->edit_text($_POST['id']);
            } else {
                $data['text_short'] = $_POST['text_short'];

                if (isset($_POST['part_name'])) {
                    $data['id_category'] = $_POST['id'];
                    $this->_update($data, $_POST['part_name']);
                } else {
                    $data['id'] = $_POST['id'];
                    $this->exhibition_model->update($_POST['id'], $data);
                    redirect(base_url() . 'exhibition/edit_other_text/' . $_POST['cat_name']);
                }
            }
        } else {
            $this->login_model->logOut();
        }
    }


    public function check_valid($action, $part = null)
    {
        if ($this->session->userdata('username')) {
            $countArr = 0;
            $count    = 0;
            if ($_FILES['img_path']['name'] !== '') {
                $countArr = count($_FILES['img_path']['name']);
                for ($i = 0; $i <= $countArr; $i++) {
                    !empty($_FILES['img_path']['name'][$i]) ? $count++ : null;
                }
            }
            if ($action == 'add') {
                $category_arr = $this->exhibition_model->getArrWhere('category', array('part_name' => $part), null, null);
                //if add new placards and any files was not attached - reload add form whith massage error
                if ($count < 1) {
                    $this->data_arr['message'] = "<h2 class='mess_bad'>ВНИМАНИЕ! Вы не выбрали файл для загрузки. Попробуйте еще раз.";
                    $data                      = array(
                        'menu'    => $this->load->view(MENU_ADMIN, '', true),
                        'content' => $this->load->view('exhibition/new', $this->data_arr, true)
                    );
                    $this->load->view('layout_admin', $data);
                } //if array of file fields of form was not empty
                elseif ($count > 0) {
                    $count_false = 0; //counter for error insert action
                    for ($k = 0; $k <= $countArr; $k++) {
                        //if a file field of form was not empty - load the file
                        if (!empty($_FILES['img_path']['name'][$k])) {
                            $upload_path = "img/" . $part . "/";
                            $img_arr     = array();
                            $img_arr     = $_FILES['img_path']['name'][$k];
                            $img_arr_tmp = $_FILES['img_path']['tmp_name'][$k];
                            //if image was successfully loaded into server - to create array of data  for insert to DB
                            if ($filename = $this->imgloader->loadImg($img_arr, $upload_path, $img_arr_tmp)) {
                                $max_number = $this->exhibition_model->getMaxNumByIdCat('images', $category_arr[0]['id']);

                                $data ['id_category']  = $category_arr[0]['id'];
                                $data ['number']       = $max_number[0]['number'] + 1;
                                $data ['img_path']     = $part . "/" . $filename;
                                $data ['img_name']     = $_REQUEST['img_name'][$k];
                                $data ['img_year']     = $_REQUEST['img_year'][$k];
                                $data ['img_material'] = $_REQUEST['img_material'][$k];
                                $data ['img_size']     = $_REQUEST['img_width'][$k] . 'x' . $_REQUEST['img_height'][$k];
                                $data ['img_comment']  = $_REQUEST['img_comment'][$k];
                                $data ['sell_price']   = $_REQUEST['sell_price'][$k];
                                $data ['status']       = 'on';

                                $this->_add($data, 'images', true) ? $this->data_arr['message'] = MESS_SUCCES : $count_false++;
                            }
                        }
                    }
                    if ($count_false > 0) {
                        $this->data_arr['message'] = "<h2 class='mess_bad'>Некоторые из файлов НЕ были загружены! Пожалуйста, проверьте, какие файлы не загрузились, и повторите попытку.</h2>";
                    }

                    $resultArr                = $this->exhibition_model->getArrWhere('category', array('part_name' => $part), null, null);
                    $this->data_arr['result'] = $this->exhibition_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
                    $this->data_arr['part']   = $part;
                    $data                     = array(
                        'menu'    => $this->load->view(MENU_ADMIN, '', true),
                        'content' => $this->load->view('exhibition/edit_list', $this->data_arr, true),
                        'title'   => $this->data_arr['title']
                    );

                    $this->load->view('layout_admin', $data);
                }
            }

            if ($action == 'update') {
                $data ['id_category']  = $_REQUEST['id_category'];
                $data ['number']       = $_REQUEST['number'];
                $data ['img_name']     = $_REQUEST['img_name'];
                $data ['img_year']     = $_REQUEST['img_year'];
                $data ['img_material'] = $_REQUEST['img_material'];
                $data ['img_size']     = $_REQUEST['img_width'] . 'x' . $_REQUEST['img_height'];
                $data ['img_comment']  = $_REQUEST['img_comment'];
                $data ['sell_price']   = $_REQUEST['sell_price'];
                $data ['status']       = $_REQUEST['status'];
                //if update the placards and new file was not attached - to update only text fields
                if ($count < 1) {
                    $this->_update($data, $part, 'images');
                } //if file field of form was not empty
                elseif ($count > 0) {
                    $upload_path = "img/" . $part . "/";
                    $img_arr     = array();
                    $img_arr     = $_FILES['img_path']['name'];
                    $img_arr_tmp = $_FILES['img_path']['tmp_name'];
                    //if image was successfully loaded into server - to create array of data  for insert to DB
                    if (unlink('img/' . $_REQUEST['img_path_old'])) {
                        if ($filename = $this->imgloader->loadImg($img_arr, $upload_path, $img_arr_tmp)) {
                            $data ['img_path'] = $part . "/" . $filename;
                            $this->_update($data, $part, 'images');
                        }
                    }
                }
            }
        } else {
            $this->login_model->logOut();
        }
    }


    public function sort_list($part)
    {
        if ($this->session->userdata('username')) {
            $this->data_arr['title']  = 'Сортировать '. translate_photos($part);
            $this->data_arr['part']   = $part;
            $resultArr                = $this->photos_model->getArrWhere('category', array('part_name' => $part), null, null);
            $this->data_arr['result'] = $this->photos_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
            $data                     = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true),
                'content' => $this->load->view('exhibition/edit_list_sortable', $this->data_arr, true)
            );

            $this->load->view('layout_admin', $data);
        } else {
            $this->login_model->logOut();
        }
    }


    private function _add($data, $table, $plural = false)
    {
        if ($plural) {
            return $this->exhibition_model->addInTable($data, $table) ? true : false;
        } else {
            ($this->exhibition_model->addInTable($data, $table)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;

            $this->data_arr['result'] = $this->exhibition_model->getArrWhere('images', array('id_category' => $data['id_category']), null, null, 'number');
            $part                     = explode('/', $data['img_path']);
            $this->data_arr['part']   = $part[0];
            $data                     = array(
                'menu'    => $this->load->view(MENU_ADMIN, '', true),
                'content' => $this->load->view('exhibition/edit_list', $this->data_arr, true),
                'title'   => $this->data_arr['title']
            );

            $this->load->view('layout_admin', $data);
        }
    }


    private function _update($data, $part, $table = null)
    {
        $id_category = $data['id_category'];
        if ($table) {
            $this->data_arr['message'] = $this->exhibition_model->updateInTable($_POST['id'], $data, $table) ? MESS_SUCCES : MESS_ERROR;
        } else {
            //update text
            unset($data['id_category']);
            ($this->exhibition_model->update($_POST['id'], $data)) ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
        }
        $this->data_arr['result'] = $this->exhibition_model->getArrWhere('images', array('id_category' => $id_category), null, null, 'number');
        $this->data_arr['part']   = $part;
        $data_arr                 = array(
            'menu'    => $this->load->view(MENU_ADMIN, '', true),
            'content' => $this->load->view('exhibition/edit_list', $this->data_arr, true),
            'title'   => $this->data_arr['title']
        );

        $this->load->view('layout_admin', $data_arr);
    }


    public function del($part, $id = false)
    {
        if ($this->session->userdata('username')) {
            $this->data_arr['title'] = 'РЈРґР°Р»РёС‚СЊ ' . translate_painting($part);
            $this->data_arr['part']  = $part;
            if (!$id) {
                $resultArr                = $this->exhibition_model->getArrWhere('category', array('part_name' => $part), null, null);
                $this->data_arr['result'] = $this->exhibition_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data                     = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('exhibition/del_list', $this->data_arr, true)
                );

                $this->load->view('layout_admin', $data);
            } else {
                $img_path = $this->exhibition_model->getArrWhere('images', array('id' => $id), null, null);
                $del_done = $this->exhibition_model->delFromTable($id, 'images') ? $this->data_arr['message'] = MESS_SUCCES : $this->data_arr['message'] = MESS_ERROR;
                $del_done ? unlink('img/' . $img_path[0]['img_path']) : false;

                $resultArr                = $this->exhibition_model->getArrWhere('category', array('part_name' => $part), null, null);
                $this->data_arr['result'] = $this->exhibition_model->getArrWhere('images', array('id_category' => $resultArr[0]['id']), null, null, 'number');
                $data                     = array(
                    'menu'    => $this->load->view(MENU_ADMIN, '', true),
                    'content' => $this->load->view('exhibition/del_list', $this->data_arr, true),
                    'title'   => $this->data_arr['title']
                );
                $this->load->view('layout_admin', $data);
            }
        } else {
            $this->login_model->logOut();
        }
    }


    public function comment_add()
    {
        $rules = array(
            array(
                'field' => 'comment_name',
                'label' => '<Имя>',
                'rules' => 'trim|required')
        , array(
                'field' => 'comment_text',
                'label' => '<Текст комментария>',
                'rules' => 'trim|required')
        );

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() !== false) {
            $data['author']   = htmlspecialchars(strip_tags($_POST['comment_name']));
            $data['text']     = htmlspecialchars(strip_tags($_POST['comment_text']));
            $data['date']     = date('Y-m-d');
            $data['time']     = date('H:i:s');
            $data['status']   = 'on';
            $data['image_id'] = $_POST['id'];
            $this->_add_comment($data);
        }
        redirect(base_url() . 'exhibition/' . $_POST['part_name']);
    }


    private function _add_comment($data)
    {
        $this->exhibition_model->addInTable($data, 'comments');
    }
}
