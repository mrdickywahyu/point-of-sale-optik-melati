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

<style>
li{
	list-style: none;
}
</style>

<body style='background-color: #FFF; color: #000;'>
{literal}
	<script>
		$(document).ready(function() {
			
			$("#user").submit(function() { return false; });
	
			$("#send").on("click", function(){
				var userID = $("#userID").val();
				var userFullName = $("#userFullName").val();
				var userPhone = $("#userPhone").val();
				var userLevel = $("#userLevel").val();
				var userBlocked = $("#userBlocked").val();
				var userName = $("#userName").val();
				var userPassword = $("#userPassword").val();
				
				if (userID != '' && userFullName != '' && userLevel != '' && userBlocked != '' & userName != ''){
				
					$.ajax({
						type: 'POST',
						url: 'save_edit_users.php',
						dataType: 'JSON',
						data:{
							userID: userID,
							userFullName: userFullName,
							userPhone: userPhone,
							userLevel: userLevel,
							userBlocked: userBlocked,
							userName: userName,
							userPassword: userPassword
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
				

{if $module == 'user' AND $act == 'edit'}
	<table width="95%" align="center">
		<tr>
			<td colspan="3"><h3>Ubah User</h3></td>
		</tr>
		<tr>
			<td>
				<form id="user" name="user" method="POST" action="#">
				<input type="hidden" id="userID" name="userID" value="{$userID}">
				<table cellpadding="7" cellspacing="7">
					<tr>
						<td width="140">NIP</td>
						<td width="5">:</td>
						<td><input type="text" name="userNIP" value="{$userNIP}" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
							<input type="hidden" name="userNIP" id="userNIP" value="{$userNIP}">
						</td>
					</tr>
					<tr>
						<td>Nama </td>
						<td>:</td>
						<td><input type="text" name="userFullName" value="{$userFullName}" id="userFullName" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Phone </td>
						<td>:</td>
						<td><input type="text" name="userPhone" value="{$userPhone}" id="userPhone" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr>
						<td>Level</td>
						<td>:</td>
						<td><select name="userLevel" id="userLevel" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
							<option value="">- Pilih Level -</option>
							<option value="1" {if $userLevel == '1'} SELECTED {/if}>Administrator</option>
							<option value="2" {if $userLevel == '2'} SELECTED {/if}>Staff</option>
						</select></td>
					</tr>
					<tr>
						<td>Blokir</td>
						<td>:</td>
						<td><select name="userBlocked" id="userBlocked" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
							<option value="">- Pilih Status -</option>
							<option value="Y" {if $userBlocked == 'Y'} SELECTED {/if}>Y (Aktif)</option>
							<option value="N" {if $userBlocked == 'N'} SELECTED {/if}>N (Tidak Aktif)</option>
						</select></td>
					</tr>
					<tr>
						<td>Username</td>
						<td>:</td>
						<td><input type="text" name="userName" value="{$userName}" id="userName" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
					</tr>
					<tr valign="top">
						<td>Password</td>
						<td>:</td>
						<td><input type="text" name="userPassword" id="userPassword" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"> 
						<span style="font-size: 10pt;">*) Bila tidak ingin mengubah password, dikosongkan saja.</span></td>
					</tr>
				</table>
				<button id="send" class="btn btn-primary">Simpan</button>
				</form>
			</td>
		</tr>
	</table>

{/if}
</body>