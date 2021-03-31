<?php

include 'db.php';
include 'data.php';
//$phone_number = '0715752697';
$phone_number=filter_input(INPUT_POST,'phone_number');
//0780493462
/*$sql = "SELECT * FROM orders WHERE orders.customer_phone='$phone_number' ORDER BY orders.id DESC LIMIT 50" ;*/
$sql="SELECT * FROM orders WHERE orders.customer_phone='$phone_number' ORDER BY orders.id DESC LIMIT 50";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$receipts = array();
$deliveries=array();

$url = "https://queensclassycollections.com/express.queensclassy.com/userfiles/receipts/";

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $order_id=$row['id'];
        $bill_no=$row['bill_no'];
        $cancelled=$row['cancel_order'];
        $date_ordered=$row['date_time']; 
        $order_date=date('Y/m/d h:i a',$date_ordered);
        $customer_name=$row['customer_name'];
        $customer_address=$row['customer_address'];
        $customer_phone=$row['customer_phone'];
        $assigned_status=$row['assigned'];
        $order_status='NOT ASSIGNED';
        $riders_name='';
        $riders_contacts='';
        $receipt='';
        
       
        if($assigned_status==1){
            $order_status='NOT DELIVERED';
           $sql1="SELECT parcel.id as parcelid,parcel.receipt,users.username,users.phone FROM parcel INNER JOIN users ON (parcel.rider_id=users.id) WHERE bill_id='$order_id'" ;
           $result1=mysqli_query($conn,$sql1);
           if(mysqli_num_rows($result1) > 0){
               while($row1=mysqli_fetch_array($result1)){
                  $riders_name=$row1['username'];
                  $riders_contacts=$row1['phone'];
                  $extensions=array("jpg","png","gif");
                  $order_status='RECEIPT NOT SENT';
                  $receipt_url='https://shop.shopilyv.com/assets/images/product_image/empty.jpg';
                  $receipt=$row1['receipt'];
                  $receipt_explode=explode(".",$receipt);
                  $re=$receipt_explode[1];
                  if(in_array($re,$extensions)){
                      $receipt_url=$url.$receipt;
                      $order_status="RECEIPT SENT";
                  }
                  
                  $receipts[] = array(
      
            'id' => $row1['parcelid'],
            'order' => $row['bill_no'],
            'receipt' => $receipt_url,
            'receipt_name'=>$row1['receipt'],
            'customer' =>$row['customer_name'],
            'Address' => $row['customer_address'],
            'phone' =>$row['customer_phone'],
            'rider' =>$row1['username'],
            'order_status'=>$order_status
        );
        
               }
               
               echo json_encode(['Receipts' => $receipts]);
           }
           else{
            /*$sql2="SELECT deliveries.id as delid,users.username ,users.phone,deliveries.date_time as deldate,deliveries.status,deliveries.reasons FROM deliveries INNER JOIN users ON (parcel.rider_id=users.id) WHERE bill_id='$order_id'";*/
            $sql2="SELECT deliveries.id as delid,users.username ,users.phone,deliveries.date_time as deldate,deliveries.status,deliveries.reasons,
deliveries.bill_id FROM deliveries INNER JOIN users ON (deliveries.rider_id=users.id) where deliveries.bill_id='14'";
            $result2=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result2) > 0){
               while($row2=mysqli_fetch_array($result2)){
                   $delid=$row2['delid'];
                  $riders_name=$row2['username'];
                  $riders_contacts=$row2['phone'];
                   $del_status=$row2['status'];
                   $reasons=$row2['reasons'];
                   
                   if($del_status=='1' && is_null($reasons)){
                       $order_status='Delivered';
                   }
                   
                   elseif($del_status=='1' && !is_null($reasons)){
                       $order_status='Some items returned';
                   }
                   
                   $deliveries[]=array(
            'id' => $row2['delid'],
            'status'=>$order_status,
            'deldate' => $row2['deldate'],
            'reasons'=>$row2['reasons'],
            'phone' =>$row2['phone'],
            'rider' =>$row2['username'],
                       );
               }
               
               echo json_encode(['Deliveries' => $deliveries]);
           }
           }
           
        }
        if(!is_null($cancelled)){
            $order_status='CANCELLED';
        }
        /*$receipts[] = array(
      
           'id' => $row['parcelid'],
            'order' => $row['bill_no'],
            'receipt' => $url.$row1['receipt'],
            'receipt_name'=>$row1['receipt'],
            'customer' =>$row['customer_name'],
            'Address' => $row['customer_address'],
             'phone' =>$row['customer_phone'],
              'rider' =>$row['username'],
        );*/
    }
    /*if(!empty($receipts)) echo json_encode(['Receipts' => $receipts]);
    else echo '404';*/
} else {
    die('404');
}
  ?>
           