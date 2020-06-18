<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 23:28:02
         compiled from ".\templates\debts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142085d825b12e73937-99871850%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '448be3ac0765c25a976018e51c0c58d64737c84d' => 
    array (
      0 => '.\\templates\\debts.tpl',
      1 => 1413929097,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142085d825b12e73937-99871850',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module' => 0,
    'act' => 0,
    'startDate' => 0,
    'endDate' => 0,
    'dataDebt' => 0,
    'status' => 0,
    'start' => 0,
    'end' => 0,
    'supplierID' => 0,
    'debtID' => 0,
    'invoiceID' => 0,
    'sisa' => 0,
    'identityPrintDebt' => 0,
    'trxFullName' => 0,
    'totalHarusBayar' => 0,
    'trxAddress' => 0,
    'totalPay' => 0,
    'trxPhone' => 0,
    'totalSisa' => 0,
    'totalSisaIf' => 0,
    'trxStatus' => 0,
    'trxTerminDate' => 0,
    'dataPayment' => 0,
    'debtDate' => 0,
    'identityName' => 0,
    'identityAddress' => 0,
    'trxDate' => 0,
    'dataDetail' => 0,
    'trxSubtotal' => 0,
    'trxDP' => 0,
    'trxDiscount' => 0,
    'kurang' => 0,
    'trxTotal' => 0,
    'terbilang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d825b130c8826_49195671',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d825b130c8826_49195671')) {function content_5d825b130c8826_49195671($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


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
  				<script type='text/javascript' src="design/js/jquery.autocomplete.js"></script>
  				<link rel="stylesheet" type="text/css" href="design/css/jquery.autocomplete.css" />
				
				
					<script>
						$(document).ready(function() {
							
							$( "#debtDate" ).datepicker({
								changeMonth: true,
								changeYear: true,
								dateFormat: "yy-mm-dd",
								yearRange: '2014:c-0'
							});
							
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
							
							$("#debt").submit(function() { return false; });
							$("#debt2").submit(function() { return false; });
							
							$("#send").on("click", function(){
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								var supplierID = $("#supplierID").val();
								var status = $("#status").val();
								
								if (status != ''){
									setTimeout("$.fancybox.close()", 1000);
									window.location.href = "debts.php?module=debt&act=search&startDate=" + startDate + "&endDate=" + endDate + "&status=" + status + "&supplierID=" + supplierID;
								}
							});
							
							$("#supplierID").autocomplete("supplier_autocomplete.php", {
								width: 310
							}).result(function(event, item) {
								
								var myarr = item[0].split(" - ");
								
								document.getElementById('supplierID').value = myarr[0];
							});
							
							$("#send2").on("click", function(){
								var debtDate = $("#debtDate").val();
								var debtAmount = $("#debtAmount").val();
								var sisa = $("#sisa").val();
								var debtID = $("#debtID").val();
								var invoiceID = $("#invoiceID").val();
								var startDate = $("#startDate").val();
								var endDate = $("#endDate").val();
								
								if (debtDate != '' && debtAmount != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_debt.php',
										dataType: 'JSON',
										data:{
											debtDate: debtDate,
											debtAmount: debtAmount,
											sisa: sisa,
											debtID: debtID,
											invoiceID: invoiceID
										},
										beforeSend: function (data) {
											$('#send2').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "debts.php?module=debt&act=view&debtID="+ debtID + "&invoiceID=" + invoiceID + "&startDate=" + startDate + "&endDate=" + endDate;
										}
									});
								}
							});
						});
					</script>
				
				
				<?php if ($_smarty_tpl->tpl_vars['module']->value=='debt'&&$_smarty_tpl->tpl_vars['act']->value=='search'){?>
					<br>
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Catatan Hutang, Periode <?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
 s/d <?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>No. Faktur <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>ID Member <i class="fa fa-sort"></i></th>
											<th width="180" style='border-left: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Jumlah <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Bayar <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Sisa <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
											<th width="100" style='border-left: 1px solid #CCCCCC;'>Jatuh Tempo <i class="fa fa-sort"></i></th>
											<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['name'] = 'dataDebt';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDebt']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total']);
