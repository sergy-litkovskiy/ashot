<?php
/**
 * @author Litkovsky
 * @copyright 2010
 * model for object BOOKS
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Books_model extends Crud
{
	var $table = 'books';
	var $idkey = 'id';
	
	function __construct()
    {
        parent::Model();
    }
    
    /**
	 * get list of all books (if there is not status off) and description from category
     * 
     * @return array
	 */
	public function getListJoin()
	{
	   $this ->db->select($this->table.'.*');
       $this ->db->select('category.*');
       $this ->db->from('category');
	   $this ->db->join($this->table, 'category.id = '.$this->table.'.id_category', 'left');
       $this ->db->where($this->table.'.status', 'on');
       $this ->db->order_by($this->table.'.number');

	   $query = $this->db->get();
	   return $query ->result_array();
	}
    
    /**
	 * get list of all books (if there is not status off) and description from category
     * 
     * @return array
	 */
	public function getIdCatAndMaxNum()
	{
	   $this ->db->select($this->table.'.id_category');
       $this ->db->select_max($this->table.'.number');
       $this ->db->from($this->table);
       $this ->db->group_by($this->table.'.id_category');

	   $query = $this->db->get();
	   return $query ->result_array();
	}
}