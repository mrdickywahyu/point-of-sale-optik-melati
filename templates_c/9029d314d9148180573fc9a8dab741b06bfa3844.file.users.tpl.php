<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:00:22
         compiled from ".\templates\users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:283005d8246860c21f3-87650868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9029d314d9148180573fc9a8dab741b06bfa3844' => 
    array (
      0 => '.\\templates\\users.tpl',
      1 => 1414745582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '283005d8246860c21f3-87650868',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataUser' => 0,
    'pageLink' => 0,
    'userNIP' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d82468613d381_33607075',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d82468613d381_33607075')) {function content_5d82468613d381_33607075($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['name'] = 'dataUser';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataUser']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataUser']['total']);
?>
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['no'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['userNIP'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['userFullName'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['userPhone'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['userLevel'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['userBlocked'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['userName'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a href="edit_users.php?module=user&act=edit&userID=<?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['userID'];?>
" data-width="450" data-height="480" class="various2 fancybox.iframe"><button type="button" class="btn btn-success">Edit</button></a>
										<a href="users.php?module=user&act=delete&userID=<?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['userID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus user <?php echo $_smarty_tpl->tpl_vars['dataUser']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataUser']['index']]['userFullName'];?>
?');"><button type="button" class="btn btn-danger">Hapus</button></a>
									</td>
								</tr>
								<?php endfor; endif; ?>
							</tbody>
						</table>
					</div>
					<br>
					<div id="paging"><?php echo $_smarty_tpl->tpl_vars['pageLink']->value;?>
</div>
					
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
											<td><input type="text" name="userNIP" value="<?php echo $_smarty_tpl->tpl_vars['userNIP']->value;?>
" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
												<input type="hidden" name="userNIP" id="userNIP" value="<?php echo $_smarty_tpl->tpl_vars['userNIP']->value;?>
">
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
		
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>