<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Imgloader
{

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
        $final_width_of_image = 100;

        if (preg_match('/[.](jpg)$/', $filename)) {
            $im = imagecreatefromjpeg($upload_path . $filename);
        } else if (preg_match('/[.](jpeg)$/', $filename)) {
            $im = imagecreatefromjpeg($upload_path . $filename);
        } else if (preg_match('/[.](gif)$/', $filename)) {
            $im  = imagecreatefromgif($upload_path . $filename);
            $gif = 1;
        } else if (preg_match('/[.](png)$/', $filename)) {
            $im  = imagecreatefrompng($upload_path . $filename);
            $png = 1;
        }

        $ox = imagesx($im);
        $oy = imagesy($im);

        if ($ox > $final_width_of_image) {
            $nx = $final_width_of_image;
            $ny = floor($oy * ($final_width_of_image / $ox));

            $nm = imagecreatetruecolor($nx, $ny);

            if (isset($png) || isset($gif)) {
                Profile:: setTransparency($nm, $im);
            }

            imagecopyresized($nm, $im, 0, 0, 0, 0, $nx, $ny, $ox, $oy);

            if (!isset($png) && !isset($gif)) {
                imagejpeg($nm, $upload_path . $filename);
            } elseif (isset($png)) {
                imagepng($nm, $upload_path . $filename);
            } elseif (isset($gif)) {
                imagegif($nm, $upload_path . $filename);
            }
        }
    }

//--------------------------------------------------------------------------------

    /**
     * load img
     * @param string $imgName
     * @param string $uploadPath
     * @param string $imgTmpName
     *
     * @return string $filename
     */
    public function loadImg($imgName, $uploadPath, $imgTmpName)
    {
        $imgName = iconv("windows-1251//IGNORE", "UTF-8", $imgName);

        $filename = $this->transliterateText(strtolower($imgName));

        $allowedFiletypes = array('.jpg', '.png', '.jpeg', '.gif');

        $maxFilesize = 2111111;

        $ext = substr($filename, strpos($filename, '.'), strlen($filename) - 1);

        if (!in_array(strtolower($ext), $allowedFiletypes))
            die('You try invalid file type');

        if (filesize($imgTmpName) > $maxFilesize)
            die("Your file " . $filename . " is more than 2M");

        if (!is_writable($uploadPath))
            die("You can not upload " . $filename . " to the server");

        if (!move_uploaded_file($imgTmpName, $uploadPath . $filename)) {
            die ("Sorry your file " . $filename . " was not uploaded.<br>Please, try again or ask your administrator");
        }

        return $filename;
    }

    public function transliterateText($text)
    {
        $rules = array(
            " х "=>"x",
            " Х "=>"x",
            "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d",
            "Е"=>"e", "Ё"=>"yo", "Ж"=>"zh", "З"=>"z", "И"=>"i",
            "Й"=>"j", "К"=>"k", "Л"=>"l", "М"=>"m", "Н"=>"n",
            "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t",
            "У"=>"u", "Ф"=>"f", "Х"=>"kh", "Ц"=>"ts", "Ч"=>"ch",
            "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"", "Ы"=>"y", "Ь"=>"",
            "Э"=>"e", "Ю"=>"yu", "Я"=>"ya",
            "а"=>"a", "б"=>"b",
            "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo",
            "ж"=>"zh", "з"=>"z", "и"=>"i", "й"=>"j", "к"=>"k",
            "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p",
            "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f",
            "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch",
            "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu",
            "я"=>"ya",
            " . "=>"_",
            ". "=>"_",
            " ."=>"_",
            " , "=>"_",
            ", "=>"_",
            " ,"=>"_",
            " - "=>"-",
            " _ "=>"_",
            "; "=>"_",
            ","=>"_",
            "/"=>"-",
            ":"=>"-",
            ";"=>"_",
            "–-"=>"-",
            " "=>"_",
        );

        $cyrillicData = array_keys($rules);
        $latinData = array_values($rules);

        return str_replace($cyrillicData, $latinData, $text);
    }
}