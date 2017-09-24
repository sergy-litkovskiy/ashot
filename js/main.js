  $(document).ready(function() {
	$('ul.menu ul').each(function(i) {
		if ($.cookie('submenuMark-' + i)) { 
			$(this).show().prev().removeClass('collapsed').addClass('expanded'); // Show it (add apropriate classes)
		}else {
			$(this).hide().prev().removeClass('expanded').addClass('collapsed'); // Hide it
		}
		$(this).prev().addClass('collapsible').click(function() { 
			if ($(this).next().css('display') == 'none') {
				$(this).next().slideDown(200, function () { // Show submenu:
					$(this).prev().removeClass('collapsed').addClass('expanded');
					cookieSet(i);
				});
			}else {
				$(this).next().slideUp(200, function () { // Hide submenu:
					$(this).prev().removeClass('expanded').addClass('collapsed');
					cookieDel(i);
					$(this).find('ul').each(function() {
						$(this).hide(0, cookieDel($('ul.menu ul').index($(this)))).prev().removeClass('expanded').addClass('collapsed');
					});
				});
			}
		return false; // Prohibit the browser to follow the link address
		});
	});
});
function cookieSet(index) {
	$.cookie('submenuMark-' + index, 'opened', {expires: null, path: '/'}); // Set mark to cookie (submenu is shown):
}
function cookieDel(index) {
	$.cookie('submenuMark-' + index, null, {expires: null, path: '/'}); // Delete mark from cookie (submenu is hidden):
}

