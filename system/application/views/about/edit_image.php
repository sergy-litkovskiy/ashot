<h2><?php echo $title;?></h2>
<?php echo @$message; ?>
<p style="color: #FF0000;"><b><?php echo validation_errors(); ?></b></p>
<form class="add_new" action='<?php echo base_url();?>about/check_valid_image/update' method='post' name='add_new' enctype='multipart/form-data'>
    <table class="form_edit">
    <tr> 
        <td>
            <p><b>��������� �����������: </b><br/>(������ ���� ���������� �������� ������ �����������)</p>
        </td>
        <td><img style="width: 80px; float:left" src="<?php echo  base_url();?>img/<?php echo  $result[0]['img_path'];?>"/>
            <input style='border: 1px solid #C0C0C0' name='img_path' type='file' size='80' value="<?php echo set_value('img_path',$result[0]['img_path']);?>"/>
            <p style="color: #FF0000;font-size: 8pt;">�������������� ������ ����������� �������� - 800�600 ��. ��� ������������ �������� ������ 600 px.</p>
        </td>
    </tr>
    <tr>
        <td>
            <p><b>�������� ������:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_name' value="<?php echo set_value('img_name',$result[0]['img_name']);?>"/>
        </td>
    </tr>

    <tr> 
        <td>
            <p><b>�������������� �����������:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_comment' value="<?php echo set_value('img_comment',$result[0]['img_comment']);?>"/>
        </td>
    </tr> 
    <tr>
        <td colspan="2">   
            <b>��� &nbsp;</b><font style="color: #FF0000;font-size: 8pt;">(4 �����)</font>:
                <input style='border: 1px solid #C0C0C0;width:10%' name='img_year' value="<?php echo set_value('img_year',$result[0]['img_year']);?>"/></p>
        </td> 
    </tr> 
    <tr>
        <td colspan="2">   
            <p><b>������:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name='status' value="on"<?php echo set_radio('status', 'on', $result[0]['status']=='on'?true:false);?>/>&nbsp;������������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name='status' value="off"<?php echo set_radio('status', 'off', $result[0]['status']=='off'?true:false);?>/>&nbsp;������</p>
        </td> 
    </tr>
    </table>
        <input name="id" type="hidden" value="<?php echo set_value('id',$result[0]['id']);?>"/>
        <input name="img_path_old" type="hidden" value="<?php echo set_value('img_path_old',$result[0]['img_path']);?>"/>
        <input name="id_category" type="hidden" value="<?php echo set_value('id_category',$result[0]['id_category']);?>"/>
        <input name="number" type="hidden" value="<?php echo set_value('number',$result[0]['number']);?>"/>
        <input style='text-align:center' id='button' name='add' type='submit' value='���������'/>
</form>