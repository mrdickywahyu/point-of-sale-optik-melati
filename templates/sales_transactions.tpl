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
						
						function validatepay() {
							var grandtotal = parseInt(document.forms["checkpay"]["grandtotal"].value);
							var dp = parseInt(document.forms["checkpay"]["dp"].value);
							var status = document.forms["checkpay"]["status"].value;
							var memberID = document.forms["checkpay"]["memberID"].value;
							
							var total = grandtotal;
							
							if (status == '1' && dp < total) {
								alert("Total Transaksi = " + total + ", Pembayaran kurang!");
								return false;
							}
							
							else if (status == '3' && memberID == '') {
								alert("Masukkan kode member untuk pembayaran dengan termin!");
								return false;
							} 
						}
						
						function validatepay2() {
							var grandtotal = parseInt(document.forms["checkpay"]["grandtotal"].value);
							var dp = parseInt(document.forms["checkpay"]["dp"].value);
							var status = document.forms["checkpay"]["status"].value;
							var memberID = document.forms["checkpay"]["memberIDD"].value;
							
							var total = grandtotal;
							
							if (status == '1' && dp < total) {
								alert("Total Transaksi = " + total + ", Pembayaran kurang!");
								return false;
							}
							
							else if (status == '3' && memberID == '') {
								alert("Masukkan kode member untuk pembayaran dengan termin!");
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
							
							$("#searchType").change(function(e){
								var searchType = $("#searchType").val();
								
								$("#searchBox").empty(); 
								
								if (searchType == '1'){
									$('<li></li>').appendTo('#searchBox').html('<label>Nomor Transaksi :</label><input type="text" name="trxNo" size="28" placeholder="Nomor Transaksi" style="display: block; width: 245px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>').addClass('lisearch');
								}
								if (searchType == '2'){
								
									var newinput = $('<label>ID Member :</label><input type="text" name="memberID" id="memberID" size="28" placeholder="ID Member" style="display: block; width: 245px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required><br>');
									
									newinput.appendTo('#searchBox').autocomplete("member_autocomplete.php", {
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
							
							$("#status").change(function(e){
								var status = $("#status").val();
								
								$("#searchStatus").empty(); 
								
								if (status == '3'){
									
									var newinput3 = $('<input type="text" id="trxTerminDate" name="trxTerminDate" size="28" placeholder="Tanggal Jatuh Tempo" required>');
									
									newinput3.appendTo('#searchStatus').datepicker({
										changeMonth: true,
										changeYear: true,
										dateFormat: "yy-mm-dd",
										yearRange: '2014:c-0'
									});
								}
							});
							
							$("#memberID").autocomplete("member_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split("-");
								
								location.href = "sales_transactions.php?module=trx&act=add&memberID=" + myarr[0];
							});
							
							$("#memberIDD").autocomplete("member_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								var invoiceID = $("#faktur").val();
								var trxID = $("#trxID").val();
								var myarr = item[0].split(" - ");
								
								location.href = "sales_transactions.php?module=trx&act=edit&memberID=" + myarr[0] + "&invoiceID=" + invoiceID + "&trxID=" + trxID;
							});
							
							$("#frm_trx").submit(function(e){
								var productBarcode = $("#productBarcode").val();
								var memberID = $("#memberID").val();
								var yes = $("#yes").val();
								var invoice = $("#faktur").val();
								var table = $("#show");
								var table_body = table.find('tbody');
								var total = 0;
							
								$.ajax({
									type: "POST",
							        dataType: "JSON",
							        url: "save_detail_trx.php",
							        data: {
							            productBarcode: productBarcode,
							            yes: yes,
							            invoice: invoice
						        	},
									success: function(data){
									
										if (data[0] == 'ERROR')
										{
											alert("Jumlah Stok tidak cukup");
										}
										else if (data[0] == 'NO')
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
											var modal = data[3];
											var ppn = data[4];
											var ppnrupiah = data[5];
											var grandtotal = data[6];
											var grandtotalrupiah = data[7];
											var discTotal = data[8];
											var discTotalRupiah = data[9];
											
											document.getElementById('subtotal').value = subtotal;
											document.getElementById('rupiah').value = rupiah;
											document.getElementById('trxModal').value = modal;
											document.getElementById('ppn').value = ppn;
											document.getElementById('ppnrupiah').value = ppnrupiah;
											document.getElementById('grandtotal').value = grandtotal;
											document.getElementById('grandtotalrupiah').value = grandtotalrupiah;
											document.getElementById('discTotal').value = discTotal;
											document.getElementById('discTotalRupiah').value = discTotalRupiah;
											
											$(c).appendTo(table_body);
											for (var i = 0; i < 20; i++){
												var detailID  = c[i].detailID;
												var productBarcode	= c[i].productBarcode;
												var productName    = c[i].productName;
												var detailPrice = c[i].detailPrice;
												var detailQty = c[i].detailQty;
												var discPercent = c[i].discPercent;
												var detailSubtotal = c[i].detailSubtotal;
												var count   = i+1;
												
												//alert(result);
												var tblRow =
							                        "<tr valign='top'>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+count+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productBarcode+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productName+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>"+detailPrice+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>"+detailQty+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>"+discPercent+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>"+detailSubtotal+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a title='Edit' href=edit_sales_transactions.php?module=trx&act=edit&detailID="+detailID+" data-width='550' data-height='300' class='various2 fancybox.iframe'><img src='images/icons/edit.png' width='18'></a><a title='Hapus' href=sales_transactions.php?module=trx&act=delete&detailID="+detailID+"&memberID="+memberID+"><img src='images/icons/delete.png' width='18'></td>"
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
								var invoice = $("#faktur").val();
								var trxID = $("#trxID").val();
								var table = $("#show");
								var table_body = table.find('tbody');
								var total = 0;
							
								$.ajax({
									type: "POST",
							        dataType: "JSON",
							        url: "save_detail_trx.php",
							        data: {
							            productBarcode: productBarcode,
							            yes: yes,
							            invoice: invoice
						        	},
									success: function(data){
									
										if (data[0] == 'ERROR')
										{
											alert("Jumlah Stok tidak cukup");
										}
										else if (data[0] == 'NO')
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
											var modal = data[3];
											var ppn = data[4];
											var ppnrupiah = data[5];
											var grandtotal = data[6];
											var grandtotalrupiah = data[7];
											var discTotal = data[8];
											var discTotalRupiah = data[9];
											
											document.getElementById('subtotal').value = subtotal;
											document.getElementById('rupiah').value = rupiah;
											document.getElementById('trxModal').value = modal;
											document.getElementById('ppn').value = ppn;
											document.getElementById('ppnrupiah').value = ppnrupiah;
											document.getElementById('grandtotal').value = grandtotal;
											document.getElementById('grandtotalrupiah').value = grandtotalrupiah;
											document.getElementById('discTotal').value = discTotal;
											document.getElementById('discTotalRupiah').value = discTotalRupiah;
											
											$(c).appendTo(table_body);
											for (var i = 0; i < 20; i++){
												var detailID  = c[i].detailID;
												var productBarcode	= c[i].productBarcode;
												var productName    = c[i].productName;
												var detailPrice = c[i].detailPrice;
												var detailQty = c[i].detailQty;
												var detailSubtotal = c[i].detailSubtotal;
												var discPercent = c[i].discPercent;
												var count   = i+1;
												
												//alert(result);
												var tblRow =
							                        "<tr valign='top'>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+count+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productBarcode+"</td>"	
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>"+productName+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>"+detailPrice+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>"+detailQty+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>"+discPercent+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>"+detailSubtotal+"</td>"
							                          +"<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a title='Edit' href=edit_sales_transactions.php?module=trx&act=edit&detailID="+detailID+" data-width='550' data-height='300' class='various2 fancybox.iframe'><img src='images/icons/edit.png' width='18'></a><a title='Hapus' href=sales_transactions.php?module=trx&act=deleteedit&detailID="+detailID+"&invoiceID="+ invoice + "&trxID=" + trxID +"&pending=" + yes + "><img src='images/icons/delete.png' width='18'></td>"
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
								<form id="frm_trx" name="frm_trx" action="save_detail_trx.php" method="POST">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td style="padding-top: 20px;">No. Faktur : {$faktur}</td>
										</tr>
										<tr>
											<td>Tanggal : {$tanggal}</td>
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
								<br>
							</td>
							<td width="80%" bgcolor="#389c1d" style="padding: 10px 0px 0px 10px;">
								{if $code == '5'}
									<center><p style="color: red; font-weight: bold;">ID Member tidak ditemukan, periksa kembali ID Member yang dimasukkan.</p></center>
								{/if}
								<form method="POST" action="sales_transactions.php?module=trx&act=input" onsubmit="return validatepay(this)" name="checkpay">
								<input type="hidden" name="faktur" size="40" id="faktur" value="{$faktur}">
								<table>
									<tr>
										<td width="90">ID Member</td>
										<td width="400">: <input type="text" name="memberID" size="40" id="memberID" value="{$memberCode}"></td>
										<td width="130">Status Transaksi</td>
										<td><select name="status" id="status" required>
												<option value=""></option>
												<option value="1" SELECTED>Cash</option>
												<option value="2">Pending</option>
												<option value="3">Termin</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>: <input type="text" id="memberFullName" name="memberFullName" value="{$memberFullName}" size="40"></td>
										<td></td>
										<td>
											<div id="searchStatus"></div>
										</td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>: <input type="text" name="memberAddress" id="memberAddress" value="{$memberAddress}" size="40"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>HP</td>
										<td>: <input type="text" name="memberPhone" id="memberPhone" value="{$memberPhone}" size="40"></td>
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
														<th width="110" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
														<th width="270" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Harga</th>
														<th width="50" style='border-left: 1px solid #CCCCCC;'>Qty</th>
														<th width="70" style='border-left: 1px solid #CCCCCC;'>Disc (%)</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Subtotal</th>
														<th width="60" style='border-left: 1px solid #CCCCCC;'>Aksi</th>
											    	</tr>
											    <thead>
											    <tbody>
											    	{section name=dataShow loop=$dataShow}
											    	<tr valign="top">
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].no}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].productBarcode}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].productName}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataShow[dataShow].detailPrice}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataShow[dataShow].detailQty}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataShow[dataShow].discPercent}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataShow[dataShow].detailSubtotal}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
											    			<a href="edit_sales_transactions.php?module=trx&act=edit&detailID={$dataShow[dataShow].detailID}" data-width="550" data-height="300" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20"></a>
											    			<a href="sales_transactions.php?module=trx&act=delete&detailID={$dataShow[dataShow].detailID}&memberID={$memberCode}"><img src="images/icons/delete.png" width="20"></td>
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
										    			<input type="hidden" value="{$total}" name="subtotal" id="subtotal">
										    			<input type="hidden" value="{$modal}" name="trxModal" id="trxModal">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>PPN ({$identityPPN}%) </b></td>
										    		<td>:</td>
										    		<td colspan="2">
										    			<input type="text" name="ppnrupiah" id="ppnrupiah" value="{$ppnrupiah}" DISABLED>
										    			<input type="hidden" name="ppn" id="ppn" value="{$ppn}">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>TOTAL DISKON</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" name="discTotalRupiah" id="discTotalRupiah" value="{$discTotalRupiah}" DISABLED>
										    			<input type="hidden" name="discTotal" id="discTotal" value="{$discTotal}">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>GRANDTOTAL</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" name="grandtotalrupiah" id="grandtotalrupiah" value="{$grandtotalrupiah}" DISABLED>
										    			<input type="hidden" name="grandtotal" id="grandtotal" value="{$grandtotal}">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>BAYAR/DP</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" name="dp" id="dp" required>
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td colspan="3"></td>
										    		<td><button type="submit" class="btn btn-primary" style="background-color: #ff6600;">ADD PAYMENT</button></td>
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
								<form id="frm_trx2" name="frm_trx2" action="save_detail_trx.php" method="POST">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td style="padding-top: 20px;">No. Faktur : {$invoiceID}</td>
										</tr>
										<tr>
											<td>Tanggal : {$trxDate}</td>
										</tr>
										<tr>
											<td style="padding-top: 15px;">Kode Produk :<br>
												<input type="text" name="productBarcode" placeholder="Masukkan kode produk disini" id="productBarcode" style="display: block; width: 244px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required autofocus>
												<input type="hidden" name="yes" id="yes" value="yes">
												<input type="hidden" name="faktur" size="40" id="faktur" value="{$invoiceID}">
												<input type="hidden" name="trxID" size="40" id="trxID" value="{$trxID}">
											</td>
										</tr>
										<tr>
											<td><button type="submit" class="btn btn-primary">Simpan</button></td>
										</tr>
									</table>
								</form>
							</td>
							<td width="80%" bgcolor="#389c1d" style="padding: 10px 0px 0px 10px;">
								<form method="POST" action="sales_transactions.php?module=trx&act=update" onsubmit="return validatepay2(this)" name="checkpay">
								<input type="hidden" name="faktur" size="40" id="faktur" value="{$invoiceID}">
								<input type="hidden" name="trxID" size="40" id="trxID" value="{$trxID}">
								<table>
									<tr>
										<td width="90">ID Member</td>
										<td width="400">: <input type="hidden" name="pending" size="40" id="pending" value="{$pending}"><input type="text" name="memberIDD" size="40" id="memberIDD" value="{$memberCode}"></td>
										<td width="130">Status Transaksi</td>
										<td><select name="status" id="status" required>
												<option value=""></option>
												<option value="1" {if $status == '1'} SELECTED {/if}>Cash</option>
												<option value="2" {if $status == '2'} SELECTED {/if}>Pending</option>
												<option value="3" {if $status == '3'} SELECTED {/if}>Termin</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>: <input type="text" id="memberFullName" name="memberFullName" value="{$memberFullName}" size="40"></td>
										<td></td>
										<td><div id="searchStatus">
												{if $status == '3'} <input type="text" name="trxTerminDate" size="20" id="terminDate" value="{$trxTerminDate}"> {/if}
											</div>
										</td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>: <input type="text" name="memberAddress" id="memberAddress" value="{$memberAddress}" size="40"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>HP</td>
										<td>: <input type="text" name="memberPhone" id="memberPhone" value="{$memberPhone}" size="40"></td>
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
														<th width="110" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
														<th width="270" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Harga</th>
														<th width="50" style='border-left: 1px solid #CCCCCC;'>Qty</th>
														<th width="70" style='border-left: 1px solid #CCCCCC;'>Disc (%)</th>
														<th width="100" style='border-left: 1px solid #CCCCCC;'>Subtotal</th>
														<th width="60" style='border-left: 1px solid #CCCCCC;'>Aksi</th>
											    	</tr>
											    <thead>
											    <tbody>
											    	{section name=dataShow loop=$dataShow}
											    	<tr valign="top">
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].no}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].productBarcode}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataShow[dataShow].productName}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataShow[dataShow].detailPrice}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataShow[dataShow].detailQty}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataShow[dataShow].discPercent}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataShow[dataShow].detailSubtotal}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
											    			<a title="Edit" href="edit_sales_transactions.php?module=trx&act=edit&detailID={$dataShow[dataShow].detailID}" data-width="550" data-height="300" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="18"></a>
											    			<a title="Hapus" href="sales_transactions.php?module=trx&act=deleteedit&detailID={$dataShow[dataShow].detailID}&invoiceID={$invoiceID}&trxID={$trxID}&pending={$pending}"><img src="images/icons/delete.png" width="18"></td>
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
										    			<input type="hidden" value="{$total}" name="subtotal" id="subtotal">
										    			<input type="hidden" value="{$modal}" name="trxModal" id="trxModal">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>PPN ({$identityPPN}%) </b></td>
										    		<td>:</td>
										    		<td colspan="2">
										    			<input type="text" name="ppnrupiah" id="ppnrupiah" value="{$ppnrupiah}" DISABLED>
										    			<input type="hidden" name="ppn" id="ppn" value="{$ppn}">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>TOTAL DISCOUNT</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" name="discTotalRupiah" id="discTotalRupiah" value="{$discTotalRupiah}" DISABLED>
										    			<input type="hidden" name="discTotal" id="discTotal" value="{$discTotal}">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>GRANDTOTAL</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" name="grandtotalrupiah" id="grandtotalrupiah" value="{$grandtotalrupiah}" DISABLED>
										    			<input type="hidden" name="grandtotal" id="grandtotal" value="{$grandtotal}">
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td><b>BAYAR/DP</b></td>
										    		<td width="5">:</td>
										    		<td colspan="2">
										    			<input type="text" name="dp" value="{$trxPay}" id="dp" required>
										    		</td>
										    	</tr>
										    	<tr bgcolor="#667eac">
										    		<td colspan="3"></td>
										    		<td><button type="submit" class="btn btn-primary" style="background-color: #ff6600;">ADD PAYMENT</button></td>
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
								<a href="sales_transactions.php?module=trx&act=edit&invoiceID={$invoiceID}&trxID={$trxID}"><button type="button" class="btn btn-primary">Edit Transaksi</button></a> 
								<!--<a href="print_sales_transactions.php?module=trx&act=print&invoiceID={$invoiceID}&trxID={$trxID}" target="_blank"><button type="button" class="btn btn-success">Print</button></a>-->
								{if $identityPrintSale == '1'}
									<a onclick="finish_confirm('Transaksi selesai, mulai transaksi baru?','sales_transactions.php?module=trx&act=finish&invoiceID={$invoiceID}&trxID={$trxID}&status={$trxStatus}','print_sales_transactions.php?module=trx&act=print&invoiceID={$invoiceID}&trxID={$trxID}');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>
								{else}
									<a onclick="finish_confirm('Transaksi selesai, mulai transaksi baru?','sales_transactions.php?module=trx&act=finish&invoiceID={$invoiceID}&trxID={$trxID}&status={$trxStatus}','print_mini_sales_transactions.php?module=trx&act=print&invoiceID={$invoiceID}&trxID={$trxID}');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>
								{/if}
								<a href="sales_transactions.php?module=trx&act=cancel&invoiceID={$invoiceID}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi ini?');"><button type="button" class="btn btn-danger">Batal</button></a>
							</td>
						</tr>
					</table>
					<center><h3>Rincian Transaksi</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="400" style="padding-right: 20px;"><b>{$identityName}</b> <br>
								{$identityAddress}
							</td>
							<td width="350">Teluk Kuantan, {$trxDate}<br>Kepada Yth : <br>
								{if $memberID != ''} {$memberID} - {/if}
								{$trxFullName}
							</td>
						</tr>
						<tr valign="top">
							<td></td>
							<td>{if $trxAddress != ''} {$trxAddress} {/if} </td>
						</tr>
						<tr valign="top">
							<td></td>
							<td>{if $trxPhone != ''} {$trxPhone} {/if}</td>
						</tr>
						<tr>
							<td colspan="2"><br>Nomor Faktur : {$invoiceID} / Type : {if $trxStatus == '3'} {$status} {$terminDate} {else} {$status} {/if}</td>
						</tr>
					</table>
					<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="850" align="center">
						<thead>
					    	<tr>
					    		<th width="25" style='border-left: 1px solid #CCCCCC;'>No</th>
								<th width="120" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
								<th width="285" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
								<th width="130" style='border-left: 1px solid #CCCCCC;'>Harga Satuan</th>
								<th width="70" style='border-left: 1px solid #CCCCCC;'>Disc (%)</th>
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
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailPrice}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDetail[dataDetail].discPercent}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDetail[dataDetail].detailQty}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailSubtotal}</td>
					    	</tr>
					    	{/section}
					    </tbody>
					</table>
					<br>
					<table align="center" width="850">
						<tr valign="top">
							<td width="120">Subtotal</td>
							<td width="240">: Rp. {$trxSubtotal}</td>
							<td width="120">DP/Bayar</td>
							<td width="370">: Rp. {$trxPay}</td>
						</tr>
						<tr valign="top">
							<td>Diskon</td>
							<td>: Rp. {$trxDiscount}</td>
							<td>Kembali</td>
							<td>: Rp. {$trxChange}</td>
						</tr>
						<tr valign="top">
							<td>PPN ({$identityPPN}%)</td>
							<td>: Rp. {$trxPPN}</td>
							<td></td>
							<td></td>
						</tr>
						<tr valign="top">
							<td><b>Grandtotal</b></td>
							<td><b>: Rp. {$trxTotal}</b></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" style="border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;">Terbilang : {$terbilang} Rupiah</td>
						</tr>
					</table>
					
				{elseif $module == 'trx' AND $act == 'previewdetail'}
					
					{if $pending != 'cash'}
						{literal}
							<script>
								window.location.hash="no-back-button";
								window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
								window.onhashchange=function(){window.location.hash="no-back-button";}
							</script>
						{/literal}
					{/if}
				
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								{if $pending == 'cash'}
									<a href="javascript:history.go(-1)"><button type="button" class="btn btn-info">Back</button></a>
								{else}
									<a href="sales_transactions.php?module=trx&act=pending"><button type="button" class="btn btn-info">Back</button></a>
								{/if}
								
								{if $pending != 'cash'}
									<a href="sales_transactions.php?module=trx&act=edit&invoiceID={$invoiceID}&trxID={$trxID}&pending=yes"><button type="button" class="btn btn-primary">Edit Transaksi</button></a>
								{/if} 
								<!--<a href="print_sales_transactions.php?module=trx&act=print&invoiceID={$invoiceID}&trxID={$trxID}" target="_blank"><button type="button" class="btn btn-success">Print</button></a>-->
								{if $identityPrintSale == '1'}
									{if $pending != 'cash'}
										<a onclick="finish_confirm('Transaksi selesai, mulai transaksi baru?','sales_transactions.php?module=trx&act=finish&invoiceID={$invoiceID}&trxID={$trxID}&status={$trxStatus}&pending=yes','print_sales_transactions.php?module=trx&act=print&invoiceID={$invoiceID}&trxID={$trxID}');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>
									{/if}
								{else}
									{if $pending != 'cash'}
										<a onclick="finish_confirm('Transaksi selesai, mulai transaksi baru?','sales_transactions.php?module=trx&act=finish&invoiceID={$invoiceID}&trxID={$trxID}&status={$trxStatus}&pending=yes','print_mini_sales_transactions.php?module=trx&act=print&invoiceID={$invoiceID}&trxID={$trxID}');"><button type="button" class="btn btn-info">Transaksi Selesai</button></a>
									{/if}
								{/if}
							</td>
						</tr>
					</table>
					<center><h3>Rincian Transaksi</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="400" style="padding-right: 20px;"><b>{$identityName}</b> <br>
								{$identityAddress}
							</td>
							<td width="350">Teluk Kuantan, {$trxDate}<br>Kepada Yth : <br>
								{if $memberID != ''} {$memberID} - {/if}
								{$trxFullName}
							</td>
						</tr>
						<tr valign="top">
							<td></td>
							<td>{if $trxAddress != ''} {$trxAddress} {/if} </td>
						</tr>
						<tr>
							<td colspan="2"><br>Nomor Faktur : {$invoiceID} / Type : {if $trxStatus == '3'} {$status} {$terminDate} {else} {$status} {/if}</td>
						</tr>
					</table>
					<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="850" align="center">
						<thead>
					    	<tr>
					    		<th width="25" style='border-left: 1px solid #CCCCCC;'>No</th>
								<th width="120" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
								<th width="285" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
								<th width="130" style='border-left: 1px solid #CCCCCC;'>Harga Satuan</th>
								<th width="70" style='border-left: 1px solid #CCCCCC;'>Disc (%)</th>
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
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailPrice}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDetail[dataDetail].discPercent}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDetail[dataDetail].detailQty}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailSubtotal}</td>
					    	</tr>
					    	{/section}
					    </tbody>
					</table>
					<br>
					<table align="center" width="850">
						<tr valign="top">
							<td width="120">Subtotal</td>
							<td width="240">: Rp. {$trxSubtotal}</td>
							<td width="120">DP/Bayar</td>
							<td width="370">: Rp. {$trxPay}</td>
						</tr>
						<tr valign="top">
							<td>Inc. Diskon</td>
							<td>: Rp. {$trxDiscount}</td>
							<td>Kembali</td>
							<td>: Rp. {$trxChange}</td>
						</tr>
						<tr valign="top">
							<td>PPN ({$identityPPN}%)</td>
							<td>: Rp. {$trxPPN}</td>
							<td></td>
							<td></td>
						</tr>
						<tr valign="top">
							<td><b>Grandtotal</b></td>
							<td><b>: Rp. {$trxTotal}</b></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" style="border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;">Terbilang : {$terbilang} Rupiah</td>
						</tr>
					</table>
				
				{elseif $module == 'trx' AND $act == 'search'}
				
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form action="sales_transactions.php" method="GET" id="search">
									<input type="hidden" name="module" value="trx">
									<input type="hidden" name="act" value="search">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td>Tipe Pencarian :<br>
												<select id="searchType" name="searchType" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value="">- Pilih Tipe Pencarian -</option>
													<option value="1">Berdasarkan Nomor Faktur</option>
													<option value="2">Berdasarkan ID Member</option>
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
									<center><p style="color: red; font-weight: bold;">ID Member tidak ditemukan, periksa kembali ID Member yang dimasukkan.</p></center>
								{/if}
								
								<span style="font-size: 20px; font-weight: bold;">Pencarian Data Transaksi</span><br>
								Tipe Pencarian : {$typeName}<br>
								Keyword : {$based}
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
														<th width="130" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
														<th width="60" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
											    	</tr>
											    <thead>
											    <tbody>
											    	{section name=dataTrx loop=$dataTrx}
											    	<tr class="borderedtd">
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'>{$dataTrx[dataTrx].no}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'>{$dataTrx[dataTrx].invoiceID}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'>{$dataTrx[dataTrx].trxFullName}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt;'>{$dataTrx[dataTrx].trxDate}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt; text-align: right;'>{$dataTrx[dataTrx].trxTotal}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt; text-align: center;'>{$dataTrx[dataTrx].status}</td>
											    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; font-style: 14pt; text-align: center;'>
											    			<a href="sales_transactions.php?module=trx&act=previewdetail&invoiceID={$dataTrx[dataTrx].invoiceID}&trxID={$dataTrx[dataTrx].trxID}&pending=cash" title="Lihat Detail"><img src="images/icons/view.png" width="20">
											    			<a href="sales_transactions.php?module=trx&act=deletetrx&type={$type}&invoiceID={$dataTrx[dataTrx].invoiceID}&trxID={$dataTrx[dataTrx].trxID}&startDate={$start}&endDate={$end}&memberID={$dataTrx[dataTrx].memberID}&status={$dataTrx[dataTrx].statusori}" onclick="return confirm('Anda Yakin ingin menghapus transaksi {$dataTrx[dataTrx].invoiceID}? Kami menyarankan agar transaksi tidak boleh hapus!');" title="Hapus Transaksi"><img src="images/icons/delete.png" width="20"></td>
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
					
				{elseif $module == 'trx' AND $act == 'pending'}
				
					<div style="width: 99%; margin: 0px auto;">
					
						<h3>Transaksi Pending</h3>
						<div class="table-responsive">
							<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
								<thead>
							    	<tr>
							    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
										<th width="100" style='border-left: 1px solid #CCCCCC;'>Nomor Faktur <i class="fa fa-sort"></i></th>
										<th width="160" style='border-left: 1px solid #CCCCCC;'>Nama Konsumen <i class="fa fa-sort"></i></th>
										<th width="100" style='border-left: 1px solid #CCCCCC;'>Phone <i class="fa fa-sort"></i></th>
										<th width="130" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
										<th width="130" style='border-left: 1px solid #CCCCCC;'>Grandtotal <i class="fa fa-sort"></i></th>
										<th width="100" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
							    	</tr>
							    <thead>
								<tbody>
									{section name=dataTrx loop=$dataTrx}
							    	<tr>
							    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataTrx[dataTrx].no}</td>
							    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataTrx[dataTrx].invoiceID}</td>
							    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataTrx[dataTrx].trxFullName}</td>
							    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataTrx[dataTrx].trxPhone}</td>
							    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataTrx[dataTrx].trxDate}</td>
							    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>Rp. {$dataTrx[dataTrx].trxTotal}</td>
							    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
							    			<a href="sales_transactions.php?module=trx&act=previewdetail&invoiceID={$dataTrx[dataTrx].invoiceID}&trxID={$dataTrx[dataTrx].trxID}" title="Lihat Detail"><button type="button" class="btn btn-success">Bayar</button>
							    			<a href="sales_transactions.php?module=trx&act=deletetrx&invoiceID={$dataTrx[dataTrx].invoiceID}&trxID={$dataTrx[dataTrx].trxID}&status={$dataTrx[dataTrx].status}" onclick="return confirm('Anda Yakin ingin membatalkan transaksi {$dataTrx[dataTrx].invoiceID}?');"><button type="button" class="btn btn-danger">Batal</button></a>
							    		</td>
							    	</tr>
							    	{/section}
								</tbody>
							</table>
						</div>
						<br>
						<div id="paging">{$pageLink}</div>
					
						<p>&nbsp;</p>
					</div>
				
				{else}
					
					<table width="100%">
						<tr valign="top">
							<td width="20%" bgcolor="#667eac" style="padding: 0px 10px 0px 10px;">
								<form action="sales_transactions.php" method="GET" id="search">
									<input type="hidden" name="module" value="trx">
									<input type="hidden" name="act" value="search">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td>Tipe Pencarian :<br>
												<select id="searchType" name="searchType" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value="">- Pilih Tipe Pencarian -</option>
													<option value="1">Berdasarkan Nomor Faktur</option>
													<option value="2">Berdasarkan ID Member</option>
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
									<center><p style="color: red; font-weight: bold;">ID Member tidak ditemukan, periksa kembali ID Member yang dimasukkan.</p></center>
								{/if}
								
								<span style="font-size: 20px; font-weight: bold;">Pencarian Data Transaksi</span><br>
								<table width="100%">
									<tr>
										<td style="padding: 10px 0px 0px 2px;">
											<p>Pada halaman ini, Anda dapat melakukan pencarian data transaksi berdasarkan 3 option:</p>
											<table>
											<tr valign="top">
												<td width="20">1.</td>
												<td><b>Berdasarkan Nomor Faktur</b> <br>
													Dapat Anda pilih tipe pencarian pada sebelah kiri halaman, pilih option "Berdasarkan Nomor Faktur", otomatis akan tampil textbox,
													silahkan masukkan nomor faktur pada textbox tersebut dan lanjutkan dengan klik tombol "Search".<br><br>
												</td>
											</tr>
											<tr valign="top">
												<td width="20">2.</td>
												<td><b>Berdasarkan ID Member</b> <br>
													Dapat Anda pilih tipe pencarian pada sebelah kiri halaman, pilih option "Berdasarkan ID Member", otomatis akan tampil textbox,
													silahkan masukkan ID Member pada textbox tersebut dan lanjutkan dengan klik tombol "Search".<br><br>
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