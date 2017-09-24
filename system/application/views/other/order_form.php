<div id="dialog_order_add" class="dialog_order_add" style="display:none;">
	<form action="#" class="dialog_order_add" method="post" enctype="multipart/form-data">
    	<table>
        	<tr>
        		<td style="width:80px"><p class="red">Имя:</p></td>
        		<td><input style='border: 1px solid #C0C0C0' id="customer_name" name='customer_name' type='text' size='24' value=""/></td>
        	</tr>
            <tr>
        		<td style="width:80px"><p class="red">E-mail:</p></td>
        		<td><input style='border: 1px solid #C0C0C0' id="customer_email" name='customer_email' type='text' size='24' value=""/></td>
        	</tr>
            <tr>
        		<td style="width:80px"><p class="red">Контактный телефон:</p></td>
        		<td><input style='border: 1px solid #C0C0C0' id="customer_phone" name='customer_phone' type='text' size='24' value=""/></td>
        	</tr>
        	<tr>
        		<td><p class="red">Какую картину хотите заказать/купить:</p></td>
        		<td><textarea style='border: 1px solid #C0C0C0; width:99%' id='text' name='text'></textarea></td>
        	</tr>
        	<tr>
        	<td>
                <input class="button_send_order_form" style='text-align:center' id='button' type='submit' value='Отправить'/>
            </td>
            <td style="text-align: right;">
                <input class="button_close_order_form" style='text-align:center' id='button' value='Закрыть'/>
            </td>
           </tr>
    	</table>
    </form>
</div>    