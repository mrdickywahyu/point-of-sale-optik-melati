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
			
			$("#trx").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var detailID = $("#detailID").val();
				var qty = $("#qty").val();
				var price = $("#price").val();
				
				if (detailID != '' && qty != '' && price != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_retur_transactions.php',
						dataType: 'JSON',
						data:{
							detailID: detailID,
							qty: qty,
							price: price
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
				

{if $module == 'trx' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Detail Retur</h3></td>
		</tr>
		<tr>
			<td>
				<form id="trx" name="trx" method="POST" action="#">
				<input type="hidden" id="detailID" name="detailID" value="{$detailID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="250">Kode Produk</td>
						<td width="5">:</td>
						<td>{$productBarcode}</td>
					</tr>
					<tr valign="top">
						<td>Nama Produk</td>
						<td>:</td>
						<td>{$productName}</td>
					</tr>
					<tr>
						<td>Harga Sup Sebelumnya</td>
						<td>:</td>
						<td>Rp. {$productBuyPrice}</td>
					</tr>
					<tr>
						<td>Harga Supplier Satuan</td>
						<td>:</td>
						<td><input type="text" id="price" name="price" value="{$detailReturPrice}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Qty</td>
						<td>:</td>
						<td><input type="text" id="qty" name="qty" value="{$detailReturQty}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>