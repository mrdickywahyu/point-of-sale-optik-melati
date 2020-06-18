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
			
			$("#so").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var soID = $("#soID").val();
				var productBarcode = $("#productBarcode").val();
				var realStock = parseInt($("#realStock").val());
				var stok = $("#stok").val();
				var realStock2 = $("#realStock2").val();
				var status = $("#status").val();
				var qty = $("#qty").val();
				var qty2 = $("#qty2").val();
				var productStock = parseInt($("#productStock").val());
				var soDescription = $("#soDescription").val();
				
				if (soID != '' && realStock != '' && status != '' && qty != ''){
					if (status == '1' && realStock < productStock){
						alert("Periksa kembali stok nyata.");
					}
					else if (status == '2' && productStock < realStock){
						alert("Periksa kembali stok nyata.");
					}
					else if (qty == '0' || realStock == '0'){
						alert("Periksa kembali penulisan stok.");
					}
					else{
						$.ajax({
							type: 'POST',
							url: 'save_edit_stock_opname.php',
							dataType: 'JSON',
							data:{
								soID: soID,
								productBarcode: productBarcode,
								realStock: realStock,
								realStock2: realStock2,
								stok: stok,
								productStock: productStock,
								status: status,
								qty: qty,
								qty2: qty2,
								soDescription: soDescription
							},
							beforeSend: function (data) {
								$('#send').hide();
							},
							success: function(data) {
								parent.jQuery.fancybox.close();
							}
						});
					}
				}
			});
		});
	</script>	
{/literal}
				

{if $module == 'stock' AND $act == 'edit'}
	<h2>Ubah Stock Opname</h2>
						
	<form id="so" name="so" action="#" method="POST">
		<input type="hidden" name="soID" id="soID" value="{$soID}">
		<input type="hidden" id="productBarcode" value="{$productBarcode}" name="productBarcode">
		<input type="hidden" id="stok" value="{$stok}" name="stok">
		<input type="hidden" id="productStock" value="{$productStock}" name="productStock">
		<input type="hidden" id="realStock2" value="{$realStock}" name="realStock2">
		<input type="hidden" value="{$qty}" id="qty2" name="qty2">
		<input type="hidden" value="{$status}" id="status" name="status">
		<table cellpadding="7" cellspacing="7">
			<tr>
				<td width="120">Tanggal</td>
				<td width="5">:</td>
				<td>{$soDate}</td>
			</tr>
			<tr>
				<td>Kode Produk</td>
				<td>:</td>
				<td>{$productBarcode}</td>
			</tr>
			<tr>
				<td>Nama Produk</td>
				<td>:</td>
				<td>{$productName}</td>
			</tr>
			<tr>
				<td colspan="3"><h3>Data Opname</h3></td>
			</tr>
			<tr>
				<td>Stok Produk</td>
				<td>:</td>
				<td>{$productStock}</td>
			</tr>
			<tr>
				<td>Stok Nyata</td>
				<td>:</td>
				<td><input type="number" id="realStock" value="{$realStock}" name="realStock" class="txt" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
			</tr>
			<tr>
				<td>Status Selisih</td>
				<td>:</td>
				<td>
					<select id="status" name="status" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
						<option value=""></option>
						<option value="1" {if $status == '1'} SELECTED {/if}>Lebih</option>
						<option value="2" {if $status == '2'} SELECTED {/if}>Kurang</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Qty Selisih</td>
				<td>:</td>
				<td><input type="number" value="{$qty}" id="qty" name="qty" class="txt" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td><input type="text" value="{$soDescription}" maxlength="100" id="soDescription" name="soDescription" class="txt" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
			</tr>
		</table>
		<button id="send" class="btn btn-primary">Simpan</button>
	</form>

{/if}
</body>