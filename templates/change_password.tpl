{include file="header.tpl"}

<style>
li{
	list-style: none;
}
</style>

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
				
				<div style="width: 95%; margin: 0px auto;">
				
					{if $code == '1'}
						<div class="n_error">Anda salah memasukkan password lama Anda.</div>
					{/if}
					{if $code == '2'}
						<div class="n_error">Password baru dan ketikkan ulang password baru tidak cocok.</div>
					{/if}
					{if $code == '3'}
						<div class="n_ok">Password berhasil diupdate.</div>
					{/if}
					
					<h2>Ubah Password</h2>
							
					<form name="identity" action="change_password.php?module=change&act=update" method="POST">
						<table width="300" cellpadding="8" cellspacing="8" bgcolor="#FFFFFF" style="color: #000000;">
							<tr>
								<td width="300">
									<label for="oldPassword">Password Lama Anda</label><br>
									<input type="password" id="oldPassword" name="oldPassword" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
							</tr>
							<tr>
								<td>
									<label for="newPassword">Password Baru Anda</label><br>
									<input type="password" id="newPassword" name="newPassword" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
							</tr>
							<tr valign="top">
								<td rowspan="2">
									<label for="newPassword2">Ulangi Password Baru</label><br>
									<input type="password" id="newPassword2" name="newPassword2" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
							</tr>
						</table>
						<br>
						<button type="submit" class="btn btn-success">Ubah Password</button>
					</form>
					<p>&nbsp;</p>
				</div>
				
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}