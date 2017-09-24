<h2><?php echo $title;?></h2>
<?php echo @$message;?>
<p style="color: #FF0000;"><b><?php echo validation_errors(); ?></b></p>

    <?php foreach($result as $key => $comment):?>
    <table class="comment_table">
        <tr>
            <td>
                <img style="float: left; width:80px" src="<?php echo  base_url();?>img/<?php echo  $comment[0]['img_path'];?>"/>
            </td>
            <td>
            <table class="comment_edit">
                <?php foreach($comment as $comment_item):?>
                    <tr>
                        <td>
                            <p><b><?php echo  $comment_item['author'];?></b></p>
                            <p class="text" id="<?php echo  $comment_item['id'];?>"><?php echo  $comment_item['text'];?></p>
                            	<form action="#" class="form_comment_edit_<?php echo  $comment_item['id'];?>" style="display: none; width:285px" method="post" enctype="multipart/form-data">
                                    <textarea style='border: 1px solid #C0C0C0; width:285px' rows="5" id='text' name='text'></textarea>
                                    <input class="form_comment_edit" type='submit' value='Сохранить'/>
                                </form>
                        </td>
                        <td style="width: 55px; vertical-align: middle; padding: 0em 0.5em;">
                            <a class="edit_comment" id="<?php echo  $comment_item['id'];?>" href="#"><img src="<?php echo  base_url();?>img/img_main/pencil.png"/></a>
                            <a class="delite_comment" id="<?php echo  $comment_item['id'];?>" href="#"><img src="<?php echo  base_url();?>img/img_main/cross.png"/></a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
            </td>
        </tr>
        <!--
<tr style="height: 15px;">&nbsp;</tr>
-->
        </table>
    <?php endforeach;?>