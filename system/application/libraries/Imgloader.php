<?php

/**
 * @author Litkovskiy
 * @copyright 2010
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Imgloader {
	
    /**
	 * set transparency
     * 
     * @param string $new_image
     * @param string $image_source
	 */
	
	public function setTransparency($new_image, $image_source)
        {
	        $transparencyIndex = imagecolortransparent($image_source);
	        
	        $transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);
	       
	        if ($transparencyIndex >= 0)
	        
	            $transparencyColor = imagecolorsforindex($image_source, $transparencyIndex);   
	       
	        $transparencyIndex = imagecolorallocate($new_image, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']);
	        
	        imagefill($new_image, 0, 0, $transparencyIndex);
	        
	        imagecolortransparent($new_image, $transparencyIndex);
        }

//--------------------------------------------------------------------------------		
    /**
	 * set new size img
     * 
     * @param string $filename
     * @param string $upload_path
	 */
	public function setNewSize($filename, $upload_path)
		{
			       /*������������� ����� ������, �� ������� ����� ��������*/
					$final_width_of_image = 100;
					
		            /*���������� ������ ������������ �����������*/
					if(preg_match('/[.](jpg)$/', $filename)) {
					  $im = imagecreatefromjpeg($upload_path . $filename);
					  } 
					  else if (preg_match('/[.](jpeg)$/', $filename)) {
					  $im = imagecreatefromjpeg($upload_path . $filename);
					  } 
					  else if (preg_match('/[.](gif)$/', $filename)) {
					  $im = imagecreatefromgif($upload_path . $filename);
					  $gif = 1;
					  } 
					  else if (preg_match('/[.](png)$/', $filename)) {
					  $im = imagecreatefrompng($upload_path . $filename);
					  $png = 1;
					  } 
					  
					  $ox = imagesx($im);
					  $oy = imagesy($im);
					  
					  /*���� ������ ����������� �������� ������ ����������� - ��������� �� ����������� � ��������������*/
					  if($ox > $final_width_of_image)
					  {
						  $nx = $final_width_of_image;
						  $ny = floor($oy * ($final_width_of_image / $ox));
						  
						  $nm = imagecreatetruecolor($nx, $ny);
						  
						  /*���� �������� png ��� gif*/
						  if(isset($png) || isset($gif))
						  {
						    Profile:: setTransparency($nm,$im);
						  }

             			  imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
						  
						  /*���� �������� jpg*/
						  if(!isset($png) && !isset($gif))
						  {
						    imagejpeg($nm, $upload_path . $filename);
						  }
						  elseif(isset($png))
						  {
						  	imagepng($nm, $upload_path . $filename);
						  }
						  elseif(isset($gif))
						  {
						  	imagegif($nm, $upload_path . $filename);
						  }
					    }    
		}

//--------------------------------------------------------------------------------
    /**
	 * load img
     * @param array $img_arr array of file property
     * @param string $upload_path
     * @param array $img_arr_tmp array of tmp file property
     * 
     * @return string $filename
	 */
		public function loadImg($img_arr, $upload_path, $img_arr_tmp)
		{
            $filename = strtolower($img_arr);
		
    		$allowed_filetypes = array('.jpg','.png','.jpeg','.gif'); 
    
    		$max_filesize = 2111111; 
    									
    		$ext = substr($filename, strpos($filename,'.'), strlen($filename)-1); 
    		
    		if(!in_array($ext,$allowed_filetypes))
    		die('������ ��� ����� �� ��������������.');
    		
    		if($img_arr_tmp > $max_filesize)
    		die("���� ".$filename." ������� �������");
    		
    		if(!is_writable($upload_path))
    		die("���������� ��������� ���� ".$filename." �� ������");
    
    		/* ��������� ���� � ��������� �����*/
    		if(!move_uploaded_file($img_arr_tmp, $upload_path.$filename))
    		{
    		die ("� ���������, ��� ���� ".$filename." �� ��� �������� �� ������.<br>���������� ��������� � ��������� ������� ��� ���������� � �������������� �����");
    		}
            
            return $filename;
     }
}