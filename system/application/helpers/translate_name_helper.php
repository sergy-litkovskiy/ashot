<?php

/**
 * @author Litkovskiy
 * @copyright 2010
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function __construct()
{
    $CI =& get_instance();
}

if ( ! function_exists('translate_painting'))
{
    function translate_painting($param)
    {
        $param_ru = '';
        switch ($param){
            case 'portrets': $param_ru = 'Портреты';
                break;

            case 'landscapes': $param_ru = 'Пейзаж';
                break;

            case 'still_life': $param_ru = 'Натюрморт';
                break;

            case 'sale': $param_ru = 'Выставка-продажа';
                break;

            case 'art_tehnic': $param_ru = 'Техника выполнения';
                break;

            case 'elite_gift': $param_ru = 'Элитный подарок';
                break;

            case 'smile': $param_ru = 'Улыбайтесь, господа!';
                break;
        }
        return $param_ru;
    }
}

if ( ! function_exists('translate_photo'))
{
    function translate_photos($param)
    {
        switch ($param){
            case 'kids'    : $param_ru = 'Дети';
                break;

            case 'people'  : $param_ru = 'Люди';
                break;

            case 'kiev'    : $param_ru = 'Киев';
                break;

            case 'ukraine' : $param_ru = 'Украина';
                break;

            case 'medicine': $param_ru = 'Медицина';
                break;
        }
    }
}
		
