<?php

/**
 * @author Litkovsky
 * @copyright 2010
 * model for object MESSAGES
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Messages_model extends Crud
{
	var $table = 'messages';
	var $idkey = 'id';
	
	function __construct()
    {
        parent::Model();
    }
}