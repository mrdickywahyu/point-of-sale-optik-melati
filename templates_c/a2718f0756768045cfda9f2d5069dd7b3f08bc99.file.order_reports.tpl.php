<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:17:47
         compiled from ".\templates\order_reports.tpl" */ ?>
<?php /*%%SmartyHeaderCode:259385d824a9b2ca251-18162967%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2718f0756768045cfda9f2d5069dd7b3f08bc99' => 
    array (
      0 => '.\\templates\\order_reports.tpl',
      1 => 1413929852,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '259385d824a9b2ca251-18162967',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'startDate' => 0,
    'endDate' => 0,
    'dataOrder' => 0,
    'grandTotalRp' => 0,
    'grandTotalTerminRp' => 0,
    'grandPaymentRp' => 0,
    'grandTotalDebtRp' => 0,
    'grandPayDebtRp' => 0,
    'grandRabatRp' => 0,
    'grandFundAmountRp' => 0,
    'start' => 0,
    'end' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d824a9b32dc25_99086647',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d824a9b32dc25_99086647')) {function content_5d824a9b32dc25_99086647($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
							
							$( "#startDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: '2014:c-0'
							});
							
							$( "#endDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: '2014:c-0'
							});
							
							$(".modalbox").fancybox();
							
							$("#order").submit(function() { return false; });
							
							$("#send").on("click", function(){
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								
								if (startDate.length != '' && endDate.length != ''){
									
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "order_reports.php?module=order&act=search&startDate=" + startDate + "&endDate=" + endDate;
									
								}
							});
						});
					</script>
				
					
				<br>
				<table width="98%" align="center">
					<tr>
						<td>
							<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Cari Laporan</button></a>
						</td>
					</tr>
				</table>
				
				<!-- hidden inline form -->
				<div id="inline">
					<table width="95%" align="center">
						<tr>
							<td colspan="3"><h3>Laporan Pendapatan per Periode</h3></td>
						</tr>
						<tr>
							<td>
								<form id="order" name="order" action="#" method="POST">
								<table cellpadding="7" cellspacing="7">
									<tr>
										<td width="140">Periode Awal</td>
										<td width="5">:</td>
										<td><input type="text" id="startDate" name="startDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
									</tr>
									<tr>
										<td>Periode Akhir</td>
										<td>:</td>
										<td><input type="text" id="endDate" name="endtDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
									</tr>
								</table>
								<button id="send" class="btn btn-primary">Cari</button>
								</form>
							</td>
						</tr>
					</table>
				</div>
				
				<?php if ($_smarty_tpl->tpl_vars['module']->value=='order'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Hasil Pencarian : <?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
 s/d <?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Transaksi <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Piutang <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Penerimaan Piutang <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Hutang <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Pembayaran Hutang <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Rabat <i class="fa fa-sort"></i></th>
											<th width="60" style='border-left: 1px solid #CCCCCC;'>Total Biaya <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['name'] = 'dataOrder';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataOrder']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataOrder']['total']);
?>
								    	<tr>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataOrder']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataOrder']['index']]['no'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataOrder']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataOrder']['index']]['trxDate'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataOrder']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataOrder']['index']]['trxTotal'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataOrder']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataOrder']['index']]['trxTotalTermin'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataOrder']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataOrder']['index']]['trxPayment'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataOrder']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataOrder']['index']]['trxTotalDebt'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataOrder']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataOrder']['index']]['trxPayDebt'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataOrder']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataOrder']['index']]['trxRabat'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataOrder']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataOrder']['index']]['trxFund'];?>
</td>
								    	</tr>
								    	<?php endfor; endif; ?>
								    	<tr>
								    		<td colspan='2' style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>Rp.</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b><?php echo $_smarty_tpl->tpl_vars['grandTotalRp']->value;?>
</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b><?php echo $_smarty_tpl->tpl_vars['grandTotalTerminRp']->value;?>
</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b><?php echo $_smarty_tpl->tpl_vars['grandPaymentRp']->value;?>
</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b><?php echo $_smarty_tpl->tpl_vars['grandTotalDebtRp']->value;?>
</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b><?php echo $_smarty_tpl->tpl_vars['grandPayDebtRp']->value;?>
</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b><?php echo $_smarty_tpl->tpl_vars['grandRabatRp']->value;?>
</b></td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b><?php echo $_smarty_tpl->tpl_vars['grandFundAmountRp']->value;?>
</b></td>
								    	</tr>
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_order_reports.php?module=order&act=print&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
" target="_blank"><button type="button" class="btn btn-warning">Print</button></a></td>
						</tr>
					</table>
					<p>&nbsp;</p>
				<?php }?>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>