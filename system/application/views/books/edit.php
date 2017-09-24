<h2><?php echo $title;?></h2>
<?php echo @$message;?>
<p style="color: #FF0000;"><b><?php echo validation_errors(); ?></b></p>
<form class="add_new" action='<?php echo base_url();?>books/check_valid/update' method='post' name='edit_news' enctype='multipart/form-data'>
    <p><b>Название:</b></p>
        <input style='border: 1px solid #C0C0C0;width:80%' name='title' value="<?php echo set_value('text',$result[0]['title']);?>"/>
    <br/><br/>
    <p><b>Картинка:</b></p>
    <p style="color: #FF0000;font-size: 8pt;">Заполнять поле ТОЛЬКО если необходимо заменить картинку (размер картинки - 146Х204 рх)</p>
        <input style='border: 1px solid #C0C0C0' name='img_path' type='file' size='40' value="<?php echo set_value('img_path',$result[0]['img_path']);?>"/>
    <img style="width: 80px;float:left" src="<?php echo set_value('img_path','/ashot.kiev.ua/img/'.$result[0]['img_path']);?>"/>
    <div style="float: left; margin-top: 1em;">
    <p><b>Текст:</b></p>
        <textarea id="full" style='border: 1px solid #C0C0C0;width:80%' name='text' cols='50' rows='8'><?php echo set_value('text',$result[0]['text']);?></textarea>
        <input name="id" type="hidden" value="<?php echo set_value('id',$result[0]['id']);?>"/>
        <input name="status" type="hidden" value="<?php echo set_value('status',$result[0]['status']);?>"/>
        <input style='text-align:center' id='button' name='edit_news' type='submit' value='Отправить'/>
    </div>
</form>