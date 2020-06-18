<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 23:24:49
         compiled from ".\templates\buy_transactions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:289675d824ad065d7d1-76846202%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '577731cb4920bbdbc8accc95521304ff0c248170' => 
    array (
      0 => '.\\templates\\buy_transactions.tpl',
      1 => 1568823885,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '289675d824ad065d7d1-76846202',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d824ad079bbb8_55822916',
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'fakturBuy' => 0,
    'tanggal' => 0,
    'code' => 0,
    'supplierCode' => 0,
    'supplierName' => 0,
    'supplierAddress' => 0,
    'supplierPhone' => 0,
    'dataShow' => 0,
    'rupiah' => 0,
    'total' => 0,
    'invoiceBuyID' => 0,
    'trxDate' => 0,
    'trxID' => 0,
    'invoiceSupplier' => 0,
    'status' => 0,
    'trxTerminDate' => 0,
    'trxDiscount' => 0,
    'trxDP' => 0,
    'identityPrintBuy' => 0,
    'identityName' => 0,
    'identityAddress' => 0,
    'supplierID' => 0,
    'trxFullName' => 0,
    'trxAddress' => 0,
    'trxPhone' => 0,
    'trxStatus' => 0,
    'dataDetail' => 0,
    'trxSubtotal' => 0,
    'kurang' => 0,
    'trxTotal' => 0,
    'terbilang' => 0,
    'typeName' => 0,
    'based' => 0,
    'dataTrx' => 0,
    'type' => 0,
    'start' => 0,
    'end' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d824ad079bbb8_55822916')) {function content_5d824ad079bbb8_55822916($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<style>
li{
	list-style: none;
}
</style>

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
				
				<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
  				<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
  				<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
  				<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />
				
				
					<script>
						function finish_confirm(msg,urlfinish,url)
						{
							var x = confirm(msg);
							if(x == true)
							{
								window.location.href = urlfinish;
								window.open(url, '_blank');
							}
							else{
							}
						}
						
						function validatepay() {
							var subtotal = parseInt(document.forms["checkpay"]["subtotal"].value);
							var discount = parseInt(document.forms["checkpay"]["discount"].value);
							var dp = parseInt(document.forms["checkpay"]["dp"].value);
							var status = document.forms["checkpay"]["status"].value;
							var supplierID = document.forms["checkpay"]["supplierID"].value;
							
							var total = subtotal - discount;
							
							if (status == '1' && dp < total) {
								alert("Total Transaksi = " + total + ", Pembayaran kurang!");
								return false;
							}
							
							else if (status == '2' && supplierID == '') {
								alert("Masukkan kode supplier untuk pembayaran dengan termin!");
								return false;
							} 
						}
						
						function validatepay2() {
							var subtotal = parseInt(document.forms["checkpay"]["subtotal"].value);
							var discount = parseInt(document.forms["checkpay"]["discount"].value);
							var dp = parseInt(document.forms["checkpay"]["dp"].value);
							var status = document.forms["checkpay"]["status"].value;
							var supplierID = document.forms["checkpay"]["supplierIDD"].value;
							
							var total = subtotal - discount;
							
							if (status == '1' && dp < total) {
								alert("Total Transaksi = " + total + ", Pembayaran kurang!");
								return false;
							}
							
							else if (status == '2' && supplierID == '') {
								alert("Masukkan kode supplier untuk pembayaran dengan termin!");
								return false;
							} 
						}
						
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
							
							$( "#startDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: 'c-0:c+1'
							});
							
							$( "#endDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: 'c-0:c+1'
							});
							
							$( "#terminDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: 'c-0:c+1'
							});
							
							$('#defaultEntry').timeEntry({show24Hours: true});
							
							$("#productBarcode").autocomplete("product_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('productBarcode').value = myarr[0];
							});
							
							$("#status").change(function(e){
								var status = $("#status").val();
								
								$("#searchStatus").empty(); 
								
								if (status == '2'){
									
									var newinput3 = $('<input type="text" id="trxTerminDate" name="trxTerminDate" size="28" placeholder="Tanggal Jatuh Tempo" required>');
									
									newinput3.appendTo('#searchStatus').datepicker({
										changeMonth: true,
										changeYear: true,
										dateFormat: "yy-mm-dd",
										yearRange: '2014:c-0'
									});
								}
							});
							
							$("#searchType").change(function(e){
								var searchType = $("#searchType").val();
								
								$("#searchBox").empty(); 
								
								if (searchType == '1'){
									$('<li></li>').appendTo('#searchBox').html('<label>Nomor Transaksi :</label><input type="text" name="trxNo" size="28" placeholder="Nomor Pembelian" style="display: block; width: 245px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>').addClass('lisearch');
								}
								if (searchType == '2'){
								
									var newinput = $('<label>ID Supplier :</label><input type="text" name="supplierID" id="" size="28" placeholder="ID Supplier" style="display: block; width: 245px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required><br>');
									
									newinput.appendTo('#searchBox').autocomplete("supplier_autocomplete.php", {
										width: 310
									});
								}
								if (searchType == '3'){
									
									var newinput = $('<label>Periode Awal :</label><input type="text" id="start1" name="startDate" size="28" placeholder="Periode Awal" style="display: block; width: 245px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required><br>');
									var newinput2 = $('<label>Periode Akhir :</label><input type="text" id="start2" name="endDate" size="28" placeholder="Periode Akhir" style="display: block; width: 245px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>');
									
									newinput.appendTo('#searchBox').datepicker({
										changeMonth: true,
										changeYear: true,
										dateFormat: "yy-mm-dd",
										yearRange: '2014:c-0'
									});
									
									newinput2.appendTo('#searchBox').datepicker({
										changeMonth: true,
										changeYear: true,
										dateFormat: "yy-mm-dd",
										yearRange: '2014:c-0'
									});
								}
							});
							
							$("#categoryID").change(function(){
								var categoryID = $("#categoryID").val();
								
								$("#packageID").empty();
								
								$.ajax({
									type: "GET",
									dataType: "JSON",
									url: "get_packages.php",
									data:{
										categoryID: categoryID
									},
									success: function(data){
										
										var obj = JSON.stringify(data);
										eval("var c = " + obj);
										
										var foo = data.length;
										
										$(c).appendTo("#packageID");
										for (var i = 0; i < foo; i++){
											var packageID  = c[i].packageID;
											var packageName= c[i].packageName;
											var price    = c[i].price;
											
											//alert(result);
											var tblRow = "<option value=" + packageID + ">" + packageName + " - " + price + "</option>"
						                    $(tblRow).appendTo("#packageID");	
										}
									}
								});
							});
							
							$("#supplierID").autocomplete("supplier_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split("-");
								
								location.href = "buy_transactions.php?module=trx&act=add&supplierID=" + myarr[0];
							});
							
							$("#supplierIDD").autocomplete("supplier_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								var invoiceID = $("#fakturBuy").val();
								var trxID = $("#trxID").val();
								var myarr = item[0].split(" - ");
								
								location.href = "buy_transactions.php?module=trx&act=edit&supplierID=" + myarr[0] + "&invoiceBuyID=" + invoiceID + "&trxID=" + trxID;
							});
							
							$("#frm_trx").submit(function(e){
								var productBarcode = $("#productBarcode").val();
								var yes = $("#yes").val();
								var invoice = $("#fakturBuy").val();
								var table = $("#show");
								var table_body = table.find('tbody');
								var total = 0;
							
								$.ajax({
									type: "POST",
							        dataType: "JSON",
							        url: "save_detail_buy_trx.php",
							        data: {
							            productBarcode: productBarcode,
							            yes: yes,
							            invoice: invoice
						        	},
									success: function(data){
									
										if (data[0] == 'NO')
										{
											alert("Kode Produk tidak ditemukan");
										}
										else if (data[0] == 'EXIST')
										{
											alert("Produk sudah ada di transaksi, silahkan klik icon edit jika ingin melakukan perubahan transaksi");
										}
										else{
									
											$("#productBarcode").val('');
											
											table_body.empty();
											
											var obj = JSON.stringify(data[0]);
											eval("var c = " + obj);
											
											var subtotal = data[1];
											var rupiah = data[2];
											
											document.getElementById('subtotal').value = subtotal;
											document.getElementById('rupiah').value = rupiah;
											
											$(c).appendTo(table_body);
											for (var i = 0; i < 20; i++){
												var detailID  = c[i].detailID;
												var productBarcode	= c[i].productBarcode;
												var productName    = c[i].productName;
												var detailBuyPrice = c[i].detailBuyPrice;
												var detailBuyQty = c[i].detailBuyQty;
												var detailBuySubtotal = c[i].detailBuySubtotal;
												var count   = i+1;
												
												//alert(result);
												var tblRow =
							                        "<tr valign='top'>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+count+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productBarcode+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productName+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailBuyPrice+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailBuyQty+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailBuySubtotal+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a href=edit_buy_transactions.php?module=trx&act=edit&detailID="+detailID+" data-width='520' data-height='280' class='various2 fancybox.iframe'><img src='images/icons/edit.png' width='20'></a><a href=buy_transactions.php?module=trx&act=delete&detailID="+detailID+"><img src='images/icons/delete.png' width='20'></td>"
							                        +"</tr>"
							                    
							                    $(tblRow).appendTo(table_body);
							                }
										}
							        	//alert(c.state);
									},
									error: function(jqXHR, textStatus, errorThrown)
									{
									
									}
								});
								e.preventDefault();
							});
							
							$("#frm_trx2").submit(function(e){
								var productBarcode = $("#productBarcode").val();
								var yes = $("#yes").val();
								var invoice = $("#fakturBuy").val();
								var trxID = $("#trxID").val();
								var table = $("#show");
								var table_body = table.find('tbody');
								var total = 0;
							
								$.ajax({
									type: "POST",
							        dataType: "JSON",
							        url: "save_detail_buy_trx.php",
							        data: {
							            productBarcode: productBarcode,
							            yes: yes,
							            invoice: invoice
						        	},
									success: function(data){
									
										if (data[0] == 'NO')
										{
											alert("Kode Produk tidak ditemukan");
										}
										else if (data[0] == 'EXIST')
										{
											alert("Produk sudah ada di transaksi, silahkan klik icon edit jika ingin melakukan perubahan transaksi");
										}
										else{
									
											$("#productBarcode").val('');
											
											table_body.empty();
											
											var obj = JSON.stringify(data[0]);
											eval("var c = " + obj);
											
											var subtotal = data[1];
											var rupiah = data[2];
											
											document.getElementById('subtotal').value = subtotal;
											document.getElementById('rupiah').value = rupiah;
											
											$(c).appendTo(table_body);
											for (var i = 0; i < 20; i++){
												var detailID  = c[i].detailID;
												var productBarcode	= c[i].productBarcode;
												var productName    = c[i].productName;
												var detailBuyPrice = c[i].detailBuyPrice;
												var detailBuyQty = c[i].detailBuyQty;
												var detailBuySubtotal = c[i].detailBuySubtotal;
												var count   = i+1;
												
												//alert(result);
												var tblRow =
							                        "<tr valign='top'>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+count+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productBarcode+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productName+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailBuyPrice+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailBuyQty+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailBuySubtotal+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a href=edit_buy_transactions.php?module=trx&act=edit&detailID="+detailID+" data-width='520' data-height='340' class='various2 fancybox.iframe'><img src='images/icons/edit.png' width='20'></a><a href=buy_transactions.php?module=trx&act=deleteedit&detailID="+detailID+"&invoiceBuyID="+invoice+"&trxID="+trxID+"><img src='images/icons/delete.png' width='20'></td>"
							                        +"</tr>"
							                    
							                    $(tblRow).appendTo(table_body);
							                }
										}
							        	//alert(c.state);
									},
									error: function(jqXHR, textStatus, errorThrown)
									{
									
									}
								});
								e.preventDefault();
							});
						});
					</script>	
				
				
				<!-- Top Navigation -->
				<div class="codrops-top clearfix">
					<!--<a href="#" id="trigger" class="menu-trigger">Open Menu</a>-->
					<a class="codrops-icon codrops-icon-prev" href="#" id="trigger"><span>Open Menu</span></a> |
					<a href="backup.php"><span>Backup</span></a> |
					<a href="home.php"><span>Home</span></a>
					<span class="right"><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Logout</span></a></span>
				</div>
				
				<?php if ($_smarty_tpl->tpl_vars['module']->value=='trx'&&$_smarty_tpl->tpl_vars['act']->value=='add'){?>
					
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form id="frm_trx" name="frm_trx" action="save_detail_buy_trx.php" method="POST">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="130">
												Nomor Pembelian : <?php echo $_smarty_tpl->tpl_vars['fakturBuy']->value;?>
 <br><br>
												Tanggal : <?php echo $_smarty_tpl->tpl_vars['tanggal']->value;?>

											</td>
										</tr>
										<tr>
											<td style="padding-top: 15px;">Kode Produk :<br>
												<input type="text" name="productBarcode" placeholder="Masukkan kode produk disini" id="productBarcode" style="display: block; width: 244px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required autofocus>
											</td>
										</tr>
										<tr>
											<td><button type="submit" class="btn btn-primary">Simpan</button></td>
										</tr>
									</table>
								</form>
							</td>
							<td width="80%" bgcolor="#389c1d" style="padding: 10px 0px 0px 10px;">
								<?php if ($_smarty_tpl->tpl_vars['code']->value=='5'){?>
									<center><p style="color: red; font-weight: bold;">ID Supplier tidak ditemukan, periksa kembali ID Supplier yang dimasukkan.</p></center>
								<?php }?>
								<form method="POST" action="buy_transactions.php?module=trx&act=input" onsubmit="return validatepay(this)" name="checkpay">
								<input type="hidden" name="fakturBuy" size="40" id="fakturBuy" value="<?php echo $_smarty_tpl->tpl_vars['fakturBuy']->value;?>
">
								<table>
									<tr>
										<td width="110">ID Supplier</td>
										<td width="360">: <input type="text" name="supplierID" size="40" id="supplierID" value="<?php echo $_smarty_tpl->tpl_vars['supplierCode']->value;?>
"></td>
										<td width="130">Faktur (Supplier)</td>
										<td>: <input type="text" id="invoiceSupplier" name="invoiceSupplier" size="40"></td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>: <input type="text" id="supplierName" name="supplierName" value="<?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
" size="40"></td>
										<td>Status Transaksi</td>
										<td>: 
											<select name="status" id="status" required>
												<option value=""></option>
												<option value="1" SELECTED>Cash</option>
												<option value="2">Termin</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>: <input type="text" name="supplierAddress" id="supplierAddress" value="<?php echo $_smarty_tpl->tpl_vars['supplierAddress']->value;?>
" size="40"></td>
										<td></td>
										<td><div id="searchStatus"></div></td>
									</tr>
									<tr>
										<td>HP</td>
										<td>: <input type="text" name="supplierPhone" id="supplierPhone" value="<?php echo $_smarty_tpl->tpl_vars['supplierPhone']->value;?>
" size="40"></td>
										<td></td>
										<td></td>
									</tr>
								</table>
								
								<table width="100%">
									<tr>
										<td style="padding: 10px 0px 0px 2px;">
											<table cellpadding="5" cellspacing="5" style="background-color: #FFFFFF; color: #000000; font-size: 14px;" width="99%" id="show">
												<thead>
											    	<tr>
											    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No</th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
														<th width="280" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
														<th width="150" style='border-left: 1px solid #CCCCCC;'>Harga Beli Satuan</th>
														<th width="80" style='border-left: 1px solid #CCCCCC;'>Qty</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Subtotal</th>
														<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi</th>
											    	</tr>
											    <thead>
											    <tbody>
											    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['name'] = 'dataShow';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataShow']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total']);
