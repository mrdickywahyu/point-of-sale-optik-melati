<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 22:17:51
         compiled from ".\templates\fund_reports.tpl" */ ?>
<?php /*%%SmartyHeaderCode:205155d824a9f870ec1-64387271%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '741f1a4aebcfa9ae832e54f3f58740e6dabb5af8' => 
    array (
      0 => '.\\templates\\fund_reports.tpl',
      1 => 1413930046,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205155d824a9f870ec1-64387271',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'startDate' => 0,
    'endDate' => 0,
    'dataFund' => 0,
    'fundTotal' => 0,
    'start' => 0,
    'end' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d824a9f8dbc97_94052234',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d824a9f8dbc97_94052234')) {function content_5d824a9f8dbc97_94052234($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
									window.location.href = "fund_reports.php?module=fund&act=search&startDate=" + startDate + "&endDate=" + endDate;
									
								}
							});
						});
					</script>
				
				
				
				<br>
				<table width="98%" align="center">
					<tr>
						<td>
							<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Laporan Pengeluaran Biaya</button></a>
						</td>
					</tr>
				</table>
				
				<!-- hidden inline form -->
				<div id="inline">
					<table width="95%" align="center">
						<tr>
							<td colspan="3"><h3>Laporan Pengeluaran Biaya</h3></td>
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
				
				<?php if ($_smarty_tpl->tpl_vars['module']->value=='fund'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Hasil Pencarian, Periode <?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
 s/d <?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30">No</th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="110">Tanggal <i class="fa fa-sort"></i></th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="100">Kode Akun <i class="fa fa-sort"></i></th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="255">Nama Akun <i class="fa fa-sort"></i></th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="400">Keterangan <i class="fa fa-sort"></i></th>
											<th style='border-left: 1px solid #CCCCCC; text-align:center;' width="120">Jumlah <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['name'] = 'dataFund';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataFund']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['total']);
?>
								    	<tr>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataFund']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFund']['index']]['no'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataFund']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFund']['index']]['fundDate'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataFund']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFund']['index']]['accountCode'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataFund']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFund']['index']]['accountName'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataFund']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFund']['index']]['fundNote'];?>
</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataFund']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataFund']['index']]['fundAmount'];?>
</td>
								    	</tr>
								    	<?php endfor; endif; ?>
								    	<tr>
								    		<td colspan="5" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'>Rp.</td>
								    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><b><?php echo $_smarty_tpl->tpl_vars['fundTotal']->value;?>
</b></td>
								    	</tr>
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_fund_reports.php?module=fund&act=print&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
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