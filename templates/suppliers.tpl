{include file="header.tpl"}

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
					<a href="backup.php"><span>Backup</span></a> |
					<a href="home.php"><span>Home</span></a>
					<span class="right"><a class="codrops-icon codrops-icon-drop" href="logout.php"><span>Logout</span></a></span>
				</div>
				
				<link rel="stylesheet" type="text/css" media="all" href="design/js/fancybox/jquery.fancybox.css">
  				<script type="text/javascript" src="design/js/fancybox/jquery.fancybox.js?v=2.0.6"></script>
  				
  				{literal}
					<script>
						$(document).ready(function() {
							
							$(".various2").fancybox({
								fitToView: false,
								scrolling: 'no',
								afterLoad: function(){
									this.width = $(this.element).data("width");
									this.height = $(this.element).data("height");
								},
								'afterClose':function () {
									window.location.reload();
								}
							});
							
							$(".modalbox").fancybox();
							$(".modalbox2").fancybox();
							
							$("#supplier").submit(function() { return false; });
							
							$("#supplier2").submit(function() { return false; });
					
							
							$("#send").on("click", function(){
								var supplierCode = $("#supplierCode").val();
								var supplierName = $("#supplierName").val();
								var supplierAddress = $("#supplierAddress").val();
								var supplierPhone = $("#supplierPhone").val();
								var supplierFax = $("#supplierFax").val();
								var supplierContactPerson = $("#supplierContactPerson").val();
								var supplierCPHp = $("#supplierCPHp").val();
								var supplierStatus = $("#supplierStatus").val();
								
								if (supplierCode != '' && supplierName != '' && supplierStatus != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_supplier.php',
										dataType: 'JSON',
										data:{
											supplierCode: supplierCode,
											supplierName: supplierName,
											supplierAddress: supplierAddress,
											supplierPhone: supplierPhone,
											supplierFax: supplierFax,
											supplierContactPerson: supplierContactPerson,
											supplierCPHp: supplierCPHp,
											supplierStatus: supplierStatus
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "suppliers.php?code=1";
										}
									});
								}
							});
						});
					</script>
				{/literal}
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Supplier</button></a>
					<a href="print_supplier.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen Supplier</h3>
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="80" style='border-left: 1px solid #CCCCCC;'>Kode <i class="fa fa-sort"></i></th>
									<th width="230" style='border-left: 1px solid #CCCCCC;'>Nama Supplier <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Phone <i class="fa fa-sort"></i></th>
									<th width="210" style='border-left: 1px solid #CCCCCC;'>Kontak Person <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>No. HP <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
									<th width="80" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								{section name=dataSupplier loop=$dataSupplier}
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataSupplier[dataSupplier].no}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataSupplier[dataSupplier].supplierCode}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataSupplier[dataSupplier].supplierName}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataSupplier[dataSupplier].supplierPhone}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataSupplier[dataSupplier].supplierContactPerson}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataSupplier[dataSupplier].supplierCPHp}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataSupplier[dataSupplier].supplierStatus}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a title="Edit" href="edit_suppliers.php?module=supplier&act=edit&supplierID={$dataSupplier[dataSupplier].supplierID}" data-width="450" data-height="470" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="18"></a>
										<a title="Hapus" href="suppliers.php?module=supplier&act=delete&supplierID={$dataSupplier[dataSupplier].supplierID}" onclick="return confirm('Anda Yakin ingin menghapus supplier {$dataSupplier[dataSupplier].supplierName}?');"><img src="images/icons/delete.png" width="18"></a>
									</td>
								</tr>
								{/section}
							</tbody>
						</table>
					</div>
					<br>
					<div id="paging">{$pageLink}</div>
					
					<div id="inline">	
						<table width="98%" align="center">
							<tr>
								<td colspan="3"><h3>Tambah Supplier</h3></td>
							</tr>
							<tr>
								<td>
									<form id="supplier" name="supplier" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Kode Supplier</td>
											<td width="5">:</td>
											<td><input type="text" id="supplierCode" value="{$supplierCode}" name="supplierCode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
												<input type="hidden" id="supplierCode" value="{$supplierCode}" name="supplierCode">
											</td>
										</tr>
										<tr>
											<td>Nama Supplier</td>
											<td>:</td>
											<td><input type="text" id="supplierName" name="supplierName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>:</td>
											<td><input type="text" id="supplierAddress" name="supplierAddress" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Phone</td>
											<td>:</td>
											<td><input type="text" id="supplierPhone" name="supplierPhone" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Fax</td>
											<td>:</td>
											<td><input type="text" id="supplierFax" name="supplierFax" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Kontak Person</td>
											<td>:</td>
											<td><input type="text" id="supplierContactPerson" name="supplierContactPerson" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Nomor HP</td>
											<td>:</td>
											<td><input type="text" id="supplierCPHp" name="supplierCPHp" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Status</td>
											<td>:</td>
											<td><select name="supplierStatus" id="supplierStatus" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
												<option value="">- Pilih Status -</option>
												<option value="Y">Y (Aktif)</option>
												<option value="N">N (Tidak Aktif)</option>
											</select></td>
										</tr>
									</table>
									<button id="send" class="btn btn-primary">Simpan</button>
									</form>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div><!-- /scroller-inner -->
		</div><!-- /scroller -->

	</div><!-- /pusher -->
</div><!-- /container -->
		
{include file="footer.tpl"}