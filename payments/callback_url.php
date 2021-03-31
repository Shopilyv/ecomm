<?php
require '../database/db.php';

$stkCallbackResponse = file_get_contents('php://input');
$logFile = "push.json";
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);


$jdata=json_decode($stkCallbackResponse,true);
$ResultCode=$jdata['Body']['stkCallback']['ResultCode'];
$checkoutRequestID=$jdata['Body']['stkCallback']['CheckoutRequestID'];
if ($ResultCode==0) { 
$Amount = $jdata['Body']['stkCallback'] ['CallbackMetadata']['Item'][0]['Value'];
$MpesaReceiptNumber = $jdata['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
$TransactionDate = $jdata['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'];
$PhoneNumber = $jdata['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];   





 $sql = "INSERT INTO `payments_table` (`payment_id`,`Amount`,`MpesaReceipt`,`TransactionDate`,`PhoneNumber`,`CheckoutRequestID`)
            VALUES (NULL, '$Amount', '$MpesaReceiptNumber','$TransactionDate','$PhoneNumber','$checkoutRequestID');";
            $run_query = mysqli_query($con,$sql);
            
            if($run_query){
			echo "";
		}
}


else{
	echo "unsucessful";
} 