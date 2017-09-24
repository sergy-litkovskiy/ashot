<h1><?php echo $title;?></h1>
<div id="text_short_about">
        <?php echo word_limiter($result[0]['text_short'], 182);?>
</div>
<div id="text_long_about" style="display: none;">
        <?php echo $result[0]['text_short'];?>
</div>
<div class="index_block">    
    <h3>Автор с известными людьми</h3>
    <ul class="img">
     <?php foreach($result as $images){?>
        <li><a href="<?php echo base_url();?>img/<?php echo $images['img_path'];?>" rel="prettyPhoto[]"
        alt=" <p id='pretty'><?php if ($images['img_name']):?><b>Название:</b> <?php echo $images['img_name'];?><br/><?php endif;?>
        <?php if ($images['img_year']):?><b>Год:</b> <?php echo $images['img_year'];?><br><?php endif;?>
        <?php if ($images['img_comment']):?><b>Описание:</b> <?php echo $images['img_comment'];?><br/><?php endif;?></p>" >
        <img src="<?php echo base_url();?>img/<?php echo $images['img_path'];?>"/></a></li>
     <?php };?>
    </ul>
</div>

<div class="index_block" style="margin-bottom:1em">
    <h3>СМИ об авторе</h3>
    <ul class="links">
    <?php foreach($about_link as $links):?>
        <li><a href="<?php echo base_url();?>about/link/<?php echo $links['id'];?>"><b><?php echo $links['name'];?></b>&nbsp;&nbsp;<?php echo $links['source'];?></a></li>
    <?php endforeach;?>
    
    </ul>
</div>

<div class="index_block" style="width: 350px; padding-right: 0.5em">
    <h3>Контакты</h3>
      <table class="vizitka">
        <tr>
        	<td rowspan="2"><img src="<?php echo base_url();?>img/img_main/gerb_gold.png"/></td>
            <td style="vertical-align: middle;"><h2>АРУТЮНЯН &nbsp;АШОТ</h2></td>
        </tr>
        <tr>
            <td><p>художник, дизайнер, фотограф, книгоиздатель</p></td>
        </tr>
        <tr>
            <td colspan="2"><p>Моб. тел.: <?php echo $about_contact[0]['mobile_phone'];?></p></td>
        </tr>
        <tr>
            <td colspan="2"><p>E-mail: <?php echo $about_contact[0]['email'];?></p></td>
        </tr>
     </table>
</div>

<div class="index_block" style="width: 500px; padding-left: 1em;">
    <h3>Написать автору</h3>
	<!--messages/send-->
    <form class="add_new" action='<?php echo base_url();?>messages/send' method='post' name='add_new' enctype='multipart/form-data'>
    <p class="err_mess"><?php echo validation_errors(); ?></p>
    <table class="contact">
        <tr>
        	<td style="width: 60px;"><p><b>Ваше Имя:</b><lable class="error">*</lable></p></td>
        	<td><input class="total" style='width:90%' name='name' value="<?php echo set_value('name');?>"/></td>
            <td style="width: 50px;"><p><b>E-mail:</b></p></td>
        	<td><input class="total" style='width:100%' name='email' value="<?php echo set_value('email');?>"/></td>
        </tr>
        <tr>
        	<td><p><b>Сообщение:</b><lable class="error">*</lable></p></td>
        	<td colspan="3"><textarea style='width:100%' name='text' cols='50' rows='6'><?php echo set_value('text');?></textarea></td>
        </tr>
    </table>
            <input style='text-align:center; float:right; margin-right: -5.5em;' id='button' class="butt_add_mess" name='add' type='submit' value='Отправить'/>
    </form>
</div>