?>
											    	<tr valign="top">
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['no'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['productBarcode'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['productName'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailBuyPrice'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailBuyQty'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailBuySubtotal'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
											    			<a href="edit_buy_transactions.php?module=trx&act=edit&detailID=<?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailID'];?>
" data-width="520" data-height="280" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20"></a>
											    			<a href="buy_transactions.php?module=trx&act=delete&detailID=<?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailID'];?>
"><img src="images/icons/delete.png" width="20"></td>
											    	</tr>
											    	<?php endfor; endif; ?>
											    </tbody>
											</table>
											<table width="99%">
												<tr bgcolor="#667eac">
										    		<td width="700" rowspan="5">
										    		</td>
										    		<td><b>SUBTOTAL</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['rupiah']->value;?>
" name="rupiah" id="rupiah" DISABLED>
										    			<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" name="subtotal" id="subtotal">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>DISCOUNT</b></td>
										    		<td>:</td>
										    		<td colspan="2">
										    			<input type="text" name="discount" id="discount" value="0" name="discount" required>
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>TITIP BAYAR</b></td>
										    		<td>:</td>
										    		<td colspan="2">
										    			<input type="text" name="dp" id="dp" required>
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td colspan="3"></td>
										    		<td><button type="submit" class="btn btn-primary" style="background-color: #ff6600;">SIMPAN PEMBELIAN</button></td>
										    	</tr>
										    </table>
										</td>
									</tr>
									</form>
								</table>
							</td>
						</tr>
					</table>
				
				<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='trx'&&$_smarty_tpl->tpl_vars['act']->value=='edit'){?>
					
					
						<script>
							window.location.hash="no-back-button";
							window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
							window.onhashchange=function(){window.location.hash="no-back-button";}
							
							document.onkeydown = function (e) {
								if (e.keyCode === 116) {
									return false;
								}
							};
						</script>
					
					
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form id="frm_trx2" name="frm_trx2" action="save_detail_buy_trx.php" method="POST">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td>Nomor Pembelian : <?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
 <br><br> Tanggal : <?php echo $_smarty_tpl->tpl_vars['trxDate']->value;?>
</td>
										</tr>
										<tr>
											<td style="padding-top: 15px;">Kode Produk :<br>
												<input type="text" name="productBarcode" placeholder="Masukkan kode produk disini" id="productBarcode" style="display: block; width: 244px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required autofocus>
												<input type="hidden" name="fakturBuy" size="40" id="fakturBuy" value="<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
">
											</td>
										</tr>
										<tr>
											<td><button type="submit" class="btn btn-primary">Simpan</button></td>
										</tr>
									</table>
								</form>
							</td>
							<td width="80%" bgcolor="#389c1d" style="padding: 10px 0px 0px 10px;">
								<form method="POST" action="buy_transactions.php?module=trx&act=update" onsubmit="return validatepay2(this)" name="checkpay">
								<input type="hidden" name="fakturBuy" size="40" id="fakturBuy" value="<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
"><input type="hidden" name="trxID" size="40" id="trxID" value="<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
">
								<table>
									<tr>
										<td width="110">ID Supplier</td>
										<td width="360">: <input type="text" name="supplierIDD" size="40" id="supplierIDD" value="<?php echo $_smarty_tpl->tpl_vars['supplierCode']->value;?>
"></td>
										<td width="130">Faktur (Supplier)</td>
										<td>: <input type="text" id="invoiceSupplier" name="invoiceSupplier" size="40" value="<?php echo $_smarty_tpl->tpl_vars['invoiceSupplier']->value;?>
"></td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>: <input type="text" id="trxFullName" name="trxFullName" value="<?php echo $_smarty_tpl->tpl_vars['supplierName']->value;?>
" size="40"></td>
										<td>Status</td>
										<td>:
											<select name="status" id="status" required>
												<option value=""></option>
												<option value="1" <?php if ($_smarty_tpl->tpl_vars['status']->value=='1'){?> SELECTED <?php }?>>Cash</option>
												<option value="2" <?php if ($_smarty_tpl->tpl_vars['status']->value=='2'){?> SELECTED <?php }?>>Termin</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>: <input type="text" name="trxAddress" id="trxAddress" value="<?php echo $_smarty_tpl->tpl_vars['supplierAddress']->value;?>
" size="40"></td>
										<td></td>
										<td><div id="searchStatus"><?php if ($_smarty_tpl->tpl_vars['status']->value=='2'){?> <input type="text" name="trxTerminDate" size="20" id="terminDate" value="<?php echo $_smarty_tpl->tpl_vars['trxTerminDate']->value;?>
"> <?php }?></div></td>
									</tr>
									<tr>
										<td>HP</td>
										<td>: <input type="text" name="trxPhone" id="trxPhone" value="<?php echo $_smarty_tpl->tpl_vars['supplierPhone']->value;?>
" size="40"></td>
										<td></td>
										<td></td>
									</tr>
								</table>
								
								<table width="100%">
									<tr>
										<td style="padding: 10px 0px 0px 2px;">
											<table cellpadding="5" cellspacing="5" style="background-color: #FFFFFF; color: #000000; font-size: 14px;" width="99%" id="show">
												<thead>
											    	<tr>
											    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No</th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
														<th width="280" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Harga Satuan</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Qty</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Subtotal</th>
														<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi</th>
											    	</tr>
											    <thead>
											    <tbody>
											    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['name'] = 'dataShow';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataShow']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataShow']['total']);
?>
											    	<tr valign="top">
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['no'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['productBarcode'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['productName'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailBuyPrice'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailBuyQty'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailBuySubtotal'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
											    			<a href="edit_buy_transactions.php?module=trx&act=edit&detailID=<?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailID'];?>
" data-width="520" data-height="340" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20"></a>
											    			<a href="buy_transactions.php?module=trx&act=deleteedit&detailID=<?php echo $_smarty_tpl->tpl_vars['dataShow']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataShow']['index']]['detailID'];?>
&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
"><img src="images/icons/delete.png" width="20"></td>
											    	</tr>
											    	<?php endfor; endif; ?>
											    </tbody>
											</table>
											<table width="99%">
												<tr bgcolor="#667eac">
										    		<td width="700" rowspan="5">
										    		</td>
										    		<td><b>SUBTOTAL</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['rupiah']->value;?>
" name="rupiah" id="rupiah" DISABLED>
										    			<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
" name="subtotal" id="subtotal">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>DISCOUNT</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" name="discount" id="discount" value="<?php echo $_smarty_tpl->tpl_vars['trxDiscount']->value;?>
" name="discount" required>
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>TITIP BAYAR</b></td>
										    		<td>:</td>
										    		<td colspan="2">
										    			<input type="text" name="dp" id="dp" value="<?php echo $_smarty_tpl->tpl_vars['trxDP']->value;?>
" required>
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td colspan="3"></td>
										    		<td><button type="submit" class="btn btn-primary" style="background-color: #ff6600;">SIMPAN PEMBELIAN</button></td>
										    	</tr>
										    </table>
										</td>
									</tr>
									</form>
								</table>
							</td>
						</tr>
					</table>
				
				<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='trx'&&$_smarty_tpl->tpl_vars['act']->value=='preview'){?>
					
					
						<script>
							window.location.hash="no-back-button";
							window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
							window.onhashchange=function(){window.location.hash="no-back-button";}
						</script>
					
				
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								<a href="buy_transactions.php?module=trx&act=edit&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
"><button type="button" class="btn btn-primary">Edit Transaksi</button></a> 
								<!--<a href="print_buy_transactions.php?module=trx&act=print&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
" target="_blank"><button type="button" class="btn btn-success">Print</button></a>-->
								<?php if ($_smarty_tpl->tpl_vars['identityPrintBuy']->value=='1'){?>
									<a onclick="finish_confirm('Transaksi pembelian selesai, transaksi pembelian baru?','buy_transactions.php?module=trx&act=finish&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
','print_buy_transactions.php?module=trx&act=print&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>
								<?php }else{ ?>
									<a onclick="finish_confirm('Transaksi pembelian selesai, transaksi pembelian baru?','buy_transactions.php?module=trx&act=finish&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
','print_mini_buy_transactions.php?module=trx&act=print&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>
								<?php }?>
								<!--<a href="" onclick="return confirm('');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>-->
								<a href="buy_transactions.php?module=trx&act=cancel&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
" onclick="return confirm('Anda Yakin ingin membatalkan transaksi ini?');"><button type="button" class="btn btn-danger">Batal</button></a>
							</td>
						</tr>
					</table>
					<center><h3>Rincian Transaksi Pembelian</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="400" rowspan="2" style="padding-right: 20px;"><b><?php echo $_smarty_tpl->tpl_vars['identityName']->value;?>
</b> <br>
								<?php echo $_smarty_tpl->tpl_vars['identityAddress']->value;?>

							</td>
							<td width="350">Supplier : <br>
								<?php if ($_smarty_tpl->tpl_vars['invoiceSupplier']->value!=''){?> ID#<?php echo $_smarty_tpl->tpl_vars['invoiceSupplier']->value;?>
 <br><?php }?>
								<?php if ($_smarty_tpl->tpl_vars['supplierID']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
 - <?php }?>
								<?php echo $_smarty_tpl->tpl_vars['trxFullName']->value;?>

							</td>
						</tr>
						<tr valign="top">
							<td><?php if ($_smarty_tpl->tpl_vars['trxAddress']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['trxAddress']->value;?>
 <?php }?> </td>
						</tr>
						<tr valign="top">
							<td>Teluk Kuantan, <?php echo $_smarty_tpl->tpl_vars['trxDate']->value;?>
</td>
							<td><?php if ($_smarty_tpl->tpl_vars['trxPhone']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['trxPhone']->value;?>
 <?php }?></td>
						</tr>
						<tr>
							<td colspan="2"><br>Nomor Pembelian : <?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
 / Type : <?php if ($_smarty_tpl->tpl_vars['trxStatus']->value=='2'){?> <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['trxTerminDate']->value;?>
 <?php }else{ ?> <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 <?php }?></td>
						</tr>
					</table>
					<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="850" align="center">
						<thead>
					    	<tr>
					    		<th width="25" style='border-left: 1px solid #CCCCCC;'>No</th>
								<th width="120" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
								<th width="255" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
								<th width="130" style='border-left: 1px solid #CCCCCC;'>Harga Beli Satuan</th>
								<th width="50" style='border-left: 1px solid #CCCCCC;'>Qty</th>
								<th width="100" style='border-left: 1px solid #CCCCCC;'>Subtotal</th>
					    	</tr>
					    <thead>
					    <tbody>
					    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['name'] = 'dataDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total']);
?>
					    	<tr>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productBarcode'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailBuyPrice'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailBuyQty'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailBuySubtotal'];?>
</td>
					    	</tr>
					    	<?php endfor; endif; ?>
					    </tbody>
					</table>
					<br>
					<table align="center" width="850">
						<tr valign="top">
							<td width="100">Subtotal</td>
							<td width="200">: Rp. <?php echo $_smarty_tpl->tpl_vars['trxSubtotal']->value;?>
</td>
							<td width="100">Titip Bayar</td>
							<td>: Rp. <?php echo $_smarty_tpl->tpl_vars['trxDP']->value;?>
</td>
						</tr>
						<tr valign="top">
							<td>Diskon</td>
							<td>: Rp. <?php echo $_smarty_tpl->tpl_vars['trxDiscount']->value;?>
</td>
							<td>Kurang</td>
							<td>: Rp. <?php echo $_smarty_tpl->tpl_vars['kurang']->value;?>
</td>
						</tr>
						<tr valign="top">
							<td><b>Grandtotal</b></td>
							<td><b>: Rp. <?php echo $_smarty_tpl->tpl_vars['trxTotal']->value;?>
</b></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" style="border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;">Terbilang : <?php echo $_smarty_tpl->tpl_vars['terbilang']->value;?>
</td>
						</tr>
					</table>
				
				<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='trx'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
				
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form action="buy_transactions.php" method="GET" id="search">
									<input type="hidden" name="module" value="trx">
									<input type="hidden" name="act" value="search">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td>Tipe Pencarian :<br>
												<select id="searchType" name="searchType" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value="">- Pilih Tipe Pencarian -</option>
													<option value="1">Berdasarkan Nomor Faktur</option>
													<option value="2">Berdasarkan ID Supplier</option>
													<option value="3">Berdasarkan Periode</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>
												<div id="searchBox">
													<li class="lisearch"></li>
												</div>
											</td>
										</tr>
										<tr>
											<td><button type="submit" class="btn btn-primary">Search</button></td>
										</tr>
									</table>
								</form>
							</td>
							<td width="80%" bgcolor="#389c1d" style="padding: 10px 0px 0px 10px;">
								<?php if ($_smarty_tpl->tpl_vars['code']->value=='5'){?>
									<center><p style="color: red; font-weight: bold;">ID Supplier tidak ditemukan, periksa kembali ID Supplier yang dimasukkan.</p></center>
								<?php }?>
								
								<span style="font-size: 20px; font-weight: bold;">Pencarian Data Transaksi</span><br>
								Tipe Pencarian : <?php echo $_smarty_tpl->tpl_vars['typeName']->value;?>
<br>
								Keyword : <?php echo $_smarty_tpl->tpl_vars['based']->value;?>

								<table width="100%">
									<tr>
										<td style="padding: 10px 0px 0px 2px;">
											<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="99%">
												<thead>
											    	<tr>
											    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Nomor Transaksi <i class="fa fa-sort"></i></th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Grandtotal <i class="fa fa-sort"></i></th>
														<th width="60" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
											    	</tr>
											    <thead>
											    <tbody>
											    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['name'] = 'dataTrx';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataTrx']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataTrx']['total']);
