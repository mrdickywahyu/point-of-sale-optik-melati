<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 23:29:28
         compiled from ".\templates\profit_reports.tpl" */ ?>
<?php /*%%SmartyHeaderCode:230385d825b68571693-08830607%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aad728a04569ccd5fade8bd7a39431052c72535f' => 
    array (
      0 => '.\\templates\\profit_reports.tpl',
      1 => 1413930169,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '230385d825b68571693-08830607',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tahun' => 0,
    'module' => 0,
    'act' => 0,
    'yr' => 0,
    'dataProfit' => 0,
    'dataAccount' => 0,
    'jan' => 0,
    'feb' => 0,
    'mar' => 0,
    'apr' => 0,
    'may' => 0,
    'jun' => 0,
    'jul' => 0,
    'aug' => 0,
    'sep' => 0,
    'oct' => 0,
    'nov' => 0,
    'dec' => 0,
    'totJan' => 0,
    'totFeb' => 0,
    'totMar' => 0,
    'totApr' => 0,
    'totMay' => 0,
    'totJun' => 0,
    'totJul' => 0,
    'totAug' => 0,
    'totSep' => 0,
    'totOct' => 0,
    'totNov' => 0,
    'totDec' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d825b686e4f63_32550963',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d825b686e4f63_32550963')) {function content_5d825b686e4f63_32550963($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
							
							$(".modalbox").fancybox();
							
							$("#profit").submit(function() { return false; });
							
							$("#send").on("click", function(){
								var year = $("#year").val();
								
								if (year.length != ''){
									
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "profit_reports.php?module=profit&act=search&year=" + year;
									
								}
							});
						});
					</script>
				
					
				<br>
				<table width="99%" align="center">
					<tr>
						<td>
							<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Laporan Laba dan Proyeksi</button></a>
						</td>
					</tr>
				</table>
				
				<!-- hidden inline form -->
				<div id="inline">
					<table width="95%" align="center">
						<tr>
							<td colspan="3"><h3>Laporan Laba dan Proyeksi</h3></td>
						</tr>
						<tr>
							<td>
								<form id="profit" name="profit" action="#" method="POST">
								<table cellpadding="7" cellspacing="7">
									<tr>
										<td width="80">Tahun</td>
										<td width="5">:</td>
										<td>
											<select id="year" name="year" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
												<option value="">- Pilih Tahun -</option>
												<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['tahun'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['name'] = 'tahun';
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['tahun']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['tahun']['total']);
?>
													<option value="<?php echo $_smarty_tpl->tpl_vars['tahun']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tahun']['index']];?>
"><?php echo $_smarty_tpl->tpl_vars['tahun']->value[$_smarty_tpl->getVariable('smarty')->value['section']['tahun']['index']];?>
</option>
												<?php endfor; endif; ?>
											</select>
										</td>
									</tr>
								</table>
								<button id="send" class="btn btn-primary">Cari</button>
								</form>
							</td>
						</tr>
					</table>
				</div>
				
				<?php if ($_smarty_tpl->tpl_vars['module']->value=='profit'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
					<table width="99%" align="center">
						<tr valign="top">
							<td><h3>Tahun <?php echo $_smarty_tpl->tpl_vars['yr']->value;?>
</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000; font-size: 11pt;" width="100%">
									<thead>
								    	<tr>
								    		<th width="160">Nama Akun</th>
											<th width="80">Jan</th>
											<th width="80">Feb</th>
											<th width="80">Mar</th>
											<th width="80">Apr</th>
											<th width="80">Mei</th>
											<th width="80">Jun</th>
											<th width="80">Jul</th>
											<th width="80">Ags</th>
											<th width="80">Sep</th>
											<th width="80">Okt</th>
											<th width="80">Nov</th>
											<th width="80">Des</th>
								    	</tr>
								    <thead>
								    
								    <tbody>
								    	<tr>
								    		<td width="160"><b>Pendapatan</b></td>
								    		<td colspan="12"></td>
								    	</tr>
								    	<tr>
								    		<td>Total Pendapatan (+ PPN)</td>
								    		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['name'] = 'dataProfit';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataProfit']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total']);
?>
												<td width="80" align="right"><?php echo $_smarty_tpl->tpl_vars['dataProfit']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProfit']['index']]['trxTotal'];?>
</td>
											<?php endfor; endif; ?>
								    	</tr>
								    	<tr>
								    		<td>Piutang (-)</td>
								    		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['name'] = 'dataProfit';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataProfit']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total']);
?>
												<td width="80" align="right"><?php echo $_smarty_tpl->tpl_vars['dataProfit']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProfit']['index']]['trxTotalTermin'];?>
</td>
											<?php endfor; endif; ?>
								    	</tr>
								    	<tr>
								    		<td style='text-align: right;'><b>Subtotal (KAS) Rp.</b></td>
								    		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['name'] = 'dataProfit';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataProfit']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total']);
?>
												<td width="80" align="right"><b><?php echo $_smarty_tpl->tpl_vars['dataProfit']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProfit']['index']]['grandTotalProfitRp'];?>
</b></td>
											<?php endfor; endif; ?>
								    	</tr>
								    	<tr>
								    		<td width="160"><br><b>Hutang - Piutang</b></td>
								    		<td colspan="12"></td>
								    	</tr>
								    	<tr>
								    		<td>Pembayaran Hutang</td>
								    		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['name'] = 'dataProfit';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataProfit']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total']);
?>
												<td width="80" align="right"><?php echo $_smarty_tpl->tpl_vars['dataProfit']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProfit']['index']]['trxPaymentDebt'];?>
</td>
											<?php endfor; endif; ?>
								    	</tr>
								    	<tr>
								    		<td>Penerimaan Piutang</td>
								    		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['name'] = 'dataProfit';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataProfit']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total']);
?>
												<td width="80" align="right"><?php echo $_smarty_tpl->tpl_vars['dataProfit']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProfit']['index']]['trxPayment'];?>
</td>
											<?php endfor; endif; ?>
								    	</tr>
								    	<tr>
								    		<td width="160"><br><b>Rabat</b></td>
								    		<td colspan="12"></td>
								    	</tr>
								    	<tr>
								    		<td>Total Rabat</td>
								    		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['name'] = 'dataProfit';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataProfit']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataProfit']['total']);
?>
												<td width="80" align="right"><?php echo $_smarty_tpl->tpl_vars['dataProfit']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProfit']['index']]['grandRabatRp'];?>
</td>
											<?php endfor; endif; ?>
								    	</tr>
								    	<tr>
								    		<td><br><b>Pegeluaran Biaya</b></td>
								    		<td></td>
								    	</tr>
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
								    		<td><?php echo $_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['accountName'];?>
</td>
								    		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['name'] = 'dataFund';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataFund']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['fund']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
								    			<td align="right"><?php echo $_smarty_tpl->tpl_vars['dataAccount']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataAccount']['index']]['fund'][$_smarty_tpl->getVariable('smarty')->value['section']['dataFund']['index']]['fundAmountRp'];?>
</td>
								    		<?php endfor; endif; ?>
								    	</tr>
								    	<?php endfor; endif; ?>
								    	<tr>
								    		<td style='text-align: right;'><b>Subtotal Rp.</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['jan']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['feb']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['mar']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['apr']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['may']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['jun']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['jul']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['aug']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['sep']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['oct']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['nov']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['dec']->value;?>
</b></td>
								    	</tr>
								    	<tr>
								    		<td colspan="13">&nbsp;</td>
								    	</tr>
								    	<tr valign="top">
								    		<td style='text-align: right;'><b>Netto Rp.<br>(Rabat - Biaya)</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totJan']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totFeb']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totMar']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totApr']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totMay']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totJun']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totJul']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totAug']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totSep']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totOct']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totNov']->value;?>
</b></td>
								    		<td align="right"><b><?php echo $_smarty_tpl->tpl_vars['totDec']->value;?>
</b></td>
								    	</tr>
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_profit_reports.php?module=profit&act=print&year=<?php echo $_smarty_tpl->tpl_vars['yr']->value;?>
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