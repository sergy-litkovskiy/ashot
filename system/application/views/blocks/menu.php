<?php $url_name = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>
<ul class="menu">
            <?php if($url_name == base_url().'about'){?>
                <li class="unlink_item"><p>Об авторе</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>about">Об авторе</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'portrets'){?>
                <li class="unlink_item"><p>Портреты</p></li>
            <?php } else {?>
		    <li class="main_item"><p><a href="<?php echo base_url();?>portrets">Портреты</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'painting/art_tehnic'){?>
                <li class="unlink_item"><p>Техника</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>painting/art_tehnic">Техника</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'painting/elite_gift'){?>
                <li class="unlink_item"><p>Элитный подарок</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>painting/elite_gift">Элитный подарок</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'painting'){?>
                <li class="unlink_item"><p>Живопись</p></li>
            <?php } else {?>
		    <li class="main_item"><p><a href="<?php echo base_url();?>painting">Живопись</a></p></li>
            <?php }?>
               <ul class="items">
               <?php if($url_name == base_url().'painting/surrealism'){?>
                    <li class="unlink_item_inside"><p>Сюреализм&nbsp;&#8226;</p></li>
               <?php } else {?>
                    <li class="item"><a href="<?php echo base_url();?>painting/surrealism">Сюреализм&nbsp;&#8226;</a></li>
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
                    <li class="unlink_item"><p>Выставка</p></li>
                <?php } else {?>
                    <li class="main_item"><p><a href="<?php echo base_url();?>exhibition">Выставка</a></p></li>
                <?php }?>
                <ul class="items">
                    <?php if($url_name == base_url().'exhibition/smile'){?>
                        <li class="unlink_item_inside"><p>Улыбайтесь, господа!&nbsp;&#8226;</p></li>
                    <?php } else {?>
                        <li class="item"><a href="<?php echo base_url();?>exhibition/smile">Улыбайтесь, господа!&nbsp;&#8226;</a></li>
                    <?php }?>
                </ul>
			
            <!--<?php //if($url_name == base_url().'cinemaplacard'){?>
                <li class="unlink_item"><p>?????????</p></li>
            <?php //} else {?>   
                <li class="main_item"><p><a href="<?//= //base_url();?>cinemaplacard">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?????????</a></p></li>
            <?php //}?>
            !-->
            <?php if($url_name == base_url().'placards'){?>
                <li class="unlink_item"><p>Рекламные плакаты</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>placards">Рекламные плакаты</a></p></li>
            <?php }?>
            <!--
            <?php //if($url_name == base_url().'books'){?>
                <li class="unlink_item"><p>?????, ???????????</p></li>
            <?php //} else {?>
                <li class="main_item"><p><a href="<?//= //base_url();?>books">?????, ???????????</a></p></li>
            <?php //}?>
            !-->
            <!--<li class="main_item"><p><a href="<?php //echo base_url();?>photos">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;??????????</a></p></li>
               <ul class="items">
               <?php //if($url_name == base_url().'photos/kids'){?>
                    <li class="unlink_item_inside"><p>????&nbsp;&#8226;</p></li>
               <?php //} else {?>
			   <li class="item"><a href="<?php //echo base_url();?>photos/kids">????&nbsp;&#8226;</a></li>
               <?php //}?>
               
               <?php //if($url_name == base_url().'photos/people'){?>
                    <li class="unlink_item_inside"><p>????&nbsp;&#8226;</p></li>
               <?php //} else {?>
               <li class="item"><a href="<?php //echo base_url();?>photos/people">????&nbsp;&#8226;</a></li>
               <?php //}?>
               
               <?php //if($url_name == base_url().'photos/kiev'){?>
                    <li class="unlink_item_inside"><p>????&nbsp;&#8226;</p></li>
               <?php //} else {?>
               <li class="item"><a href="<?php //echo base_url();?>photos/kiev">????&nbsp;&#8226;</a></li>
               <?php //}?>
               
               <?php //if($url_name == base_url().'photos/ukraine'){?>
                    <li class="unlink_item_inside"><p>???????&nbsp;&#8226;</p></li>
               <?php //} else {?>
               <li class="item"><a href="<?php //echo base_url();?>photos/ukraine">???????&nbsp;&#8226;</a></li>
               <?php //}?>
               
               <?php //if($url_name == base_url().'photos/medicine'){?>
                    <li class="unlink_item_inside"><p>????????&nbsp;&#8226;</p></li>
               <?php //} else {?>
               <li class="item"><a href="<?php //echo base_url();?>photos/medicine">????????&nbsp;&#8226;</a></li>
               <?php //}?>
               </ul>!-->
            <?php if($url_name == base_url().'restaurant'){?>
                <li class="unlink_item"><p>Ресторан Наполеон</p></li>
            <?php } else {?>   
                <li class="main_item"><p><a href="<?php echo base_url();?>restaurant">Ресторан Наполеон</a></p></li>
            <?php }?>
            
			 <?php if($url_name == base_url().'books'){?>
                <li class="unlink_item"><p>Книги, фотоальбомы</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>books">Книги, фотоальбомы</a></p></li>
            <?php }?>
                <p style="color: #FFEDC1; text-align: right; margin-top:1em; margin-right: 1em;">Партнеры</p>
    </ul>