<?php $url_name = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>
<ul class="menu">
            <?php if($url_name == base_url().'about'){?>
                <li class="unlink_item"><p>ОБ АВТОРЕ</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>about">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ОБ АВТОРЕ</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'portrets'){?>
                <li class="unlink_item"><p>ПОРТРЕТЫ</p></li>
            <?php } else {?>
		    <li class="main_item"><p><a href="<?php echo base_url();?>portrets">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ПОРТРЕТЫ</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'painting/art_tehnic'){?>
                <li class="unlink_item"><p>ТЕХНИКА</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>painting/art_tehnic">ТЕХНИКА</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'painting/elite_gift'){?>
                <li class="unlink_item"><p>ЭЛИТНЫЙ ПОДАРОК</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>painting/elite_gift">ЭЛИТНЫЙ ПОДАРОК</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'painting'){?>
                <li class="unlink_item"><p>ЖИВОПИСЬ</p></li>
            <?php } else {?>
		    <li class="main_item"><p><a href="<?php echo base_url();?>painting">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ЖИВОПИСЬ</a></p></li>
            <?php }?>
               <ul class="items">
               <?php if($url_name == base_url().'painting/surrealism'){?>
                    <li class="unlink_item_inside"><p>Сюрреализм&nbsp;&#8226;</p></li>
               <?php } else {?>
                    <li class="item"><a href="<?php echo base_url();?>painting/surrealism">Сюрреализм&nbsp;&#8226;</a></li>
               <?php }?>
               
               <?php if($url_name == base_url().'painting/landscapes'){?>
					<li class="unlink_item_inside"><p>Пейзажи&nbsp;&#8226;</p></li>
               <?php } else {?>
					<li class="item"><a href="<?php echo base_url();?>painting/landscapes">Пейзажи&nbsp;&#8226;</a></li>
               <?php }?>
               
               <?php if($url_name == base_url().'painting/still_life'){?>
                    <li class="unlink_item_inside"><p>Натюрморты&nbsp;&#8226;</p></li>
               <?php } else {?>
                    <li class="item"><a href="<?php echo base_url();?>painting/still_life">Натюрморты&nbsp;&#8226;</a></li>
               <?php }?>
               
                <?php if($url_name == base_url().'painting/sundry'){?>
					<li class="unlink_item_inside"><p>Разное&nbsp;&#8226;</p></li>
               <?php } else {?>
					<li class="item"><a href="<?php echo base_url();?>painting/sundry">Разное&nbsp;&#8226;</a></li>
               <?php }?>
               </ul>
                <?php if($url_name == base_url().'exhibition'){?>
                    <li class="unlink_item"><p>ВЫСТАВКА</p></li>
                <?php } else {?>
                    <li class="main_item"><p><a href="<?php echo base_url();?>exhibition">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ВЫСТАВКА</a></p></li>
                <?php }?>
                <ul class="items">
                    <?php if($url_name == base_url().'exhibition/smile'){?>
                        <li class="unlink_item_inside"><p>Улыбайтесь, господа!&nbsp;&#8226;</p></li>
                    <?php } else {?>
                        <li class="item"><a href="<?php echo base_url();?>exhibition/smile">Улыбайтесь, господа!&nbsp;&#8226;</a></li>
                    <?php }?>
                </ul>
			
            <!--<?php //if($url_name == base_url().'cinemaplacard'){?>
                <li class="unlink_item"><p>КИНОАФИША</p></li>
            <?php //} else {?>   
                <li class="main_item"><p><a href="<?//= //base_url();?>cinemaplacard">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;КИНОАФИША</a></p></li>
            <?php //}?>
            !-->
            <?php if($url_name == base_url().'placards'){?>
                <li class="unlink_item"><p>РЕКЛАМНЫЕ ПЛАКАТЫ</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>placards">РЕКЛАМНЫЕ ПЛАКАТЫ</a></p></li>
            <?php }?>
            <!--
            <?php //if($url_name == base_url().'books'){?>
                <li class="unlink_item"><p>КНИГИ, ФОТОАЛЬБОМЫ</p></li>
            <?php //} else {?>
                <li class="main_item"><p><a href="<?//= //base_url();?>books">КНИГИ, ФОТОАЛЬБОМЫ</a></p></li>
            <?php //}?>
            !-->
            <!--<li class="main_item"><p><a href="<?php //echo base_url();?>photos">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ФОТОГРАФИИ</a></p></li>
               <ul class="items">
               <?php //if($url_name == base_url().'photos/kids'){?>
                    <li class="unlink_item_inside"><p>Дети&nbsp;&#8226;</p></li>
               <?php //} else {?>
			   <li class="item"><a href="<?php //echo base_url();?>photos/kids">Дети&nbsp;&#8226;</a></li>
               <?php //}?>
               
               <?php //if($url_name == base_url().'photos/people'){?>
                    <li class="unlink_item_inside"><p>Люди&nbsp;&#8226;</p></li>
               <?php //} else {?>
               <li class="item"><a href="<?php //echo base_url();?>photos/people">Люди&nbsp;&#8226;</a></li>
               <?php //}?>
               
               <?php //if($url_name == base_url().'photos/kiev'){?>
                    <li class="unlink_item_inside"><p>Киев&nbsp;&#8226;</p></li>
               <?php //} else {?>
               <li class="item"><a href="<?php //echo base_url();?>photos/kiev">Киев&nbsp;&#8226;</a></li>
               <?php //}?>
               
               <?php //if($url_name == base_url().'photos/ukraine'){?>
                    <li class="unlink_item_inside"><p>Украина&nbsp;&#8226;</p></li>
               <?php //} else {?>
               <li class="item"><a href="<?php //echo base_url();?>photos/ukraine">Украина&nbsp;&#8226;</a></li>
               <?php //}?>
               
               <?php //if($url_name == base_url().'photos/medicine'){?>
                    <li class="unlink_item_inside"><p>Медицина&nbsp;&#8226;</p></li>
               <?php //} else {?>
               <li class="item"><a href="<?php //echo base_url();?>photos/medicine">Медицина&nbsp;&#8226;</a></li>
               <?php //}?>
               </ul>!-->
            <?php if($url_name == base_url().'restaurant'){?>
                <li class="unlink_item"><p>РЕСТОРАН НАПОЛЕОН</p></li>
            <?php } else {?>   
                <li class="main_item"><p><a href="<?php echo base_url();?>restaurant">РЕСТОРАН НАПОЛЕОН</a></p></li>
            <?php }?>
            
			 <?php if($url_name == base_url().'books'){?>
                <li class="unlink_item"><p>КНИГИ, ФОТОАЛЬБОМЫ</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>books">КНИГИ, ФОТОАЛЬБОМЫ</a></p></li>
            <?php }?>
                <p style="color: #FFEDC1; text-align: right; margin-top:1em; margin-right: 1em;">ПАРТНЕРЫ</p>
    </ul>