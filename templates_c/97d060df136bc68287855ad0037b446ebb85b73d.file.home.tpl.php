<?php /* Smarty version Smarty-3.1.11, created on 2019-09-19 00:00:28
         compiled from ".\templates\home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:272485d82459bd98af5-90287161%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97d060df136bc68287855ad0037b446ebb85b73d' => 
    array (
      0 => '.\\templates\\home.tpl',
      1 => 1568826023,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '272485d82459bd98af5-90287161',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d82459beca7f1_27825352',
  'variables' => 
  array (
    'outletLevel' => 0,
    'outletName' => 0,
    'userFullName' => 0,
    'numsProduct' => 0,
    'numsPiutang' => 0,
    'numsHutang' => 0,
    'userID' => 0,
    'module' => 0,
    'act' => 0,
    'dataProduct' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d82459beca7f1_27825352')) {function content_5d82459beca7f1_27825352($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<div class="container">
	<!-- Push Wrapper -->
	<div class="mp-pusher" id="mp-pusher">

		<?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


		<div class="scroller"><!-- this is for emulating position fixed of the nav -->
			<div class="scroller-inner">
				<div style="padding-left: 18px; padding-top: 10px;">
					
					<?php echo $_smarty_tpl->getSubTemplate ("logo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					
				</div>
				
				<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
  				<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
				<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
  				<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />
  				
  				
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
							
							$(".various3").fancybox({
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
							
							$(".various4").fancybox({
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
							
							$("#productBarcode").autocomplete("product_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('productBarcode').value = myarr[0];
							});
						});
					</script>	
				
				
				<!-- Top Navigation -->
				<div class="codrops-top clearfix">
					<!--<a href="#" id="trigger" class="menu-trigger">Open Menu</a>-->
					<a class="codrops-icon codrops-icon-prev" href="#" id="trigger"><span>Open Menu</span></a> |
					<a href="backup.php"><span>Backup</span></a> |
					<a href="home.php"><span>Home</span></a>
					<span class="right"><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Logout</span></a></span>
				</div>
				
				<p style="padding: 20px;">
					<?php if ($_smarty_tpl->tpl_vars['outletLevel']->value=='1'){?>
						Hi <b><?php echo $_smarty_tpl->tpl_vars['outletName']->value;?>
</b><blink>, Selamat datang di aplikasi Melati Optical. </blink><br>
						Anda dapat melakukan pengolahan data outlet melalui menu yang dapat Anda klik pada pojok kiri atas (Open Menu).
					<?php }else{ ?>
						Hi <b><?php if ($_smarty_tpl->tpl_vars['userFullName']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['userFullName']->value;?>
 <?php }else{ ?> <?php echo $_smarty_tpl->tpl_vars['outletName']->value;?>
 <?php }?></b>, Selamat datang di aplikasi Melati Optical <br>
						Anda dapat melakukan transaksi penjualan melalui menu yang dapat Anda klik pada pojok kiri atas (Open Menu).
					<?php }?>
					<br><br>
					<a href="stock_minimal.php" data-width="1100" data-height="450" class="various2 fancybox.iframe" title="Stok Produk Akan Habis"><button type="button" class="btn btn-warning">Produk Kosong / Akan Kosong (<?php echo $_smarty_tpl->tpl_vars['numsProduct']->value;?>
)</button></a>
					<a href="piutang.php" data-width="1100" data-height="450" class="various3 fancybox.iframe" title="Piutang Jatuh Tempo"><button type="button" class="btn btn-info">Piutang Jatuh Tempo (<?php echo $_smarty_tpl->tpl_vars['numsPiutang']->value;?>
)</button></a>
					<a href="hutang.php" data-width="1100" data-height="450" class="various4 fancybox.iframe" title="Hutang Jatuh Tempo"><button type="button" class="btn btn-danger">Hutang Jatuh Tempo (<?php echo $_smarty_tpl->tpl_vars['numsHutang']->value;?>
)</button></a>
					
					<?php if ($_smarty_tpl->tpl_vars['userID']->value!=''){?>
						<form action="home.php" method="GET">
							<input type="hidden" name="module" value="home">
							<input type="hidden" name="act" value="search">
							<table cellpadding="7" cellspacing="7" width="98%" align="center">
								<tr>
									<td width="130">Pencarian Produk</td>
									<td width="255"><input type="text" name="productBarcode" placeholder="Kode atau nama produk" id="productBarcode" style="display: block; width: 244px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required autofocus></td>
									<td><button type="submit" class="btn btn-primary">Cari</button></td>
								</tr>
							</table>
						</form>
					<?php }?>
					
					<?php if ($_smarty_tpl->tpl_vars['module']->value=='home'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
						
						<h3 style="padding-left: 15px;">Hasil Pencarian :</h3>
						<div class="table-responsive">
							<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="98%" align="center">
								<thead>
									<tr>
										<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
										<th width="130" style='border-left: 1px solid #CCCCCC;'>Kode Produk <i class="fa fa-sort"></i></th>
										<th width="300" style='border-left: 1px solid #CCCCCC;'>Nama Produk <i class="fa fa-sort"></i></th>
										<th width="80" style='border-left: 1px solid #CCCCCC;'>Stok <i class="fa fa-sort"></i></th>
										<th width="120" style='border-left: 1px solid #CCCCCC;'>Harga Beli <i class="fa fa-sort"></i></th>
										<th width="120" style='border-left: 1px solid #CCCCCC;'>Harga Jual <i class="fa fa-sort"></i></th>
										<th width="80" style='border-left: 1px solid #CCCCCC;'>Diskon (%) <i class="fa fa-sort"></i></th>
									</tr>
								</thead>
								<tbody>
									<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['name'] = 'dataProduct';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataProduct']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProduct']['total']);
?>
									<tr>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['no'];?>
</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productBarcode'];?>
</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productName'];?>
</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productStock'];?>
</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productBuyPrice'];?>
</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productSalePrice'];?>
</td>
										<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productDiscount'];?>
</td>
									</tr>
									<?php endfor; endif; ?>
								</tbody>
							</table>
						</div>
					<?php }?>
				</p>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>