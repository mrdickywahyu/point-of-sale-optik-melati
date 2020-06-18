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
			
			$("#member").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var memberID = $("#memberID").val();
				var memberFullName = $("#memberFullName").val();
				var memberAddress = $("#memberAddress").val();
				var memberPhone = $("#memberPhone").val();
				
				if (memberID != '' && memberFullName != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_members.php',
						dataType: 'JSON',
						data:{
							memberID: memberID,
							memberFullName: memberFullName,
							memberAddress: memberAddress,
							memberPhone: memberPhone
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
				

{if $module == 'member' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah Member</h3></td>
		</tr>
		<tr>
			<td>
				<form id="member" name="member" method="POST" action="#">
				<input type="hidden" id="memberID" name="memberID" value="{$memberID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">Kode Member</td>
						<td width="5">:</td>
						<td><input type="text" id="memberCode" name="memberCode" value="{$memberCode}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td><input type="text" id="memberFullName" name="memberFullName" value="{$memberFullName}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><input type="text" id="memberAddress" name="memberAddress" value="{$memberAddress}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
					<tr>
						<td>Phone</td>
						<td>:</td>
						<td><input type="text" id="memberPhone" name="memberPhone" value="{$memberPhone}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>