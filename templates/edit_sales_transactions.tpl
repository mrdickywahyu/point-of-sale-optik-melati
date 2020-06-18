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

<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />

<body style='background-color: #FFF; color: #000;'>
{literal}
	<script>
		$(document).ready(function() {
			
			$("#trx").submit(function() { return false; });
			
			$("#send").on("click", function(){
				var detailID = $("#detailID").val();
				var qty = $("#qty").val();
				var price = $("#price").val();
				var stock = $("#stock").val();
				var buyPrice = $("#buyPrice").val();
				var discPercent = $("#discPercent").val();
				var note = $("#note").val();
				
				if (detailID != '' && qty != '' && price != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_sales_transactions.php',
						dataType: 'JSON',
						data:{
							detailID: detailID,
							qty: qty,
							price: price,
							stock: stock,
							buyPrice: buyPrice,
							note: note,
							discPercent: discPercent
						},
						beforeSend: function (data) {
							$('#send').hide();
						},
						success: function(data) {
							if (data == 'ERROR')
							{
								alert("Jumlah stok tidak cukup, stok saat ini: "+stock);
								$('#send').show();
							}
							else
							{
								parent.jQuery.fancybox.close();
							}
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
			<td colspan="3"><h3>Ubah Detail Transaksi</h3></td>
		</tr>
		<tr>
			<td>
				<form id="trx" name="trx" method="POST" action="#">
				<input type="hidden" id="detailID" name="detailID" value="{$detailID}">
				<input type="hidden" id="stock" name="stock" value="{$productStock}">
				<input type="hidden" id="discPercent" name="discPercent" value="{$discPercent}">
				<table cellpadding="7" cellspacing="7">
					<tr valign="top">
						<td width="110">Kode Produk</td>
						<td width="5">:</td>
						<td>{$productBarcode}</td>
					</tr>
					<tr valign="top">
						<td>Nama Produk</td>
						<td>:</td>
						<td>{$productName}</td>
					</tr>
					<tr valign="top">
						<td>Harga Satuan</td>
						<td>:</td>
						<td>{$detailPrice}<input type="hidden" id="price" name="price" value="{$detailPrice}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr valign="top">
						<td>Qty</td>
						<td>:</td>
						<td><input type="text" id="qty" name="qty" value="{$detailQty}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr valign="top">
						<td>Note</td>
						<td>:</td>
						<td><input type="text" id="note" name="note" value="{$note}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>