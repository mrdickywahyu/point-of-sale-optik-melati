{include file="header.tpl"}

<div class="container">
	<!-- Push Wrapper -->
	<div class="mp-pusher" id="mp-pusher">

		{include file="navigation.tpl"}

		<div class="scroller"><!-- this is for emulating position fixed of the nav -->
			<div class="scroller-inner">
				<div style="padding-left: 18px; padding-top: 10px;">
					
					{include file="logo.tpl"}
					
				</div>
				
				<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
  				<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
				<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
  				<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />
  				
  				{literal}
					<script>
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
							
							$(".various3").fancybox({
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
							
							$(".various4").fancybox({
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
							
							$("#productBarcode").autocomplete("product_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('productBarcode').value = myarr[0];
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
				
				<p style="padding: 20px;">
					{if $outletLevel == '1'}
						Hi <b>{$outletName}</b><blink>, Selamat datang di aplikasi Melati Optical. </blink><br>
						Anda dapat melakukan pengolahan data outlet melalui menu yang dapat Anda klik pada pojok kiri atas (Open Menu).
					{else}
						Hi <b>{if $userFullName != ''} {$userFullName} {else} {$outletName} {/if}</b>, Selamat datang di aplikasi Melati Optical <br>
						Anda dapat melakukan transaksi penjualan melalui menu yang dapat Anda klik pada pojok kiri atas (Open Menu).
					{/if}
					<br><br>
					<a href="stock_minimal.php" data-width="1100" data-height="450" class="various2 fancybox.iframe" title="Stok Produk Akan Habis"><button type="button" class="btn btn-warning">Produk Kosong / Akan Kosong ({$numsProduct})</button></a>
					<a href="piutang.php" data-width="1100" data-height="450" class="various3 fancybox.iframe" title="Piutang Jatuh Tempo"><button type="button" class="btn btn-info">Piutang Jatuh Tempo ({$numsPiutang})</button></a>
					<a href="hutang.php" data-width="1100" data-height="450" class="various4 fancybox.iframe" title="Hutang Jatuh Tempo"><button type="button" class="btn btn-danger">Hutang Jatuh Tempo ({$numsHutang})</button></a>
					
					{if $userID != ''}
						<form action="home.php" method="GET">
							<input type="hidden" name="module" value="home">
							<input type="hidden" name="act" value="search">
							<table cellpadding="7" cellspacing="7" width="98%" align="center">
								<tr>
									<td width="130">Pencarian Produk</td>
									<td width="255"><input type="text" name="productBarcode" placeholder="Kode atau nama produk" id="productBarcode" style="display: block; width: 244px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required autofocus></td>
									<td><button type="submit" class="btn btn-primary">Cari</button></td>
								</tr>
							</table>
						</form>
					{/if}
					
					{if $module == 'home' AND $act == 'search'}
						
						<h3 style="padding-left: 15px;">Hasil Pencarian :</h3>
						<div class="table-responsive">
							<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="98%" align="center">
								<thead>
									<tr>
										<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
										<th width="130" style='border-left: 1px solid #CCCCCC;'>Kode Produk <i class="fa fa-sort"></i></th>
										<th width="300" style='border-left: 1px solid #CCCCCC;'>Nama Produk <i class="fa fa-sort"></i></th>
										<th width="80" style='border-left: 1px solid #CCCCCC;'>Stok <i class="fa fa-sort"></i></th>
										<th width="120" style='border-left: 1px solid #CCCCCC;'>Harga Beli <i class="fa fa-sort"></i></th>
										<th width="120" style='border-left: 1px solid #CCCCCC;'>Harga Jual <i class="fa fa-sort"></i></th>
										<th width="80" style='border-left: 1px solid #CCCCCC;'>Diskon (%) <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
									{section name=dataProduct loop=$dataProduct}
									<tr>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataProduct[dataProduct].no}</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataProduct[dataProduct].productBarcode}</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataProduct[dataProduct].productName}</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataProduct[dataProduct].productStock}</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataProduct[dataProduct].productBuyPrice}</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataProduct[dataProduct].productSalePrice}</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataProduct[dataProduct].productDiscount}</td>
									</tr>
									{/section}
								</tbody>
							</table>
						</div>
					{/if}
				</p>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}