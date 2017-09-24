<h2><?php echo $title?></h2>
<?php echo @$message?>
<ul>
<?php foreach($result as $list):?>
<div style="margin-top:1em;">
<p><a style="color:red; cursor:pointer" onclick="GotoURL ('<?php echo base_url();?>books/del/<?php echo $list['id'];?>','¬ы уверены, что хотите удалить новость?');">”ƒјЋ»“№</a>&nbsp;&rarr;&nbsp;<b><?php echo $list['title'];?></b></p> 
</div>
<?php endforeach;?>	
</ul>