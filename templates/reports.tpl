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
				<table width="98%" align="center">
					<tr>
						<td>
							<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Laporan</button></a>
							<a href="#inline2" class="modalbox2"><button type="button" class="btn btn-primary">Proyeksi dan Laba Kerugian</button></a>
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
							<td colspan="3"><h3>Proyeksi dan Laba Kerugian</h3></td>
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
				
				{if $module == 'order' AND $act == 'search'}
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Hasil Pencarian : {$startDate} s/d {$endDate}</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Transaksi <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Piutang <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Penerimaan Piutang <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Hutang <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Pembayaran Hutang <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Rabat <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Biaya <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	{section name=dataOrder loop=$dataOrder}
								    	<tr>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataOrder[dataOrder].no}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataOrder[dataOrder].trxDate}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataOrder[dataOrder].trxTotal}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataOrder[dataOrder].trxTotalTermin}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataOrder[dataOrder].trxPayment}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataOrder[dataOrder].trxTotalDebt}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataOrder[dataOrder].trxPayDebt}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataOrder[dataOrder].trxRabat}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataOrder[dataOrder].trxFund}</td>
								    	</tr>
								    	{/section}
								    	<tr>
								    		<td colspan='2' style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>Rp.</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b>{$grandTotalRp}</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b>{$grandTotalTerminRp}</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b>{$grandPaymentRp}</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b>{$grandTotalDebtRp}</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b>{$grandPayDebtRp}</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b>{$grandRabatRp}</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b>{$grandFundAmountRp}</b></td>
								    	</tr>
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_order_reports.php?module=order&act=print&startDate={$start}&endDate={$end}" target="_blank"><button type="button" class="btn btn-success">Print</button></a></td>
						</tr>
					</table>
					<p>&nbsp;</p>
				{/if}
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}