<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 21:56:47
         compiled from ".\templates\identity.tpl" */ ?>
<?php /*%%SmartyHeaderCode:296055d8245afebaf62-94549694%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '531e252325ff13ad5b65720f8d1810293b52625f' => 
    array (
      0 => '.\\templates\\identity.tpl',
      1 => 1414239968,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '296055d8245afebaf62-94549694',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'code' => 0,
    'identityID' => 0,
    'identityName' => 0,
    'identityOwner' => 0,
    'identityPrintSale' => 0,
    'identityAddress' => 0,
    'identityOwnerPhone' => 0,
    'identityPrintBuy' => 0,
    'identityPhone' => 0,
    'identityEmail' => 0,
    'identityPrintRetur' => 0,
    'identityPKP' => 0,
    'identityPKPDate' => 0,
    'identityPrintDebt' => 0,
    'identityNPWP' => 0,
    'identityPPN' => 0,
    'identityPrintReceive' => 0,
    'identityImage' => 0,
    'identityPrintReport' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d8245aff2d128_08963535',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d8245aff2d128_08963535')) {function content_5d8245aff2d128_08963535($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<style>
li{
	list-style: none;
}
</style>

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
					<a href="home.php"><span>Home</span></a>
					<span class="right"><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Logout</span></a></span>
				</div>
				
				<script type="text/javascript" src="design/js/ajaxupload.3.5.js" ></script>
				<link rel="stylesheet" type="text/css" href="design/css/Ajaxfile-upload.css" />
				
				
				<script type="text/javascript" >
				
					$(function(){
						$( "#identityPKPDate" ).datepicker({
							changeMonth: true,
							changeYear: true,
							dateFormat: "yy-mm-dd",
							yearRange: 'c-10:c'
						});
					
						var btnUpload=$('#me');
						var mestatus=$('#mestatus');
						var files=$('#files');
						new AjaxUpload(btnUpload, {
							action: 'upload_identity.php',
							name: 'uploadfile',
							onSubmit: function(file, ext){
								 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
				                    // extension is not allowed 
									mestatus.text('Only JPG files are allowed');
									return false;
								}
								mestatus.html('<img src="images/ajax-loader.gif" height="16" width="16">');
							},
							onComplete: function(file, response){
								//On completion clear the status
								mestatus.text('');
								//On completion clear the status
								files.html('');
								//Add uploaded file to list
								if(response!=="error"){
									$('<li></li>').appendTo('#files').html('<img src="images/outlets/'+response+'" alt="" width="120"/><br />').addClass('success');
									$('<li></li>').appendTo('#identity').html('<input type="hidden" name="filename" value="'+response+'">').addClass('nameupload');
									
								} else{
									$('<li></li>').appendTo('#files').text(file).addClass('error');
								}
							}
						});
						
					});
				</script>
				
				
				
				<div style="width: 95%; margin: 0px auto;">
				
					<?php if ($_smarty_tpl->tpl_vars['code']->value=='1'){?>
						<div class="n_ok">Identitas outlet berhasil diupdate.</div>
					<?php }?>
					
					<h2>Ubah Identitas Outlet</h2>
							
					<form name="identity" action="identity.php?module=identity&act=update" method="POST">
						<input type="hidden" name="identityID" value="<?php echo $_smarty_tpl->tpl_vars['identityID']->value;?>
">
						<table width="700" cellpadding="8" cellspacing="8" bgcolor="#FFFFFF" style="color: #000000;">
							<tr>
								<td width="400">
									<label for="identityName">Nama Outlet</label><br>
									<input type="text" id="identityName" value="<?php echo $_smarty_tpl->tpl_vars['identityName']->value;?>
" name="identityName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
								<td>
									<label for="identityOwner">Nama Pemilik / Penanggung Jawab</label><br>
									<input type="text" id="identityOwner" value="<?php echo $_smarty_tpl->tpl_vars['identityOwner']->value;?>
" name="identityOwner" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
								<td>
									<label for="identityPrintSale">Print Paper Size Penjualan</label><br>
									<select name="identityPrintSale" id="identityPrintSale" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" <?php if ($_smarty_tpl->tpl_vars['identityPrintSale']->value=='1'){?> SELECTED <?php }?>>Besar (Epson LX-310)</option>
										<option value="2" <?php if ($_smarty_tpl->tpl_vars['identityPrintSale']->value=='2'){?> SELECTED <?php }?>>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label for="identityAddress">Alamat</label><br>
									<input type="text" id="identityAddress" maxlength="200" value="<?php echo $_smarty_tpl->tpl_vars['identityAddress']->value;?>
" name="identityAddress" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
								<td>
									<label for="identityOwnerPhone">No. Hp Pemilik / Penanggung Jawab</label><br>
									<input type="text" id="identityOwnerPhone" name="identityOwnerPhone" value="<?php echo $_smarty_tpl->tpl_vars['identityOwnerPhone']->value;?>
" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
								<td>
									<label for="identityPrintBuy">Print Paper Size Pembelian</label><br>
									<select name="identityPrintBuy" id="identityPrintBuy" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" <?php if ($_smarty_tpl->tpl_vars['identityPrintBuy']->value=='1'){?> SELECTED <?php }?>>Besar (Epson LX-310)</option>
										<option value="2" <?php if ($_smarty_tpl->tpl_vars['identityPrintBuy']->value=='2'){?> SELECTED <?php }?>>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<label for="identityPhone">Telepon</label><br>
									<input type="text" id="identityPhone" value="<?php echo $_smarty_tpl->tpl_vars['identityPhone']->value;?>
" name="identityPhone" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityEmail">Email</label><br>
									<input type="email" id="identityEmail" value="<?php echo $_smarty_tpl->tpl_vars['identityEmail']->value;?>
" name="identityEmail" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPrintRetur">Print Paper Size Retur</label><br>
									<select name="identityPrintRetur" id="identityPrintRetur" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" <?php if ($_smarty_tpl->tpl_vars['identityPrintRetur']->value=='1'){?> SELECTED <?php }?>>Besar (Epson LX-310)</option>
										<option value="2" <?php if ($_smarty_tpl->tpl_vars['identityPrintRetur']->value=='2'){?> SELECTED <?php }?>>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<label for="identityPKP">No. PKP</label><br>
									<input type="text" id="identityPKP" value="<?php echo $_smarty_tpl->tpl_vars['identityPKP']->value;?>
" name="identityPKP" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPKPDate">Tanggal Pengukuhan PKP</label><br>
									<input type="text" id="identityPKPDate" value="<?php echo $_smarty_tpl->tpl_vars['identityPKPDate']->value;?>
" name="identityPKPDate" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPrintDebt">Print Paper Size Hutang</label><br>
									<select name="identityPrintDebt" id="identityPrintDebt" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" <?php if ($_smarty_tpl->tpl_vars['identityPrintDebt']->value=='1'){?> SELECTED <?php }?>>Besar (A4)</option>
										<option value="2" <?php if ($_smarty_tpl->tpl_vars['identityPrintDebt']->value=='2'){?> SELECTED <?php }?>>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<label for="identityNPWP">NPWP</label><br>
									<input type="text" id="identityNPWP" value="<?php echo $_smarty_tpl->tpl_vars['identityNPWP']->value;?>
" name="identityNPWP" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPPN">PPN (%)</label><br>
									<input type="number" id="identityPPN" value="<?php echo $_smarty_tpl->tpl_vars['identityPPN']->value;?>
" name="identityPPN" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPrintReceive">Print Paper Size Piutang</label><br>
									<select name="identityPrintReceive" id="identityPrintReceive" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" <?php if ($_smarty_tpl->tpl_vars['identityPrintReceive']->value=='1'){?> SELECTED <?php }?>>Besar (A4)</option>
										<option value="2" <?php if ($_smarty_tpl->tpl_vars['identityPrintReceive']->value=='2'){?> SELECTED <?php }?>>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<label for="identityImage">Logo</label><br>
									<div id="me" class="styleall" style="cursor:pointer;">
										<label>
											<button class="btn btn-primary">Browse</button>
										</label>
									</div>
									<span id="mestatus"></span>
									<div id="identity">
										<li class="nameupload"></li>
									</div>
									<div id="files">
										<li class="success">
											<?php if ($_smarty_tpl->tpl_vars['identityImage']->value!=''){?>
												<img src="images/outlets/<?php echo $_smarty_tpl->tpl_vars['identityImage']->value;?>
" width="160">
											<?php }?>
										</li>
									</div>
								</td>
								<td></td>
								<td>
									<label for="identityPrintReport">Print Paper Size Laporan</label><br>
									<select name="identityPrintReport" id="identityPrintReport" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" <?php if ($_smarty_tpl->tpl_vars['identityPrintReport']->value=='1'){?> SELECTED <?php }?>>Besar (A4)</option>
										<option value="2" <?php if ($_smarty_tpl->tpl_vars['identityPrintReport']->value=='2'){?> SELECTED <?php }?>>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
						</table>
						<br>
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="reset" class="btn btn-warning">Reset</button>
					</form>
					<p>&nbsp;</p>
				</div>
				
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
<?php echo $_smarty_tpl->getSubTemplate ("footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>