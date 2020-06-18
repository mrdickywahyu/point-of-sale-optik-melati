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
							
							$(".modalbox").fancybox();
							
							$("#barcode").submit(function() { return false; });
							
							$("#productBarcode").autocomplete("product_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('productBarcode').value = myarr[0];
							});
							
							$("#send").on("click", function(){
								var productBarcode = $("#productBarcode").val();
								var qty = $("#qty").val();
								
								if (productBarcode != '' && qty != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_barcode.php',
										dataType: 'JSON',
										data:{
											productBarcode: productBarcode,
											qty: qty
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											if (data[0] == 'NO')
											{
												alert("Produk tidak ditemukan, cek kembali kode yang Anda masukkan.");
												$('#send').show();
											}
											else if (data[0] == 'EXIST')
											{
												alert("Produk sudah ada di daftar cetak barcode.");
												$('#send').show();
											}
											else
											{
												setTimeout("$.fancybox.close()", 1000);
												window.location.href = "barcodes.php?code=1";
											}
										}
									});
								}
							});
						});
					</script>
				{/literal}
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Cetak Barcode</button></a>
					<a href="barcodes.php?module=barcode&act=refresh"><button class="btn btn-warning" type="button">Refresh</button></a>
					<h3>Manajemen Cetak Barcode</h3>
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="30" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="80" style='border-left: 1px solid #CCCCCC;'>Kode Produk <i class="fa fa-sort"></i></th>
									<th width="200" style='border-left: 1px solid #CCCCCC;'>Nama Produk <i class="fa fa-sort"></i></th>
									<th width="130" style='border-left: 1px solid #CCCCCC;'>Kategori <i class="fa fa-sort"></i></th>
									<th width="70" style='border-left: 1px solid #CCCCCC;'>Brand <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Barcode <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Qty Barcode<i class="fa fa-sort"></i></th>
									<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								{section name=dataBarcode loop=$dataBarcode}
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataBarcode[dataBarcode].no}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataBarcode[dataBarcode].productBarcode}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataBarcode[dataBarcode].productName}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataBarcode[dataBarcode].categoryName}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataBarcode[dataBarcode].brandName}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><img src="images/barcodes/{$dataBarcode[dataBarcode].productBarcode}.png" height="50"></td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataBarcode[dataBarcode].qty}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a href="barcodes.php?module=barcode&act=delete&barcodeID={$dataBarcode[dataBarcode].barcodeID}&productBarcode={$dataBarcode[dataBarcode].productBarcode}" onclick="return confirm('Anda Yakin ingin menghapus cetak barcode {$dataBarcode[dataBarcode].productBarcode}#{$dataBarcode[dataBarcode].productName}?');"><button type="button" class="btn btn-danger">Hapus</button></a>
									</td>
								</tr>
								{/section}
							</tbody>
						</table>
					</div>
					<br>
					<a href="print_barcodes.php?module=barcode&act=print" target="_blank"><button class="btn btn-success" type="button">Cetak Barcode</button></a><br><br>
					
					<div id="inline">	
						<table width="95%" align="center">
							<tr>
								<td colspan="3"><h3>Tambah Cetak Barcode</h3></td>
							</tr>
							<tr>
								<td>
									<form id="barcode" name="barcode" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="130">Kode Produk</td>
											<td width="5">:</td>
											<td><input type="text" placeholder="Kode atau Nama Produk" id="productBarcode" name="productBarcode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Qty Barcode</td>
											<td>:</td>
											<td><input type="text" placeholder="Jumlah barcode yang dicetak" id="qty" name="qty" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
									</table>
									<button id="send" class="btn btn-primary">Simpan</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}