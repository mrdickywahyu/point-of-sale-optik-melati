<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:08:52
         compiled from ".\templates\change_password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:156355d824884735282-20875549%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5a9cd71620095e3c61c6d407328df0d8f21e456' => 
    array (
      0 => '.\\templates\\change_password.tpl',
      1 => 1413905760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156355d824884735282-20875549',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'code' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d82488478a867_66907502',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d82488478a867_66907502')) {function content_5d82488478a867_66907502($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<style>
li{
	list-style: none;
}
</style>

<div class="container">
	<!-- Push Wrapper -->
	<div class="mp-pusher" id="mp-pusher">

		<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<div class="scroller"><!-- this is for emulating position fixed of the nav -->
			<div class="scroller-inner">
				<!-- Top Navigation -->
				<div style="padding-left: 18px; padding-top: 10px;">
					
					<?php echo $_smarty_tpl->getSubTemplate ("logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					
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
				
					<?php if ($_smarty_tpl->tpl_vars['code']->value=='1'){?>
						<div class="n_error">Anda salah memasukkan password lama Anda.</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['code']->value=='2'){?>
						<div class="n_error">Password baru dan ketikkan ulang password baru tidak cocok.</div>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['code']->value=='3'){?>
						<div class="n_ok">Password berhasil diupdate.</div>
					<?php }?>
					
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
		
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>