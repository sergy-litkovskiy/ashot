<h2><?php echo $title;?></h2>
<?php echo @$message; ?>

<form class="add_new" action='<?php echo base_url();?>photos/check_valid/add/<?php echo $part;?>' method='post' name='add_new' enctype='multipart/form-data'>
<div id="add_img_tmpl">
    <table class="form_edit">
    <tr> 
        <td>
            <p><b>��������� �����������:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0' name='img_path[]' type='file' size='80' value="<?php echo set_value('img_path[]');?>"/>
            <p style="color: #FF0000;font-size: 8pt;">�������������� ������ ����������� �������� - 800�600 ��. ��� ������������ �������� ������ 600 px.</p>
        </td>
    </tr>
    <tr>
        <td>
            <p><b>�������� ������:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_name[]' value="<?php echo set_value('img_name[]');?>"/>
        </td>
    </tr>

    <tr> 
        <td>
            <p><b>�������������� �����������:</b></p>
        </td>
        <td>
            <input style='border: 1px solid #C0C0C0;width:75%' name='img_comment[]' value="<?php echo set_value('img_comment[]');?>"/>
        </td>
    </tr> 
    <tr>
        <td colspan="2">   
            <p><b>��������:</b><input style='border: 1px solid #C0C0C0;width:20%' name='img_material[]' value="<?php echo set_value('img_material[]');?>"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>�������:</b>
                <input style='border: 1px solid #C0C0C0;width:5%' name='img_width[]' value="<?php echo set_value('img_width[]');?>"/>&nbsp;x&nbsp;
                <input style='border: 1px solid #C0C0C0;width:5%' name='img_height[]' value="<?php echo set_value('img_height[]');?>"/>&nbsp;��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>��� ��������&nbsp;</b><font style="color: #FF0000;font-size: 8pt;">(4 �����)</font>:
                <input style='border: 1px solid #C0C0C0;width:10%' name='img_year[]' value="<?php echo set_value('img_year[]');?>"/></p>
        </td> 
    </tr> 
   
    </table>
</div>
    <div class="butt_add_plus"><a href="#" id="push_me">�������� ��� ����� ��� ��������</a></div>
        <input style='text-align:center' id='button' name='add' type='submit' value='���������'/>
</form>