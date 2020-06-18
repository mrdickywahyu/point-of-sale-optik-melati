{include file="header.tpl"}

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
				
				{literal}
					<script>
						$(document).ready(function() {
							
							$( "#debtDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: '2014:c-0'
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
							
							$(".modalbox").fancybox();
							
							$("#debt").submit(function() { return false; });
							$("#debt2").submit(function() { return false; });
							
							$("#send").on("click", function(){
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								var supplierID = $("#supplierID").val();
								var status = $("#status").val();
								
								if (status != ''){
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "debts.php?module=debt&act=search&startDate=" + startDate + "&endDate=" + endDate + "&status=" + status + "&supplierID=" + supplierID;
								}
							});
							
							$("#supplierID").autocomplete("supplier_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('supplierID').value = myarr[0];
							});
							
							$("#send2").on("click", function(){
								var debtDate = $("#debtDate").val();
								var debtAmount = $("#debtAmount").val();
								var sisa = $("#sisa").val();
								var debtID = $("#debtID").val();
								var invoiceID = $("#invoiceID").val();
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								
								if (debtDate != '' && debtAmount != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_debt.php',
										dataType: 'JSON',
										data:{
											debtDate: debtDate,
											debtAmount: debtAmount,
											sisa: sisa,
											debtID: debtID,
											invoiceID: invoiceID
										},
										beforeSend: function (data) {
											$('#send2').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "debts.php?module=debt&act=view&debtID="+ debtID + "&invoiceID=" + invoiceID + "&startDate=" + startDate + "&endDate=" + endDate;
										}
									});
								}
							});
						});
					</script>
				{/literal}
				
				{if $module == 'debt' AND $act == 'search'}
					<br>
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Catatan Hutang, Periode {$startDate} s/d {$endDate}</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>No. Faktur <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>ID Member <i class="fa fa-sort"></i></th>
											<th width="180" style='border-left: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Jumlah <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Bayar <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Sisa <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
											<th width="100" style='border-left: 1px solid #CCCCCC;'>Jatuh Tempo <i class="fa fa-sort"></i></th>
											<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	{section name=dataDebt loop=$dataDebt}
								    		{if $dataDebt[dataDebt].totalsisa <= 0 && $status == '2'}
									    		<tr valign="top">
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].no}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxDate}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].invoiceID}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].supplierID}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxFullName}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].trxTotal}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].trxDP}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].sisa}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDebt[dataDebt].statusSisa}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxTerminDate}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="debts.php?module=debt&act=view&debtID={$dataDebt[dataDebt].debtID}&invoiceID={$dataDebt[dataDebt].invoiceID}&startDate={$start}&endDate={$end}" title="Detil Catatan Hutang"><img src="images/icons/view.png" width="18"></td>
										    	</tr>
										    	
										    {elseif $dataDebt[dataDebt].totalsisa > 0 && $status == '3'}
									    		<tr valign="top">
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].no}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxDate}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].invoiceID}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].supplierID}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxFullName}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].trxTotal}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].trxDP}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].sisa}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDebt[dataDebt].statusSisa}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxTerminDate}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="debts.php?module=debt&act=view&debtID={$dataDebt[dataDebt].debtID}&invoiceID={$dataDebt[dataDebt].invoiceID}&startDate={$start}&endDate={$end}" title="Detil Catatan Hutang"><img src="images/icons/view.png" width="18"></td>
										    	</tr>
										    
										    {elseif $status == '1'}
									    		<tr valign="top">
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].no}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxDate}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].invoiceID}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].supplierID}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxFullName}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].trxTotal}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].trxDP}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].sisa}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDebt[dataDebt].statusSisa}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxTerminDate}</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="debts.php?module=debt&act=view&debtID={$dataDebt[dataDebt].debtID}&invoiceID={$dataDebt[dataDebt].invoiceID}&startDate={$start}&endDate={$end}" title="Detil Catatan Hutang"><img src="images/icons/view.png" width="18"></td>
										    	</tr>
									    	{/if}
									    	
								    	{/section}
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_debts.php?module=debt&act=print&startDate={$start}&endDate={$end}&status={$status}&supplierID={$supplierID}" target="_blank"><button type="button" class="btn btn-warning">Print</button></a></td>
						</tr>
					</table>
					
				{elseif $module == 'debt' AND $act == 'view'}
					
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Back</button></a>
								<a href="debts.php?module=debt&act=preview&debtID={$debtID}&invoiceID={$invoiceID}&startDate={$startDate}&endDate={$endDate}"><button type="button" class="btn btn-info">Detail Transaksi</button></a>
								{if $sisa > 0}
									<a href="#inline2" class="modalbox"><button type="button" class="btn btn-warning">Bayar</button></a>
								{/if}
								{if $identityPrintDebt == '1'}
									<a href="print_pay_debts.php?module=debt&act=print&debtID={$debtID}&invoiceID={$invoiceID}&startDate={$startDate}&endDate={$endDate}" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								{else}
									<a href="print_mini_pay_debts.php?module=debt&act=print&debtID={$debtID}&invoiceID={$invoiceID}&startDate={$startDate}&endDate={$endDate}" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								{/if}
							</td>
						</tr>
					</table>
					<center><h3>Catatan Hutang</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="130" style="padding-right: 20px;">ID/Nama Supplier</td>
							<td width="280">: {if $supplierID != ''} {$supplierID} - {$trxFullName} {else} - {/if}</td>
							<td width="120" style="padding-left: 50px;">Hutang</td>
							<td width="120">: Rp. {$totalHarusBayar}</td>
						</tr>
						<tr valign="top">
							<td>Alamat</td>
							<td>: {if $trxAddress != ''} {$trxAddress} {else} - {/if} </td>
							<td style="padding-left: 50px;">Total Bayar Masuk</td>
							<td>: Rp. {$totalPay} </td>
						</tr>
						<tr valign="top">
							<td>Phone</td>
							<td>: {if $trxPhone != ''} {$trxPhone} {else} - {/if}</td>
							<td style="padding-left: 50px;">Sisa Hutang</td>
							<td>: Rp. {$totalSisa} </td>
						</tr>
						<tr valign="top">
							<td>Nomor Faktur</td>
							<td>: {$invoiceID}</td>
							<td style="padding-left: 50px;">Status</td>
							<td>: {$totalSisaIf} </td>
						</tr>
						<tr valign="top">
							<td>Tipe / Jatuh Tempo</td>
							<td>: {if $trxStatus == '2'} Termin / {$trxTerminDate} {else} Cash {/if}</td>
							<td></td>
							<td></td>
						</tr>
					</table>
					<br>
					<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="850" align="center">
						<thead>
					    	<tr>
					    		<th width="25" style='border-left: 1px solid #CCCCCC;'>No</th>
								<th width="120" style='border-left: 1px solid #CCCCCC;'>Tanggal</th>
								<th width="125" style='border-left: 1px solid #CCCCCC;'>Bayar</th>
								<th width="80" style='border-left: 1px solid #CCCCCC;'>Aksi</th>
					    	</tr>
					    <thead>
					    <tbody>
					    	{section name=dataPayment loop=$dataPayment}
					    	<tr valign="top">
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataPayment[dataPayment].no}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataPayment[dataPayment].debtDate}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataPayment[dataPayment].debtPay}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>
					    			<a href="debts.php?module=debt&act=delete&id={$dataPayment[dataPayment].paymentID}&debtID={$debtID}&invoiceID={$invoiceID}&startDate={$startDate}&endDate={$endDate}" onclick="return confirm('Anda Yakin ingin menghapus pembayaran hutang member {$dataPayment[dataPayment].paymentID}#{$dataPayment[dataPayment].debtDate}?');"><img src="images/icons/delete.png" width="18"></a>
					    		</td>
					    	</tr>
					    	{/section}
					    </tbody>
					</table>
					
					<div id="inline2">
						<table width="95%" align="center">
							<tr>
								<td colspan="3"><h3>Bayar Hutang Supplier</h3></td>
							</tr>
							<tr>
								<td>
									<form id="debt" name="debt" method="POST" action="#">
									<input type="hidden" value="{$startDate}" id="startDate" name="startDate">
									<input type="hidden" value="{$endDate}" id="endDate" name="endDate">
									<input type="hidden" value="{$invoiceID}" id="invoiceID" name="invoiceID">
									<input type="hidden" value="{$debtID}" id="debtID" name="debtID">
									<input type="hidden" value="{$sisa}" id="sisa" name="sisa">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Tanggal</td>
											<td width="5">:</td>
											<td><input type="text" value="{$debtDate}" id="debtDate" name="debtDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Jumlah</td>
											<td>:</td>
											<td><input type="text" id="debtAmount" name="debtAmount" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
									</table>
									<button id="send2" class="btn btn-primary">Simpan</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
					
				{elseif $module == 'debt' AND $act == 'preview'}
					
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Back</button></a>
							</td>
						</tr>
					</table>
					<center><h3>Rincian Transaksi</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="400" style="padding-right: 20px;"><b>{$identityName}</b> <br>
								{$identityAddress}
							</td>
							<td width="350">Cirebon, {$trxDate}<br>Kepada Yth : <br>
								{if $supplierID != ''} {$supplierID} - {/if}
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
							<td colspan="2"><br>Nomor Faktur : {$invoiceID} / Type : {if $trxStatus == '2'} {$status} {$trxTerminDate} {else} {$status} {/if}</td>
						</tr>
					</table>
					<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="850" align="center">
						<thead>
					    	<tr>
					    		<th width="25" style='border-left: 1px solid #CCCCCC;'>No</th>
								<th width="120" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
								<th width="285" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
								<th width="130" style='border-left: 1px solid #CCCCCC;'>Harga Satuan</th>
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
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailBuyPrice}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDetail[dataDetail].detailBuyQty}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDetail[dataDetail].detailBuySubtotal}</td>
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
							<td width="370">: Rp. {$trxDP}</td>
						</tr>
						<tr valign="top">
							<td>Diskon</td>
							<td>: Rp. {$trxDiscount}</td>
							<td>Kurang</td>
							<td>: Rp. {$kurang}</td>
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
					
				{else}
					<br>
					<table width="98%" align="center">
						<tr>
							<td>
								<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Cari Kartu Hutang</button></a>
								<a href="print_debt.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
							</td>
						</tr>
					</table>
					
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Catatan Hutang</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>No. Faktur <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>ID Supplier <i class="fa fa-sort"></i></th>
											<th width="180" style='border-left: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Jumlah <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Bayar <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Sisa <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
											<th width="100" style='border-left: 1px solid #CCCCCC;'>Jatuh Tempo <i class="fa fa-sort"></i></th>
											<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	{section name=dataDebt loop=$dataDebt}
								    	{if $dataDebt[dataDebt].totalsisa > 0}
									    	<tr valign="top">
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].no}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxDate}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].invoiceID}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].supplierID}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxFullName}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].trxTotal}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].trxPay}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataDebt[dataDebt].sisa}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataDebt[dataDebt].statusSisa}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataDebt[dataDebt].trxTerminDate}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="debts.php?module=debt&act=view&debtID={$dataDebt[dataDebt].debtID}&invoiceID={$dataDebt[dataDebt].invoiceID}&startDate=&endDate=" title="Detil Catatan Hutang"><img src="images/icons/view.png" width="18"></td>
									    	</tr>
									    {/if}
								    	{/section}
								    </tbody>
								</table>
							</td>
						</tr>
					</table>
					
					<!-- hidden inline form -->
					<div id="inline">
						<table width="95%" align="center">
							<tr>
								<td colspan="3"><h3>Catatan Jatuh Tempo Hutang</h3></td>
							</tr>
							<tr>
								<td>
									<form id="debt2" name="debt2" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Periode Awal</td>
											<td width="5">:</td>
											<td><input type="text" value="{$startDate}" id="startDate" name="startDate" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Periode Akhir</td>
											<td>:</td>
											<td><input type="text" value="{$endDate}" id="endDate" name="endDate" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Status Hutang</td>
											<td>:</td>
											<td>
												<select id="status" name="status" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value=""></option>
													<option value="3">Semua Status</option>
													<option value="2">Lunas</option>
													<option value="1">Belum Lunas</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Supplier</td>
											<td>:</td>
											<td><input type="text" name="supplierID" size="40" id="supplierID" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
									</table>
									<button id="send" class="btn btn-primary">Pencarian</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
				{/if}
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}