//////////////////////////////////////////////////////////////// 
//initialization prettyPhoto gallery
$(document).ready(function(){
        //rules for all pages
        $("li a[rel^='prettyPhoto']").prettyPhoto({
            animationSpeed: 'normal',
            padding: 40,
            opacity: 0.35,
            showTitle: true,
            allowresize: true,
            counter_separator_label: '/',          
            theme: 'light_rounded' 
        });
        //rules for book page
        for (i=0; i<=15; i++){
        $(".img_small:eq("+i+") a[rel^='prettyBook']").prettyPhoto({
            animationSpeed: 'normal',
            padding: 40,
            opacity: 0.35,
            showTitle: true,
            allowresize: true,
            counter_separator_label: '/',          
            theme: 'light_rounded' 
        });
        }
////////////////////////////////////////////////////////////////        
        //show cut text/full text for all pages
        var text_full = $('div.content span#text_total').html(),
            descroption = $('div.content span#text_total').find('p');
     
        if(descroption.length > 1 || descroption.text() != ''){
            $('div.content span#text_total').html($('div.content span#text_total').text().substr(0,750)).append("<a id='detail_show' href='#'>...подробнее</a>");
        }

        $('a#detail_show').live("click", function(e){
            $('div.content span#text_total').slideUp('800');
            $('div.content span#text_total').html(text_full).append("<a id='detail_hide' href='#'>свернуть</a>").slideDown('800'); 
            e.preventDefault();
        });
        $('a#detail_hide').live("click", function(e){
            $('div.content span#text_total').slideUp('800');
            $('div.content span#text_total').html($('div.content span#text_total').text().substr(0,750)).append("<a id='detail_show' href='#'>...подробнее</a>").slideDown('800'); 
            e.preventDefault();
        });
        
////////////////////////////////////////////////////////////////         
//show cut text/full text for about_page

        $('#text_long_about').hide();
        var long_text   = $('#text_long_about').append("<a id='detail_hide_about' href='#'>свернуть</a>");

        if($('#text_short_about').has('p')){
            var short_text = $('#text_short_about p').html();
            var short_text = $('#text_short_about').html(short_text).append("<a id='detail_show_about' href='#'>...подробнее</a>");
        }
        else{
            var short_text = $('#text_short_about').append("<a id='detail_show_about' href='#'>подробнее</a>");
        }
        
        $('#detail_show_about').live("click", function(e){
            $(short_text).slideUp('800');
            $(long_text).slideDown('200');
            e.preventDefault();
        });
        
        $('#detail_hide_about').live("click", function(e){
            $(long_text).slideUp('200');
            $(short_text).slideDown('800');
            e.preventDefault();
        });
        
////////////////////////////////////////////////////////////////       
        //after click add one new form for upload files
        var max_photos_upload = 15;
        var added_forms = 1;
        var tmpl = $('#add_img_tmpl').html();
        $('#push_me').click(function(){
            if (added_forms < max_photos_upload){
                $('#add_img_tmpl').append(tmpl);
                added_forms++;
            }
            return false;
        });

////////////////////////////////////////////////////////////////
        //dialog window
        $('#login').dialog({
        	autoOpen: false,
        	title: '<p style=\'font-size:12pt;color:#FFFFFF\'>Введите логин и пароль</p>',
        	width:350,
        	heigth:300,
        	show: 'blind',
        	hide: 'explode'
        });
        
        $('#opener').click(function() {
        	$('#login').dialog('open');
        	return false;
        });

////////////////////////////////////////////////////////////////
        //dialog window
        $('div.dialog_comment_add').dialog({
        	autoOpen: false,
        	title: '<p style=\'font-size:12pt;color:#FFFFFF\'>Комментарии</p>',
        	width:400,
        	heigth:300,
        	show: 'blind',
        	hide: 'explode'
        });
        
        $('a.comment_add').live('click', function(e) {
        $('div.pp_overlay').hide();
        var pretty = $(this).parent().parent().parent().parent().parent($('div.pp_pic_holder light_rounded'));
        pretty.hide();
			//$('.pp_pic_holder light_rounded').hide();
            var id = $(this).data('id');
            $('div#'+id).dialog('open');

        	return false;
        });
        
        $("input.button_close").live('click', function(e) {
            $('div.pp_overlay').show();
            $('div.ui-dialog').hide();
            window.location.reload();
            return false;
        });
  
  ////////////////////////////////////////////////////////////////
        //dialog order window
        $('.order_form').click(function() {
        	$('#dialog_order_add').dialog('open');
        	return false;
        });
        
        $('#dialog_order_add').dialog({
        	autoOpen: false,
        	title: '<p style=\'font-size:12pt;color:#FFFFFF\'>Заказать/Купить</p>',
        	width:400,
        	heigth:300,
        	show: 'blind',
        	hide: 'explode'
        });
        
        $("input.button_close_order_form").live('click', function(e) {
            $('#dialog_order_add,.ui-dialog').hide();
            window.location.reload();
            return false;
        });
        
        $('form.dialog_order_add').submit(function() {
            var message_validator = $("form.dialog_order_add").validate({ 
                rules: {
                    customer_name: "required",
                    customer_email: {
                        required: true,
                        email: true
                    },
                    customer_phone: {
                        required: true,
                        digits: true
                    },
                    text:   "required"
                }
             ,
                messages: {
                    customer_name: "Введите Ваше имя",
                    customer_email: {
                        required: "Введите Ваш e-mail",
                        email: "E-mail в формате name@domen.ua"
                    },
                    customer_phone: {
                        required: "Введите контактный телефон",
                        digits: "Номер телефона должен содержать цифры"
                    },
                    text:   "Введите текст сообщения"
            },
            submitHandler: function(form) {
                    if(message_validator.valid){
                        var customer_name = $('#customer_name').val();
                        var customer_email = $('#customer_email').val();
                        var customer_phone = $('#customer_phone').val();
                        var text = $('textarea#text').val();
                        $.ajax({
                            type: "POST",
                            async: false,
                            url: "/painting/order_add",
                            data: "customer_name="+customer_name+"&customer_email="+customer_email+"&customer_phone="+customer_phone+"&text="+text,
                            success: function(data){
                                window.location.reload();
                            }
                        });
                    } 
                }
            });

        	return false;
        });
          
////////////////////////////////////////////////////////////////        
        //form validation - about page
        $("input.butt_add_mess").click(function(){
            $("form.add_new").validate({rules: { 
                    name: "required",
                    email:  "email",
                    text:   "required"
                },
                messages: {
                    name: "Введите Ваше имя",
                    email:  "Введите email в формате (name@domain.ua)",
                    text:   "Введите текст сообщения"
            }});
       });    

////////////////////////////////////////////////////////////////        
        //sortable list
        $( "#sortable" ).sortable();
///////////////////////////////////////////////////////////////
        var itemList = $("div.content > ul > li > div.gallery");      
        if(itemList.length > 0){
            $("div.content > ul > li").addClass("img_list");
        }  
///////////////////////////////////////////////////////////////
        //edit comments
         $("a.edit_comment").live('click', function(e) {
            var id = $(this).attr('id');
            var text_old = $('p#'+id).html();
            var form = $('form.form_comment_edit_'+id);
            
            $('p#'+id).hide();
            $(this).hide();
            $('form.form_comment_edit_' + id +' > textarea').html(text_old);
            form.slideDown('600');
            form.submit(function() {
                var text = $('form.form_comment_edit_' + id +' > textarea').val();
                $.ajax({
                    type: "POST",
                    async: false,
                    dataType: "json",
                    url: "/comments/edit_comments_ajax",
                    data: "id="+id+"&text="+text,
                    success: function(data){
                        if(data.success == 'true'){
                            form.animate({opacity: 0.25});
                            alert('Текст комментария успешно обновлен!');
                        }else{
                            alert('Ошибка! Текст комментария НЕ был обновлен. Попробуйте еще раз.');
                        }
                        
                        window.location.reload();
                    }
                });
            });
            return false;
        });
///////////////////////////////////////////////////////////////
        //edit comments
         $("a.delite_comment").live('click', function(e) {
            var id = $(this).attr('id');   
            $.ajax({
                type: "POST",
                async: false,
                dataType: "json",
                url: "/comments/delite_comments_ajax",
                data: "id="+id,
                success: function(data){
                    if(data.success == 'true'){
                        $('form.form_comment_edit_'+id).animate({opacity: 0.25});
                        alert('Текст комментария успешно удален!');
                    }else{
                        alert('Ошибка! Текст комментария НЕ был удален. Попробуйте еще раз.');
                    }
                    
                    window.location.reload();
                }
            });   
            return false;
        }); 
});                
//////////////////////////////////////////////////////////////// 
function SortList(control, part){
   
            var partname =  part ? "/" + part : "";
            var res = $( "#sortable" ).sortable('toArray');
         
           $.ajax({
             type: "POST",
             async: false,
             url: "/" + control + "/ajax_sortable",
             data: { ids: res },
             success: function(data){
                $('div#message').html(data).show();

                    //window.location.reload();
                    //window.location.href = "http://localhost/ashot.kiev.ua/photos/edit/kids";
                   //if( data === 'true' ){
                    
                    //window.location = "/ashot.kiev.ua/" + control + "/edit" + partname;
                   // }
                        }
            });
            return false;
        }


function GotoURL(URL,text){
 if (confirm(text)) {
     parent.location.href=URL;
    }
}