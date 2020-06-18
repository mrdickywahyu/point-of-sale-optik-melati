<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:15:11
         compiled from ".\templates\suppliers.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31275d8249ffeaa293-76252238%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '169aab38d349cbcc8716fc31c1fcec74a7b4c94e' => 
    array (
      0 => '.\\templates\\suppliers.tpl',
      1 => 1413905456,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31275d8249ffeaa293-76252238',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataSupplier' => 0,
    'pageLink' => 0,
    'supplierCode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d824a00007de5_12074245',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d824a00007de5_12074245')) {function content_5d824a00007de5_12074245($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
							
							$("#supplier").submit(function() { return false; });
							
							$("#supplier2").submit(function() { return false; });
					
							
							$("#send").on("click", function(){
								var supplierCode = $("#supplierCode").val();
								var supplierName = $("#supplierName").val();
								var supplierAddress = $("#supplierAddress").val();
								var supplierPhone = $("#supplierPhone").val();
								var supplierFax = $("#supplierFax").val();
								var supplierContactPerson = $("#supplierContactPerson").val();
								var supplierCPHp = $("#supplierCPHp").val();
								var supplierStatus = $("#supplierStatus").val();
								
								if (supplierCode != '' && supplierName != '' && supplierStatus != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_supplier.php',
										dataType: 'JSON',
										data:{
											supplierCode: supplierCode,
											supplierName: supplierName,
											supplierAddress: supplierAddress,
											supplierPhone: supplierPhone,
											supplierFax: supplierFax,
											supplierContactPerson: supplierContactPerson,
											supplierCPHp: supplierCPHp,
											supplierStatus: supplierStatus
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "suppliers.php?code=1";
										}
									});
								}
							});
						});
					</script>
				
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Supplier</button></a>
					<a href="print_supplier.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen Supplier</h3>
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="80" style='border-left: 1px solid #CCCCCC;'>Kode <i class="fa fa-sort"></i></th>
									<th width="230" style='border-left: 1px solid #CCCCCC;'>Nama Supplier <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Phone <i class="fa fa-sort"></i></th>
									<th width="210" style='border-left: 1px solid #CCCCCC;'>Kontak Person <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>No. HP <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
									<th width="80" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['name'] = 'dataSupplier';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataSupplier']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataSupplier']['total']);
?>
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['no'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCode'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierPhone'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierContactPerson'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierCPHp'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierStatus'];?>
</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a title="Edit" href="edit_suppliers.php?module=supplier&act=edit&supplierID=<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
" data-width="450" data-height="470" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="18"></a>
										<a title="Hapus" href="suppliers.php?module=supplier&act=delete&supplierID=<?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierID'];?>
" onclick="return confirm('Anda Yakin ingin menghapus supplier <?php echo $_smarty_tpl->tpl_vars['dataSupplier']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataSupplier']['index']]['supplierName'];?>
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
								<td colspan="3"><h3>Tambah Supplier</h3></td>
							</tr>
							<tr>
								<td>
									<form id="supplier" name="supplier" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Kode Supplier</td>
											<td width="5">:</td>
											<td><input type="text" id="supplierCode" value="<?php echo $_smarty_tpl->tpl_vars['supplierCode']->value;?>
" name="supplierCode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
												<input type="hidden" id="supplierCode" value="<?php echo $_smarty_tpl->tpl_vars['supplierCode']->value;?>
" name="supplierCode">
											</td>
										</tr>
										<tr>
											<td>Nama Supplier</td>
											<td>:</td>
											<td><input type="text" id="supplierName" name="supplierName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>:</td>
											<td><input type="text" id="supplierAddress" name="supplierAddress" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Phone</td>
											<td>:</td>
											<td><input type="text" id="supplierPhone" name="supplierPhone" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Fax</td>
											<td>:</td>
											<td><input type="text" id="supplierFax" name="supplierFax" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Kontak Person</td>
											<td>:</td>
											<td><input type="text" id="supplierContactPerson" name="supplierContactPerson" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Nomor HP</td>
											<td>:</td>
											<td><input type="text" id="supplierCPHp" name="supplierCPHp" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Status</td>
											<td>:</td>
											<td><select name="supplierStatus" id="supplierStatus" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
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