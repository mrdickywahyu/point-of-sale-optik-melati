<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 23:25:11
         compiled from ".\templates\edit_retur_transactions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:290425d825a678d8662-77735425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '687ccbfed795a37432b37d690fd50534d6a7a1e3' => 
    array (
      0 => '.\\templates\\edit_retur_transactions.tpl',
      1 => 1410713210,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '290425d825a678d8662-77735425',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'detailID' => 0,
    'productBarcode' => 0,
    'productName' => 0,
    'productBuyPrice' => 0,
    'detailReturPrice' => 0,
    'detailReturQty' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d825a67901100_15131666',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d825a67901100_15131666')) {function content_5d825a67901100_15131666($_smarty_tpl) {?><link rel="shortcut icon" href="images/favicon.jpg">
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
			
			$("#trx").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var detailID = $("#detailID").val();
				var qty = $("#qty").val();
				var price = $("#price").val();
				
				if (detailID != '' && qty != '' && price != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_retur_transactions.php',
						dataType: 'JSON',
						data:{
							detailID: detailID,
							qty: qty,
							price: price
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

				

<?php if ($_smarty_tpl->tpl_vars['module']->value=='trx'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Detail Retur</h3></td>
		</tr>
		<tr>
			<td>
				<form id="trx" name="trx" method="POST" action="#">
				<input type="hidden" id="detailID" name="detailID" value="<?php echo $_smarty_tpl->tpl_vars['detailID']->value;?>
">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="250">Kode Produk</td>
						<td width="5">:</td>
						<td><?php echo $_smarty_tpl->tpl_vars['productBarcode']->value;?>
</td>
					</tr>
					<tr valign="top">
						<td>Nama Produk</td>
						<td>:</td>
						<td><?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
</td>
					</tr>
					<tr>
						<td>Harga Sup Sebelumnya</td>
						<td>:</td>
						<td>Rp. <?php echo $_smarty_tpl->tpl_vars['productBuyPrice']->value;?>
</td>
					</tr>
					<tr>
						<td>Harga Supplier Satuan</td>
						<td>:</td>
						<td><input type="text" id="price" name="price" value="<?php echo $_smarty_tpl->tpl_vars['detailReturPrice']->value;?>
" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Qty</td>
						<td>:</td>
						<td><input type="text" id="qty" name="qty" value="<?php echo $_smarty_tpl->tpl_vars['detailReturQty']->value;?>
" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

<?php }?>
</body><?php }} ?>