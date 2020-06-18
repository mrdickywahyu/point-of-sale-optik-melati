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
			
			$("#fund").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var fundID = $("#fundID").val();
				var accountID = $("#accountID").val();
				var fundAmount = $("#fundAmount").val();
				var fundNote = $("#fundNote").val();
				var startDate = $("#startDate").val();
				var endDate = $("#endDate").val();
				
				if (accountID != '' && fundAmount != '' && fundID != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_fund.php',
						dataType: 'JSON',
						data:{
							accountID: accountID,
							fundAmount: fundAmount,
							fundNote: fundNote,
							fundID: fundID
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
				

{if $module == 'fund' AND $act == 'edit'}
	<h2>Ubah Akun Biaya</h2>
						
	<form id="fund" name="fund" action="#" method="POST">
		<input type="hidden" name="fundID" id="fundID" value="{$fundID}">
		<table cellpadding="7" cellspacing="7">
			<tr>
				<td width="140">Tanggal</td>
				<td width="5">:</td>
				<td>{$fundDate}</td>
			</tr>
			<tr>
				<td>Akun Biaya</td>
				<td>:</td>
				<td>
					<select id="accountID" name="accountID" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
						<option value=""></option>
						{section name=dataAccount loop=$dataAccount}
							{if $dataAccount[dataAccount].accountID == $accountID}
								<option value="{$dataAccount[dataAccount].accountID}" SELECTED>{$dataAccount[dataAccount].accountCode} - {$dataAccount[dataAccount].accountName}</option>
							{else}
								<option value="{$dataAccount[dataAccount].accountID}">{$dataAccount[dataAccount].accountCode} - {$dataAccount[dataAccount].accountName}</option>
							{/if}
						{/section}
					</select>
				</td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td>:</td>
				<td><input type="text" id="fundAmount" value="{$fundAmount}" name="fundAmount" class="txt" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td><input type="text" id="fundNote" value="{$fundNote}" name="fundNote" class="txt" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
			</tr>
		</table>
		<button id="send" class="btn btn-primary">Simpan</button>
	</form>

{/if}
</body>