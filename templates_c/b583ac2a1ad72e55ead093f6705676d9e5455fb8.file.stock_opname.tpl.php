<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:10:09
         compiled from ".\templates\stock_opname.tpl" */ ?>
<?php /*%%SmartyHeaderCode:250805d8248d1318117-02559066%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b583ac2a1ad72e55ead093f6705676d9e5455fb8' => 
    array (
      0 => '.\\templates\\stock_opname.tpl',
      1 => 1413928451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '250805d8248d1318117-02559066',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'startDate' => 0,
    'endDate' => 0,
    'prodBarcode' => 0,
    'prodName' => 0,
    'dataSO' => 0,
    'start' => 0,
    'end' => 0,
    'periodMonth' => 0,
    'periodYear' => 0,
    'soDate' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d8248d13c0bb1_76843199',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d8248d13c0bb1_76843199')) {function content_5d8248d13c0bb1_76843199($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
				
				
					<script>
						$(document).ready(function() {
							
							$( "#soDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: 'c-0:c-0'
							});
							
							$( "#startDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: '2014:c-0'
							});
							
							$( "#endDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: '2014:c-0'
							});
							
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
							
							$(".modalbox").fancybox();
							$(".modalbox2").fancybox();
							
							$("#so").submit(function() { return false; });
							
							$("#so2").submit(function() { return false; });
							
							$("#productBarcode").autocomplete("product_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('productBarcode').value = myarr[0];
								document.getElementById('productName').value = myarr[1];
								document.getElementById('productStock').value = myarr[2];
								document.getElementById('productName2').value = myarr[1];
								document.getElementById('productStock2').value = myarr[2];
							});
							
							$("#send").on("click", function(){
								var soDate = $("#soDate").val();
								var productBarcode = $("#productBarcode").val();
								var productStock = $("#productStock2").val();
								var realStock = parseInt($("#realStock").val());
								var stok = $("#stok").val();
								var status = $("#status").val();
								var qty = parseInt($("#qty").val());
								var soDescription = $("#soDescription").val();
								
								if (soDate != '' && productBarcode != '' && productStock != '' && realStock != '' && status != '' && qty != ''){
									
									if (status == '1' && realStock < productStock){
										alert("Status selisih salah");
									}
									else if (status == '2' && productStock < realStock){
										alert("Status selisih salah");
									}
									else if (qty == '0' || realStock == '0'){
										alert("Periksa kembali penulisan stok.");
									}
									else{
										$.ajax({
											type: 'POST',
											url: 'save_stock_opname.php',
											dataType: 'JSON',
											data:{
												soDate: soDate,
												productBarcode: productBarcode,
												productStock: productStock,
												realStock: realStock,
												status: status,
												qty: qty,
												soDescription: soDescription
											},
											beforeSend: function (data) {
												$('#send').hide();
											},
											success: function(data) {
												if (data == 'NO'){
													alert("Kode produk tidak ditemukan");
												}
												else{
													setTimeout("$.fancybox.close()", 1000);
													window.location.href = "stock_opname.php?code=1";
												}
											}
										});
									}
								}
							});
							
							$("#send2").on("click", function(){
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								var productBarcode = $("#productBarcode").val();
								
								if (startDate.length != '' && endDate.length != ''){
									
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "stock_opname.php?module=stock&act=search&q=" + productBarcode + "&startDate=" + startDate + "&endDate=" + endDate;
									
								}
							});
						});
					</script>
				
				
				<?php if ($_smarty_tpl->tpl_vars['module']->value=='stock'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
					<br>
					<table width="98%" align="center">
						<tr>
							<td>
								<a href="#inline2" class="modalbox2"><button type="button" class="btn btn-primary">Cari Stock Opname</button></a>
							</td>
						</tr>
					</table>
					
					<!-- hidden inline form -->
					<div id="inline2">
						<table width="95%" align="center">
							<tr>
								<td colspan="3"><h2>Cari Stock Opname</h2></td>
							</tr>
							<tr>
								<td>
									<form id="so2" name="so2" action="#" method="POST">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="120">Periode Awal</td>
											<td width="5">:</td>
											<td><input type="text" id="startDate" name="startDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Periode Akhir</td>
											<td>:</td>
											<td><input type="text" id="endDate" name="endtDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Kode Produk</td>
											<td>:</td>
											<td><input type="text" id="productBarcode" name="productBarcode" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
									</table>
									<button id="send2" class="btn btn-primary">Cari</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Stock Opname</h3></td>
						</tr>
						<tr>
							<td>Periode : <?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
 s/d <?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
</td>
						</tr>
						<tr>
							<td>Kode Produk : <?php echo $_smarty_tpl->tpl_vars['prodBarcode']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['prodName']->value;?>
</td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="120" style='border-left: 1px solid #CCCCCC;'>Kode Produk <i class="fa fa-sort"></i></th>
											<th width="220" style='border-left: 1px solid #CCCCCC;'>Nama Produk <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Stok Prod <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Stok Nyata <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Selisih <i class="fa fa-sort"></i></th>
											<th width="220" style='border-left: 1px solid #CCCCCC;'>Keterangan <i class="fa fa-sort"></i></th>
											<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['name'] = 'dataSO';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSO']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total']);
?>
								    	<tr valign="top">
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['no'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soDate'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['productBarcode'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['productName'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['productStock'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['realStock'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['qty'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soDescription'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a href="edit_stock_opname.php?module=stock&act=edit&soID=<?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soID'];?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
&l=1" data-width="440" data-height="500" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20">
								    			<a href="stock_opname.php?module=stock&act=delete&soID=<?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soID'];?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
&l=1" onclick="return confirm('Anda Yakin ingin menghapus data stock opname <?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['productBarcode'];?>
#<?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soDate'];?>
?');"><img src="images/icons/delete.png" width="20"></td>
								    	</tr>
								    	<?php endfor; endif; ?>
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_stock_opname.php?module=stock&act=print&q=<?php echo $_smarty_tpl->tpl_vars['prodBarcode']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
" target="_blank"><button type="button" class="btn btn-warning">Print</button></a></td>
						</tr>
					</table>
					
				<?php }else{ ?>
					<br>
					<table width="98%" align="center">
						<tr>
							<td>
								<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Tambah Stock Opname</button></a>
							</td>
						</tr>
					</table>
					
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Stock Opname per <?php echo $_smarty_tpl->tpl_vars['periodMonth']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['periodYear']->value;?>
</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="120" style='border-left: 1px solid #CCCCCC;'>Kode Produk <i class="fa fa-sort"></i></th>
											<th width="220" style='border-left: 1px solid #CCCCCC;'>Nama Produk <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Stok Prod <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Stok Nyata <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Selisih <i class="fa fa-sort"></i></th>
											<th width="220" style='border-left: 1px solid #CCCCCC;'>Keterangan <i class="fa fa-sort"></i></th>
											<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['name'] = 'dataSO';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSO']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSO']['total']);
?>
								    	<tr class="borderedtd">
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['no'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soDate'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['productBarcode'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['productName'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['productStock'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['realStock'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['qty'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soDescription'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a href="edit_stock_opname.php?module=stock&act=edit&soID=<?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soID'];?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
&l=1" data-width="440" data-height="500" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20">
								    			<a href="stock_opname.php?module=stock&act=delete&soID=<?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soID'];?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
&l=1" onclick="return confirm('Anda Yakin ingin menghapus data stock opname <?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['productBarcode'];?>
#<?php echo $_smarty_tpl->tpl_vars['dataSO']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSO']['index']]['soDate'];?>
?');"><img src="images/icons/delete.png" width="20"></td>
								    	</tr>
								    	<?php endfor; endif; ?>
								    </tbody>
								</table>
							</td>
						</tr>
					</table>
					
					<!-- hidden inline form -->
					<div id="inline">
						<table width="95%" align="center">
							<tr>
								<td colspan="3"><h3>Stock Opname</h3></td>
							</tr>
							<tr>
								<td>
									<form id="so" name="so" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Tanggal</td>
											<td width="5">:</td>
											<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['soDate']->value;?>
" id="soDate" name="soDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
												<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['soDate']->value;?>
" id="soDate" name="soDate">
											</td>
										</tr>
										<tr>
											<td>Kode Produk</td>
											<td>:</td>
											<td><input type="text" id="productBarcode" name="productBarcode" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Nama Produk</td>
											<td>:</td>
											<td><input type="text" id="productName" name="productName" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
												<input type="hidden" id="productName2" name="productName2">
											</td>
										</tr>
										<tr>
											<td colspan="3"><h3>Data Opname</h3></td>
										</tr>
										<tr>
											<td>Stok Produk</td>
											<td>:</td>
											<td><input type="text" id="productStock" name="productStock" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
												<input type="hidden" id="productStock2" name="productStock2">
											</td>
										</tr>
										<tr>
											<td>Stok Nyata</td>
											<td>:</td>
											<td><input type="text" id="realStock" name="realStock" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Status Selisih</td>
											<td>:</td>
											<td>
												<select id="status" name="status" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value=""></option>
													<option value="1">Lebih</option>
													<option value="2">Kurang</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Qty Selisih</td>
											<td>:</td>
											<td><input type="text" id="qty" name="qty" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Keterangan</td>
											<td>:</td>
											<td><input type="text" maxlength="100" id="soDescription" name="soDescription" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
									</table>
									<button id="send" class="btn btn-primary">Simpan</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
				<?php }?>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>