<h2><?php echo  $title;?></h2>

<p><?php echo  $result[0]['text_short'];?></p>

<div style="clear: both; width: 500px;">&nbsp;</div>
<ul>
    <?php foreach($result as $key => $photos):?>
    <li class="img_list">
    <div style="float: left;">
        <a href="<?php echo  base_url();?>img/<?php echo  $photos['img_path'];?>" rel="prettyPhoto[]" 
        alt="<p id='pretty'>
        <?php if ($photos['img_name']):?><b>Название:</b> <?php echo  $photos['img_name'];?><br/><?php endif;?>
        <?php if ($photos['img_year']):?><b>Год:</b> <?php echo  $photos['img_year'];?><br><?php endif;?>
        <?php if ($photos['img_material']):?><b>Материал:</b> <?php echo  $photos['img_material'];?><br><?php endif;?>
        <?php if ($photos['img_size']):?><b>Размер:</b> <?php echo  $photos['img_size'];?><br/><?php endif;?>
        <?php if ($photos['img_comment']):?><b>Описание:</b> <?php echo  $photos['img_comment'];?><br/><?php endif;?>
        </p>"><img src="<?php echo  base_url();?>img/<?php echo  $photos['img_path'];?>"/>
        </a><br/>
    </div>
    </li>
    <?php endforeach;?>
</ul>