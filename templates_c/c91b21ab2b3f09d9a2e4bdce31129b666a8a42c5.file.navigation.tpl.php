<?php /* Smarty version Smarty-3.1.11, created on 2019-09-18 21:56:27
         compiled from ".\templates\navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77905d82459bee4f63-05295319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c91b21ab2b3f09d9a2e4bdce31129b666a8a42c5' => 
    array (
      0 => '.\\templates\\navigation.tpl',
      1 => 1414237647,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77905d82459bee4f63-05295319',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'userID' => 0,
    'userLevel' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5d82459bf3d7d6_92673922',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d82459bf3d7d6_92673922')) {function content_5d82459bf3d7d6_92673922($_smarty_tpl) {?>
<!-- mp-menu -->
<nav id="mp-menu" class="mp-menu">
	<div class="mp-level">
		<h2 class="icon icon-world">Menu</h2>
		<ul>
			<?php if ($_smarty_tpl->tpl_vars['userID']->value!=''&&$_smarty_tpl->tpl_vars['userLevel']->value=='1'){?>
				<li><a href="identity.php">Identitas Outlet</a></li>
				<li><a href="users.php">Manajemen Users</a></li>
				<li>
					<a href="#">Master Data</a>
					<div class="mp-level">
						<h2 class="icon icon-world">Master Data</h2>
						<a class="mp-back" href="#">back</a>
						<ul>
							<li>
								<a href="categories.php">Kategori</a>
							</li>
							<li>
								<a href="brands.php">Brand</a>
							</li>
							<li>
								<a href="suppliers.php">Supplier</a>
							</li>
							<li>
								<a href="products.php">Produk</a>
							</li>
							<li>
								<a href="members.php">Member</a>
							</li>
						</ul>
					</div>
				</li>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['userID']->value!=''){?>
				<li>
					<a href="#">Transaksi Penjualan</a>
					<div class="mp-level">
						<h2 class="icon icon-world">Transaksi Penjualan</h2>
						<a class="mp-back" href="#">back</a>
						<ul>
							<li>
								<a href="sales_transactions.php?module=trx&act=add">Tambah Transaksi</a>
							</li>
							<li>
								<a href="sales_transactions.php?module=trx&act=pending">Transaksi Pending</a>
							</li>
							<li>
								<a href="sales_transactions.php">Cari Transaksi</a>
							</li>
						</ul>
					</div>
				</li>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['userID']->value!=''&&$_smarty_tpl->tpl_vars['userLevel']->value=='1'){?>
				<li>
					<a href="#">Transaksi Pembelian</a>
					<div class="mp-level">
						<h2 class="icon icon-world">Transaksi Pembelian</h2>
						<a class="mp-back" href="#">back</a>
						<ul>
							<li>
								<a href="buy_transactions.php?module=trx&act=add">Tambah Transaksi</a>
							</li>
							<li>
								<a href="buy_transactions.php">Cari Transaksi</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#">Retur Produk</a>
					<div class="mp-level">
						<h2 class="icon icon-world">Retur Produk</h2>
						<a class="mp-back" href="#">back</a>
						<ul>
							<li>
								<a href="retur_transactions.php?module=trx&act=add">Tambah Retur</a>
							</li>
							<li>
								<a href="retur_transactions.php">Cari Retur</a>
							</li>
						</ul>
					</div>
				</li>
				<li>
					<a href="#">Master Biaya</a>
					<div class="mp-level">
						<h2 class="icon icon-world">Master Biaya</h2>
						<a class="mp-back" href="#">back</a>
						<ul>
							<li>
								<a href="accounts.php">Akun Biaya</a>
							</li>
							<li>
								<a href="funds.php">Pengeluaran Biaya</a>
							</li>
							<li>
								<a href="funds.php?module=fund&act=search">Cari Pengeluaran Biaya</a>
							</li>
						</ul>
					</div>
				</li>	
				<li>
					<a href="#">Stock Opname</a>
					<div class="mp-level">
						<h2 class="icon icon-world">Stock Opname</h2>
						<a class="mp-back" href="#">back</a>
						<ul>
							<li>
								<a href="stock_opname.php">Tambah Stock Opname</a>
							</li>
							<li>
								<a href="stock_opname.php?module=stock&act=search">Pencarian Stock Opname</a>
							</li>
							<li>
								<a href="stock_product.php">Cetak Produk</a>
							</li>
						</ul>
					</div>
				</li>
			<?php }?>
			
			<li><a href="barcodes.php">Cetak Barcode</a></li>
			
			<?php if ($_smarty_tpl->tpl_vars['userID']->value!=''&&$_smarty_tpl->tpl_vars['userLevel']->value=='1'){?>
				<li>
					<a href="debts.php">Kartu Hutang</a>
				</li>
				<li>
					<a href="receivables.php">Kartu Piutang</a>
				</li>
				<li>
					<a href="#">Laporan</a>
					<div class="mp-level">
						<h2 class="icon icon-world">Laporan</h2>
						<a class="mp-back" href="#">back</a>
						<ul>
							<li>
								<a href="order_reports.php">Laporan Pendapatan</a>
							</li>
							<li>
								<a href="fund_reports.php">Laporan Pengeluaran</a>
							</li>
							<li>
								<a href="profit_reports.php">Laba dan Proyeksi Kerugian</a>
							</li>
						</ul>
					</div>
				</li>
			<?php }?>
			
			
			<li><a href="change_password.php">Ubah Password</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
			
	</div>
</nav>
<!-- /mp-menu --><?php }} ?>