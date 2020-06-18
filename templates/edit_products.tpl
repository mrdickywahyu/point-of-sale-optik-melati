<link rel="shortcut icon" href="images/favicon.jpg">
<link rel="stylesheet" type="text/css" href="design/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="design/css/demo.css" />
<link rel="stylesheet" type="text/css" href="design/css/icons.css" />
<link rel="stylesheet" type="text/css" href="design/css/component.css" />
<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="design/js/modernizr.custom.js"></script>
<link rel="stylesheet" href="design/js/development-bundle/themes/base/jquery.ui.all.css" type="text/css">
<script type="text/javascript" src="design/js/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="design/js/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="design/js/development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="design/js/ckeditor/ckeditor.js"></script>
<script src="design/js/jquery.plugin.js"></script>
<script src="design/js/jquery.timeentry.js"></script>
	
<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<body style='background-color: #FFF; color: #000;'>
{literal}
	<script>
		$(document).ready(function() {
			
			$("#product").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var productID = $("#productID").val();
				var supplierID = $("#supplierID").val();
				var categoryID = $("#categoryID").val();
				var brandID = $("#brandID").val();
				var productName = $("#productName").val();
				var productDiscount = $("#productDiscount").val();
				var productBuyPrice = $("#productBuyPrice").val();
				var productSalePrice = $("#productSalePrice").val();
				var productStock = $("#productStock").val();
				var productNote = $("#productNote").val();
				
				if (productID != '' && productName != '' && productBuyPrice != '' && productSalePrice != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_products.php',
						dataType: 'JSON',
						data:{
							productID: productID,
							supplierID: supplierID,
							categoryID: categoryID,
							brandID: brandID,
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
							parent.jQuery.fancybox.close();
						}
					});
				}
			});
		});
	</script>	
{/literal}
				

{if $module == 'product' AND $act == 'edit'}
	<table width="98%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Produk</h3></td>
		</tr>
		<tr>
			<td>
				<form id="product" name="product" method="POST" action="#">
				<input type="hidden" name="productID" id="productID" value="{$productID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode Produk</td>
						<td width="5">:</td>
						<td><input type="text" id="productBarcode" name="productBarcode" value="{$productBarcode}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED></td>
						<td width="20"></td>
						<td>Harga Beli</td>
						<td>:</td>
						<td><input type="number" id="productBuyPrice" value="{$productBuyPrice}" name="productBuyPrice" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Nama Produk</td>
						<td>:</td>
						<td><input type="text" value="{$productName}" id="productName" name="productName" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
						<td width="20"></td>
						<td>Harga Jual</td>
						<td>:</td>
						<td><input type="number" id="productSalePrice" name="productSalePrice" value="{$productSalePrice}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Supplier</td>
						<td>:</td>
						<td><select name="supplierID" id="supplierID" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
							<option value="" {if $supplierID == '0'} SELECTED {/if}>None</option>
							{section name=dataSupplier loop=$dataSupplier}
								{if $supplierID == $dataSupplier[dataSupplier].supplierID}
									<option value="{$dataSupplier[dataSupplier].supplierID}" SELECTED>{$dataSupplier[dataSupplier].supplierName}</option>
								{else}
									<option value="{$dataSupplier[dataSupplier].supplierID}">{$dataSupplier[dataSupplier].supplierName}</option>
								{/if}
							{/section}
						</select></td>
						<td width="20"></td>
						<td>Diskon (%)</td>
						<td>:</td>
						<td><input type="number" id="productDiscount" name="productDiscount" value="{$productDiscount}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
					<tr>
						<td>Kategori</td>
						<td>:</td>
						<td><select name="categoryID" id="categoryID" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
							<option value="" {if $categoryID == '0'} SELECTED {/if}>None</option>
							{section name=dataCategory loop=$dataCategory}
								{if $categoryID == $dataCategory[dataCategory].categoryID}
									<option value="{$dataCategory[dataCategory].categoryID}" SELECTED>{$dataCategory[dataCategory].categoryName}</option>
								{else}
									<option value="{$dataCategory[dataCategory].categoryID}">{$dataCategory[dataCategory].categoryName}</option>
								{/if}
							{/section}
						</select></td>
						<td width="20"></td>
						<td>Stok</td>
						<td>:</td>
						<td><input type="number" id="productStock" value="{$productStock}" name="productStock" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Brand</td>
						<td>:</td>
						<td><select name="brandID" id="brandID" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
							<option value="" {if $brandID == '0'} SELECTED {/if}>None</option>
							{section name=dataBrand loop=$dataBrand}
								{if $brandID == $dataBrand[dataBrand].brandID}
									<option value="{$dataBrand[dataBrand].brandID}" SELECTED>{$dataBrand[dataBrand].brandName}</option>
								{else}
									<option value="{$dataBrand[dataBrand].brandID}">{$dataBrand[dataBrand].brandName}</option>
								{/if}
							{/section}
						</select></td>
						<td width="20"></td>
						<td>Note</td>
						<td>:</td>
						<td><input type="text" id="productNote" name="productNote" value="{$productNote}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>