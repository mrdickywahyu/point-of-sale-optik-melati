{include file="header.tpl"}

<style>
li{
	list-style: none;
}
</style>

<div class="container">
	<!-- Push Wrapper -->
	<div class="mp-pusher" id="mp-pusher">

		{include file="navigation.tpl"}

		<div class="scroller"><!-- this is for emulating position fixed of the nav -->
			<div class="scroller-inner">
				<!-- Top Navigation -->
				<div style="padding-left: 18px; padding-top: 10px;">
					
					{include file="logo.tpl"}
					
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
				
				{literal}
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
				{/literal}
				
				
				<div style="width: 95%; margin: 0px auto;">
				
					{if $code == '1'}
						<div class="n_ok">Identitas outlet berhasil diupdate.</div>
					{/if}
					
					<h2>Ubah Identitas Outlet</h2>
							
					<form name="identity" action="identity.php?module=identity&act=update" method="POST">
						<input type="hidden" name="identityID" value="{$identityID}">
						<table width="700" cellpadding="8" cellspacing="8" bgcolor="#FFFFFF" style="color: #000000;">
							<tr>
								<td width="400">
									<label for="identityName">Nama Outlet</label><br>
									<input type="text" id="identityName" value="{$identityName}" name="identityName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
								<td>
									<label for="identityOwner">Nama Pemilik / Penanggung Jawab</label><br>
									<input type="text" id="identityOwner" value="{$identityOwner}" name="identityOwner" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
								<td>
									<label for="identityPrintSale">Print Paper Size Penjualan</label><br>
									<select name="identityPrintSale" id="identityPrintSale" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" {if $identityPrintSale == '1'} SELECTED {/if}>Besar (Epson LX-310)</option>
										<option value="2" {if $identityPrintSale == '2'} SELECTED {/if}>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label for="identityAddress">Alamat</label><br>
									<input type="text" id="identityAddress" maxlength="200" value="{$identityAddress}" name="identityAddress" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
								<td>
									<label for="identityOwnerPhone">No. Hp Pemilik / Penanggung Jawab</label><br>
									<input type="text" id="identityOwnerPhone" name="identityOwnerPhone" value="{$identityOwnerPhone}" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
								</td>
								<td>
									<label for="identityPrintBuy">Print Paper Size Pembelian</label><br>
									<select name="identityPrintBuy" id="identityPrintBuy" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" {if $identityPrintBuy == '1'} SELECTED {/if}>Besar (Epson LX-310)</option>
										<option value="2" {if $identityPrintBuy == '2'} SELECTED {/if}>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<label for="identityPhone">Telepon</label><br>
									<input type="text" id="identityPhone" value="{$identityPhone}" name="identityPhone" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityEmail">Email</label><br>
									<input type="email" id="identityEmail" value="{$identityEmail}" name="identityEmail" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPrintRetur">Print Paper Size Retur</label><br>
									<select name="identityPrintRetur" id="identityPrintRetur" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" {if $identityPrintRetur == '1'} SELECTED {/if}>Besar (Epson LX-310)</option>
										<option value="2" {if $identityPrintRetur == '2'} SELECTED {/if}>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<label for="identityPKP">No. PKP</label><br>
									<input type="text" id="identityPKP" value="{$identityPKP}" name="identityPKP" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPKPDate">Tanggal Pengukuhan PKP</label><br>
									<input type="text" id="identityPKPDate" value="{$identityPKPDate}" name="identityPKPDate" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPrintDebt">Print Paper Size Hutang</label><br>
									<select name="identityPrintDebt" id="identityPrintDebt" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" {if $identityPrintDebt == '1'} SELECTED {/if}>Besar (A4)</option>
										<option value="2" {if $identityPrintDebt == '2'} SELECTED {/if}>Kecil (Epson TM U220)</option>
									</select>
								</td>
							</tr>
							<tr valign="top">
								<td>
									<label for="identityNPWP">NPWP</label><br>
									<input type="text" id="identityNPWP" value="{$identityNPWP}" name="identityNPWP" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPPN">PPN (%)</label><br>
									<input type="number" id="identityPPN" value="{$identityPPN}" name="identityPPN" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;">
								</td>
								<td>
									<label for="identityPrintReceive">Print Paper Size Piutang</label><br>
									<select name="identityPrintReceive" id="identityPrintReceive" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" {if $identityPrintReceive == '1'} SELECTED {/if}>Besar (A4)</option>
										<option value="2" {if $identityPrintReceive == '2'} SELECTED {/if}>Kecil (Epson TM U220)</option>
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
											{if $identityImage != ''}
												<img src="images/outlets/{$identityImage}" width="160">
											{/if}
										</li>
									</div>
								</td>
								<td></td>
								<td>
									<label for="identityPrintReport">Print Paper Size Laporan</label><br>
									<select name="identityPrintReport" id="identityPrintReport" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
										<option value="">- Paper Size -</option>
										<option value="1" {if $identityPrintReport == '1'} SELECTED {/if}>Besar (A4)</option>
										<option value="2" {if $identityPrintReport == '2'} SELECTED {/if}>Kecil (Epson TM U220)</option>
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
		
{include file="footer.tpl"}