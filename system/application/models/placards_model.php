<?php

/**
 * @author Litkovsky
 * @copyright 2010
 * model for object PLACARDS
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Placards_model extends Crud
{
	
	var $table = 'category';
	var $idkey = 'id';
	
	function __construct()
    {
        parent::Model();
    }
    
   /**
	 * get list of category and list of all imgages (if there is not status off) and description from category
	 */
	public function getListJoin()
	{
	   $this -> db -> select($this->table.'.*');
       $this -> db -> select('images.*');
       $this -> db -> from($this->table);
	   $this -> db -> join('images', $this->table.'.id = images.id_category', 'left');
       $this -> db -> where($this->table.'.cat_name', 'placards');
       $this -> db -> where('images.status', 'on');
       $this -> db -> order_by('images.number');

	   $query = $this -> db -> get();
	   return $query -> result_array();
	}
    
    public function getCountComments($id)
	{
	      $query = $this->db->query("SELECT 
                                        comments.*
                                    FROM
                                        comments
                                    WHERE
                                        comments.id = ".$id."
                                    AND
                                        comments.status = 'on'
                                    ORDER by
                                        comments.date DESC, comments.time DESC");

        return $query->result_array();
        
    }
}