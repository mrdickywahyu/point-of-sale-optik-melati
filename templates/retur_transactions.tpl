{include file="header.tpl"}

<style>
li{
	list-style: none;
}
</style>

<div class="container">
	<!-- Push Wrapper -->
	<div class="mp-pusher" id="mp-pusher">

		{include file="navigation.tpl"}

		<div class="scroller"><!-- this is for emulating position fixed of the nav -->
			<div class="scroller-inner">
				<!-- Top Navigation -->
				<div style="padding-left: 18px; padding-top: 10px;">
					
					{include file="logo.tpl"}
					
				</div>
				
				<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
  				<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
  				<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
  				<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />
				
				{literal}
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
							
							$('#defaultEntry').timeEntry({show24Hours: true});
							
							$("#productBarcode").autocomplete("product_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('productBarcode').value = myarr[0];
							});
							
							$("#searchType").change(function(e){
								var searchType = $("#searchType").val();
								
								$("#searchBox").empty(); 
								
								if (searchType == '1'){
									$('<li></li>').appendTo('#searchBox').html('<label>Nomor Retur :</label><input type="text" name="trxNo" size="28" placeholder="Nomor Retur" style="display: block; width: 245px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>').addClass('lisearch');
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
							
							$("#supplierID").autocomplete("supplier_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split("-");
								
								location.href = "retur_transactions.php?module=trx&act=add&supplierID=" + myarr[0];
							});
							
							$("#supplierIDD").autocomplete("supplier_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								var invoiceID = $("#fakturRetur").val();
								var trxID = $("#trxID").val();
								var myarr = item[0].split(" - ");
								
								location.href = "retur_transactions.php?module=trx&act=edit&supplierID=" + myarr[0] + "&invoiceReturID=" + invoiceID + "&trxID=" + trxID;
							});
							
							$("#frm_trx").submit(function(e){
								var productBarcode = $("#productBarcode").val();
								var yes = $("#yes").val();
								var invoice = $("#fakturRetur").val();
								var supplier = $("#supplierIDS").val();
								var table = $("#show");
								var table_body = table.find('tbody');
								var total = 0;
							
								$.ajax({
									type: "POST",
							        dataType: "JSON",
							        url: "save_detail_retur_trx.php",
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
											
											var total = data[1];
											var rupiah = data[2];
											
											document.getElementById('total').value = total;
											document.getElementById('rupiah').value = rupiah;
											
											$(c).appendTo(table_body);
											for (var i = 0; i < 20; i++){
												var detailID  = c[i].detailID;
												var productBarcode	= c[i].productBarcode;
												var productName    = c[i].productName;
												var detailReturPrice = c[i].detailReturPrice;
												var detailReturQty = c[i].detailReturQty;
												var detailReturSubtotal = c[i].detailReturSubtotal;
												var count   = i+1;
												
												//alert(result);
												var tblRow =
							                        "<tr valign='top'>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+count+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productBarcode+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productName+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailReturPrice+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailReturQty+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailReturSubtotal+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a href=edit_retur_transactions.php?module=trx&act=edit&detailID="+detailID+" data-width='520' data-height='320' class='various2 fancybox.iframe'><img src='images/icons/edit.png' width='20'></a><a href=retur_transactions.php?module=trx&act=delete&detailID="+detailID+"&supplierID="+supplier+"><img src='images/icons/delete.png' width='20'></td>"
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
								var invoice = $("#fakturRetur").val();
								var supplier = $("#supplierIDS").val();
								var trxID = $("#trxID").val();
								var table = $("#show");
								var table_body = table.find('tbody');
								var total = 0;
							
								$.ajax({
									type: "POST",
							        dataType: "JSON",
							        url: "save_detail_retur_trx.php",
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
											
											var total = data[1];
											var rupiah = data[2];
											
											document.getElementById('total').value = total;
											document.getElementById('rupiah').value = rupiah;
											
											$(c).appendTo(table_body);
											for (var i = 0; i < 20; i++){
												var detailID  = c[i].detailID;
												var productBarcode	= c[i].productBarcode;
												var productName    = c[i].productName;
												var detailReturPrice = c[i].detailReturPrice;
												var detailReturQty = c[i].detailReturQty;
												var detailReturSubtotal = c[i].detailReturSubtotal;
												var count   = i+1;
												
												//alert(result);
												var tblRow =
							                        "<tr valign='top'>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+count+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productBarcode+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productName+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailReturPrice+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailReturQty+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+detailReturSubtotal+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a href=edit_retur_transactions.php?module=trx&act=edit&detailID="+detailID+" data-width='520' data-height='320' class='various2 fancybox.iframe'><img src='images/icons/edit.png' width='20'></a><a href=retur_transactions.php?module=trx&act=deleteedit&detailID="+detailID+"&invoiceReturID="+invoice+"&trxID="+trxID+"&supplierID="+supplier+"><img src='images/icons/delete.png' width='20'></td>"
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
				{/literal}
				
				<!-- Top Navigation -->
				<div class="codrops-top clearfix">
					<!--<a href="#" id="trigger" class="menu-trigger">Open Menu</a>-->
					<a class="codrops-icon codrops-icon-prev" href="#" id="trigger"><span>Open Menu</span></a> |
					<a href="backup.php"><span>Backup</span></a> |
					<a href="home.php"><span>Home</span></a>
					<span class="right"><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Logout</span></a></span>
				</div>
				
				{if $module == 'trx' AND $act == 'add'}
					
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form id="frm_trx" name="frm_trx" action="save_detail_retur_trx.php" method="POST">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td style="padding-top: 15px;">Kode Produk :<br>
												<input type="text" name="productBarcode" placeholder="Masukkan kode produk disini" id="productBarcode" style="display: block; width: 244px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required autofocus>
												<input type="hidden" name="supplierIDS" size="40" id="supplierIDS" value="{$supplierCode}">
											</td>
										</tr>
										<tr>
											<td><button type="submit" class="btn btn-primary">Simpan</button></td>
										</tr>
									</table>
								</form>
							</td>
							<td width="80%" bgcolor="#389c1d" style="padding: 10px 0px 0px 10px;">
								{if $code == '5'}
									<center><p style="color: red; font-weight: bold;">ID Supplier tidak ditemukan, periksa kembali ID Supplier yang dimasukkan.</p></center>
								{/if}
								<form method="POST" action="retur_transactions.php?module=trx&act=input">
								<table>
									<tr>
										<td width="130">Nomor Retur</td>
										<td width="350">: {$fakturRetur}<input type="hidden" name="fakturRetur" size="40" id="fakturRetur" value="{$fakturRetur}"></td>
										<td width="90">ID Supplier</td>
										<td>: <input type="text" name="supplierID" size="40" id="supplierID" value="{$supplierCode}"></td>
									</tr>
									<tr>
										<td>Tanggal</td>
										<td>: {$tanggal}</td>
										<td>Nama</td>
										<td>: <input type="text" id="supplierName" name="supplierName" value="{$supplierName}" size="40"></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>Alamat</td>
										<td>: <input type="text" name="supplierAddress" id="supplierAddress" value="{$supplierAddress}" size="50"></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>HP</td>
										<td>: <input type="text" name="supplierPhone" id="supplierPhone" value="{$supplierPhone}" size="40"></td>
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
														<th width="150" style='border-left: 1px solid #CCCCCC;'>Harga Supplier</th>
														<th width="80" style='border-left: 1px solid #CCCCCC;'>Qty</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Subtotal</th>
														<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi</th>
											    	</tr>
											    <thead>
											    <tbody>
											    	{section name=dataShow loop=$dataShow}
											    	<tr valign="top">
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].no}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].productBarcode}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].productName}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].detailReturPrice}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].detailReturQty}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].detailReturSubtotal}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
											    			<a href="edit_retur_transactions.php?module=trx&act=edit&detailID={$dataShow[dataShow].detailID}" data-width="520" data-height="320" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20"></a>
											    			<a href="retur_transactions.php?module=trx&act=delete&detailID={$dataShow[dataShow].detailID}&supplierID={$supplierCode}"><img src="images/icons/delete.png" width="20"></td>
											    	</tr>
											    	{/section}
											    </tbody>
											</table>
											<table width="99%">
												<tr bgcolor="#667eac">
										    		<td width="700" rowspan="5"></td>
										    		<td><b>SUBTOTAL</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" value="{$rupiah}" name="rupiah" id="rupiah" DISABLED>
										    			<input type="hidden" value="{$total}" name="total" id="total">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td colspan="3"></td>
										    		<td><button type="submit" class="btn btn-primary" style="background-color: #ff6600;">SIMPAN RETUR</button></td>
										    	</tr>
										    </table>
										</td>
									</tr>
									</form>
								</table>
							</td>
						</tr>
					</table>
				
				{elseif $module == 'trx' AND $act == 'edit'}
					
					{literal}
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
					{/literal}
					
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form id="frm_trx2" name="frm_trx2" action="save_detail_retur_trx.php" method="POST">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td style="padding-top: 15px;">Kode Produk :<br>
												<input type="text" name="productBarcode" placeholder="Masukkan kode produk disini" id="productBarcode" style="display: block; width: 244px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required autofocus>
												<input type="hidden" name="fakturRetur" size="40" id="fakturRetur" value="{$invoiceReturID}">
												<input type="hidden" name="supplierIDS" size="40" id="supplierIDS" value="{$supplierCode}">
											</td>
										</tr>
										<tr>
											<td><button type="submit" class="btn btn-primary">Simpan</button></td>
										</tr>
									</table>
								</form>
							</td>
							<td width="80%" bgcolor="#389c1d" style="padding: 10px 0px 0px 10px;">
								<form method="POST" action="retur_transactions.php?module=trx&act=update">
								<table>
									<tr>
										<td width="130">Nomor Retur</td>
										<td width="350">: {$invoiceReturID}<input type="hidden" name="fakturRetur" size="40" id="fakturRetur" value="{$invoiceReturID}"><input type="hidden" name="trxID" size="40" id="trxID" value="{$trxID}"></td>
										<td width="90">ID Supplier</td>
										<td>: <input type="text" name="supplierIDD" size="40" id="supplierIDD" value="{$supplierCode}"></td>
									</tr>
									<tr>
										<td>Tanggal</td>
										<td>: {$trxDate}</td>
										<td>Nama</td>
										<td>: <input type="text" id="trxFullName" name="trxFullName" value="{$supplierName}" size="40"></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>Alamat</td>
										<td>: <input type="text" name="trxAddress" id="trxAddress" value="{$supplierAddress}" size="50"></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td>HP</td>
										<td>: <input type="text" name="trxPhone" id="trxPhone" value="{$supplierPhone}" size="40"></td>
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
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Harga Supplier</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Qty</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Subtotal</th>
														<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi</th>
											    	</tr>
											    <thead>
											    <tbody>
											    	{section name=dataShow loop=$dataShow}
											    	<tr valign="top">
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].no}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].productBarcode}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].productName}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].detailReturPrice}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].detailReturQty}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].detailReturSubtotal}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
											    			<a href="edit_retur_transactions.php?module=trx&act=edit&detailID={$dataShow[dataShow].detailID}" data-width="520" data-height="320" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20"></a>
											    			<a href="retur_transactions.php?module=trx&act=deleteedit&detailID={$dataShow[dataShow].detailID}&invoiceReturID={$invoiceReturID}&trxID={$trxID}&supplierID={$supplierCode}"><img src="images/icons/delete.png" width="20"></td>
											    	</tr>
											    	{/section}
											    </tbody>
											</table>
											<table width="99%">
												<tr bgcolor="#667eac">
										    		<td width="650" rowspan="5">
										    		</td>
										    		<td><b>SUBTOTAL</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" value="{$rupiah}" name="rupiah" id="rupiah" DISABLED>
										    			<input type="hidden" value="{$total}" name="total" id="total">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td colspan="3"></td>
										    		<td><button type="submit" class="btn btn-primary" style="background-color: #ff6600;">SIMPAN RETUR</button></td>
										    	</tr>
										    </table>
										</td>
									</tr>
									</form>
								</table>
							</td>
						</tr>
					</table>
				
				{elseif $module == 'trx' AND $act == 'preview'}
					
					{literal}
						<script>
							window.location.hash="no-back-button";
							window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
							window.onhashchange=function(){window.location.hash="no-back-button";}
						</script>
					{/literal}
				
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								<a href="retur_transactions.php?module=trx&act=edit&invoiceReturID={$invoiceReturID}&trxID={$trxID}"><button type="button" class="btn btn-primary">Edit Transaksi</button></a> 
								<!--<a href="print_retur_transactions.php?module=trx&act=print&invoiceReturID={$invoiceReturID}&trxID={$trxID}" target="_blank"><button type="button" class="btn btn-success">Print</button></a>-->
								{if $identityPrintRetur == '1'}
									<a onclick="finish_confirm('Transaksi retur selesai, transaksi retur baru?','retur_transactions.php?module=trx&act=finish&invoiceReturID={$invoiceReturID}&trxID={$trxID}','print_retur_transactions.php?module=trx&act=print&invoiceReturID={$invoiceReturID}&trxID={$trxID}');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>
								{else}
									<a onclick="finish_confirm('Transaksi retur selesai, transaksi retur baru?','retur_transactions.php?module=trx&act=finish&invoiceReturID={$invoiceReturID}&trxID={$trxID}','print_mini_retur_transactions.php?module=trx&act=print&invoiceReturID={$invoiceReturID}&trxID={$trxID}');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>
								{/if}
								<!--<a href="retur_transactions.php?module=trx&act=finish&invoiceReturID={$invoiceReturID}&trxID={$trxID}" onclick="return confirm('Transaksi retur selesai, transaksi retur baru?');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>-->
							</td>
						</tr>
					</table>
					<center><h3>Rincian Retur</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="400" rowspan="2" style="padding-right: 20px;"><b>{$identityName}</b> <br>
								{$identityAddress}
							</td>
							<td width="350">Supplier : <br>
								{if $supplierID != ''} {$supplierID} - {/if}
								{$trxFullName}
							</td>
						</tr>
						<tr valign="top">
							<td>{if $trxAddress != ''} {$trxAddress} {/if} </td>
						</tr>
						<tr valign="top">
							<td>Cirebon, {$trxDate}</td>
							<td>{if $trxPhone != ''} {$trxPhone} {/if}</td>
						</tr>
						<tr>
							<td colspan="2"><br>Nomor Retur : {$invoiceReturID}</td>
						</tr>
					</table>
					<table cellpadding="5" cellspacing="5" style="background-color: #FFFFFF; color: #000000; font-size: 14px;" width="850" id="show" align="center">
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
					    	{section name=dataDetail loop=$dataDetail}
					    	<tr valign="top">
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDetail[dataDetail].no}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDetail[dataDetail].productBarcode}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDetail[dataDetail].productName}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailReturPrice}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDetail[dataDetail].detailReturQty}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailReturSubtotal}</td>
					    	</tr>
					    	{/section}
					    </tbody>
					</table>
					<br>
					<table align="center" width="850">
						<tr valign="top">
							<td width="80">Total</td>
							<td>: Rp. {$trxTotal}</td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" style="border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;">Terbilang : {$terbilang}</td>
						</tr>
					</table>
				
				{elseif $module == 'trx' AND $act == 'search'}
				
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form action="retur_transactions.php" method="GET" id="search">
									<input type="hidden" name="module" value="trx">
									<input type="hidden" name="act" value="search">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td>Tipe Pencarian :<br>
												<select id="searchType" name="searchType" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value="">- Pilih Tipe Pencarian -</option>
													<option value="1">Berdasarkan Nomor Retur</option>
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
								{if $code == '5'}
									<center><p style="color: red; font-weight: bold;">ID Supplier tidak ditemukan, periksa kembali ID Supplier yang dimasukkan.</p></center>
								{/if}
								
								<span style="font-size: 20px; font-weight: bold;">Pencarian Data Retur</span><br>
								Tipe Pencarian : {$typeName}<br>
								Keyword : {$based}
								<table width="100%">
									<tr>
										<td style="padding: 10px 0px 0px 2px;">
											<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="99%">
												<thead>
											    	<tr>
											    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Nomor Retur <i class="fa fa-sort"></i></th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Grandtotal <i class="fa fa-sort"></i></th>
														<th width="60" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
											    	</tr>
											    <thead>
											    <tbody>
											    	{section name=dataTrx loop=$dataTrx}
											    	<tr class="borderedtd">
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'>{$dataTrx[dataTrx].no}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'>{$dataTrx[dataTrx].invoiceReturID}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'>{$dataTrx[dataTrx].trxFullName}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'>{$dataTrx[dataTrx].trxDate}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt; text-align: right;'>{$dataTrx[dataTrx].trxTotal}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt; text-align: center;'>
											    			<a href="retur_transactions.php?module=trx&act=previewdetail&invoiceReturID={$dataTrx[dataTrx].invoiceReturID}&trxID={$dataTrx[dataTrx].trxID}" title="Lihat Detail"><img src="images/icons/view.png" width="20">
											    			<a href="retur_transactions.php?module=trx&act=deletetrx&type={$type}&invoiceReturID={$dataTrx[dataTrx].invoiceReturID}&trxID={$dataTrx[dataTrx].trxID}&startDate={$start}&endDate={$end}&supplierID={$dataTrx[dataTrx].supplierID}" onclick="return confirm('Anda Yakin ingin menghapus retur {$dataTrx[dataTrx].invoiceReturID}? Kami menyarankan agar transaksi tidak boleh hapus!, kecuali karena kesalahan.');" title="Hapus Transaksi"><img src="images/icons/delete.png" width="20"></td>
											    	</tr>
											    	{/section}
											    </tbody>
											</table>
										</td>
									</tr>
									</form>
								</table><br>
								<div id="paging">{$pageLink}</div}
								<p>&nbsp;</p>
							</td>
						</tr>
					</table>
				
				{elseif $module == 'trx' AND $act == 'previewdetail'}
					
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								<a href="javascript:history.go(-1)"><button type="button" class="btn btn-info">Back</button></a>
								{if $identityPrintRetur == '1'}
									<a href="print_retur_transactions.php?module=trx&act=print&invoiceReturID={$invoiceReturID}&trxID={$trxID}" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								{else}
									<a href="print_mini_retur_transactions.php?module=trx&act=print&invoiceReturID={$invoiceReturID}&trxID={$trxID}" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								{/if}
							</td>
						</tr>
					</table>
					<center><h3>Rincian Retur</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="400" style="padding-right: 20px;"><b>{$identityName}</b> <br>
								{$identityAddress}
							</td>
							<td width="350">Supplier : <br>
								{if $supplierID != ''} {$supplierID} - {/if}
								{$trxFullName}
							</td>
						</tr>
						<tr valign="top">
							<td></td>
							<td>{if $trxAddress != ''} {$trxAddress} {/if} </td>
						</tr>
						<tr valign="top">
							<td>Cirebon, {$trxDate}</td>
							<td>{if $trxPhone != ''} {$trxPhone} {/if}</td>
						</tr>
						<tr>
							<td colspan="2"><br>Nomor Retur : {$invoiceReturID}</td>
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
					    	{section name=dataDetail loop=$dataDetail}
					    	<tr>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDetail[dataDetail].no}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDetail[dataDetail].productBarcode}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDetail[dataDetail].productName}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailReturPrice}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDetail[dataDetail].detailReturQty}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailReturSubtotal}</td>
					    	</tr>
					    	{/section}
					    </tbody>
					</table>
					<br>
					<table align="center" width="850">
						<tr valign="top">
							<td width="100">Subtotal</td>
							<td>: Rp. {$trxTotal}</td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" style="border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;">Terbilang : {$terbilang}</td>
						</tr>
					</table>
				
				
				{else}
					
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form action="retur_transactions.php" method="GET" id="search">
									<input type="hidden" name="module" value="trx">
									<input type="hidden" name="act" value="search">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td>Tipe Pencarian :<br>
												<select id="searchType" name="searchType" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value="">- Pilih Tipe Pencarian -</option>
													<option value="1">Berdasarkan Nomor Retur</option>
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
								{if $code == '5'}
									<center><p style="color: red; font-weight: bold;">ID Supplier tidak ditemukan, periksa kembali ID Supplier yang dimasukkan.</p></center>
								{/if}
								
								<span style="font-size: 20px; font-weight: bold;">Pencarian Data Transaksi</span><br>
								<table width="100%">
									<tr>
										<td style="padding: 10px 0px 0px 2px;">
											<p>Pada halaman ini, Anda dapat melakukan pencarian data retur berdasarkan 3 option:</p>
											<table>
											<tr valign="top">
												<td width="20">1.</td>
												<td><b>Berdasarkan Nomor Retur</b> <br>
													Dapat Anda pilih tipe pencarian pada sebelah kiri halaman, pilih option "Berdasarkan Nomor Retur", otomatis akan tampil textbox,
													silahkan masukkan nomor retur pada textbox tersebut dan lanjutkan dengan klik tombol "Search".<br><br>
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
					
				{/if}
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}