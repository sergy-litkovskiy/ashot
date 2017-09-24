<h2><?php echo $title;?></h2>
<?php echo @$message; ?>

<form class="add_new" action='<?php echo base_url();?>about/check_valid_contacts/update' method='post' name='add_new' enctype='multipart/form-data'>
    <p><b>Телефоны:</b>
        <input class="total" style='width:45%' name='mobile_phone' value="<?php echo set_value('mobile_phone', $result[0]['mobile_phone']);?>"/></p>
    <br/>
    <p><b>E-mail:</b>
        <input class="total" style='width:25%' name='email' value="<?php echo set_value('email', $result[0]['email']);?>"/></p>
        <input name="id" type="hidden" value="<?php echo set_value('id',$result[0]['id']);?>"/>
        <input style='text-align:center' id='button' name='add' type='submit' value='Загрузить'/>
</form>
