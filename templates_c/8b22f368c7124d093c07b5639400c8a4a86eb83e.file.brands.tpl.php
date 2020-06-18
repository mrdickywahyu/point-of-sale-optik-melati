<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:15:07
         compiled from ".\templates\brands.tpl" */ ?>
<?php /*%%SmartyHeaderCode:300065d8249fb899539-47215688%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b22f368c7124d093c07b5639400c8a4a86eb83e' => 
    array (
      0 => '.\\templates\\brands.tpl',
      1 => 1413905443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '300065d8249fb899539-47215688',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataBrand' => 0,
    'pageLink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d8249fb954f97_26219841',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d8249fb954f97_26219841')) {function content_5d8249fb954f97_26219841($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
							
							$("#brand").submit(function() { return false; });
							
							$("#brand2").submit(function() { return false; });
					
							
							$("#send").on("click", function(){
								var brandName = $("#brandName").val();
								var brandStatus = $("#brandStatus").val();
								
								if (brandName != '' && brandStatus != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_brand.php',
										dataType: 'JSON',
										data:{
											brandName: brandName,
											brandStatus: brandStatus
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "brands.php?code=1";
										}
									});
								}
							});
						});
					</script>
				
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Brand</button></a>
					<a href="print_brand.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen Brand</h3>
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="30" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Nama Brand <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
									<th width="450" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['name'] = 'dataBrand';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataBrand']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataBrand']['total']);
?>
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['no'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['brandName'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['brandStatus'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a title="Edit" href="edit_brands.php?module=brand&act=edit&brandID=<?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['brandID'];?>
" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="18"></a>
										<a title="Hapus" href="brands.php?module=brand&act=delete&brandID=<?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['brandID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus brand <?php echo $_smarty_tpl->tpl_vars['dataBrand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataBrand']['index']]['brandName'];?>
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
								<td colspan="3"><h3>Tambah Brand</h3></td>
							</tr>
							<tr>
								<td>
									<form id="brand" name="brand" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Nama Brand</td>
											<td width="5">:</td>
											<td><input type="text" id="brandName" name="brandName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Status</td>
											<td>:</td>
											<td><select name="brandStatus" id="brandStatus" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
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