<h2><?php echo $title?></h2>
<?php echo @$message; ?>

<form class="add_new" action='<?php echo base_url();?>about/check_valid_image/add' method='post' name='add_new' enctype='multipart/form-data'>
<div id="add_img_tmpl">
    <table class="form_edit">
    <tr> 
        <td>
            <p><b>Загрузить изображение:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0' name='img_path[]' type='file' size='80' value="<?php echo set_value('img_path[]');?>"/>
            <p style="color: #FF0000;font-size: 8pt;">Ренкомендуемый размер загружаемой картинки - 800Х600 рх. Для вертикальных картинок высота 600 px.</p>
        </td>
    </tr>
    <tr>
        <td>
            <p><b>Название работы:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_name[]' value="<?php echo set_value('img_name[]');?>"/>
        </td>
    </tr>

    <tr> 
        <td>
            <p><b>Дополнительный комментарий:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_comment[]' value="<?php echo set_value('img_comment[]');?>"/>
        </td>
    </tr> 
    <tr>
        <td colspan="2">   
            <b>Год &nbsp;</b><font style="color: #FF0000;font-size: 8pt;">(4 цифры)</font>:
                <input style='border: 1px solid #C0C0C0;width:10%' name='img_year[]' value="<?php echo set_value('img_year[]');?>"/></p>
        </td> 
    </tr> 
   
    </table>
</div>
    <div class="butt_add_plus"><a href="#" id="push_me">Добавить еще форму для загрузки</a></div>
        <input style='text-align:center' id='button' name='add' type='submit' value='Загрузить'/>
</form>
