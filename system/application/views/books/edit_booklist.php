<h2><?php echo $title;?></h2>
<?php echo @$message;?>
    <ul>
        <?php foreach($result as $list):?>
        <li style="list-style: none; line-height:2em">
            Редактировать информацию о книге&nbsp;&rarr;&nbsp;<a href="<?php echo base_url();?>books/edit_booklist/<?php echo $list['id'];?>"><?php echo $list['title'];?></a>
        </li>
        <?php endforeach;?>	
    </ul>	