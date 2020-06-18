<?php /* Smarty version Smarty-3.1.11, created on 2019-09-19 00:11:25
         compiled from ".\templates\edit_brands.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7675d82653d113149-76560199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9ea2a4317ed5b5d81c68f12dafb9897d6a68be1' => 
    array (
      0 => '.\\templates\\edit_brands.tpl',
      1 => 1407866332,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7675d82653d113149-76560199',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'brandID' => 0,
    'brandName' => 0,
    'brandStatus' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d82653d1d2628_79488902',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d82653d1d2628_79488902')) {function content_5d82653d1d2628_79488902($_smarty_tpl) {?><link rel="shortcut icon" href="images/favicon.jpg">
<link rel="stylesheet" type="text/css" href="design/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="design/css/demo.css" />
<link rel="stylesheet" type="text/css" href="design/css/icons.css" />
<link rel="stylesheet" type="text/css" href="design/css/component.css" />
<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="design/js/modernizr.custom.js"></script>
<link rel="stylesheet" href="design/js/development-bundle/themes/base/jquery.ui.all.css" type="text/css">
<script type="text/javascript" src="design/js/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="design/js/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="design/js/development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="design/js/ckeditor/ckeditor.js"></script>
<script src="design/js/jquery.plugin.js"></script>
<script src="design/js/jquery.timeentry.js"></script>
	
<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>

	<script>
		$(document).ready(function() {
			
			$("#brand").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var brandID = $("#brandID").val();
				var brandName = $("#brandName").val();
				var brandStatus = $("#brandStatus").val();
				
				if (brandID != '' && brandName != '' && brandStatus != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_brands.php',
						dataType: 'JSON',
						data:{
							brandID: brandID,
							brandName: brandName,
							brandStatus: brandStatus
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							parent.jQuery.fancybox.close();
						}
					});
				}
			});
		});
	</script>	

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='brand'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Brand</h3></td>
		</tr>
		<tr>
			<td>
				<form id="brand" name="brand" method="POST" action="#">
				<input type="hidden" id="brandID" name="brandID" value="<?php echo $_smarty_tpl->tpl_vars['brandID']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Nama Brand</td>
						<td width="5">:</td>
						<td><input type="text" id="brandName" name="brandName" value="<?php echo $_smarty_tpl->tpl_vars['brandName']->value;?>
" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><select name="brandStatus" id="brandStatus" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
							<option value="">- Pilih Status -</option>
							<option value="Y" <?php if ($_smarty_tpl->tpl_vars['brandStatus']->value=='Y'){?> SELECTED <?php }?>>Y (Aktif)</option>
							<option value="N" <?php if ($_smarty_tpl->tpl_vars['brandStatus']->value=='N'){?> SELECTED <?php }?>>N (Tidak Aktif)</option>
						</select></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>