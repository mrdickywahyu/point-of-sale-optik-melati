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
							
							$("#member").submit(function() { return false; });
							
							$("#member2").submit(function() { return false; });
					
							
							$("#send").on("click", function(){
								var memberCode = $("#memberCode").val();
								var memberFullName = $("#memberFullName").val();
								var memberAddress = $("#memberAddress").val();
								var memberPhone = $("#memberPhone").val();
								
								if (memberCode != '' && memberFullName != ''){
								
									$.ajax({
										type: 'POST',
										url: 'save_member.php',
										dataType: 'JSON',
										data:{
											memberCode: memberCode,
											memberFullName: memberFullName,
											memberAddress: memberAddress,
											memberPhone: memberPhone
										},
										beforeSend: function (data) {
											$('#send').hide();
										},
										success: function(data) {
											setTimeout("$.fancybox.close()", 1000);
											window.location.href = "members.php?code=1";
										}
									});
								}
							});
						});
					</script>
				{/literal}
				
				<div style="width: 98%; margin: 0px auto;">
					<br>
					<a href="#inline" class="modalbox"><button class="btn btn-primary" type="button">Tambah Member</button></a>
					<a href="print_member.php" target="_blank"><button class="btn btn-warning" type="button">Print</button></a>
					<h3>Manajemen Member</h3>
					<div class="table-responsive">
						<table cellpadding="5" cellspacing="5" class="table table-bordered table-hover tablesorter" style="background-color: #FFFFFF; color: #000000;" width="100%">
							<thead>
								<tr>
									<th width="40" style='border-left: 1px solid #CCCCCC;'>No. <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Kode Member <i class="fa fa-sort"></i></th>
									<th width="150" style='border-left: 1px solid #CCCCCC;'>Nama <i class="fa fa-sort"></i></th>
									<th width="300" style='border-left: 1px solid #CCCCCC;'>Alamat <i class="fa fa-sort"></i></th>
									<th width="120" style='border-left: 1px solid #CCCCCC;'>Phone <i class="fa fa-sort"></i></th>
									<th width="100" style='border-left: 1px solid #CCCCCC;'>Aksi <i class="fa fa-sort"></i></th>
								</tr>
							</thead>
							<tbody>
								{section name=dataMember loop=$dataMember}
								<tr>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataMember[dataMember].no}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC; text-align: center;'>{$dataMember[dataMember].memberCode}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataMember[dataMember].memberFullName}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataMember[dataMember].memberAddress}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>{$dataMember[dataMember].memberPhone}</td>
									<td style='border-left: 1px solid #CCCCCC; border-top: 1px solid #CCCCCC;'>
										<a title="Edit" href="edit_members.php?module=member&act=edit&memberID={$dataMember[dataMember].memberID}" data-width="450" data-height="280" class="various2 fancybox.iframe"><img src="images/icons/edit.png" width="18"></a>
										<a title="Hapus" href="members.php?module=member&act=delete&memberID={$dataMember[dataMember].memberID}" onclick="return confirm('Anda Yakin ingin menghapus member {$dataMember[dataMember].memberFullName}?');"><img src="images/icons/delete.png" width="18"></a>
									</td>
								</tr>
								{/section}
							</tbody>
						</table>
					</div>
					<br>
					<div id="paging">{$pageLink}</div>
					<br><br>
					<div id="inline">	
						<table width="98%" align="center">
							<tr>
								<td colspan="3"><h3>Tambah Member</h3></td>
							</tr>
							<tr>
								<td>
									<form id="member" name="member" method="POST" action="#">
									<table cellpadding="7" cellspacing="7">
										<tr>
											<td width="140">Kode Member</td>
											<td width="5">:</td>
											<td><input type="text" id="memberCode" value="{$memberCode}" name="memberCode" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" DISABLED>
												<input type="hidden" id="memberCode" value="{$memberCode}" name="memberCode">
											</td>
										</tr>
										<tr>
											<td>Nama</td>
											<td>:</td>
											<td><input type="text" id="memberFullName" name="memberFullName" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;" required></td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td>:</td>
											<td><input type="text" id="memberAddress" name="memberAddress" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
										</tr>
										<tr>
											<td>Phone</td>
											<td>:</td>
											<td><input type="text" id="memberPhone" name="memberPhone" style="display: block; width: 270px; height: 20px; padding: 6px 12px; font-size: 14px; line-height: 1.428571429; color: #555; background-color: #fff; border: 1px solid #ccc; border-radius: 4px;"></td>
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