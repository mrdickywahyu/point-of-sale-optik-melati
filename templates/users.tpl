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
					<a href="home.php"><span>Home</span></a>
					<span class="right"><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Logout</span></a></span>
				</div>
				
				<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
  				<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
  				
  				<style>
  					li{
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
							
							$(".modalbox").fancybox();
							$(".modalbox2").fancybox();
							
							$("#user").submit(function() { return false; });
							
							$("#user2").submit(function() { return false; });
							
							$("#send").on("click", function(){
								var userNIP = $("#userNIP").val();
								var userFullName = $("#userFullName").val();
								var userPhone = $("#userPhone").val();
								var userLevel = $("#userLevel").val();
								var userBlocked = $("#userBlocked").val();
								var userName = $("#userName").val();
								var userPassword = $("#userPassword").val();
								
								if (userNIP != '' && userFullName != '' && userName != '' && userBlocked != '' && userPassword != '' && userLevel != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_user.php',
										dataType: 'JSON',
										data:{
											userNIP: userNIP,
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
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "users.php?code=1";
										}
									});
								}
							});
						});
					</script>
				{/literal}
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah User</button></a>
					<a href="print_user.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen User</h3>
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>NIP <i class="fa fa-sort"></i></th>
									<th width="300" style='border-left: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Phone <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Level <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Blokir <i class="fa fa-sort"></i></th>
									<th width="200" style='border-left: 1px solid #CCCCCC;'>Username <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								{section name=dataUser loop=$dataUser}
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataUser[dataUser].no}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataUser[dataUser].userNIP}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataUser[dataUser].userFullName}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataUser[dataUser].userPhone}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataUser[dataUser].userLevel}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataUser[dataUser].userBlocked}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataUser[dataUser].userName}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a href="edit_users.php?module=user&act=edit&userID={$dataUser[dataUser].userID}" data-width="450" data-height="480" class="various2 fancybox.iframe"><button type="button" class="btn btn-success">Edit</button></a>
										<a href="users.php?module=user&act=delete&userID={$dataUser[dataUser].userID}" onclick="return confirm('Anda Yakin ingin menghapus user {$dataUser[dataUser].userFullName}?');"><button type="button" class="btn btn-danger">Hapus</button></a>
									</td>
								</tr>
								{/section}
							</tbody>
						</table>
					</div>
					<br>
					<div id="paging">{$pageLink}</div>
					
					<div id="inline">	
						<table width="98%" align="center">
							<tr>
								<td colspan="3"><h3>Tambah User</h3></td>
							</tr>
							<tr>
								<td>
									<form id="user" name="user" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="120">NIP</td>
											<td width="5">:</td>
											<td><input type="text" name="userNIP" value="{$userNIP}" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
												<input type="hidden" name="userNIP" id="userNIP" value="{$userNIP}">
											</td>
										</tr>
										<tr>
											<td>Nama </td>
											<td>:</td>
											<td><input type="text" name="userFullName" id="userFullName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Phone </td>
											<td>:</td>
											<td><input type="text" name="userPhone" id="userPhone" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Level</td>
											<td>:</td>
											<td><select name="userLevel" id="userLevel" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
												<option value="">- Pilih Level -</option>
												<option value="1">Administrator</option>
												<option value="2">Staff</option>
											</select></td>
										</tr>
										<tr>
											<td>Blokir</td>
											<td>:</td>
											<td><select name="userBlocked" id="userBlocked" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
												<option value="">- Pilih Status -</option>
												<option value="Y">Y (Aktif)</option>
												<option value="N">N (Tidak Aktif)</option>
											</select></td>
										</tr>
										<tr>
											<td>Username</td>
											<td>:</td>
											<td><input type="text" name="userName" id="userName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Password</td>
											<td>:</td>
											<td><input type="text" name="userPassword" id="userPassword" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
									</table>
									<button id="send" class="btn btn-primary">Simpan</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}