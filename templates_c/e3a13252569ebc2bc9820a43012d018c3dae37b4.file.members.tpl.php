<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:58:40
         compiled from ".\templates\members.tpl" */ ?>
<?php /*%%SmartyHeaderCode:293235d825430941680-66282277%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e3a13252569ebc2bc9820a43012d018c3dae37b4' => 
    array (
      0 => '.\\templates\\members.tpl',
      1 => 1413905529,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '293235d825430941680-66282277',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataMember' => 0,
    'pageLink' => 0,
    'memberCode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d8254309b8207_63824859',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d8254309b8207_63824859')) {function content_5d8254309b8207_63824859($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
							
							$("#member").submit(function() { return false; });
							
							$("#member2").submit(function() { return false; });
					
							
							$("#send").on("click", function(){
								var memberCode = $("#memberCode").val();
								var memberFullName = $("#memberFullName").val();
								var memberAddress = $("#memberAddress").val();
								var memberPhone = $("#memberPhone").val();
								
								if (memberCode != '' && memberFullName != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_member.php',
										dataType: 'JSON',
										data:{
											memberCode: memberCode,
											memberFullName: memberFullName,
											memberAddress: memberAddress,
											memberPhone: memberPhone
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "members.php?code=1";
										}
									});
								}
							});
						});
					</script>
				
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Member</button></a>
					<a href="print_member.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen Member</h3>
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Kode Member <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
									<th width="300" style='border-left: 1px solid #CCCCCC;'>Alamat <i class="fa fa-sort"></i></th>
									<th width="120" style='border-left: 1px solid #CCCCCC;'>Phone <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['name'] = 'dataMember';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataMember']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataMember']['total']);
?>
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataMember']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataMember']['index']]['no'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataMember']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataMember']['index']]['memberCode'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataMember']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataMember']['index']]['memberFullName'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataMember']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataMember']['index']]['memberAddress'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataMember']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataMember']['index']]['memberPhone'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a title="Edit" href="edit_members.php?module=member&act=edit&memberID=<?php echo $_smarty_tpl->tpl_vars['dataMember']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataMember']['index']]['memberID'];?>
" data-width="450" data-height="280" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="18"></a>
										<a title="Hapus" href="members.php?module=member&act=delete&memberID=<?php echo $_smarty_tpl->tpl_vars['dataMember']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataMember']['index']]['memberID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus member <?php echo $_smarty_tpl->tpl_vars['dataMember']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataMember']['index']]['memberFullName'];?>
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
					<br><br>
					<div id="inline">	
						<table width="98%" align="center">
							<tr>
								<td colspan="3"><h3>Tambah Member</h3></td>
							</tr>
							<tr>
								<td>
									<form id="member" name="member" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Kode Member</td>
											<td width="5">:</td>
											<td><input type="text" id="memberCode" value="<?php echo $_smarty_tpl->tpl_vars['memberCode']->value;?>
" name="memberCode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
												<input type="hidden" id="memberCode" value="<?php echo $_smarty_tpl->tpl_vars['memberCode']->value;?>
" name="memberCode">
											</td>
										</tr>
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td><input type="text" id="memberFullName" name="memberFullName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>:</td>
											<td><input type="text" id="memberAddress" name="memberAddress" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Phone</td>
											<td>:</td>
											<td><input type="text" id="memberPhone" name="memberPhone" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
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