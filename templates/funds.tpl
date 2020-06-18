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
							
							$( "#fundDate" ).datepicker({
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
							
							$("#fund").submit(function() { return false; });
							
							$("#fund2").submit(function() { return false; });
					
							
							$("#send").on("click", function(){
								var accountID = $("#accountID").val();
								var fundDate = $("#fundDate").val();
								var fundAmount = $("#fundAmount").val();
								var fundNote = $("#fundNote").val();
								
								if (accountID != '' && fundDate != '' && fundAmount != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_fund.php',
										dataType: 'JSON',
										data:{
											accountID: accountID,
											fundDate: fundDate,
											fundAmount: fundAmount,
											fundNote: fundNote
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "funds.php?code=1";
										}
									});
								}
							});
							
							$("#send2").on("click", function(){
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								
								if (startDate.length != '' && endDate.length != ''){
									
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "funds.php?module=fund&act=search&startDate=" + startDate + "&endDate=" + endDate;
									
								}
							});
						});
					</script>
				{/literal}
				
				{if $module == 'fund' AND $act == 'search'}
					<br>
					<table width="98%" align="center">
						<tr>
							<td>
								<a href="#inline2" class="modalbox2"><button type="button" class="btn btn-primary">Cari Pengeluaran Biaya</button></a>
							</td>
						</tr>
					</table>
					
					<!-- hidden inline form -->
					<div id="inline2">
						<form id="fund2" name="fund2" action="#" method="POST">
						<table cellpadding="5" cellspacing="5" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<tr>
								<td colspan="2"><h3>Cari Pengeluaran Biaya</h3></td>
							</tr>
							<tr>
								<td><label for="startDate">Periode Awal</label></td>
								<td><input type="text" id="startDate" name="startDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
							</tr>
							<tr>
								<td><label for="endDate">Periode Akhir</label></td>
								<td><input type="text" id="endDate" name="endtDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
							</tr>
						</table>
						<button id="send2" class="btn btn-primary">Cari</button>
						</form>
					</div>
					
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Hasil Pencarian, Periode {$startDate} s/d {$endDate}</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="100" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Kode Akun <i class="fa fa-sort"></i></th>
											<th width="200" style='border-left: 1px solid #CCCCCC;'>Nama Akun <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Jumlah <i class="fa fa-sort"></i></th>
											<th width="250" style='border-left: 1px solid #CCCCCC;'>Keterangan <i class="fa fa-sort"></i></th>
											<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	{section name=dataFund loop=$dataFund}
								    	<tr class="borderedtd">
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].no}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].fundDate}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].accountCode}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].accountName}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].fundAmount}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].fundNote}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a href="edit_funds.php?module=fund&act=edit&fundID={$dataFund[dataFund].fundID}&startDate={$start}&endDate={$end}" data-width="400" data-height="290" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20">
								    			<a href="funds.php?module=fund&act=delete&fundID={$dataFund[dataFund].fundID}&startDate={$start}&endDate={$end}" onclick="return confirm('Anda Yakin ingin menghapus data biaya {$dataFund[dataFund].accountName}?');"><img src="images/icons/delete.png" width="20"></td>
								    	</tr>
								    	{/section}
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_funds.php?module=fund&act=print&startDate={$start}&endDate={$end}" target="_blank"><button type="button" class="btn btn-warning">Print</button></a></td>
						</tr>
					</table>
					
				{else}
					<br>
					<table width="98%" align="center">
						<tr>
							<td>
								<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Tambah Pengeluaran Biaya</button></a>
							</td>
						</tr>
					</table>
					
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Pengeluaran Biaya per {$periodMonth} {$periodYear}</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="100" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Kode Akun <i class="fa fa-sort"></i></th>
											<th width="200" style='border-left: 1px solid #CCCCCC;'>Nama Akun <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Jumlah <i class="fa fa-sort"></i></th>
											<th width="250" style='border-left: 1px solid #CCCCCC;'>Keterangan <i class="fa fa-sort"></i></th>
											<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	{section name=dataFund loop=$dataFund}
								    	<tr class="borderedtd">
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].no}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].fundDate}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].accountCode}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].accountName}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].fundAmount}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataFund[dataFund].fundNote}</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><a href="edit_funds.php?module=fund&act=edit&fundID={$dataFund[dataFund].fundID}&startDate={$start}&endDate={$end}" data-width="400" data-height="290" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20">
								    			<a href="funds.php?module=fund&act=delete&fundID={$dataFund[dataFund].fundID}&startDate={$start}&endDate={$end}" onclick="return confirm('Anda Yakin ingin menghapus data biaya {$dataFund[dataFund].accountName}?');"><img src="images/icons/delete.png" width="20"></td>
								    	</tr>
								    	{/section}
								    </tbody>
								</table>
							</td>
						</tr>
					</table>
					
					<!-- hidden inline form -->
					<div id="inline">
						<table width="98%" align="center">
							<tr>
								<td colspan="3"><h3>Pengeluaran Biaya</h3></td>
							</tr>
							<tr>
								<td>
									<form id="fund" name="fund" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Tanggal</td>
											<td width="5">:</td>
											<td><input type="text" value="{$fundDate}" id="fundDate" name="fundDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Akun Biaya</td>
											<td>:</td>
											<td>
												<select id="accountID" name="accountID" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value=""></option>
													{section name=dataAccount loop=$dataAccount}
														<option value="{$dataAccount[dataAccount].accountID}">{$dataAccount[dataAccount].accountCode} - {$dataAccount[dataAccount].accountName}</option>
													{/section}
												</select>
											</td>
										</tr>
										<tr>
											<td>Jumlah</td>
											<td>:</td>
											<td><input type="text" id="fundAmount" name="fundAmount" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Keterangan</td>
											<td>:</td>
											<td><input type="text" id="fundNote" name="fundNote" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
									</table>
									<button id="send" class="btn btn-primary">Simpan</button>
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