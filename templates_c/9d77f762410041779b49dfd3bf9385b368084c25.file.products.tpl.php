<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:11:07
         compiled from ".\templates\products.tpl" */ ?>
<?php /*%%SmartyHeaderCode:304175d82490b2e1f92-91447913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d77f762410041779b49dfd3bf9385b368084c25' => 
    array (
      0 => '.\\templates\\products.tpl',
      1 => 1414208358,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '304175d82490b2e1f92-91447913',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataProduct' => 0,
    'pageLink' => 0,
    'productBarcode' => 0,
    'dataSupplier' => 0,
    'dataCategory' => 0,
    'dataBrand' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d82490b377f78_02906562',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d82490b377f78_02906562')) {function content_5d82490b377f78_02906562($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="container">
	<!-- Push Wrapper -->
	<div class="mp-pusher" id="mp-pusher">

		<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<div class="scroller"><!-- this is for emulating position fixed of the nav -->
			<div class="scroller-inner">
				<!-- Top Navigation -->
				<div style="padding-left: 18px; padding-top: 10px;">
					
					<?php echo $_smarty_tpl->getSubTemplate ("logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					
				</div>
				
				<!-- Top Navigation -->
				<div class="codrops-top clearfix">
					<!--<a href="#" id="trigger" class="menu-trigger">Open Menu</a>-->
					<a class="codrops-icon codrops-icon-prev" href="#" id="trigger"><span>Open Menu</span></a> |
					<a href="backup.php"><span>Backup</span></a> |
					<a href="home.php"><span>Home</span></a>
					<span class="right"><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Logout</span></a></span>
				</div>
				
				<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
  				<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
  				<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
  				<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />
  				
  				<style>
  					.libarcode{
  						list-style: none;
  					}
  				</style>
  				
  				
					<script>
						$(document).ready(function() {
							
							$(".various2").fancybox({
								fitToView: false,
								scrolling: 'no',
								afterLoad: function(){
									this.width = $(this.element).data("width");
									this.height = $(this.element).data("height");
								},
								'afterClose':function () {
									window.location.reload();
								}
							});
							
							$("#barcodeType").change(function(e){
								var barcodeType = $("#barcodeType").val();
								
								var myarr = barcodeType.split("#");
								
								$("#barcodeBox").empty(); 
								
								if (myarr[0] == '1'){
									$('<li></li>').appendTo('#barcodeBox').html('<input type="text" id="productBarcode" name="productBarcode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>').addClass('libarcode');
								}
								if (myarr[0] == '2'){
									$('<li></li>').appendTo('#barcodeBox').html('<input type="text" id="productBarcode" value="'+ myarr[1] +'" name="productBarcode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED><input type="hidden" id="productBarcode" value="'+ myarr[1] +'" name="productBarcode">').addClass('libarcode');
								}
							});
							
							$(".modalbox").fancybox();
							$(".modalbox2").fancybox();
							
							$("#product").submit(function() { return false; });
							
							$("#product2").submit(function() { return false; });
							
							$("#productBarcode2").autocomplete("product_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('productBarcode2').value = myarr[0];
							});
					
							
							$("#send").on("click", function(){
								var supplierID = $("#supplierID").val();
								var categoryID = $("#categoryID").val();
								var brandID = $("#brandID").val();
								var productBarcode = $("#productBarcode").val();
								var productName = $("#productName").val();
								var productDiscount = $("#productDiscount").val();
								var productBuyPrice = $("#productBuyPrice").val();
								var productSalePrice = $("#productSalePrice").val();
								var productStock = $("#productStock").val();
								var productNote = $("#productNote").val();
								
								if (productBarcode != '' && productName != '' && productBuyPrice != '' && productStock != '' && productSalePrice != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_product.php',
										dataType: 'JSON',
										data:{
											supplierID: supplierID,
											categoryID: categoryID,
											brandID: brandID,
											productBarcode: productBarcode,
											productName: productName,
											productDiscount: productDiscount,
											productBuyPrice: productBuyPrice,
											productSalePrice: productSalePrice,
											productStock: productStock,
											productNote: productNote
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "products.php?code=1";
										}
									});
								}
							});
							
							$("#send2").on("click", function(){
								var productBarcode = $("#productBarcode2").val();
								var categoryID = $("#categoryID2").val();
								var brandID = $("#brandID2").val();
								
								setTimeout("$.fancybox.close()", 1000);
								window.location.href = "products.php?module=product&act=search&categoryID=" + categoryID + "&brandID=" + brandID + "&productBarcode=" + productBarcode;
							});
						});
					</script>
				
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Produk</button></a>
					<a href="#inline2" class="modalbox2"><button class="btn btn-primary" type="button">Cari Produk</button></a>
					<a href="print_product.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen Produk</h3>
					
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="130" style='border-left: 1px solid #CCCCCC;'>Kode Produk <i class="fa fa-sort"></i></th>
									<th width="330" style='border-left: 1px solid #CCCCCC;'>Nama Produk <i class="fa fa-sort"></i></th>
									<th width="50" style='border-left: 1px solid #CCCCCC;'>Stok <i class="fa fa-sort"></i></th>
									<th width="110" style='border-left: 1px solid #CCCCCC;'>Harga Beli <i class="fa fa-sort"></i></th>
									<th width="110" style='border-left: 1px solid #CCCCCC;'>Harga Jual <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Diskon (%) <i class="fa fa-sort"></i></th>
									<th width="60" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['name'] = 'dataProduct';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataProduct']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total']);
?>
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['no'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productBarcode'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productName'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productStock'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productBuyPrice'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productSalePrice'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productDiscount'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a title="Edit" href="edit_products.php?module=product&act=edit&productID=<?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productID'];?>
" data-width="930" data-height="380" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20"></a>
										<a title="Hapus" href="products.php?module=product&act=delete&productID=<?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus produk <?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productBarcode'];?>
#<?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productName'];?>
?');"><img src="images/icons/delete.png" width="20"></a>
									</td>
								</tr>
								<?php endfor; endif; ?>
							</tbody>
						</table>
					</div>
					<br>
					<div id="paging"><?php echo $_smarty_tpl->tpl_vars['pageLink']->value;?>
</div>
					
					<div id="inline">	
						<table width="100%" align="center">
							<tr>
								<td colspan="3"><h3>Tambah Produk</h3></td>
							</tr>
							<tr>
								<td>
									<form id="product" name="product" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="120">Kode Produk</td>
											<td width="5">:</td>
											<td><select name="barcodeType" id="barcodeType" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value="">- Pilih Penggunaan Kode Produk -</option>
													<option value="1#A">Manual</option>
													<option value="2#<?php echo $_smarty_tpl->tpl_vars['productBarcode']->value;?>
">Otomatis</option>
												</select>
											</td>
											<td width="20"></td>
											<td width="120">Harga Beli</td>
											<td width="5">:</td>
											<td><input type="number" id="productBuyPrice" name="productBuyPrice" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td>
												<div id="barcodeBox">
													<li class="libarcode"></li>
												</div>
											</td>
											<td width="20"></td>
											<td>Harga Jual</td>
											<td>:</td>
											<td><input type="number" id="productSalePrice" name="productSalePrice" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Nama Produk</td>
											<td>:</td>
											<td><input type="text" id="productName" name="productName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
											<td width="20"></td>
											<td>Diskon (%)</td>
											<td>:</td>
											<td><input type="number" id="productDiscount" name="productDiscount" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Supplier</td>
											<td>:</td>
											<td><select name="supplierID" id="supplierID" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
												<option value="">None</option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['name'] = 'dataSupplier';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSupplier']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total']);
?>
													<option value="<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
</option>
												<?php endfor; endif; ?>
											</select></td>
											<td width="20"></td>
											<td>Stok</td>
											<td>:</td>
											<td><input type="number" id="productStock" name="productStock" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Kategori</td>
											<td>:</td>
											<td><select name="categoryID" id="categoryID" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
												<option value="">None</option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['name'] = 'dataCategory';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCategory']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total']);
?>
													<option value="<?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryName'];?>
</option>
												<?php endfor; endif; ?>
											</select></td>
											<td width="20"></td>
											<td>Note</td>
											<td>:</td>
											<td><input type="text" id="productNote" name="productNote" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Brand</td>
											<td>:</td>
											<td><select name="brandID" id="brandID" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
												<option value="">None</option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['name'] = 'dataBrand';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBrand']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total']);
?>
													<option value="<?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['brandID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['brandName'];?>
</option>
												<?php endfor; endif; ?>
											</select></td>
											<td width="20"></td>
											<td colspan="3"></td>
										</tr>
									</table>
									<button id="send" class="btn btn-primary">Simpan</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
					
					<div id="inline2">	
						<form id="product2" name="product2" method="GET" action="#">
						<h3>Cari Produk</h3>
						<table cellpadding="7" cellspacing="7" width="95%">
							<tr>
								<td width="130">Kategori</td>
								<td width="5">:</td>
								<td><select name="categoryID" id="categoryID2" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
									<option value="">None</option>
									<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['name'] = 'dataCategory';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataCategory']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataCategory']['total']);
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataCategory']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataCategory']['index']]['categoryName'];?>
</option>
									<?php endfor; endif; ?>
								</select></td>
							</tr>
							<tr>
								<td>Brand</td>
								<td>:</td>
								<td><select name="brandID" id="brandID2" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
									<option value="">None</option>
									<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['name'] = 'dataBrand';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBrand']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total']);
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['brandID'];?>
"><?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['brandName'];?>
</option>
									<?php endfor; endif; ?>
								</select></td>
							</tr>
							<tr>
								<td>Kode Produk</td>
								<td>:</td>
								<td><input type="text" id="productBarcode2" name="productBarcode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
							</tr>
						</table>
						<button id="send2" class="btn btn-primary">Cari</button>
						</form>
					</div>
				</div>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>