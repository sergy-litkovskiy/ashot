<h2><?php echo $title?></h2>
<?php echo @$message; ?>

<form class="add_new" action='<?php echo base_url();?>about/check_valid/update' method='post' name='add_new' enctype='multipart/form-data'>
    <p><b>Название статьи:</b>
        <input style='border: 1px solid #C0C0C0;width:75%' name='name' value="<?php echo set_value('name', $result[0]['name']);?>"/></p>
    <br/>
    <p><b>Источник, дата:</b>
        <input style='border: 1px solid #C0C0C0;width:75%' name='source' value="<?php echo set_value('source', $result[0]['source']);?>"/></p>
        <br/>
    <p><b>Текст:</b></p>
        <textarea id="full" style='border: 1px solid #C0C0C0;width:80%' name='text' cols='50' rows='8'><?php echo set_value('text',$result[0]['text']);?></textarea>
        <br />
        <p><b>Статус:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name='status' value="on"<?php echo set_radio('status', 'on', $result[0]['status']=='on'?true:false);?>/>&nbsp;Опубликовано&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name='status' value="off"<?php echo set_radio('status', 'off', $result[0]['status']=='off'?true:false);?>/>&nbsp;Скрыто</p>
        <input name="id" type="hidden" value="<?php echo set_value('id',$result[0]['id']);?>"/>
        <input style='text-align:center' id='button' name='add' type='submit' value='Загрузить'/>
</form>
