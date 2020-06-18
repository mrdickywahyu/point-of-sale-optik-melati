<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:09:58
         compiled from ".\templates\accounts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:300435d8248c66ce371-90490070%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '177decf95699bc0ca467071a204e32279f118968' => 
    array (
      0 => '.\\templates\\accounts.tpl',
      1 => 1413927872,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '300435d8248c66ce371-90490070',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataAccount' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d8248c6714744_68902133',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d8248c6714744_68902133')) {function content_5d8248c6714744_68902133($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
				
				<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
  				<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
  				
  				
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
							
							$("#account").submit(function() { return false; });
							
							$("#account2").submit(function() { return false; });
					
							
							$("#send").on("click", function(){
								var accountCode = $("#accountCode").val();
								var accountName = $("#accountName").val();
								var accountStatus = $("#accountStatus").val();
								
								if (accountCode != '' && accountName != '' && accountStatus != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_account.php',
										dataType: 'JSON',
										data:{
											accountCode: accountCode,
											accountName: accountName,
											accountStatus: accountStatus
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "accounts.php?code=1";
										}
									});
								}
							});
						});
					</script>
				
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Akun Biaya</button></a>
					<a href="print_account.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen Akun Biaya</h3>
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Kode Akun <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Nama Akun <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['name'] = 'dataAccount';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAccount']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataAccount']['total']);
?>
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['no'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['accountCode'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['accountName'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['accountStatus'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a href="edit_accounts.php?module=account&act=edit&accountID=<?php echo $_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['accountID'];?>
" data-width="450" data-height="230" class="various2 fancybox.iframe" title="Edit"><img src="images/icons/edit.png" width="18"></a>
										<a href="accounts.php?module=account&act=delete&accountID=<?php echo $_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['accountID'];?>
" title="Hapus" onclick="return confirm('Anda Yakin ingin menghapus akun <?php echo $_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['accountName'];?>
?');"><img src="images/icons/delete.png" width="18"></a>
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
								<td colspan="3"><h3>Tambah Akun Biaya</h3></td>
							</tr>
							<tr>
								<td>
									<form id="account" name="account" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Kode Akun</td>
											<td width="5">:</td>
											<td><input type="text" id="accountCode" name="accountCode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Nama Akun</td>
											<td>:</td>
											<td><input type="text" id="accountName" name="accountName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Status</td>
											<td>:</td>
											<td><select name="accountStatus" id="accountStatus" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
												<option value="">- Pilih Status -</option>
												<option value="Y">Y (Aktif)</option>
												<option value="N">N (Tidak Aktif)</option>
											</select></td>
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