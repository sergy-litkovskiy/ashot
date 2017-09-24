<h1><?php echo $title;?></h1>
<span id="text_total">
	<?php if(isset($result[0]['text_short'])){?>
        <p><?php echo $result[0]['text_short'];?></p>
    <?php }?>
</span>
<div class="clear">&nbsp;</div>
<ul>
    <?php foreach($result as $key => $painting):?>
    <li>
        <div class="gallery">
            <a style="float: left" href="<?php echo  base_url();?>img/<?php echo  $painting['img_path'];?>" rel="prettyPhoto[]" 
            alt="<p id='pretty'>
            
            <?php if ($painting['img_name']):?><b>Название:</b> <?php echo $painting['img_name'];?><br/><?php endif;?>
            <?php if ($painting['img_year']):?><b>Год:</b> <?php echo $painting['img_year'];?><br><?php endif;?>
            <?php if ($painting['img_material']):?><b>Материал:</b> <?php echo $painting['img_material'];?><br><?php endif;?>
            <?php if ($painting['img_size']):?><b>Размер:</b> <?php echo $painting['img_size'];?><br/><?php endif;?>
            <?php if ($painting['img_comment']):?><b>Описание:</b> <?php echo $painting['img_comment'];?><br/><?php endif;?>
            <?php if ($painting['sell_price'] > 0):?><b>Стоимость:</b> <?php echo $painting['sell_price'];?>&nbsp;$<br/><?php endif;?>
            </p>">
         
            <img style="float: left" src="<?php echo  base_url();?>img/<?php echo  $painting['img_path'];?>"/>
            </a>
            <div class="clear" style="width: 50px;">&nbsp;</div>
            <div id="<?php echo  $painting['id'];?>" class="dialog_comment_add" style="display:none;">
                <img style="float: left; width:100px" src="<?php echo base_url();?>img/<?php echo $painting['img_path'];?>"/>
                <div style="float: right; width:260px">
                     <?php foreach($painting['comments'] as $comments):?>
                        <span class="dialog_date"><i><?php echo $comments['date'].' '.$comments['time'];?></i></span>
                        <p class="dialog_comments"><?php echo '<b>'.$comments['author'].':</b> '. $comments['text'];?></p>
                    <?php endforeach;?>
                </div>
                <div class="clear">&nbsp;</div>
            	<form action="<?php echo base_url()?>painting/comment_add" method="post" enctype="multipart/form-data">
                	<table>
                    	<tr>
                    		<td style="width:80px"><p class="red">Имя:</p></td>
                    		<td><input style='border: 1px solid #C0C0C0' id="comment_name" name='comment_name' type='text' size='24' value=""/></td>
                    	</tr>
                    	<tr>
                    		<td><p class="red">Комментарий:</p></td>
                    		<td><textarea style='border: 1px solid #C0C0C0' id='comment_text' name='comment_text' cols='22'></textarea></td>
                    	</tr>
                    	<tr>
                    	<td>
                            <input type="hidden" id="id" name="id" value="<?php echo $painting['id'];?>"/>
                            <input type="hidden" id="part_name" name="part_name" value="<?php echo $painting['part_name'];?>"/>
                            <input style='text-align:center' id='button' type='submit' value='Добавить'/>
                        </td>
                        <td style="text-align: right;">
                            <input class="button_close" style='text-align:center' id='button' value='Закрыть'/>
                        </td>
                       </tr>
                	</table>
                </form>
            </div>    
        </div>
    </li>
    <?php endforeach;?>
</ul>
<div class="clear">&nbsp;</div>
<input class="order_form" style='text-align:center' id='button' type='submit' value='Заказать&nbsp;&bull;&nbsp;Купить'/>
<?php echo  @$order_form;?>