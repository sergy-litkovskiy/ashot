<h2><?php echo $title;?></h2>
<?php echo @$message?>
<p style="color: #FF0000;"><b><?php echo validation_errors(); ?></b></p>
<form class="add_new" action='<?php echo base_url();?>exhibition/check_valid/update/<?php echo $part;?>' method='post' name='add_new' enctype='multipart/form-data'>
    <table class="form_edit">
    <tr> 
        <td>
            <p><b>��������� �����������: </b><br/>(������ ���� ���������� �������� ������ �����������)</p>
        </td>
        <td><img style="width: 80px; float:left" src="<?php echo  base_url();?>img/<?php echo  $result['img_path'];?>"/>
            <input style='border: 1px solid #C0C0C0' name='img_path' type='file' size='80' value="<?php echo set_value('img_path',$result['img_path']);?>"/>
            <p style="color: #FF0000;font-size: 8pt;">������������� ������ ����������� �������� - 800�600 ��. ��� ������������ �������� ������ 600 px.</p>
        </td>
    </tr>
    <tr>
        <td>
            <p><b>�������� ������:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_name' value="<?php if($result['img_name']){echo $result['img_name'];}?>"/>
        </td>
    </tr>

    <tr> 
        <td>
            <p><b>�������������� �����������:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_comment' value="<?php if($result['img_comment']){echo $result['img_comment'];}?>"/>
        </td>
    </tr> 
    <tr> 
        <td>
            <p><b>��������� �������:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:10%' name='sell_price' value="<?php if($result['sell_price']){echo $result['sell_price'];}?>"/>&nbsp;$
        </td>
    </tr> 
    <tr>
        <td colspan="2">   
            <p><b>��������:</b><input style='border: 1px solid #C0C0C0;width:20%' name='img_material' value="<?php if($result['img_material']){echo $result['img_material'];};?>"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>�������:</b>
                <input style='border: 1px solid #C0C0C0;width:5%' name='img_width' value="<?php echo set_value('img_width',$result['width']);?>"/>&nbsp;x&nbsp;
                <input style='border: 1px solid #C0C0C0;width:5%' name='img_height' value="<?php echo set_value('img_height',$result['height']);?>"/>&nbsp;��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>��� ��������&nbsp;</b><span style="color: #FF0000;font-size: 8pt;">(4 �����)</span>:
                <input style='border: 1px solid #C0C0C0;width:10%' name='img_year' value="<?php echo set_value('img_year',$result['img_year']);?>"/></p>
        </td> 
    </tr> 
    <tr>
        <td colspan="2">   
            <p><b>������:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name='status' value="on"<?php echo set_radio('status', 'on', $result['status']=='on'?true:false);?>/>&nbsp;������������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name='status' value="off"<?php echo set_radio('status', 'off', $result['status']=='off'?true:false);?>/>&nbsp;������</p>
        </td> 
    </tr> 
    </table>
        <input name="id" type="hidden" value="<?php echo set_value('id',$result['id']);?>"/>
        <input name="img_path_old" type="hidden" value="<?php echo set_value('img_path_old',$result['img_path']);?>"/>
        <input name="id_category" type="hidden" value="<?php echo set_value('id_category',$result['id_category']);?>"/>
        <input name="number" type="hidden" value="<?php echo set_value('number',$result['number']);?>"/>
        <input style='text-align:center' id='button' name='add' type='submit' value='���������'/>
</form>