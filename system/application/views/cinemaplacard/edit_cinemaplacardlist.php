<h2><?php echo $title;?></h2>
<?php echo @$message?>
        <table>
        <?php foreach($result as $key => $list):?>
        <?php if(($key+1)%2):?>
            <tr class="img_edit_list">
            <?php endif;?>
                <td class="left">
                    <div style="clear: both;">
                        <a class="edit_link" href="<?php echo base_url();?>cinemaplacard/edit_cinemaplacard/<?php echo $list['id'];?>">
                            <img src="<?php echo  base_url();?>img/<?php echo  $list['img_path'];?>"/>
                        </a>
                    </div>
                    <div style="float: left; width: 150px;">
                        <a class="edit_link" href="<?php echo base_url();?>cinemaplacard/edit_cinemaplacard/<?php echo $list['id'];?>">
                            Редактировать
                        </a>
                    </div>
                </td>
                <td class="right">
                    <p><?php echo  $list['img_name'];?></p>
                    <p><?php echo  $list['img_year'];?></p>
                    <p><?php echo  $list['img_material'];?></p>
                    <p><?php echo  $list['img_size'];?></p>
                    <p><?php echo  $list['img_comment'];?></p>
                    <p><?php echo  $list['sell_price'];?>&nbsp;$</p>
                </td>
                <td class="middle">&nbsp;</td>
            <?php if(!($key+1)%2):?>
            </tr>
            <?php endif;?>
      
        <?php endforeach;?>	
</table>	