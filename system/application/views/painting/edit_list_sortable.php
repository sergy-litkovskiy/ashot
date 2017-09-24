<h2><?php echo $title;?></h2>
<?php echo @$message;?>
<div id="message" style="display:none"></div>
<form id="form_sortable" method='post' enctype='multipart/form-data'>
    <ul id="sortable">
        <?php foreach($result as $list):?>
            <li class="ui-state-default" id="<?php echo $list['id'];?>">
                <img src="<?php echo  base_url();?>img/<?php echo  $list['img_path'];?>"/>
            </li>

        <?php endforeach;?>	
    </ul>
    <div style="clear: both; width:800px">&nbsp;</div>
    <input style='text-align:center;' id='button' onclick="SortList('painting', '<?php echo $part;?>');" name='add' type='submit' value='Сохранить'/>	
</form>