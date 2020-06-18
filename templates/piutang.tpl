<link rel="shortcut icon" href="images/favicon.jpg">
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
			{section name=dataReceivable loop=$dataReceivable}
			{if $dataReceivable[dataReceivable].totalsisa > 0}
			<tr>
				<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].no}</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].trxDate}</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].invoiceID}</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].memberID}</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].trxFullName}</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'>{$dataReceivable[dataReceivable].trxTotal}</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'>{$dataReceivable[dataReceivable].trxPay}</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: right;'>{$dataReceivable[dataReceivable].sisa}</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; text-align: center;'>{$dataReceivable[dataReceivable].statusSisa}</td>
	    		<td style='border-left: 1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; border-right: 1px solid #CCCCCC;'>{$dataReceivable[dataReceivable].trxTerminDate}</td>
			</tr>
			{/if}
			{/section}
		</tbody>
	</table>
</div>