?>
											    	<tr class="borderedtd">
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'><?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['no'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'><?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['invoiceBuyID'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'><?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['trxFullName'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'><?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['trxDate'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['trxTotal'];?>
</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt; text-align: center;'>
											    			<a href="buy_transactions.php?module=trx&act=previewdetail&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['invoiceBuyID'];?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['trxID'];?>
" title="Lihat Detail"><img src="images/icons/view.png" width="20">
											    			<a href="buy_transactions.php?module=trx&act=deletetrx&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['invoiceBuyID'];?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['trxID'];?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
&supplierID=<?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['supplierID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus pembelian <?php echo $_smarty_tpl->tpl_vars['dataTrx']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataTrx']['index']]['invoiceBuyID'];?>
? Kami menyarankan agar transaksi tidak boleh hapus!');" title="Hapus Transaksi"><img src="images/icons/delete.png" width="20"></td>
											    	</tr>
											    	<?php endfor; endif; ?>
											    </tbody>
											</table>
										</td>
									</tr>
									</form>
								</table><br>
								<div id="paging"><?php echo $_smarty_tpl->tpl_vars['pageLink']->value;?>
</div}
								<p>&nbsp;</p>
							</td>
						</tr>
					</table>
				
				<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='trx'&&$_smarty_tpl->tpl_vars['act']->value=='previewdetail'){?>
					
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								<a href="javascript:history.go(-1)"><button type="button" class="btn btn-info">Back</button></a>
								<?php if ($_smarty_tpl->tpl_vars['identityPrintBuy']->value=='1'){?>
									<a href="print_buy_transactions.php?module=trx&act=print&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								<?php }else{ ?>
									<a href="print_mini_buy_transactions.php?module=trx&act=print&invoiceBuyID=<?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
&trxID=<?php echo $_smarty_tpl->tpl_vars['trxID']->value;?>
" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								<?php }?>
							</td>
						</tr>
					</table>
					<center><h3>Rincian Transaksi</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="400" style="padding-right: 20px;" rowspan="2"><b><?php echo $_smarty_tpl->tpl_vars['identityName']->value;?>
</b> <br>
								<?php echo $_smarty_tpl->tpl_vars['identityAddress']->value;?>

							</td>
							<td width="350">Supplier : <br>
								<?php if ($_smarty_tpl->tpl_vars['invoiceSupplier']->value!=''){?> #<?php echo $_smarty_tpl->tpl_vars['invoiceSupplier']->value;?>
 <?php }?><br>
								<?php if ($_smarty_tpl->tpl_vars['supplierID']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
 - <?php }?>
								<?php echo $_smarty_tpl->tpl_vars['trxFullName']->value;?>

							</td>
						</tr>
						<tr valign="top">
							<td><?php if ($_smarty_tpl->tpl_vars['trxAddress']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['trxAddress']->value;?>
 <?php }?> </td>
						</tr>
						<tr valign="top">
							<td>Teluk Kuantan, <?php echo $_smarty_tpl->tpl_vars['trxDate']->value;?>
</td>
							<td><?php if ($_smarty_tpl->tpl_vars['trxPhone']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['trxPhone']->value;?>
 <?php }?></td>
						</tr>
						<tr>
							<td colspan="2"><br>Nomor Pembelian : <?php echo $_smarty_tpl->tpl_vars['invoiceBuyID']->value;?>
 / Type : <?php if ($_smarty_tpl->tpl_vars['trxStatus']->value=='2'){?> <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['trxTerminDate']->value;?>
 <?php }else{ ?> <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 <?php }?></td>
						</tr>
					</table>
					<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="850" align="center">
						<thead>
					    	<tr>
					    		<th width="25" style='border-left: 1px solid #CCCCCC;'>No</th>
								<th width="120" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
								<th width="255" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
								<th width="130" style='border-left: 1px solid #CCCCCC;'>Harga Beli Satuan</th>
								<th width="50" style='border-left: 1px solid #CCCCCC;'>Qty</th>
								<th width="100" style='border-left: 1px solid #CCCCCC;'>Subtotal</th>
					    	</tr>
					    <thead>
					    <tbody>
					    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['name'] = 'dataDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total']);
