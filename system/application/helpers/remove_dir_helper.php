<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
    function RemoveDir($path)
    {
    	if(file_exists($path) && is_dir($path))
    	{
    		$dirHandle = opendir($path);
    		while (false !== ($file = readdir($dirHandle))) 
    		{
    			if ($file!='.' && $file!='..')// исключаем папки с назварием '.' и '..' 
    			{
    				$tmpPath=$path.'/'.$file;
    				chmod($tmpPath, 0777);
    				
    				if (is_dir($tmpPath))
    	  			{  // если папка
    					RemoveDir($tmpPath);
    			   	} 
    	  			else 
    	  			{ 
    	  				if(file_exists($tmpPath))
    					{
    						// удаляем файл 
    	  					unlink($tmpPath);
    					}
    	  			}
    			}
    		}
    		closedir($dirHandle);
    		
    		// удаляем текущую папку
    		if(file_exists($path))
    		{
    			rmdir($path);
    		}
            return true;
    	}
    	else
    	{
    		return false;
    	}
    }

?>