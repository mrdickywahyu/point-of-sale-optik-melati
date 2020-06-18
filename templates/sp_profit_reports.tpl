{include file="header.tpl"}

<style>
	div.ui-datepicker{
		font-size:14px;
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
				
				<!-- Top Navigation -->
				<div class="codrops-top clearfix">
					<!--<a href="#" id="trigger" class="menu-trigger">Open Menu</a>-->
					<a class="codrops-icon codrops-icon-prev" href="#" id="trigger"><span>Open Menu</span></a> |
					<a href="home.php"><span>Home</span></a>
					<span class="right"><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Logout</span></a></span>
				</div>
				
				<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
  				<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
				
				{literal}
					<script>
						$(document).ready(function() {
							
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
							
							$(".modalbox2").fancybox();
							
							$("#report").submit(function() { return false; });
							$("#report2").submit(function() { return false; });
							
							$("#send").on("click", function(){
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								var outlet = $("#outlet").val();
								var jenis = $("#jenis").val();
								
								if (startDate != '' && endDate != '' && outlet != '' && jenis != ''){
									
									setTimeout("$.fancybox.close()", 1000);
									
									if (jenis == '1'){
										window.location.href = "sp_order_reports.php?module=report&act=search&startDate=" + startDate + "&endDate=" + endDate + "&outlet=" + outlet;
									}
									
									else if (jenis == '2'){
										window.location.href = "sp_fund_reports.php?module=report&act=search&startDate=" + startDate + "&endDate=" + endDate + "&outlet=" + outlet;
									}
									
									else if (jenis == '3'){
										window.location.href = "sp_debt_reports.php?module=report&act=search&startDate=" + startDate + "&endDate=" + endDate + "&outlet=" + outlet;
									}
									
									else if (jenis == '4'){
										window.location.href = "sp_receive_reports.php?module=report&act=search&startDate=" + startDate + "&endDate=" + endDate + "&outlet=" + outlet;
									}
								}
							});
							
							$("#send2").on("click", function(){
								var year = $("#year").val();
								var outlet = $("#outlet2").val();
								
								if (year != '' && outlet != ''){
									
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "sp_profit_reports.php?module=report&act=search&year=" + year + "&outlet=" + outlet;
									
								}
							});
						});
					</script>
				{/literal}
					
				<br>
				<table width="99%" align="center">
					<tr>
						<td>
							<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Laporan</button></a>
							<a href="#inline2" class="modalbox2"><button type="button" class="btn btn-primary">Laba dan Proyeksi Kerugian</button></a>
						</td>
					</tr>
				</table>
				
				<!-- hidden inline form -->
				<div id="inline">
					<table width="95%" align="center">
						<tr>
							<td colspan="3"><h3>Laporan per Periode</h3></td>
						</tr>
						<tr>
							<td>
								<form id="report" name="report" method="POST">
								<table cellpadding="7" cellspacing="7">
									<tr>
										<td width="140">Jenis Laporan</td>
										<td width="5">:</td>
										<td><select name="jenis" id="jenis" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
												<option value="">- Pilih Laporan -</option>
												<option value="1">Laporan Pendapatan</option>
												<option value="2">Laporan Biaya</option>
												<option value="3">Laporan Hutang</option>
												<option value="4">Laporan Piutang</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Outlet</td>
										<td>:</td>
										<td><select id="outlet" name="outlet" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
												<option value="">- Pilih Outlet -</option>
												{section name=dataOutlet loop=$dataOutlet}
													<option value="{$dataOutlet[dataOutlet].outletID}">{$dataOutlet[dataOutlet].outletCode} - {$dataOutlet[dataOutlet].outletName}</option>
												{/section}
											</select>
										</td>
									</tr>
									<tr>
										<td>Periode Awal</td>
										<td>:</td>
										<td><input type="text" id="startDate" name="startDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
									</tr>
									<tr>
										<td>Periode Akhir</td>
										<td>:</td>
										<td><input type="text" id="endDate" name="endtDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
									</tr>
								</table>
								<button id="send" class="btn btn-primary">Cari</button>
								</form>
							</td>
						</tr>
					</table>
				</div>
				
				<!-- hidden inline form -->
				<div id="inline2">
					<table width="95%" align="center">
						<tr>
							<td colspan="3"><h3>Laba dan Proyeksi Kerugian</h3></td>
						</tr>
						<tr>
							<td>
								<form id="report2" name="report2" action="#" method="POST">
								<table cellpadding="7" cellspacing="7">
									<tr>
										<td>Outlet</td>
										<td>:</td>
										<td><select id="outlet2" name="outlet2" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
												<option value="">- Pilih Outlet -</option>
												{section name=dataOutlet loop=$dataOutlet}
													<option value="{$dataOutlet[dataOutlet].outletID}">{$dataOutlet[dataOutlet].outletCode} - {$dataOutlet[dataOutlet].outletName}</option>
												{/section}
											</select>
										</td>
									</tr>
									<tr>
										<td width="80">Tahun</td>
										<td width="5">:</td>
										<td>
											<select id="year" name="year" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
												<option value="">- Pilih Tahun -</option>
												{section name=tahun loop=$tahun}
													<option value="{$tahun[tahun]}">{$tahun[tahun]}</option>
												{/section}
											</select>
										</td>
									</tr>
								</table>
								<button id="send2" class="btn btn-primary">Cari</button>
								</form>
							</td>
						</tr>
					</table>
				</div>
				<br>
				{if $module == 'report' AND $act == 'search'}
					<table width="99%" align="center">
						<tr valign="top">
							<td>
								<table>
									<tr>
										<td>Nama Outlet</td>
										<td>: {$oCode} - {$oName}</td>
									</tr>
									<tr>
										<td>Jenis Laporan</td>
										<td>: Laba dan Proyeksi Kerugian</td>
									</tr>
									<tr>
										<td>Tahun</td>
										<td>: {$yr}</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000; font-size: 11pt;" width="100%">
									<thead>
								    	<tr>
								    		<th width="160">Nama Akun</th>
											<th width="80">Jan</th>
											<th width="80">Feb</th>
											<th width="80">Mar</th>
											<th width="80">Apr</th>
											<th width="80">Mei</th>
											<th width="80">Jun</th>
											<th width="80">Jul</th>
											<th width="80">Ags</th>
											<th width="80">Sep</th>
											<th width="80">Okt</th>
											<th width="80">Nov</th>
											<th width="80">Des</th>
								    	</tr>
								    <thead>
								    
								    <tbody>
								    	<tr>
								    		<td width="160"><b>Pendapatan</b></td>
								    		<td colspan="12"></td>
								    	</tr>
								    	<tr>
								    		<td>Total Pendapatan (+ PPN)</td>
								    		{section name=dataProfit loop=$dataProfit}
												<td width="80" align="right">{$dataProfit[dataProfit].trxTotal}</td>
											{/section}
								    	</tr>
								    	<tr>
								    		<td>Piutang (-)</td>
								    		{section name=dataProfit loop=$dataProfit}
												<td width="80" align="right">{$dataProfit[dataProfit].trxTotalTermin}</td>
											{/section}
								    	</tr>
								    	<tr>
								    		<td style='text-align: right;'><b>Subtotal (KAS) Rp.</b></td>
								    		{section name=dataProfit loop=$dataProfit}
												<td width="80" align="right"><b>{$dataProfit[dataProfit].grandTotalProfitRp}</b></td>
											{/section}
								    	</tr>
								    	<tr>
								    		<td width="160"><br><b>Hutang - Piutang</b></td>
								    		<td colspan="12"></td>
								    	</tr>
								    	<tr>
								    		<td>Pembayaran Hutang</td>
								    		{section name=dataProfit loop=$dataProfit}
												<td width="80" align="right">{$dataProfit[dataProfit].trxPaymentDebt}</td>
											{/section}
								    	</tr>
								    	<tr>
								    		<td>Penerimaan Piutang</td>
								    		{section name=dataProfit loop=$dataProfit}
												<td width="80" align="right">{$dataProfit[dataProfit].trxPayment}</td>
											{/section}
								    	</tr>
								    	<tr>
								    		<td width="160"><br><b>Rabat</b></td>
								    		<td colspan="12"></td>
								    	</tr>
								    	<tr>
								    		<td>Total Rabat</td>
								    		{section name=dataProfit loop=$dataProfit}
												<td width="80" align="right">{$dataProfit[dataProfit].grandRabatRp}</td>
											{/section}
								    	</tr>
								    	<tr>
								    		<td><br><b>Pegeluaran Biaya</b></td>
								    		<td></td>
								    	</tr>
								    	{section name=dataAccount loop=$dataAccount}
								    	<tr>
								    		<td>{$dataAccount[dataAccount].accountName}</td>
								    		{section name=dataFund loop=$dataAccount[dataAccount].fund}
								    			<td align="right">{$dataAccount[dataAccount].fund[dataFund].fundAmountRp}</td>
								    		{/section}
								    	</tr>
								    	{/section}
								    	<tr>
								    		<td style='text-align: right;'><b>Subtotal Rp.</b></td>
								    		<td align="right"><b>{$jan}</b></td>
								    		<td align="right"><b>{$feb}</b></td>
								    		<td align="right"><b>{$mar}</b></td>
								    		<td align="right"><b>{$apr}</b></td>
								    		<td align="right"><b>{$may}</b></td>
								    		<td align="right"><b>{$jun}</b></td>
								    		<td align="right"><b>{$jul}</b></td>
								    		<td align="right"><b>{$aug}</b></td>
								    		<td align="right"><b>{$sep}</b></td>
								    		<td align="right"><b>{$oct}</b></td>
								    		<td align="right"><b>{$nov}</b></td>
								    		<td align="right"><b>{$dec}</b></td>
								    	</tr>
								    	<tr>
								    		<td colspan="13">&nbsp;</td>
								    	</tr>
								    	<tr valign="top">
								    		<td style='text-align: right;'><b>Netto Rp.<br>(Rabat - Biaya)</b></td>
								    		<td align="right"><b>{$totJan}</b></td>
								    		<td align="right"><b>{$totFeb}</b></td>
								    		<td align="right"><b>{$totMar}</b></td>
								    		<td align="right"><b>{$totApr}</b></td>
								    		<td align="right"><b>{$totMay}</b></td>
								    		<td align="right"><b>{$totJun}</b></td>
								    		<td align="right"><b>{$totJul}</b></td>
								    		<td align="right"><b>{$totAug}</b></td>
								    		<td align="right"><b>{$totSep}</b></td>
								    		<td align="right"><b>{$totOct}</b></td>
								    		<td align="right"><b>{$totNov}</b></td>
								    		<td align="right"><b>{$totDec}</b></td>
								    	</tr>
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_sp_profit_reports.php?module=report&act=print&year={$yr}&outletID={$oID}" target="_blank"><button type="button" class="btn btn-success">Print</button></a></td>
						</tr>
					</table>
					<p>&nbsp;</p>
				{/if}
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}