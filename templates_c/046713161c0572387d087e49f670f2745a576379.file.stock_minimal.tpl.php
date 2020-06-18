<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 21:56:38
         compiled from ".\templates\stock_minimal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37095d8245a6a39952-53897063%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '046713161c0572387d087e49f670f2745a576379' => 
    array (
      0 => '.\\templates\\stock_minimal.tpl',
      1 => 1413924428,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37095d8245a6a39952-53897063',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataProduct' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d8245a6aba556_06983030',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d8245a6aba556_06983030')) {function content_5d8245a6aba556_06983030($_smarty_tpl) {?><link rel="shortcut icon" href="images/favicon.jpg">
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

<h4>Data Produk yang Akan Habis Stoknya</h4>
<div id="scrollproduct">
	<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="98%" align="center">
		<thead>
			<tr>
				<th width="40" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
				<th width="130" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Kode Produk <i class="fa fa-sort"></i></th>
				<th width="340" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Nama Produk <i class="fa fa-sort"></i></th>
				<th width="80" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Stok <i class="fa fa-sort"></i></th>
				<th width="100" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Harga Beli <i class="fa fa-sort"></i></th>
				<th width="100" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Harga Jual <i class="fa fa-sort"></i></th>
				<th width="80" style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>Diskon (%) <i class="fa fa-sort"></i></th>
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
				<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['no'];?>
</td>
				<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productBarcode'];?>
</td>
				<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productName'];?>
</td>
				<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productStock'];?>
</td>
				<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productBuyPrice'];?>
</td>
				<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productSalePrice'];?>
</td>
				<td style='border-right: 1px solid #CCCCCC; border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: center;'><?php echo $_smarty_tpl->tpl_vars['dataProduct']->value[$_smarty_tpl->getVariable('smarty')->value['section']['dataProduct']['index']]['productDiscount'];?>
</td>
			</tr>
			<?php endfor; endif; ?>
		</tbody>
	</table>
</div><?php }} ?>