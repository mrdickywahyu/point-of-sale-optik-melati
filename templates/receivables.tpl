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
							
							$( "#receivableDate" ).datepicker({
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
							
							$("#receivable").submit(function() { return false; });
							$("#receivable2").submit(function() { return false; });
							
							$("#send").on("click", function(){
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								var memberID = $("#memberID").val();
								var status = $("#status").val();
								
								if (status != ''){
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "receivables.php?module=receivable&act=search&startDate=" + startDate + "&endDate=" + endDate + "&status=" + status + "&memberID=" + memberID;
								}
							});
							
							$("#memberID").autocomplete("member_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('memberID').value = myarr[0];
							});
							
							$("#send2").on("click", function(){
								var receivableDate = $("#receivableDate").val();
								var receivableAmount = $("#receivableAmount").val();
								var sisa = $("#sisa").val();
								var receivableID = $("#receivableID").val();
								var invoiceID = $("#invoiceID").val();
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								
								if (receivableDate != '' && receivableAmount != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_receivable.php',
										dataType: 'JSON',
										data:{
											receivableDate: receivableDate,
											receivableAmount: receivableAmount,
											sisa: sisa,
											receivableID: receivableID,
											invoiceID: invoiceID
										},
										beforeSend: function (data) {
											$('#send2').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "receivables.php?module=receivable&act=view&receivableID="+ receivableID + "&invoiceID=" + invoiceID + "&startDate=" + startDate + "&endDate=" + endDate;
										}
									});
								}
							});
						});
					</script>
				{/literal}
				
				{if $module == 'receivable' AND $act == 'search'}
					<br>
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Catatan Piutang, Periode {$startDate} s/d {$endDate}</h3></td>
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
								    	{section name=dataReceivable loop=$dataReceivable}
							    			<tr valign="top">
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].no}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].trxDate}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].invoiceID}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].memberID}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].trxFullName}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataReceivable[dataReceivable].trxTotal}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataReceivable[dataReceivable].trxPay}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataReceivable[dataReceivable].sisa}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataReceivable[dataReceivable].statusSisa}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].trxTerminDate}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="receivables.php?module=receivable&act=view&receivableID={$dataReceivable[dataReceivable].receivableID}&invoiceID={$dataReceivable[dataReceivable].invoiceID}&startDate={$start}&endDate={$end}" title="Detil Catatan Piutang"><img src="images/icons/view.png" width="18"></td>
									    	</tr>
									    	
								    	{/section}
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_receivables.php?module=receivable&act=print&startDate={$start}&endDate={$end}&status={$status}&memberID={$memberID}" target="_blank"><button type="button" class="btn btn-warning">Print</button></a></td>
						</tr>
					</table>
					
				{elseif $module == 'receivable' AND $act == 'view'}
					
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Back</button></a>
								<a href="receivables.php?module=receivable&act=preview&receivableID={$receivableID}&invoiceID={$invoiceID}&startDate={$startDate}&endDate={$endDate}"><button type="button" class="btn btn-info">Detail Transaksi</button></a>
								{if $sisa > 0}
									<a href="#inline2" class="modalbox"><button type="button" class="btn btn-warning">Bayar</button></a>
								{/if}
								{if $identityPrintReceive == '1'}
									<a href="print_pay_receivables.php?module=receivable&act=print&receivableID={$receivableID}&invoiceID={$invoiceID}&startDate={$startDate}&endDate={$endDate}" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								{else}
									<a href="print_mini_pay_receivables.php?module=receivable&act=print&receivableID={$receivableID}&invoiceID={$invoiceID}&startDate={$startDate}&endDate={$endDate}" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								{/if}
							</td>
						</tr>
					</table>
					<center><h3>Catatan Piutang</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="130" style="padding-right: 20px;">ID/Nama Member</td>
							<td width="280">: {if $memberID != ''} {$memberID} - {$trxFullName} {else} - {/if}</td>
							<td width="120" style="padding-left: 50px;">Piutang</td>
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
							<td style="padding-left: 50px;">Sisa Piutang</td>
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
							<td>: {if $trxStatus == '3'} {$status} / {$terminDate} {else} {$status} {/if}</td>
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
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataPayment[dataPayment].receivableDate}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataPayment[dataPayment].receivablePay}</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>
					    			<a href="receivables.php?module=receivable&act=delete&id={$dataPayment[dataPayment].paymentID}&receivableID={$receivableID}&invoiceID={$invoiceID}&startDate={$startDate}&endDate={$endDate}" onclick="return confirm('Anda Yakin ingin menghapus pembayaran Piutang member {$dataPayment[dataPayment].paymentID}#{$dataPayment[dataPayment].receivableDate}?');"><img src="images/icons/delete.png" width="18"></a>
					    		</td>
					    	</tr>
					    	{/section}
					    </tbody>
					</table>
					
					<div id="inline2">
						<table width="95%" align="center">
							<tr>
								<td colspan="3"><h3>Bayar Piutang</h3></td>
							</tr>
							<tr>
								<td>
									<form id="receivable" name="receivable" method="POST" action="#">
									<input type="hidden" value="{$startDate}" id="startDate" name="startDate">
									<input type="hidden" value="{$endDate}" id="endDate" name="endDate">
									<input type="hidden" value="{$invoiceID}" id="invoiceID" name="invoiceID">
									<input type="hidden" value="{$receivableID}" id="receivableID" name="receivableID">
									<input type="hidden" value="{$sisa}" id="sisa" name="sisa">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Tanggal</td>
											<td width="5">:</td>
											<td><input type="text" value="{$receivableDate}" id="receivableDate" name="recevableDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Jumlah</td>
											<td>:</td>
											<td><input type="text" id="receivableAmount" name="receivableAmount" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
									</table>
									<button id="send2" class="btn btn-primary">Simpan</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
					
				{elseif $module == 'receivable' AND $act == 'preview'}
					
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
					
				{else}
					<br>
					<table width="98%" align="center">
						<tr>
							<td>
								<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Cari Kartu Piutang</button></a>
								<a href="print_receivable.php" target="_blank"><button type="button" class="btn btn-warning">Print</button></a>
							</td>
						</tr>
					</table>
					
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Catatan Piutang</h3></td>
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
								    	{section name=dataReceivable loop=$dataReceivable}
								    	{if $dataReceivable[dataReceivable].totalsisa > 0}
									    	<tr valign="top">
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].no}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].trxDate}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].invoiceID}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].memberID}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].trxFullName}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataReceivable[dataReceivable].trxTotal}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataReceivable[dataReceivable].trxPay}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataReceivable[dataReceivable].sisa}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataReceivable[dataReceivable].statusSisa}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].trxTerminDate}</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="receivables.php?module=receivable&act=view&receivableID={$dataReceivable[dataReceivable].receivableID}&invoiceID={$dataReceivable[dataReceivable].invoiceID}&startDate=&endDate=" title="Detil Catatan Piutang"><img src="images/icons/view.png" width="18"></td>
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
								<td colspan="3"><h3>Catatan Jatuh Tempo Piutang</h3></td>
							</tr>
							<tr>
								<td>
									<form id="receivable2" name="receivable2" method="POST" action="#">
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
											<td>Status Piutang</td>
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
											<td>Member</td>
											<td>:</td>
											<td><input type="text" name="memberID" size="40" id="memberID" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
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