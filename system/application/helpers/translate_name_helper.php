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
            case 'portrets': $param_ru = '��������';
                break;

            case 'landscapes': $param_ru = '������';
                break;

            case 'still_life': $param_ru = '���������';
                break;

            case 'sale': $param_ru = '��������-�������';
                break;

            case 'art_tehnic': $param_ru = '������� ����������';
                break;

            case 'elite_gift': $param_ru = '������� �������';
                break;

            case 'smile': $param_ru = '����������, �������!';
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
            case 'kids'    : $param_ru = '����';
                break;

            case 'people'  : $param_ru = '����';
                break;

            case 'kiev'    : $param_ru = '����';
                break;

            case 'ukraine' : $param_ru = '�������';
                break;

            case 'medicine': $param_ru = '��������';
                break;
        }
    }
}
		
