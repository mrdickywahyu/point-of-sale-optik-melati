<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 21:56:27
         compiled from ".\templates\logo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105115d82459c002384-70722078%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9433dccd389996af58dd620cc29f9363c4304f9' => 
    array (
      0 => '.\\templates\\logo.tpl',
      1 => 1414201045,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105115d82459c002384-70722078',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'identityImage' => 0,
    'identityName' => 0,
    'identityAddress' => 0,
    'identityPhone' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d82459c00fec6_26240370',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d82459c00fec6_26240370')) {function content_5d82459c00fec6_26240370($_smarty_tpl) {?><table>
	<tr>
		<?php if ($_smarty_tpl->tpl_vars['identityImage']->value!=''){?>
			<td width="160">
				<img src="images/outlets/<?php echo $_smarty_tpl->tpl_vars['identityImage']->value;?>
" width="150">
			</td>
		<?php }?>
		<td>
			<span style="font-size: 18px; font-weight: bold;">
				<?php echo $_smarty_tpl->tpl_vars['identityName']->value;?>

			</span><br>
			<div style="padding-bottom: 10px;"><?php echo $_smarty_tpl->tpl_vars['identityAddress']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['identityPhone']->value!=''){?>, Ph. <?php echo $_smarty_tpl->tpl_vars['identityPhone']->value;?>
<?php }?></div>
		</td>
	</tr>
</table><?php }} ?>