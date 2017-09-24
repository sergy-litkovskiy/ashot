<?php

/**
 * @author Litkovsky
 * @copyright 2010
 * 
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Comments_model extends Crud
{
	
	var $table = 'comments';
	var $idkey = 'id';
	
	function __construct()
    {
        parent::Model();
    }
    
    
	public function getListJoin($table)
	{
	   $this -> db -> select($this->table.'.*');
       $this -> db -> select($table.'.img_path');
       $this -> db -> from($this->table);
	   $this -> db -> join($table, $this->table.'.image_id = '.$table.'.id', 'left');
       //$this -> db -> where($this->table.'.image_id', $table.'.id');

	   $query = $this -> db -> get();
	   return $query -> result_array();
	}
    
    public function getComments($image_id)
	{
	      $query = $this->db->query("SELECT 
                                        comments.*
                                    FROM
                                        comments
                                    WHERE
                                        comments.image_id = ".$image_id."
                                    AND
                                        comments.status = 'on'
                                    ORDER by
                                        comments.date DESC, comments.time DESC");

        return $query->result_array();
        
    }
}