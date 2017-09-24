<h2><?php echo  $title;?></h2>
<p><?php echo  $result[0]['text_short'];?></p>
<div style="clear: both; width: 500px;">&nbsp;</div>
<ul>
    <?php foreach($result as $key => $restaurant):?>
    <li class="img_list">
    <div style="float: left;">
        <a href="<?php echo  base_url();?>img/<?php echo  $restaurant['img_path'];?>" rel="prettyPhoto[]" 
        alt="<p id='pretty'><?php if ($restaurant['img_name']):?><b>Название:</b> <?php echo  $restaurant['img_name'];?><br/><?php endif;?>
        <?php if ($restaurant['img_year']):?><b>Год:</b> <?php echo  $restaurant['img_year'];?><br><?php endif;?>
        <?php if ($restaurant['img_material']):?><b>Материал:</b> <?php echo  $restaurant['img_material'];?><br><?php endif;?>
        <?php if ($restaurant['img_size']):?><b>Размер:</b> <?php echo  $restaurant['img_size'];?><br/><?php endif;?>
        <?php if ($restaurant['img_comment']):?><b>Описание:</b> <?php echo  $restaurant['img_comment'];?><br/><?php endif;?></p>"><img src="<?php echo  base_url();?>img/<?php echo  $restaurant['img_path'];?>"/>
        </a><br />
         </div>
    </li>
    <?php endforeach;?>
</ul>