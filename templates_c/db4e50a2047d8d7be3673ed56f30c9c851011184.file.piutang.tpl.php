<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 23:44:35
         compiled from ".\templates\piutang.tpl" */ ?>
<?php /*%%SmartyHeaderCode:310085d825ef3688ed7-23555514%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db4e50a2047d8d7be3673ed56f30c9c851011184' => 
    array (
      0 => '.\\templates\\piutang.tpl',
      1 => 1413923736,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '310085d825ef3688ed7-23555514',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataReceivable' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d825ef36d9492_30660987',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d825ef36d9492_30660987')) {function content_5d825ef36d9492_30660987($_smarty_tpl) {?><link rel="shortcut icon" href="images/favicon.jpg">
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

<h4>Data Piutang (Hutang Konsumen) yang akan jatuh tempo</h4>
<div id="scrollproduct">
	<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="98%" align="center">
		<thead>
			<tr>
				<th width="30" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>No <i class="fa fa-sort"></i></th>
				<th width="80" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Tanggal <i class="fa fa-sort"></i></th>
				<th width="80" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>No. Faktur <i class="fa fa-sort"></i></th>
				<th width="80" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>ID Member <i class="fa fa-sort"></i></th>
				<th width="180" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
				<th width="70" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Jumlah <i class="fa fa-sort"></i></th>
				<th width="70" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Bayar <i class="fa fa-sort"></i></th>
				<th width="70" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Sisa <i class="fa fa-sort"></i></th>
				<th width="80" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
				<th width="100" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC;'>Jatuh Tempo <i class="fa fa-sort"></i></th>
			</tr>
		</thead>
		<tbody>
			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['name'] = 'dataReceivable';
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['dataReceivable']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['dataReceivable']['total']);
?>
			<?php if ($_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['totalsisa']>0){?>
			<tr>
				<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['no'];?>
</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['trxDate'];?>
</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['invoiceID'];?>
</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['memberID'];?>
</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['trxFullName'];?>
</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['trxTotal'];?>
</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['trxPay'];?>
</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['sisa'];?>
</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['statusSisa'];?>
</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataReceivable']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataReceivable']['index']]['trxTerminDate'];?>
</td>
			</tr>
			<?php }?>
			<?php endfor; endif; ?>
		</tbody>
	</table>
</div><?php }} ?>