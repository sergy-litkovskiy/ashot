<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">

<head>
<?php echo head_htm(); ?>
<!-- ���������� �������� -->
<?php echo show_tinymce();?>
</head>

<body>
<div class="container">

<!--����� ���� ��� ����� � ������ �������-->
<div class="content_block">

<!--���� ��� ����� � ������ ������� ��������-->
<div class="content_block_left">

<!--����� ����� ������� ��� ��������� � ����� ����-->
 <?php echo $menu ?>
</div>

<!--������ ����� �������-->
<div class="content_block_right">

<!--������� ������� ���� ����� ������ �������-->
<div class="content_block_top"></div>

<!--���� ��� �������� �������-->
<div class="content">
 <?php echo $content ?>    
</div>    

<!--������ ������� ���� ����� ������ �������-->
<div class="content_block_bot">
<p class="copyright">&copy; Copyright Ashot Arutyunyan</p>
</div>
</div>
</div>


</div>
</body>
</html>