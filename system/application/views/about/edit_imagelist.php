<h2><?php echo $title?></h2>
<?php echo @$message; ?>
    <ul>
        <?php foreach($result as $key => $list):?>
            <li class="img_edit_list">
            <div class="image_about_edit">
            <p><img class="edit_link" src="<?php echo  base_url();?>img/<?php echo  $list['img_path'];?>"/><br />
               <a href="<?php echo base_url();?>about/edit_about_image/<?php echo $list['id'];?>">
               <img src="<?php echo  base_url();?>img/img_main/pencil.png"/></a>&nbsp;
               <a href="<?php echo base_url();?>about/del_image/<?php echo $list['id'];?>">
               <img src="<?php echo  base_url();?>img/img_main/cross.png"/></a></p>
            </div>
            </li>

        <?php endforeach;?>	
    </ul>	