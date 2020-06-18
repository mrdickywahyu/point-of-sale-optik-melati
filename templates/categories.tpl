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
							
							$("#category").submit(function() { return false; });
							
							$("#category2").submit(function() { return false; });
					
							
							$("#send").on("click", function(){
								var categoryName = $("#categoryName").val();
								var categoryStatus = $("#categoryStatus").val();
								
								if (categoryName != '' && categoryStatus != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_category.php',
										dataType: 'JSON',
										data:{
											categoryName: categoryName,
											categoryStatus: categoryStatus
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "categories.php?code=1";
										}
									});
								}
							});
						});
					</script>
				{/literal}
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Kategori</button></a>
					<a href="print_category.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen Kategori</h3>
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="30" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Nama Kategori <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Status <i class="fa fa-sort"></i></th>
									<th width="450" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								{section name=dataCategory loop=$dataCategory}
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataCategory[dataCategory].no}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataCategory[dataCategory].categoryName}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataCategory[dataCategory].categoryStatus}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a title="Edit" href="edit_categories.php?module=category&act=edit&categoryID={$dataCategory[dataCategory].categoryID}" data-width="450" data-height="180" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="18"></a>
										<a title="Delete" href="categories.php?module=category&act=delete&categoryID={$dataCategory[dataCategory].categoryID}" onclick="return confirm('Anda Yakin ingin menghapus kategori {$dataCategory[dataCategory].categoryName}?');"><img src="images/icons/delete.png" width="18"></a>
									</td>
								</tr>
								{/section}
							</tbody>
						</table>
					</div>
					<br>
					<div id="paging">{$pageLink}</div>
					<p>&nbsp;</p>
					<div id="inline">	
						<table width="98%" align="center">
							<tr>
								<td colspan="3"><h3>Tambah Kategori</h3></td>
							</tr>
							<tr>
								<td>
									<form id="category" name="category" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Nama Kategori</td>
											<td width="5">:</td>
											<td><input type="text" id="categoryName" name="categoryName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Status</td>
											<td>:</td>
											<td><select name="categoryStatus" id="categoryStatus" style="display: block; width: 270px; height: 34px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required>
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