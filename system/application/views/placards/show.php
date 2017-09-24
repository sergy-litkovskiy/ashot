<h2><?php echo  $title;?></h2>
<span id="text_total">
<p><?php echo  $result[0]['text_short'];?></p>
</span>
<div style="clear: both; width: 500px;">&nbsp;</div>
<ul>
    <?php foreach($result as $key => $placards):?>
    <li class="img_list">
    <div style="float: left;">
        <a href="<?php echo  base_url();?>img/<?php echo  $placards['img_path'];?>" rel="prettyPhoto[]" 
        alt="<p id='pretty'><?php if ($placards['img_name']):?><b>Название:</b> <?php echo  $placards['img_name'];?><br/><?php endif;?>
        <?php if ($placards['img_year']):?><b>Год:</b> <?php echo  $placards['img_year'];?><br><?php endif;?>
        <?php if ($placards['img_material']):?><b>Материал:</b> <?php echo  $placards['img_material'];?><br><?php endif;?>
        <?php if ($placards['img_size']):?><b>Размер:</b> <?php echo  $placards['img_size'];?><br/><?php endif;?>
        <?php if ($placards['img_comment']):?><b>Описание:</b> <?php echo  $placards['img_comment'];?><br/><?php endif;?></p>"><img src="img/<?php echo  $placards['img_path'];?>"/>
        </a><br />
        </div>
    </li>
    <?php endforeach;?>
</ul>