<h2><?php echo $title?></h2>
<p style="color: #FF0000;"><b><?php echo validation_errors(); ?></b></p>
<form class="add_new" action='<?php echo base_url();?>books/check_valid/add' method='post' name='edit_news' enctype='multipart/form-data'>
    <p><b>Название:</b></p>
        <input style='border: 1px solid #C0C0C0;width:80%' name='title' value="<?php echo set_value('title');?>"/>
    <p><b>Картинка:</b></p>
    <p style="color: #FF0000;font-size: 8pt;">Заполнять поле ТОЛЬКО если необходимо заменить картинку (размер картинки - 146Х204 рх)</p>
        <input style='border: 1px solid #C0C0C0' name='img_path' type='file' size='40' value="<?php echo set_value('img_path');?>"/>
    <p><b>Текст:</b></p>
        <textarea id="full" style='border: 1px solid #C0C0C0;width:80%' name='text' cols='50' rows='8'><?php echo set_value('text');?></textarea>
        <input style='text-align:center' id='button' name='add' type='submit' value='Отправить'/>
</form>