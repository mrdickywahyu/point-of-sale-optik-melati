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
  				
  				<style>
  					.libarcode{
  						list-style: none;
  					}
  				</style>
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="print_stock_product.php?module=so&act=print" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Daftar Produk</h3>
					
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="130" style='border-left: 1px solid #CCCCCC;'>Kode Produk <i class="fa fa-sort"></i></th>
									<th width="320" style='border-left: 1px solid #CCCCCC;'>Nama Produk <i class="fa fa-sort"></i></th>
									<th width="70" style='border-left: 1px solid #CCCCCC;'>Stok <i class="fa fa-sort"></i></th>
									<th width="110" style='border-left: 1px solid #CCCCCC;'>Harga Beli <i class="fa fa-sort"></i></th>
									<th width="110" style='border-left: 1px solid #CCCCCC;'>Harga Jual <i class="fa fa-sort"></i></th>
									<th width="110" style='border-left: 1px solid #CCCCCC;'>Harga PM <i class="fa fa-sort"></i></th>
									<th width="80" style='border-left: 1px solid #CCCCCC;'>Disc (%)<i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								{section name=dataProduct loop=$dataProduct}
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataProduct[dataProduct].no}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataProduct[dataProduct].productBarcode}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataProduct[dataProduct].productName}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataProduct[dataProduct].productStock}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataProduct[dataProduct].productBuyPrice}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataProduct[dataProduct].productSalePrice}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>{$dataProduct[dataProduct].productCheapestPrice}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataProduct[dataProduct].productDiscount}</td>
								</tr>
								{/section}
							</tbody>
						</table>
						<p>&nbsp;</p>
					</div>
					
				</div>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}