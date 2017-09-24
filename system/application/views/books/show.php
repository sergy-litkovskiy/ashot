<h2><?php echo  $title;?></h2>
<span id="text_total">
<p><?php echo  $result[0]['text_short'];?></p>
</span>
<table>
    <?php foreach($result as $key => $books):?>
    <?php $dirname = (preg_split("/[\s.\/]+/",$books['img_path']));//get dirname for every book?>
        <tr>
            <td>
                <img style="max-width: 150px;" src="img/<?php echo  $books['img_path'];?>"/>
            </td>
             <td class="img_small">
                <ul>
                    <?php if (isset($dirread[$dirname[1]])):?>
                    <?php foreach($dirread[$dirname[1]] as $img):?>
                    <li>
                        <a href="<?php echo  base_url();?>img/<?php echo  $books['cat_name'];?>/<?php echo  $dirname[1];?>/<?php echo  $img;?>" rel="prettyBook[]">
                        <img src="img/<?php echo  $books['cat_name'];?>/<?php echo  $dirname[1];?>/<?php echo  $img;?>"/>
                        </a>
                    </li>
                    <?php endforeach;?>
                    <?php endif;?>
                </ul>
            </td>
            <td>
                <h3><?php echo  $books['title'];?></h3>
                <p><?php echo  $books['text'];?></p>
            </td>
        </tr>
        <tr style="height: 20px;"></tr>
    <?php endforeach;?>
</table>