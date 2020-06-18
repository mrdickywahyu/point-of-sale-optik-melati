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
				
				{literal}
					<script>
						$(document).ready(function() {
							
							$(".modalbox").fancybox();
							
							$("#profit").submit(function() { return false; });
							
							$("#send").on("click", function(){
								var year = $("#year").val();
								
								if (year.length != ''){
									
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "profit_reports.php?module=profit&act=search&year=" + year;
									
								}
							});
						});
					</script>
				{/literal}
					
				<br>
				<table width="99%" align="center">
					<tr>
						<td>
							<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Laporan Laba dan Proyeksi</button></a>
						</td>
					</tr>
				</table>
				
				<!-- hidden inline form -->
				<div id="inline">
					<table width="95%" align="center">
						<tr>
							<td colspan="3"><h3>Laporan Laba dan Proyeksi</h3></td>
						</tr>
						<tr>
							<td>
								<form id="profit" name="profit" action="#" method="POST">
								<table cellpadding="7" cellspacing="7">
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
								<button id="send" class="btn btn-primary">Cari</button>
								</form>
							</td>
						</tr>
					</table>
				</div>
				
				{if $module == 'profit' AND $act == 'search'}
					<table width="99%" align="center">
						<tr valign="top">
							<td><h3>Tahun {$yr}</h3></td>
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
							<td><br><a href="print_profit_reports.php?module=profit&act=print&year={$yr}" target="_blank"><button type="button" class="btn btn-warning">Print</button></a></td>
						</tr>
					</table>
					<p>&nbsp;</p>
				{/if}
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}