?>
					    	<tr valign="top">
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productBarcode'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailBuyPrice'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailBuyQty'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailBuySubtotal'];?>
</td>
					    	</tr>
					    	<?php endfor; endif; ?>
					    </tbody>
					</table>
					<br>
					<table align="center" width="850">
						<tr valign="top">
							<td width="100">Subtotal</td>
							<td wudth="200">: Rp. <?php echo $_smarty_tpl->tpl_vars['trxSubtotal']->value;?>
</td>
							<td width="100">Titip Bayar</td>
							<td width="450">: Rp. <?php echo $_smarty_tpl->tpl_vars['trxDP']->value;?>
</td>
						</tr>
						<tr valign="top">
							<td>Diskon</td>
							<td>: Rp. <?php echo $_smarty_tpl->tpl_vars['trxDiscount']->value;?>
</td>
							<td>Kurang</td>
							<td>: Rp. <?php echo $_smarty_tpl->tpl_vars['kurang']->value;?>
</td>
						</tr>
						<tr valign="top">
							<td><b>Grandtotal</b></td>
							<td><b>: Rp. <?php echo $_smarty_tpl->tpl_vars['trxTotal']->value;?>
</b></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" style="border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;">Terbilang : <?php echo $_smarty_tpl->tpl_vars['terbilang']->value;?>
</td>
						</tr>
					</table>
				
				
				<?php }else{ ?>
					
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form action="buy_transactions.php" method="GET" id="search">
									<input type="hidden" name="module" value="trx">
									<input type="hidden" name="act" value="search">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td>Tipe Pencarian :<br>
												<select id="searchType" name="searchType" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value="">- Pilih Tipe Pencarian -</option>
													<option value="1">Berdasarkan Nomor Pembelian</option>
													<option value="2">Berdasarkan ID Supplier</option>
													<option value="3">Berdasarkan Periode</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>
												<div id="searchBox">
													<li class="lisearch"></li>
												</div>
											</td>
										</tr>
										<tr>
											<td><button type="submit" class="btn btn-primary">Search</button></td>
										</tr>
									</table>
								</form>
							</td>
							<td width="80%" bgcolor="#389c1d" style="padding: 10px 0px 0px 10px;">
								<?php if ($_smarty_tpl->tpl_vars['code']->value=='5'){?>
									<center><p style="color: red; font-weight: bold;">ID Supplier tidak ditemukan, periksa kembali ID Supplier yang dimasukkan.</p></center>
								<?php }?>
								
								<span style="font-size: 20px; font-weight: bold;">Pencarian Data Transaksi</span><br>
								<table width="100%">
									<tr>
										<td style="padding: 10px 0px 0px 2px;">
											<p>Pada halaman ini, Anda dapat melakukan pencarian data transaksi berdasarkan 3 option:</p>
											<table>
											<tr valign="top">
												<td width="20">1.</td>
												<td><b>Berdasarkan Nomor Pembelian</b> <br>
													Dapat Anda pilih tipe pencarian pada sebelah kiri halaman, pilih option "Berdasarkan Nomor Pembelian", otomatis akan tampil textbox,
													silahkan masukkan nomor pembelian pada textbox tersebut dan lanjutkan dengan klik tombol "Search".<br><br>
												</td>
											</tr>
											<tr valign="top">
												<td width="20">2.</td>
												<td><b>Berdasarkan ID Supplier</b> <br>
													Dapat Anda pilih tipe pencarian pada sebelah kiri halaman, pilih option "Berdasarkan ID Supplier", otomatis akan tampil textbox,
													silahkan masukkan ID Supplier pada textbox tersebut dan lanjutkan dengan klik tombol "Search".<br><br>
												</td>
											</tr>
											<tr valign="top">
												<td width="20">3.</td>
												<td><b>Berdasarkan Periode</b> <br>
													Dapat Anda pilih tipe pencarian pada sebelah kiri halaman, pilih option "Berdasarkan Periode", otomatis akan tampil textbox periode awal dan periode akhir,
													silahkan masukkan periode awal dan periode akhir pada textbox tersebut dan lanjutkan dengan klik tombol "Search".
												</td>
											</tr>
											</table>
											
										</td>
									</tr>
									</form>
								</table>
								<p>&nbsp;</p>
							</td>
						</tr>
					</table>
					
				<?php }?>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>