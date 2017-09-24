<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">

<head>
<script language="javascript">
	var agent = navigator.appName;
	if (agent.indexOf("Netscape") != -1)
	{
		document.write("<link rel='stylesheet' href='<?php echo base_url();?>css/style_moz.css' type='text/css'/>")
	}
    if (agent.indexOf("Opera") != -1)
	{
		document.write("<link rel='stylesheet' href='<?php echo base_url();?>css/style_opera.css' type='text/css'/>")
	}
</script>

<!--[if IE 5]>
<p><font style="color:#FF0000"><b>ВНИМАНИЕ!</b></font><br>У Вас устаревшая версия Internet Explorer.<br> Для корректного отображения страниц сайта просим пользоваться версией не ниже Internet Explorer7! <br><font style="color:#FF0000"><b>Для большего удобства предлагаем использовать браузер <a href='http://www.opera.com/download/'>OPERA</a> или <a href='http://ru.www.mozilla.com'>Mozilla FireFox</a></b></font></p>
<![endif]-->
<!--[if IE 6]>
<p><font style="color:#FF0000; font-size:11pt"><b>ВНИМАНИЕ!</b> </font><span style="color:#FFFFFF;font-size:11pt">У Вас устаревшая версия Internet Explorer. Для корректного отображения страниц сайта просим пользоваться версией <b><u>не ниже Internet Explorer7! </u></b></span><br><font style="color:#FFFFFF; font-size:11pt"><b>Для большего удобства предлагаем использовать браузер <a href='http://www.opera.com/download/'>OPERA</a> или <a href='http://ru.www.mozilla.com'>Mozilla FireFox</a></b></font></p>
<link rel="stylesheet" href="<?php echo base_url();?>/css/style_ie_6.css" type="text/css" />
<![endif]-->
<!--[if ie 7]><link rel="stylesheet" href="<?php echo base_url();?>css/style_ie.css" type="text/css" /><![endif]-->
<!--[if ie 8]><link rel="stylesheet" href="<?php echo base_url();?>css/style_ie.css" type="text/css" /><![endif]-->
<link rel="stylesheet" href="<?php echo base_url();?>js/pretty_photo/css/prettyPhoto.css" type="text/css" media="all" />
<noscript>
<link rel="stylesheet" href="<?php echo base_url();?>css/style_opera.css" type="text/css" />
</noscript>

<script  type="text/javascript" src="<?php echo base_url();?>js/jquery/jquery-1.4.3.js"></script>
<script  type="text/javascript" src="<?php echo base_url();?>js/jquery/jquery.media.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23436475-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
<meta name="description" content="Ашот Арутюнян - художник, фотограф, книгоиздатель, дизайнер" />
<meta name="keywords" content="художник, фотограф, книгоиздатель, дизайнер, ашот арутюнян, портреты, фотографии, картины, фотоальбомы, заказать портрет" />
<meta name='yandex-verification' content='55a868aa97a7b23f' />
<link rel="shortcut icon" type="image/x-icon" href="/favicon_spring.ico" />

<meta name="robots" content="INDEX, FOLLOW"/>

<meta content="document" name="resource-type"/>

<meta content="no-cache" http-equiv="Pragma"/>

<meta content="no-cache" http-equiv="Cache-Control"/>

<title><?php echo $title;?></title>
</head>
<body style="background: black;">
<?php echo $content; ?> 
</body>
</html>