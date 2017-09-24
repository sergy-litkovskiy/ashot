<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
    <head><?php echo head_htm(); ?></head>
    <body oncontextmenu="return false;">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
        <div class="container">
            <div class="content_block">
                <div class="content_block_left">
                    <a href="<?php echo base_url();?>about"><div>&nbsp;</div></a>
                    <?php echo $menu; ?>
                    <div class="partners">
                        <a href="http://www.fondpremier.ru/">
                            <img src="<?php echo base_url();?>img/img_main/fondpremierlogo_sml.png" border="0"/>
                        </a>
                    </div>
                </div>
                <div class="content_block_right">
                    <div class="content_block_top"></div>
                    <div class="content">
						<div class="social">
							<a href="http://vkontakte.ru/id61446352" target="_blank">
								<img src="<?php echo base_url();?>img/img_main/vkontakte.png" border="0"/>
							</a>
							<a href="http://www.facebook.com/profile.php?id=100001259934042&sk=photos" target="_blank">
								<img src="<?php echo base_url();?>img/img_main/fb.png" border="0"/>
							</a>
							<div class="fb-like" data-href="<?php echo base_url().@$uri[1]; if(@$uri[2]){echo '/'.@$uri[2];}?>" data-send="true" data-layout="button_count" data-width="220" data-show-faces="false"></div>
						</div>
                        <?php echo $content; ?>
                    </div>    
                    <div class="content_block_bot">
                        <p class="copyright"><a style="cursor:pointer" id="opener">&copy;</a> Copyright Ashot Arutyunyan</p>
                    </div>
                </div>
            </div>
        </div>
        <?php if(@$err_message){?>
        <script  type="text/javascript">$(document).ready(function(){$('#login').dialog('open'); return false;});</script>
        <?php }?>
        <div id="login" style="display:none">
        	<form action="<?php echo base_url();?>login" method="post" enctype="multipart/form-data">
            	<table>
                	<tr><?php echo @$err_message;?>
                		<td style="width:80px"><p style="font-size:12pt; color:red">Login:</p></td>
                		<td><input style='border: 1px solid #C0C0C0' id="login" name='login' type='text' size='20' value=""/></td>
                	</tr>
                	<tr>
                		<td><p style="font-size:12pt; color:red">Password:</p></td>
                		<td><input style='border: 1px solid #C0C0C0' id='pass' name='pass' type='password' size='20' value=""/></td>
                	</tr>
                	<tr>
                	<td colspan="2"><input style='text-align:center' id='button' type='submit' value='Enter'/></td>
                   </tr>
            	</table>
            </form>
        </div>
    </body>
</html>