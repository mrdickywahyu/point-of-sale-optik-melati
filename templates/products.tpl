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
							
							$("#barcodeType").change(function(e){
								var barcodeType = $("#barcodeType").val();
								
								var myarr = barcodeType.split("#");
								
								$("#barcodeBox").empty(); 
								
								if (myarr[0] == '1'){
									$('<li></li>').appendTo('#barcodeBox').html('<input type="text" id="productBarcode" name="productBarcode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>').addClass('libarcode');
								}
								if (myarr[0] == '2'){
									$('<li></li>').appendTo('#barcodeBox').html('<input type="text" id="productBarcode" value="'+ myarr[1] +'" name="productBarcode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED><input type="hidden" id="productBarcode" value="'+ myarr[1] +'" name="productBarcode">').addClass('libarcode');
								}
							});
							
							$(".modalbox").fancybox();
							$(".modalbox2").fancybox();
							
							$("#product").submit(function() { return false; });
							
							$("#product2").submit(function() { return false; });
							
							$("#productBarcode2").autocomplete("product_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('productBarcode2').value = myarr[0];
							});
					
							
							$("#send").on("click", function(){
								var supplierID = $("#supplierID").val();
								var categoryID = $("#categoryID").val();
								var brandID = $("#brandID").val();
								var productBarcode = $("#productBarcode").val();
								var productName = $("#productName").val();
								var productDiscount = $("#productDiscount").val();
								var productBuyPrice = $("#productBuyPrice").val();
								var productSalePrice = $("#productSalePrice").val();
								var productStock = $("#productStock").val();
								var productNote = $("#productNote").val();
								
								if (productBarcode != '' && productName != '' && productBuyPrice != '' && productStock != '' && productSalePrice != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_product.php',
										dataType: 'JSON',
										data:{
											supplierID: supplierID,
											categoryID: categoryID,
											brandID: brandID,
											productBarcode: productBarcode,
											productName: productName,
											productDiscount: productDiscount,
											productBuyPrice: productBuyPrice,
											productSalePrice: productSalePrice,
											productStock: productStock,
											productNote: productNote
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "products.php?code=1";
										}
									});
								}
							});
							
							$("#send2").on("click", function(){
								var productBarcode = $("#productBarcode2").val();
								var categoryID = $("#categoryID2").val();
								var brandID = $("#brandID2").val();
								
								setTimeout("$.fancybox.close()", 1000);
								window.location.href = "products.php?module=product&act=search&categoryID=" + categoryID + "&brandID=" + brandID + "&productBarcode=" + productBarcode;
							});
						});
					</script>
				{/literal}
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Produk</button></a>
					<a href="#inline2" class="modalbox2"><button class="btn btn-primary" type="button">Cari Produk</button></a>
					<a href="print_product.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen Produk</h3>
					
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="130" style='border-left: 1px solid #CCCCCC;'>Kode Produk <i class="fa fa-sort"></i></th>
									<th width="330" style='border-left: 1px solid #CCCCCC;'>Nama Produk <i class="fa fa-sort"></i></th>
									<th width="50" style='border-left: 1px solid #CCCCCC;'>Stok <i class="fa fa-sort"></i></th>
									<th width="110" style='border-left: 1px solid #CCCCCC;'>Harga Beli <i class="fa fa-sort"></i></th>
									<th width="110" style='border-left: 1px solid #CCCCCC;'>Harga Jual <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Diskon (%) <i class="fa fa-sort"></i></th>
									<th width="60" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
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
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataProduct[dataProduct].productDiscount}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a title="Edit" href="edit_products.php?module=product&act=edit&productID={$dataProduct[dataProduct].productID}" data-width="930" data-height="380" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="20"></a>
										<a title="Hapus" href="products.php?module=product&act=delete&productID={$dataProduct[dataProduct].productID}" onclick="return confirm('Anda Yakin ingin menghapus produk {$dataProduct[dataProduct].productBarcode}#{$dataProduct[dataProduct].productName}?');"><img src="images/icons/delete.png" width="20"></a>
									</td>
								</tr>
								{/section}
							</tbody>
						</table>
					</div>
					<br>
					<div id="paging">{$pageLink}</div>
					
					<div id="inline">	
						<table width="100%" align="center">
							<tr>
								<td colspan="3"><h3>Tambah Produk</h3></td>
							</tr>
							<tr>
								<td>
									<form id="product" name="product" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="120">Kode Produk</td>
											<td width="5">:</td>
											<td><select name="barcodeType" id="barcodeType" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value="">- Pilih Penggunaan Kode Produk -</option>
													<option value="1#A">Manual</option>
													<option value="2#{$productBarcode}">Otomatis</option>
												</select>
											</td>
											<td width="20"></td>
											<td width="120">Harga Beli</td>
											<td width="5">:</td>
											<td><input type="number" id="productBuyPrice" name="productBuyPrice" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td>
												<div id="barcodeBox">
													<li class="libarcode"></li>
												</div>
											</td>
											<td width="20"></td>
											<td>Harga Jual</td>
											<td>:</td>
											<td><input type="number" id="productSalePrice" name="productSalePrice" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Nama Produk</td>
											<td>:</td>
											<td><input type="text" id="productName" name="productName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
											<td width="20"></td>
											<td>Diskon (%)</td>
											<td>:</td>
											<td><input type="number" id="productDiscount" name="productDiscount" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Supplier</td>
											<td>:</td>
											<td><select name="supplierID" id="supplierID" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
												<option value="">None</option>
												{section name=dataSupplier loop=$dataSupplier}
													<option value="{$dataSupplier[dataSupplier].supplierID}">{$dataSupplier[dataSupplier].supplierName}</option>
												{/section}
											</select></td>
											<td width="20"></td>
											<td>Stok</td>
											<td>:</td>
											<td><input type="number" id="productStock" name="productStock" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Kategori</td>
											<td>:</td>
											<td><select name="categoryID" id="categoryID" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
												<option value="">None</option>
												{section name=dataCategory loop=$dataCategory}
													<option value="{$dataCategory[dataCategory].categoryID}">{$dataCategory[dataCategory].categoryName}</option>
												{/section}
											</select></td>
											<td width="20"></td>
											<td>Note</td>
											<td>:</td>
											<td><input type="text" id="productNote" name="productNote" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Brand</td>
											<td>:</td>
											<td><select name="brandID" id="brandID" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
												<option value="">None</option>
												{section name=dataBrand loop=$dataBrand}
													<option value="{$dataBrand[dataBrand].brandID}">{$dataBrand[dataBrand].brandName}</option>
												{/section}
											</select></td>
											<td width="20"></td>
											<td colspan="3"></td>
										</tr>
									</table>
									<button id="send" class="btn btn-primary">Simpan</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
					
					<div id="inline2">	
						<form id="product2" name="product2" method="GET" action="#">
						<h3>Cari Produk</h3>
						<table cellpadding="7" cellspacing="7" width="95%">
							<tr>
								<td width="130">Kategori</td>
								<td width="5">:</td>
								<td><select name="categoryID" id="categoryID2" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
									<option value="">None</option>
									{section name=dataCategory loop=$dataCategory}
										<option value="{$dataCategory[dataCategory].categoryID}">{$dataCategory[dataCategory].categoryName}</option>
									{/section}
								</select></td>
							</tr>
							<tr>
								<td>Brand</td>
								<td>:</td>
								<td><select name="brandID" id="brandID2" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
									<option value="">None</option>
									{section name=dataBrand loop=$dataBrand}
										<option value="{$dataBrand[dataBrand].brandID}">{$dataBrand[dataBrand].brandName}</option>
									{/section}
								</select></td>
							</tr>
							<tr>
								<td>Kode Produk</td>
								<td>:</td>
								<td><input type="text" id="productBarcode2" name="productBarcode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
							</tr>
						</table>
						<button id="send2" class="btn btn-primary">Cari</button>
						</form>
					</div>
				</div>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}