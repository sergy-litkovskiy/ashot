<h2><?php echo $title;?></h2>
<?php echo @$message?>
<p style="color: #FF0000;"><b><?php echo validation_errors(); ?></b></p>
<form class="add_new" action='<?php echo base_url();?>placards/check_valid_text' method='post' name='edit_news' enctype='multipart/form-data'>
    <p><b>�����:</b></p>
        <textarea id="full" style='border: 1px solid #C0C0C0;width:80%' name='text_short' cols='50' rows='8'><?php echo set_value('text_short',$result[0]['text_short']);?></textarea>
        <input name="id" type="hidden" value="<?php echo set_value('id',$result[0]['id']);?>"/>
        <input style='text-align:center' id='button' name='edit_news' type='submit' value='���������'/>
    </div>
</form>