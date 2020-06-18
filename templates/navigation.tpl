
<!-- mp-menu -->
<nav id="mp-menu" class="mp-menu">
	<div class="mp-level">
		<h2 class="icon icon-world">Menu</h2>
		<ul>
			{if $userID != '' AND $userLevel == '1'}
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
			{/if}
			{if $userID != ''}
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
			{/if}
			{if $userID != '' AND $userLevel == '1'}
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
			{/if}
			
			<li><a href="barcodes.php">Cetak Barcode</a></li>
			
			{if $userID != '' AND $userLevel == '1'}
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
			{/if}
			
			
			<li><a href="change_password.php">Ubah Password</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
			
	</div>
</nav>
<!-- /mp-menu -->