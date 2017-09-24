<?php

/**
 * @author Litkovsky
 * @copyright 2010
 * model for object PLACARDS
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Painting_model extends Crud
{
	
	var $table = 'category';
	var $idkey = 'id';
	
	function __construct()
    {
        parent::Model();
    }
    
    /**
	 * get list of all items of part for painting (if there is not status off) and description of part from category
	 */
	public function getListJoin($part_name)
	{
	   $this -> db -> select($this->table.'.*');
       $this -> db -> select('images.*');
       $this -> db -> from($this->table);
	   $this -> db -> join('images', $this->table.".id = images.id_category AND images.status = 'on'", 'left');
       $this -> db -> where($this->table.'.part_name', $part_name);
       //$this -> db -> where('images.status', 'on');
       $this -> db -> order_by('images.number');

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
                                        comments.image_id = '".$image_id."'
                                    AND
                                        comments.status = 'on'
                                    ORDER by
                                        comments.date DESC, comments.time DESC");

        return $query->result_array();
        
    }
}