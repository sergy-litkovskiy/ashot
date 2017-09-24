<?php

/**
 * @author Litkovsky
 * @copyright 2010
 * model for all objects of site
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Crud extends Model {
	
	var $table = '';
	var $idkey = '';
    
	function __construct()
    {
        parent::Model();
    }
    
	/**
	 * add the item
     * 
     * @return int
	 */
	public function add($data)
	{
        $newData = $this->killMagicQuotes($data);
        $this -> db -> insert($this -> table, $newData);
        return $this -> db -> insert_id();
	}
	 
    /**
	 * add the item
     * 
     * @param int $id
     * @param array $data
     * 
     * @return int
	 */
	public function addInTable($data, $table)
	{
        $newData = $this->killMagicQuotes($data);
        $this -> db -> insert($table, $newData);
        return $this -> db -> insert_id();
	}
    
	/**
	 * edit the item
     * 
     * @return bool
	 */
	public function update($id, $data)
	{
        $newData = $this->killMagicQuotes($data);
		$this -> db -> where($this -> idkey, $id);		
		if(!$this -> db -> update($this -> table, $newData))
		{
			return false;
		}
		return true;
	}
	
    /**
	 * update the items by params
     * 
     * @param int $id
     * @param array $data
     * @param string $table
     * 
     * @return bool
	 */
	public function updateInTable($id, $data, $table)
	{
//var_dump($this->killMagicQuotes($data));
//exit;
	    $newData = $this->killMagicQuotes($data);
		$this -> db -> where($this -> idkey, $id);		
		if(!$this -> db -> update($table, $newData))
		{
			return false;
		}
		return true;
	}
	/**
	 * del the item
     * 
     * @return bool
	 */
    public function del($id)
	{
		$this -> db -> where($this -> idkey, $id);		
		if(!$this -> db -> delete($this -> table))
		{
			return false;
		}
		return true;
	}
	
    /**
	 * del from the table
     * 
     * @param int $id
     * @param string $table
     * 
     * @return bool
	 */
	public function delFromTable($id, $table)
	{
        $this -> db -> where($this -> idkey, $id);		
		if(!$this -> db -> delete($table))
		{
			return false;
		}
		return true;
	}
    
	/**
	 * get the item by id
     * 
     * @return array
	 */
	public function get($id)
	{
		$this -> db -> where($this -> idkey, $id);	
		$query = $this -> db -> get($this -> table);
		return $query -> result_array();
	}
	
	/**
	 * get list all items
     * 
     * @return array
	 */
	public function getList()
	{
		$query = $this -> db -> get($this -> table);
		return $query -> result_array();
	}
    
  
    /**
	 * get list of all items where
     * 
     * @param array $params
     * @param int   $limit
     * @param int   $offset
     * 
     * @return array
	 */
	public function getArrWhere($table, $params, $limit, $offset , $order_by = false)
	{
	    $order_by ? $this -> db -> order_by($order_by) : false;
    	$query = $this -> db -> get_where($table, $params, $limit, $offset);	
    	//$query = $this -> db -> get($this -> table);
        
    	return $query -> result_array();
	}
    
    /**
	 * get max number by id_category
     * 
     * @param string name of table
     * @param int id of category
     * 
     * @return array
	 */
	public function getMaxNumByIdCat($table, $id_category)
    {
       $this -> db -> select_max($table.'.number');
       $this -> db -> from($table);
       $this -> db -> where($table.'.id_category', $id_category);

	   $query = $this -> db -> get();
	   return $query -> result_array();
    }
    
    public function killMagicQuotes ($data)
    {
        if(is_array($data)){
            foreach($data as $key => $val){
                $newData[$key] = stripslashes($val);
                //$newData[$key] = preg_replace('\&quote;', "", $newData[$key]);  
            }    
            return $newData;
        } else {
            return stripslashes($data);
        }
    }
}