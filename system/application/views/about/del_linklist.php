<h2><?php echo $title;?></h2>
<?php echo @$message; ?>

<?php foreach($result as $key => $link):?>
    <p>Удалить&nbsp;&rarr;&nbsp;<a class="edit_link" href="#"  onclick="GotoURL('<?php echo base_url();?>about/del_link/<?php echo $link['id'];?>', 'Вы уверены, что хотите удалить ссылку?')"><?php echo $link['name'];?></a></p>
<?php endforeach;?>	
	