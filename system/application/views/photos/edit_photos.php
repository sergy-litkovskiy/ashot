<h2><?php echo $title;?></h2>
<?php echo @$message;?>
<p style="color: #FF0000;"><b><?php echo validation_errors(); ?></b></p>
<form class="add_new" action='<?php echo base_url();?>photos/check_valid/update/<?php echo $part;?>' method='post' name='add_new' enctype='multipart/form-data'>
    <table class="form_edit">
    <tr> 
        <td>
            <p><b>Загрузить изображение: </b><br/>(только если необходимо заменить старое изображение)</p>
        </td>
        <td><img style="width: 80px; float:left" src="<?php echo  base_url();?>img/<?php echo  $result[0]['img_path'];?>"/>
            <input style='border: 1px solid #C0C0C0' name='img_path' type='file' size='80' value="<?php echo set_value('img_path',$result[0]['img_path']);?>"/>
            <p style="color: #FF0000;font-size: 8pt;">Рекомендуемый размер загружаемой картинки - 800Х600 рх. Для вертикальных картинок высота 600 px.</p>
        </td>
    </tr>
    <tr>
        <td>
            <p><b>Название работы:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_name' value="<?php echo set_value('img_name',$result[0]['img_name']);?>"/>
        </td>
    </tr>

    <tr> 
        <td>
            <p><b>Дополнительный комментарий:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_comment' value="<?php echo set_value('img_comment',$result[0]['img_comment']);?>"/>
        </td>
    </tr> 
    <tr>
        <td colspan="2">   
            <p><b>Материал:</b><input style='border: 1px solid #C0C0C0;width:20%' name='img_material' value="<?php echo set_value('img_material',$result[0]['img_material']);?>"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>Размеры:</b>
                <input style='border: 1px solid #C0C0C0;width:5%' name='img_width' value="<?php echo set_value('img_width',$result[0]['width']);?>"/>&nbsp;x&nbsp;
                <input style='border: 1px solid #C0C0C0;width:5%' name='img_height' value="<?php echo set_value('img_height',$result[0]['height']);?>"/>&nbsp;см&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>Год создания&nbsp;</b><font style="color: #FF0000;font-size: 8pt;">(4 цифры)</font>:
                <input style='border: 1px solid #C0C0C0;width:10%' name='img_year' value="<?php echo set_value('img_year',$result[0]['img_year']);?>"/></p>
        </td> 
    </tr> 
    <tr>
        <td colspan="2">   
            <p><b>Статус:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name='status' value="on"<?php echo set_radio('status', 'on', $result[0]['status']=='on'?true:false);?>/>&nbsp;Опубликовано&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name='status' value="off"<?php echo set_radio('status', 'off', $result[0]['status']=='off'?true:false);?>/>&nbsp;Скрыто</p>
        </td> 
    </tr>
    </table>
        <input name="id" type="hidden" value="<?php echo set_value('id',$result[0]['id']);?>"/>
        <input name="img_path_old" type="hidden" value="<?php echo set_value('img_path_old',$result[0]['img_path']);?>"/>
        <input name="id_category" type="hidden" value="<?php echo set_value('id_category',$result[0]['id_category']);?>"/>
        <input name="number" type="hidden" value="<?php echo set_value('number',$result[0]['number']);?>"/>
        <input style='text-align:center' id='button' name='add' type='submit' value='Загрузить'/>
</form>