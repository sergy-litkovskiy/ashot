<?php $url_name = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>
<ul class="menu">
            <?php if($url_name == base_url().'about'){?>
                <li class="unlink_item"><p>�� ������</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>about">�� ������</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'portrets'){?>
                <li class="unlink_item"><p>��������</p></li>
            <?php } else {?>
		    <li class="main_item"><p><a href="<?php echo base_url();?>portrets">��������</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'painting/art_tehnic'){?>
                <li class="unlink_item"><p>�������</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>painting/art_tehnic">�������</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'painting/elite_gift'){?>
                <li class="unlink_item"><p>������� �������</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>painting/elite_gift">������� �������</a></p></li>
            <?php }?>
            <?php if($url_name == base_url().'painting'){?>
                <li class="unlink_item"><p>��������</p></li>
            <?php } else {?>
		    <li class="main_item"><p><a href="<?php echo base_url();?>painting">��������</a></p></li>
            <?php }?>
               <ul class="items">
               <?php if($url_name == base_url().'painting/surrealism'){?>
                    <li class="unlink_item_inside"><p>���������&nbsp;&#8226;</p></li>
               <?php } else {?>
                    <li class="item"><a href="<?php echo base_url();?>painting/surrealism">���������&nbsp;&#8226;</a></li>
               <?php }?>
               
               <?php if($url_name == base_url().'painting/landscapes'){?>
					<li class="unlink_item_inside"><p>�������&nbsp;&#8226;</p></li>
               <?php } else {?>
					<li class="item"><a href="<?php echo base_url();?>painting/landscapes">�������&nbsp;&#8226;</a></li>
               <?php }?>
               
               <?php if($url_name == base_url().'painting/still_life'){?>
                    <li class="unlink_item_inside"><p>����������&nbsp;&#8226;</p></li>
               <?php } else {?>
                    <li class="item"><a href="<?php echo base_url();?>painting/still_life">����������&nbsp;&#8226;</a></li>
               <?php }?>
               
                <?php if($url_name == base_url().'painting/sundry'){?>
					<li class="unlink_item_inside"><p>������&nbsp;&#8226;</p></li>
               <?php } else {?>
					<li class="item"><a href="<?php echo base_url();?>painting/sundry">������&nbsp;&#8226;</a></li>
               <?php }?>
               </ul>
                <?php if($url_name == base_url().'exhibition'){?>
                    <li class="unlink_item"><p>��������</p></li>
                <?php } else {?>
                    <li class="main_item"><p><a href="<?php echo base_url();?>exhibition">��������</a></p></li>
                <?php }?>
                <ul class="items">
                    <?php if($url_name == base_url().'exhibition/smile'){?>
                        <li class="unlink_item_inside"><p>����������, �������!&nbsp;&#8226;</p></li>
                    <?php } else {?>
                        <li class="item"><a href="<?php echo base_url();?>exhibition/smile">����������, �������!&nbsp;&#8226;</a></li>
                    <?php }?>
                </ul>
			
            <!--<?php //if($url_name == base_url().'cinemaplacard'){?>
                <li class="unlink_item"><p>?????????</p></li>
            <?php //} else {?>   
                <li class="main_item"><p><a href="<?//= //base_url();?>cinemaplacard">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;?????????</a></p></li>
            <?php //}?>
            !-->
            <?php if($url_name == base_url().'placards'){?>
                <li class="unlink_item"><p>��������� �������</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>placards">��������� �������</a></p></li>
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
                <li class="unlink_item"><p>�������� ��������</p></li>
            <?php } else {?>   
                <li class="main_item"><p><a href="<?php echo base_url();?>restaurant">�������� ��������</a></p></li>
            <?php }?>
            
			 <?php if($url_name == base_url().'books'){?>
                <li class="unlink_item"><p>�����, �����������</p></li>
            <?php } else {?>
                <li class="main_item"><p><a href="<?php echo base_url();?>books">�����, �����������</a></p></li>
            <?php }?>
                <p style="color: #FFEDC1; text-align: right; margin-top:1em; margin-right: 1em;">��������</p>
    </ul>