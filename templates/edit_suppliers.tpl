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
			
			$("#supplier").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var supplierID = $("#supplierID").val();
				var supplierName = $("#supplierName").val();
				var supplierAddress = $("#supplierAddress").val();
				var supplierPhone = $("#supplierPhone").val();
				var supplierFax = $("#supplierFax").val();
				var supplierContactPerson = $("#supplierContactPerson").val();
				var supplierCPHp = $("#supplierCPHp").val();
				var supplierStatus = $("#supplierStatus").val();
				
				if (supplierID != '' && supplierName != '' && supplierStatus != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_suppliers.php',
						dataType: 'JSON',
						data:{
							supplierID: supplierID,
							supplierName: supplierName,
							supplierAddress: supplierAddress,
							supplierPhone: supplierPhone,
							supplierFax: supplierFax,
							supplierContactPerson: supplierContactPerson,
							supplierCPHp: supplierCPHp,
							supplierStatus: supplierStatus
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
				

{if $module == 'supplier' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Supplier</h3></td>
		</tr>
		<tr>
			<td>
				<form id="supplier" name="supplier" method="POST" action="#">
				<input type="hidden" id="supplierID" name="supplierID" value="{$supplierID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode Supplier</td>
						<td width="5">:</td>
						<td><input type="text" id="supplierCode" name="supplierCode" value="{$supplierCode}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><input type="text" id="supplierName" name="supplierName" value="{$supplierName}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><input type="text" id="supplierAddress" name="supplierAddress" value="{$supplierAddress}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><input type="text" id="supplierPhone" name="supplierPhone" value="{$supplierPhone}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
					<tr>
						<td>Fax</td>
						<td>:</td>
						<td><input type="text" id="supplierFax" name="supplierFax" value="{$supplierFax}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
					<tr>
						<td>Kontak Person</td>
						<td>:</td>
						<td><input type="text" id="supplierContactPerson" name="supplierContactPerson" value="{$supplierContactPerson}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
					<tr>
						<td>Nomor HP</td>
						<td>:</td>
						<td><input type="text" id="supplierCPHp" name="supplierCPHp" value="{$supplierCPHp}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><select name="supplierStatus" id="supplierStatus" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
							<option value="">- Pilih Status -</option>
							<option value="Y" {if $supplierStatus == 'Y'} SELECTED {/if}>Y (Aktif)</option>
							<option value="N" {if $supplierStatus == 'N'} SELECTED {/if}>N (Tidak Aktif)</option>
						</select></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>