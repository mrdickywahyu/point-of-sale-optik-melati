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
							
							$("#order").submit(function() { return false; });
							
							$("#send").on("click", function(){
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								
								if (startDate.length != '' && endDate.length != ''){
									
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "fund_reports.php?module=fund&act=search&startDate=" + startDate + "&endDate=" + endDate;
									
								}
							});
						});
					</script>
				{/literal}
				
				
				<br>
				<table width="98%" align="center">
					<tr>
						<td>
							<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Laporan Pengeluaran Biaya</button></a>
						</td>
					</tr>
				</table>
				
				<!-- hidden inline form -->
				<div id="inline">
					<table width="95%" align="center">
						<tr>
							<td colspan="3"><h3>Laporan Pengeluaran Biaya</h3></td>
						</tr>
						<tr>
							<td>
								<form id="order" name="order" action="#" method="POST">
								<table cellpadding="7" cellspacing="7">
									<tr>
										<td width="140">Periode Awal</td>
										<td width="5">:</td>
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
				
				{if $module == 'fund' AND $act == 'search'}
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Hasil Pencarian, Periode {$startDate} s/d {$endDate}</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30">No</th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="110">Tanggal <i class="fa fa-sort"></i></th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="100">Kode Akun <i class="fa fa-sort"></i></th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="255">Nama Akun <i class="fa fa-sort"></i></th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="400">Keterangan <i class="fa fa-sort"></i></th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="120">Jumlah <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	{section name=dataFund loop=$dataFund}
								    	<tr>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].no}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].fundDate}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataFund[dataFund].accountCode}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].accountName}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].fundNote}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataFund[dataFund].fundAmount}</td>
								    	</tr>
								    	{/section}
								    	<tr>
								    		<td colspan="5" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>Rp.</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b>{$fundTotal}</b></td>
								    	</tr>
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_fund_reports.php?module=fund&act=print&startDate={$start}&endDate={$end}" target="_blank"><button type="button" class="btn btn-warning">Print</button></a></td>
						</tr>
					</table>
					<p>&nbsp;</p>
					
				{/if}
				
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}