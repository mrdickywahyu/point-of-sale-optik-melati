<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 23:44:40
         compiled from ".\templates\hutang.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7295d825ef853cc93-38765223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eba146e1f38f1c6eb12c3a1d2e13078cb38bca4e' => 
    array (
      0 => '.\\templates\\hutang.tpl',
      1 => 1413924130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7295d825ef853cc93-38765223',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataDebt' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d825ef8589d74_85509069',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d825ef8589d74_85509069')) {function content_5d825ef8589d74_85509069($_smarty_tpl) {?><link rel="shortcut icon" href="images/favicon.jpg">
<link rel="stylesheet" type="text/css" href="design/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="design/css/demo.css" />
<link rel="stylesheet" type="text/css" href="design/css/icons.css" />
<link rel="stylesheet" type="text/css" href="design/css/component.css" />
<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<script src="design/js/modernizr.custom.js"></script>
<link rel="stylesheet" href="design/js/development-bundle/themes/base/jquery.ui.all.css" type="text/css">
<script type="text/javascript" src="design/js/development-bundle/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="design/js/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="design/js/development-bundle/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="design/js/ckeditor/ckeditor.js"></script>
<script src="design/js/jquery.plugin.js"></script>
<script src="design/js/jquery.timeentry.js"></script>
	
<script src="design/js/jquery-1.8.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>

<style>
#scrollproduct {
    width: 1100px;
    height: 400px;
    overflow: scroll;
} 
</style>

<body style='background-color: #FFF; color: #000;'>

<h4>Data Hutang ke Supplier yang akan jatuh tempo</h4>
<div id="scrollproduct">
	<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="98%" align="center">
		<thead>
			<tr>
				<th width="30" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
				<th width="80" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
				<th width="70" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>No. Faktur <i class="fa fa-sort"></i></th>
				<th width="90" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>ID Supplier <i class="fa fa-sort"></i></th>
				<th width="180" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
				<th width="70" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Jumlah <i class="fa fa-sort"></i></th>
				<th width="70" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Bayar <i class="fa fa-sort"></i></th>
				<th width="70" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Sisa <i class="fa fa-sort"></i></th>
				<th width="80" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
				<th width="100" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC;'>Jatuh Tempo <i class="fa fa-sort"></i></th>
			</tr>
		</thead>
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
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['no'];?>
</td>
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxDate'];?>
</td>
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['invoiceID'];?>
</td>
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['supplierID'];?>
</td>
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxFullName'];?>
</td>
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTotal'];?>
</td>
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxPay'];?>
</td>
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['sisa'];?>
</td>
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['statusSisa'];?>
</td>
		    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataDebt']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataDebt']['index']]['trxTerminDate'];?>
</td>
		    	</tr>
		    <?php }?>
	    	<?php endfor; endif; ?>
		</tbody>
	</table>
</div><?php }} ?>