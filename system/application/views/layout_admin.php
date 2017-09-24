<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">

<head>
<?php echo head_htm(); ?>
<!-- подключаем редактор -->
<?php echo show_tinymce();?>
</head>

<body>
<div class="container">

<!--общий блок для левой и правой колонок-->
<div class="content_block">

<!--блок для левой и правой колонок контента-->
<div class="content_block_left">

<!--левая общая колонка для навигации и части лого-->
 <?php echo $menu ?>
</div>

<!--правая общая колонка-->
<div class="content_block_right">

<!--верхние круглые углы общей правой колонки-->
<div class="content_block_top"></div>

<!--блок для контента раздела-->
<div class="content">
 <?php echo $content ?>    
</div>    

<!--нижние круглые углы общей правой колонки-->
<div class="content_block_bot">
<p class="copyright">&copy; Copyright Ashot Arutyunyan</p>
</div>
</div>
</div>


</div>
</body>
</html>