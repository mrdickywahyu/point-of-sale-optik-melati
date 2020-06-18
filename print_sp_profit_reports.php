<?php
include "header.php";

// if session is null, showing up the text and exit
if ($_SESSION['userName'] == '' && $_SESSION['userPassword'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else{
	if ($_SESSION['outletLevel'] != 'W' && $_SESSION['outletID'] != '1' || $_SESSION['outletLevel'] == ''){
		// show up the text and exit
		echo "You have not authorization for access the modules.";
		exit();
	}
	
	ob_start();
	require ("includes/html2pdf/html2pdf.class.php");
	
	$now = date('Y-m-d');
	$yr = $_GET['year'];
	$outletID = $_GET['outletID'];
	
	$filename="laporan-laba-".$yr."-".$outletID.".pdf";
	$content = ob_get_clean();
	
	$outletDt = mysqli_fetch_array(mysqli_query($connect, "SELECT outletCode, outletID, outletName FROM as_outlets WHERE outletID = '$outletID'"));
	
	$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 290mm;'>
					<tr valign='top'>
						<td style='width: 290mm;' valign='middle'>
							<div style='font-weight: bold; padding-bottom: 5px; font-size: 13pt;'>
								$dataIdentity[identityName]
							</div>
							<span style='font-size: 11pt;'>$dataIdentity[identityAddress], Telp. $dataIdentity[identityPhone], Email: $dataIdentity[identityEmail]</span>
						</td>
					</tr>
				</table>
				<br>
				<table>
					<tr>
						<td>Nama Outlet</td>
						<td>: $outletDt[outletCode] - $outletDt[outletName]</td>
					</tr>
					<tr>
						<td>Jenis Laporan</td>
						<td>: Laba dan Proyeksi Kerugian</td>
					</tr>
					<tr>
						<td>Tahun</td>
						<td>: $yr</td>
					</tr>
				</table>
				<br>
				<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
					<tr>
						<th align='center' style='width: 35mm; padding: 5px; 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Nama Akun</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Jan</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Feb</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Mar</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Apr</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Mei</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Jun</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Jul</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Ags</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Sep</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Okt</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Nov</th>
						<th align='center' style='width: 21mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Des</th>
					</tr>
					<tr>
				    	<td style='font-size: 9pt;'><b>Pendapatan</b></td>
				    	<td colspan='2'></td>
				    </tr>
				    <tr>
				    	<td style='font-size: 9pt;'>Total Pendapatan (+ PPN)</td>
					";
					
						for ($i = 01; $i <= 12; $i++){
				
							if ($i < 10){
								$start = "0".$i;
							}
							else{
								$start = $i;
							}
							
							$year = $_GET['year']."-".$start;
							
							$queryProfit = "SELECT SUM(trxTotal) as trxTotal, SUM(trxTotalModal) as trxTotalModal FROM as_sales_transactions WHERE outletID = '$outletID' AND trxDate LIKE '$year%'";
							$sqlProfit = mysqli_query($connect, $queryProfit);
							$dtProfit = mysqli_fetch_array($sqlProfit);
							
							$grandTotalRp = rupiah($dtProfit['trxTotal']);
							
							$content .= "<td style='font-size: 9pt;' align='right'>$grandTotalRp</td>";
						}
					
					$content .= "
				    	</tr>
				    	<tr>
				    		<td style='font-size: 9pt;'>Piutang (-)</td>";
							for ($i = 01; $i <= 12; $i++){
				
								if ($i < 10){
									$start = "0".$i;
								}
								else{
									$start = $i;
								}
								
								$year = $_GET['year']."-".$start;
								
								$queryProfitTermin = "SELECT SUM(trxTotal) as trxTotal, SUM(trxPay) as trxPay FROM as_sales_transactions WHERE trxStatus = '3' AND outletID = '$outletID' AND trxDate LIKE '$year%'";
								$sqlProfitTermin = mysqli_query($connect, $queryProfitTermin);
								$dtProfitTermin = mysqli_fetch_array($sqlProfitTermin);
								
								$grandTotalTerminRp = rupiah($dtProfitTermin['trxTotal'] - $dtProfitTermin['trxPay']);
								
								$content .= "<td style='font-size: 9pt;' align='right'>$grandTotalTerminRp</td>";
							}
				    	$content .= "
				    	</tr>
				    	<tr>
				    		<td style='font-size: 9pt; text-align: right;'><b>Subtotal Rp.</b></td>";
				    		$grandTotalProfitRp = array();
							for ($i = 01; $i <= 12; $i++){
				
								if ($i < 10){
									$start = "0".$i;
								}
								else{
									$start = $i;
								}
								
								$year = $_GET['year']."-".$start;
								
								$queryProfit = "SELECT SUM(trxTotal) as trxTotal, SUM(trxSubtotal) as trxSubtotal, SUM(trxTotalModal) as trxTotalModal FROM as_sales_transactions WHERE outletID = '$outletID' AND trxDate LIKE '$year%'";
								$sqlProfit = mysqli_query($connect, $queryProfit);
								$dtProfit = mysqli_fetch_array($sqlProfit);
								
								$queryProfitTermin = "SELECT SUM(trxTotal) as trxTotal, SUM(trxPay) as trxPay FROM as_sales_transactions WHERE trxStatus = '3' AND outletID = '$outletID' AND trxDate LIKE '$year%'";
								$sqlProfitTermin = mysqli_query($connect, $queryProfitTermin);
								$dtProfitTermin = mysqli_fetch_array($sqlProfitTermin);
								
								$grandTotalProfitRp = rupiah($dtProfit['trxTotal'] - ($dtProfitTermin['trxTotal'] - $dtProfitTermin['trxPay']));
								
								$content .= "<td style='font-size: 9pt;' align='right'><b>$grandTotalProfitRp</b></td>";
							}
				    	$content .= "
				    	</tr>
				    	<tr>
					    	<td style='font-size: 9pt;'><br><b>Hutang - Piutang</b></td>
					    	<td colspan='2'></td>
					    </tr>
					    <tr>
					    	<td style='font-size: 9pt;'>Pembayaran Hutang</td>
						";
						
							for ($i = 01; $i <= 12; $i++){
					
								if ($i < 10){
									$start = "0".$i;
								}
								else{
									$start = $i;
								}
								
								$year = $_GET['year']."-".$start;
								
								$payQuery = "SELECT SUM(debtPay) as payTotal FROM as_debts_payment WHERE outletID = '$outletID' AND debtDate LIKE '$year%'";
								$paySql = mysqli_query($connect, $payQuery);
								$payData = mysqli_fetch_array($paySql);
								
								$grandMinHutang = rupiah($payData['payTotal']);
								
								$content .= "<td style='font-size: 9pt;' align='right'>$grandMinHutang</td>";
							}
						
						$content .= "
				    	</tr>
					    <tr>
					    	<td style='font-size: 9pt;'>Penerimaan Piutang</td>
						";
						
							for ($i = 01; $i <= 12; $i++){
					
								if ($i < 10){
									$start = "0".$i;
								}
								else{
									$start = $i;
								}
								
								$year = $_GET['year']."-".$start;
								
								$payQuery = "SELECT SUM(receivablePay) as payTotal FROM as_receivables_payment WHERE outletID = '$outletID' AND receivableDate LIKE '$year%'";
								$paySql = mysqli_query($connect, $payQuery);
								$payData = mysqli_fetch_array($paySql);
								
								$grandMinPiutang = rupiah($payData['payTotal']);
								
								$content .= "<td style='font-size: 9pt;' align='right'>$grandMinPiutang</td>";
							}
						
						$content .= "
				    	</tr>
				    	<tr>
					    	<td style='font-size: 9pt;'><br><b>Rabat</b></td>
					    	<td colspan='2'></td>
					    </tr>
					    <tr>
					    	<td style='font-size: 9pt;'>Total Rabat</td>
						";
						
							for ($i = 01; $i <= 12; $i++){
					
								if ($i < 10){
									$start = "0".$i;
								}
								else{
									$start = $i;
								}
								
								$year = $_GET['year']."-".$start;
								
								$queryProfit = "SELECT SUM(trxTotal) as trxTotal, SUM(trxSubtotal) as trxSubtotal, SUM(trxTotalModal) as trxTotalModal FROM as_sales_transactions WHERE outletID = '$outletID' AND trxDate LIKE '$year%'";
								$sqlProfit = mysqli_query($connect, $queryProfit);
								$dtProfit = mysqli_fetch_array($sqlProfit);
								
								$grandRabat = $dtProfit['trxSubtotal'] - $dtProfit['trxTotalModal'];
								
								$grandRabatRp = rupiah($grandRabat);
								$grandtotalProfit[] = $grandRabat;
								
								$content .= "<td style='font-size: 9pt;' align='right'>$grandRabatRp</td>";
							}
						
						$content .= "
				    	</tr>
				    	<tr>
				    		<td style='font-size: 9pt;'><br><b>Pengeluaran Biaya (-)</b></td>
				    		<td></td>
				    	</tr>";
				    	$queryAccount = "SELECT * FROM as_accounts WHERE outletID = '$outletID' AND accountStatus = 'Y' ORDER BY accountCode, accountName ASC";
						$sqlAccount = mysqli_query($connect, $queryAccount);
						
						// fetch data
						while ($dtAccount = mysqli_fetch_array($sqlAccount))
						{
							$content .= "<tr>
											<td style='font-size: 9pt;'>$dtAccount[accountName]</td>";
											
											$d = array();
											for ($i = 01; $i <= 12; $i++){
											
												if ($i < 10){
													$startAccount = $_GET['year']."-0".$i;
												}
												else{
													$startAccount = $_GET['year']."-".$i;
												}
												
												// showing up the funds
												$queryFund = "SELECT SUM(fundAmount) as fundAmount, fundID FROM as_funds WHERE outletID = '$outletID' AND accountID = '$dtAccount[accountID]' AND fundDate LIKE '$startAccount%'";
												$sqlFund = mysqli_query($connect, $queryFund);
												$dtFund = mysqli_fetch_array($sqlFund);
												$c = rupiah($dtFund['fundAmount']);
												$d[] = $dtFund['fundAmount'];
												
												$content .= "<td style='font-size: 9pt;' align='right'>$c</td>";
											}
											
									$content .=	"</tr>";
							$jan = $jan + $d[0];
							$feb = $feb + $d[1];
							$mar = $mar + $d[2];
							$apr = $apr + $d[3];
							$may = $may + $d[4];
							$jun = $jun + $d[5];
							$jul = $jul + $d[6];
							$aug = $aug + $d[7];
							$sep = $sep + $d[8];
							$oct = $oct + $d[9];
							$nov = $nov + $d[10];
							$dec = $dec + $d[11];
							
							// subtotal fund rp
							$janRp = rupiah($jan);
							$febRp = rupiah($feb);
							$marRp = rupiah($mar);
							$aprRp = rupiah($apr);
							$mayRp = rupiah($may);
							$junRp = rupiah($jun);
							$julRp = rupiah($jul);
							$augRp = rupiah($aug);
							$sepRp = rupiah($sep);
							$octRp = rupiah($oct);
							$novRp = rupiah($nov);
							$decRp = rupiah($dec);
							
							// count netto
							$totJan = rupiah($grandtotalProfit[0] - $jan);
							$totFeb = rupiah($grandtotalProfit[1] - $feb);
							$totMar = rupiah($grandtotalProfit[2] - $mar);
							$totApr = rupiah($grandtotalProfit[3] - $apr);
							$totMay = rupiah($grandtotalProfit[4] - $may);
							$totJun = rupiah($grandtotalProfit[5] - $jun);
							$totJul = rupiah($grandtotalProfit[6] - $jul);
							$totAug = rupiah($grandtotalProfit[7] - $aug);
							$totSep = rupiah($grandtotalProfit[8] - $sep);
							$totOct = rupiah($grandtotalProfit[9] - $oct);
							$totNov = rupiah($grandtotalProfit[10] - $nov);
							$totDec = rupiah($grandtotalProfit[11] - $dec);
				    	}
				    	$content .= "
				    	<tr>
				    		<td style='font-size: 9pt;' align='right'><b>Subtotal Rp.</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$janRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$febRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$marRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$aprRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$mayRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$junRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$julRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$augRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$sepRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$octRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$novRp</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$decRp</b></td>
				    	</tr>
				    	<tr>
				    		<td colspan='12'>&nbsp;</td>
				    	</tr>
				    	<tr valign='top'>
				    		<td style='font-size: 9pt;' align='right'><b>Netto Rp.<br>(Rabat - Biaya)</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totJan</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totFeb</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totMar</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totApr</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totMay</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totJun</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totJul</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totAug</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totSep</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totOct</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totNov</b></td>
				    		<td style='font-size: 9pt;' align='right'><b>$totDec</b></td>
				    	</tr>
					</table>
				
				";
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('L', 'A4','fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>