<h2><?php echo $title;?></h2>
<?php echo @$message; ?>

<form class="add_new" action='<?php echo base_url();?>about/check_valid/add' method='post' name='add_new' enctype='multipart/form-data'>
    <p><b>Название статьи:</b>
        <input style='border: 1px solid #C0C0C0;width:75%' name='name' value="<?php echo set_value('name');?>"/></p>
   <br/>
   <p><b>Источник, дата:</b></p>
        <input style='border: 1px solid #C0C0C0;width:75%' name='source' value="<?php echo set_value('source');?>"/>
    <br/>
    <p><b>Текст:</b></p>
        <textarea id="full" style='border: 1px solid #C0C0C0;width:80%' name='text' cols='50' rows='8'><?php echo set_value('text');?></textarea>
        <input style='text-align:center' id='button' name='add' type='submit' value='Загрузить'/>
</form>
