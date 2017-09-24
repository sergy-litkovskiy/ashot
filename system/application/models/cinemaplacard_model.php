<?php

/**
 * @author Litkovsky
 * @copyright 2010
 * model for object CINEMAPLACARD
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cinemaplacard_model extends Crud
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
	      $query = $this->db->query("SELECT
                                          ".$this->table.".text_short
                                        , ".$this->table.".part_name
                                        , ".$this->table.".cat_name
                                        , images.*
                                    FROM
                                        images
                                    LEFT JOIN
                                        ".$this->table."
                                    ON
                                        ".$this->table.".id = images.id_category
                                    WHERE
                                        ".$this->table.".cat_name = 'cinemaplacard'
                                    AND
                                        images.status = 'on'
                                    ORDER by
                                        images.number");

        return $query->result_array();
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