?>
								    		<?php if ($_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['totalsisa']<=0&&$_smarty_tpl->tpl_vars['status']->value=='2'){?>
									    		<tr valign="top">
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['no'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxDate'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceID'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['supplierID'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxFullName'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTotal'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxDP'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['sisa'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['statusSisa'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTerminDate'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="debts.php?module=debt&act=view&debtID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtID'];?>
&invoiceID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceID'];?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
" title="Detil Catatan Hutang"><img src="images/icons/view.png" width="18"></td>
										    	</tr>
										    	
										    <?php }elseif($_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['totalsisa']>0&&$_smarty_tpl->tpl_vars['status']->value=='3'){?>
									    		<tr valign="top">
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['no'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxDate'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceID'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['supplierID'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxFullName'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTotal'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxDP'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['sisa'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['statusSisa'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTerminDate'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="debts.php?module=debt&act=view&debtID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtID'];?>
&invoiceID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceID'];?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
" title="Detil Catatan Hutang"><img src="images/icons/view.png" width="18"></td>
										    	</tr>
										    
										    <?php }elseif($_smarty_tpl->tpl_vars['status']->value=='1'){?>
									    		<tr valign="top">
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['no'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxDate'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceID'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['supplierID'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxFullName'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTotal'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxDP'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['sisa'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['statusSisa'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTerminDate'];?>
</td>
										    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="debts.php?module=debt&act=view&debtID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtID'];?>
&invoiceID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceID'];?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
" title="Detil Catatan Hutang"><img src="images/icons/view.png" width="18"></td>
										    	</tr>
									    	<?php }?>
									    	
								    	<?php endfor; endif; ?>
								    </tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td><br><a href="print_debts.php?module=debt&act=print&startDate=<?php echo $_smarty_tpl->tpl_vars['start']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['end']->value;?>
&status=<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
&supplierID=<?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
" target="_blank"><button type="button" class="btn btn-warning">Print</button></a></td>
						</tr>
					</table>
					
				<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='debt'&&$_smarty_tpl->tpl_vars['act']->value=='view'){?>
					
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Back</button></a>
								<a href="debts.php?module=debt&act=preview&debtID=<?php echo $_smarty_tpl->tpl_vars['debtID']->value;?>
&invoiceID=<?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
"><button type="button" class="btn btn-info">Detail Transaksi</button></a>
								<?php if ($_smarty_tpl->tpl_vars['sisa']->value>0){?>
									<a href="#inline2" class="modalbox"><button type="button" class="btn btn-warning">Bayar</button></a>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['identityPrintDebt']->value=='1'){?>
									<a href="print_pay_debts.php?module=debt&act=print&debtID=<?php echo $_smarty_tpl->tpl_vars['debtID']->value;?>
&invoiceID=<?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								<?php }else{ ?>
									<a href="print_mini_pay_debts.php?module=debt&act=print&debtID=<?php echo $_smarty_tpl->tpl_vars['debtID']->value;?>
&invoiceID=<?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" target="_blank"><button type="button" class="btn btn-success">Print</button></a>
								<?php }?>
							</td>
						</tr>
					</table>
					<center><h3>Catatan Hutang</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="130" style="padding-right: 20px;">ID/Nama Supplier</td>
							<td width="280">: <?php if ($_smarty_tpl->tpl_vars['supplierID']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['trxFullName']->value;?>
 <?php }else{ ?> - <?php }?></td>
							<td width="120" style="padding-left: 50px;">Hutang</td>
							<td width="120">: Rp. <?php echo $_smarty_tpl->tpl_vars['totalHarusBayar']->value;?>
</td>
						</tr>
						<tr valign="top">
							<td>Alamat</td>
							<td>: <?php if ($_smarty_tpl->tpl_vars['trxAddress']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['trxAddress']->value;?>
 <?php }else{ ?> - <?php }?> </td>
							<td style="padding-left: 50px;">Total Bayar Masuk</td>
							<td>: Rp. <?php echo $_smarty_tpl->tpl_vars['totalPay']->value;?>
 </td>
						</tr>
						<tr valign="top">
							<td>Phone</td>
							<td>: <?php if ($_smarty_tpl->tpl_vars['trxPhone']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['trxPhone']->value;?>
 <?php }else{ ?> - <?php }?></td>
							<td style="padding-left: 50px;">Sisa Hutang</td>
							<td>: Rp. <?php echo $_smarty_tpl->tpl_vars['totalSisa']->value;?>
 </td>
						</tr>
						<tr valign="top">
							<td>Nomor Faktur</td>
							<td>: <?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
</td>
							<td style="padding-left: 50px;">Status</td>
							<td>: <?php echo $_smarty_tpl->tpl_vars['totalSisaIf']->value;?>
 </td>
						</tr>
						<tr valign="top">
							<td>Tipe / Jatuh Tempo</td>
							<td>: <?php if ($_smarty_tpl->tpl_vars['trxStatus']->value=='2'){?> Termin / <?php echo $_smarty_tpl->tpl_vars['trxTerminDate']->value;?>
 <?php }else{ ?> Cash <?php }?></td>
							<td></td>
							<td></td>
						</tr>
					</table>
					<br>
					<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="850" align="center">
						<thead>
					    	<tr>
					    		<th width="25" style='border-left: 1px solid #CCCCCC;'>No</th>
								<th width="120" style='border-left: 1px solid #CCCCCC;'>Tanggal</th>
								<th width="125" style='border-left: 1px solid #CCCCCC;'>Bayar</th>
								<th width="80" style='border-left: 1px solid #CCCCCC;'>Aksi</th>
					    	</tr>
					    <thead>
					    <tbody>
					    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['name'] = 'dataPayment';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataPayment']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataPayment']['total']);
?>
					    	<tr valign="top">
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['no'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['debtDate'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['debtPay'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>
					    			<a href="debts.php?module=debt&act=delete&id=<?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentID'];?>
&debtID=<?php echo $_smarty_tpl->tpl_vars['debtID']->value;?>
&invoiceID=<?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
&startDate=<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
&endDate=<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" onclick="return confirm('Anda Yakin ingin menghapus pembayaran hutang member <?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['paymentID'];?>
#<?php echo $_smarty_tpl->tpl_vars['dataPayment']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataPayment']['index']]['debtDate'];?>
?');"><img src="images/icons/delete.png" width="18"></a>
					    		</td>
					    	</tr>
					    	<?php endfor; endif; ?>
					    </tbody>
					</table>
					
					<div id="inline2">
						<table width="95%" align="center">
							<tr>
								<td colspan="3"><h3>Bayar Hutang Supplier</h3></td>
							</tr>
							<tr>
								<td>
									<form id="debt" name="debt" method="POST" action="#">
									<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate">
									<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate">
									<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
" id="invoiceID" name="invoiceID">
									<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['debtID']->value;?>
" id="debtID" name="debtID">
									<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['sisa']->value;?>
" id="sisa" name="sisa">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Tanggal</td>
											<td width="5">:</td>
											<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['debtDate']->value;?>
" id="debtDate" name="debtDate" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Jumlah</td>
											<td>:</td>
											<td><input type="text" id="debtAmount" name="debtAmount" class="txt" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
									</table>
									<button id="send2" class="btn btn-primary">Simpan</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
					
				<?php }elseif($_smarty_tpl->tpl_vars['module']->value=='debt'&&$_smarty_tpl->tpl_vars['act']->value=='preview'){?>
					
					<br>
					<table align="center" width="850">
						<tr>
							<td>
								<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Back</button></a>
							</td>
						</tr>
					</table>
					<center><h3>Rincian Transaksi</h3></center>
					<table align="center" width="850">
						<tr valign="top">
							<td width="400" style="padding-right: 20px;"><b><?php echo $_smarty_tpl->tpl_vars['identityName']->value;?>
</b> <br>
								<?php echo $_smarty_tpl->tpl_vars['identityAddress']->value;?>

							</td>
							<td width="350">Cirebon, <?php echo $_smarty_tpl->tpl_vars['trxDate']->value;?>
<br>Kepada Yth : <br>
								<?php if ($_smarty_tpl->tpl_vars['supplierID']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['supplierID']->value;?>
 - <?php }?>
								<?php echo $_smarty_tpl->tpl_vars['trxFullName']->value;?>

							</td>
						</tr>
						<tr valign="top">
							<td></td>
							<td><?php if ($_smarty_tpl->tpl_vars['trxAddress']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['trxAddress']->value;?>
 <?php }?> </td>
						</tr>
						<tr valign="top">
							<td></td>
							<td><?php if ($_smarty_tpl->tpl_vars['trxPhone']->value!=''){?> <?php echo $_smarty_tpl->tpl_vars['trxPhone']->value;?>
 <?php }?></td>
						</tr>
						<tr>
							<td colspan="2"><br>Nomor Faktur : <?php echo $_smarty_tpl->tpl_vars['invoiceID']->value;?>
 / Type : <?php if ($_smarty_tpl->tpl_vars['trxStatus']->value=='2'){?> <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['trxTerminDate']->value;?>
 <?php }else{ ?> <?php echo $_smarty_tpl->tpl_vars['status']->value;?>
 <?php }?></td>
						</tr>
					</table>
					<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="850" align="center">
						<thead>
					    	<tr>
					    		<th width="25" style='border-left: 1px solid #CCCCCC;'>No</th>
								<th width="120" style='border-left: 1px solid #CCCCCC;'>Kode Produk</th>
								<th width="285" style='border-left: 1px solid #CCCCCC;'>Nama Produk</th>
								<th width="130" style='border-left: 1px solid #CCCCCC;'>Harga Satuan</th>
								<th width="50" style='border-left: 1px solid #CCCCCC;'>Qty</th>
								<th width="100" style='border-left: 1px solid #CCCCCC;'>Subtotal</th>
					    	</tr>
					    <thead>
					    <tbody>
					    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['name'] = 'dataDetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDetail']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDetail']['total']);
?>
					    	<tr valign="top">
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['no'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productBarcode'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['productName'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailBuyPrice'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailBuyQty'];?>
</td>
					    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDetail']['index']]['detailBuySubtotal'];?>
</td>
					    	</tr>
					    	<?php endfor; endif; ?>
					    </tbody>
					</table>
					<br>
					<table align="center" width="850">
						<tr valign="top">
							<td width="120">Subtotal</td>
							<td width="240">: Rp. <?php echo $_smarty_tpl->tpl_vars['trxSubtotal']->value;?>
</td>
							<td width="120">DP/Bayar</td>
							<td width="370">: Rp. <?php echo $_smarty_tpl->tpl_vars['trxDP']->value;?>
</td>
						</tr>
						<tr valign="top">
							<td>Diskon</td>
							<td>: Rp. <?php echo $_smarty_tpl->tpl_vars['trxDiscount']->value;?>
</td>
							<td>Kurang</td>
							<td>: Rp. <?php echo $_smarty_tpl->tpl_vars['kurang']->value;?>
</td>
						</tr>
						<tr valign="top">
							<td><b>Grandtotal</b></td>
							<td><b>: Rp. <?php echo $_smarty_tpl->tpl_vars['trxTotal']->value;?>
</b></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="4" style="border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;">Terbilang : <?php echo $_smarty_tpl->tpl_vars['terbilang']->value;?>
 Rupiah</td>
						</tr>
					</table>
					
				<?php }else{ ?>
					<br>
					<table width="98%" align="center">
						<tr>
							<td>
								<a href="#inline" class="modalbox"><button type="button" class="btn btn-primary">Cari Kartu Hutang</button></a>
								<a href="print_debt.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
							</td>
						</tr>
					</table>
					
					<table width="98%" align="center">
						<tr valign="top">
							<td><h3>Catatan Hutang</h3></td>
						</tr>
						<tr>
							<td style="padding: 10px 0px 0px 2px;">
								<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
									<thead>
								    	<tr>
								    		<th width="30" style='border-left: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>No. Faktur <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>ID Supplier <i class="fa fa-sort"></i></th>
											<th width="180" style='border-left: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Jumlah <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Bayar <i class="fa fa-sort"></i></th>
											<th width="70" style='border-left: 1px solid #CCCCCC;'>Sisa <i class="fa fa-sort"></i></th>
											<th width="80" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
											<th width="100" style='border-left: 1px solid #CCCCCC;'>Jatuh Tempo <i class="fa fa-sort"></i></th>
											<th width="50" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								    	</tr>
								    <thead>
								    <tbody>
								    	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['name'] = 'dataDebt';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataDebt']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataDebt']['total']);
?>
								    	<?php if ($_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['totalsisa']>0){?>
									    	<tr valign="top">
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['no'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxDate'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceID'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['supplierID'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxFullName'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTotal'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxPay'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['sisa'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['statusSisa'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTerminDate'];?>
</td>
									    		<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'><a href="debts.php?module=debt&act=view&debtID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['debtID'];?>
&invoiceID=<?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceID'];?>
&startDate=&endDate=" title="Detil Catatan Hutang"><img src="images/icons/view.png" width="18"></td>
									    	</tr>
									    <?php }?>
								    	<?php endfor; endif; ?>
								    </tbody>
								</table>
							</td>
						</tr>
					</table>
					
					<!-- hidden inline form -->
					<div id="inline">
						<table width="95%" align="center">
							<tr>
								<td colspan="3"><h3>Catatan Jatuh Tempo Hutang</h3></td>
							</tr>
							<tr>
								<td>
									<form id="debt2" name="debt2" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Periode Awal</td>
											<td width="5">:</td>
											<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['startDate']->value;?>
" id="startDate" name="startDate" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Periode Akhir</td>
											<td>:</td>
											<td><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['endDate']->value;?>
" id="endDate" name="endDate" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Status Hutang</td>
											<td>:</td>
											<td>
												<select id="status" name="status" style="display: block; width: 270px; height: 35px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
													<option value=""></option>
													<option value="3">Semua Status</option>
													<option value="2">Lunas</option>
													<option value="1">Belum Lunas</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Supplier</td>
											<td>:</td>
											<td><input type="text" name="supplierID" size="40" id="supplierID" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
									</table>
									<button id="send" class="btn btn-primary">Pencarian</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
				<?php }?>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>