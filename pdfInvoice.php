<?php
require_once 'resources/session.php';
require_once 'resources/utilities.php';
require_once 'resources/pdf/fpdf.php';

$adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$RunQuery = new QueryControllers();
$item_id = $_POST['print_id'];
if (isset($_POST['print_id'])){
    $item_id = $_POST['print_id'];

    class myPDF extends FPDF{

        function header(){
            $adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            $date =  date('Y-m-d H:i:s');
            $print_date =  $u_date = @strftime("%b %d, %Y", @strtotime($date));
            $time = date('D, h:m A', strtotime($date));

            $Query = "SELECT client_info, order_info, p_method,balance FROM invoice WHERE in_id = ".$_POST['print_id']." ";
            $statement = $adb->prepare($Query);
            $statement->execute();

            if($data = $statement->fetch(PDO::FETCH_OBJ)){
                if ($data->p_method == 1){
                    $method = 'Cash';
                }elseif ($data->p_method == 2){
                    $method = 'Check';
                }elseif ($data->p_method == 3){
                    $method = 'Credit';
                }



                $client_info = $data->client_info;
                $order_info = $data->order_info;

                /**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
                $clientData = stripcslashes($client_info);
                $json_clientObject = json_decode($clientData);

                /**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
                $orderData = stripcslashes($order_info);
                $json_orderObject = json_decode($orderData);

                /**Formatting the order date, day and time */
                $date = strftime("%b %d, %Y", strtotime($json_orderObject->order_date));
                $order_time = date('D, h:m A', strtotime($json_orderObject->order_date));


                if ($data->balance == 0){
                    $status = 'Validated';
                }else{
                    $status = 'Pending';

                }



            $this->image('resources/pdf/logo.png',10,6);
            $this->Ln(5);
            $this->SetFont('Times','',12);
            $this->Cell(100,5,'EMS Pvt ltd',0,0,'L');
            $this->Ln();
            $this->Cell(100,5,'2886 Douala, Bonabery, +237-00-00-00-00',0,0,'L');
            $this->Ln();
            $this->Cell(100,5,'admin@gmail.com',0,0,'L');
            $this->Ln();
            $this->Cell(100,5,'+237-00-00-00-00',0,0,'L');
            $this->Ln();
            $this->Cell(176,-50,'Date Printed:'." ".$print_date,0,0,"R");
            $this->Ln(5);
            $this->Cell(180,-50,'Time Printed:'." ".$time,0,0,"R");

            $this->Ln(5);


            $this->SetFont('Times','B',12);
            $this->Cell(100,5,'Client Information',0,0,'L');
            $this->SetFont('Times','',12);
            $this->Ln();
            $this->Cell(100,5,'Name:'." ".$json_clientObject->c_name,0,0,'L');
            $this->Ln();
            $this->Cell(100,5,'Address:'." ".$json_clientObject->c_address,0,0,'L');
            $this->Ln();
            $this->Cell(100,5,'Contact:'." ".$json_clientObject->c_number,0,0,'L');
            $this->Ln();
            $this->Cell(100,5,'Email:'." ".$json_clientObject->c_email,0,0,'L');
            $this->Ln();

            $this->SetFont('Times','B',12);
            $this->Cell(130,-45,'Order Information',0,0,'C');
            $this->SetFont('Times','',12);
            $this->Ln();
            $this->Cell(130,55,'Date:'." ".$date,0,0,'C');
            $this->Ln();
            $this->Cell(135,-45,'Time:'." ".$order_time,0,0,'C');
            $this->Ln();
            $this->Cell(125,55,'Status:'." ".$status,0,0,'C');
            $this->Ln();
            $this->Cell(120,-45,'Id:'." ".$json_orderObject->order_id,0,0,'C');
            $this->Ln();

            $this->Cell(178,5,'Invoice Number:'." ".$json_orderObject->invoice_number,0,0,'R');
            $this->Ln();
            $this->Cell(165,5,'Payment Method:'." ".$method,0,0,'R');


            $this->Ln(30);
            }
     }

        function footer(){
            $this->SetY(-15);
            $this->SetFont('Arial','',8);
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }

        function headerTable(){
            $this->SetFont('Times','B',12);
            $this->Cell(8,8,'#No',1,0,'C');
            $this->Cell(40,8,'Item Name',1,0,'C');
            $this->Cell(50,8,'Description',1,0,'C');
            $this->Cell(8,8,'Qty',1,0,'C');
            $this->Cell(30,8,'C.P',1,0,'C');
            $this->Cell(30,8,'U.P',1,0,'C');
            $this->Cell(30,8,'Total',1,0,'C');

            $this->Ln();
        }

        function makeAgo($timestamp){
            date_default_timezone_set('Africa/Douala');
            $difference = time()-$timestamp;
            $periods = ["Second","Minute","Hour","Day","Week","Month","Year","Decade"];
            $lengths = ["60","60","24","7","4","35","12","10"];
            for($i = 0;
                $difference >= $lengths[$i]; $i++)
                $difference /= $lengths[$i];
            $difference = round($difference);
            if ($difference != 1) $periods[$i] .= "s";
            $output = "$difference $periods[$i]";
            return $output." ago";

        }


        function convert_datetime($str){
            date_default_timezone_set('Africa/Douala');
            list($date,$time) = explode(' ',$str);
            list($year,$month,$day) = explode('-',$date);
            list($hours,$minute,$seconds) = explode(':',$time);
            $timestamp = mktime($hours,$minute,$seconds,$month,$day,$year);
            return $timestamp;

        }

        function viewTable($adb,$item_id){

            $this->SetFont('Times','',12);
            $Query = "SELECT * FROM invoice".
                " INNER JOIN users as u USING(users_id) WHERE in_id = $item_id";
            $statement = $adb->prepare($Query);
            $statement->execute();
            if($data = $statement->fetch(PDO::FETCH_OBJ)){
                $number = 1;

                $auth_name = $data->names;
                $total = $data->total;
                $paid = $total - $data->balance;
                $balance = $data->balance;
                $details= $data->in_details;
                /**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
                $detailsData = stripcslashes($details);
                $json_detailsObject = json_decode($detailsData);

                foreach ($json_detailsObject as $name => $items) {

                    $this->Cell(8,6,$number++,1,0,'C');
                    $this->Cell(40,6,$items->Item_name,1,0,'L');
                    $this->Cell(50,6,$items->Description,1,0,'L');
                    $this->Cell(8,6,$items->Quantity,1,0,'C');
                    $this->Cell(30,6,@number_format($items->Cogs),1,0,'L');
                    $this->Cell(30,6,@number_format($items->Unit_Price),1,0,'L');
                    $this->Cell(30,6,@number_format($items->Total),1,0,'L');

                    $this->Ln();
                }
                $this->Ln();

                $this->Cell(180,10,"Sub Total:"." ".number_format($total)." FCFA",0,0,"R");
                $this->Ln(5);
                $this->Cell(171,10,"Paid:"." ".number_format($paid)." FCFA",0,0,"R");
                $this->Ln(5);
                $this->Cell(168,10,"Balance:"." ".number_format($balance)." FCFA",0,0,"R");
                $this->Ln(5);
                $this->Cell(173,10,"Total:"." ".number_format($total)." FCFA",0,0,"R");

                $this->Ln();



            }

            $this->Cell(180,10,"Authorized By:"." ".$auth_name."",0,0,"C");
            $this->Ln();
            $this->Cell(180,10,"Printed By:"." ".$_SESSION['ems_username'],0,0,"C");
            $this->Ln();
            $this->Cell(180,10,"Signature",0,0,"R");

            $this->Ln();
            $this->SetFont('Times','B',12);
            $this->Cell(100,5,'Terms and Conditions:',0,0,'L');
            $this->SetFont('Times','',12);
            $this->Ln();
            $this->MultiCell(180,5,"*********************************************************************************************************************************************************************************************",0,'L',false);

        }

    }


$update_time =  date('Y-m-d H:i:s');
$Update = "UPDATE invoice SET print=:print, date_printed=:date_printed WHERE in_id=:in_id";
$statement = $adb->prepare($Update);
$statement->execute(array(':print' => 1, ':date_printed' => $update_time, ':in_id' => $item_id));

if ($statement->rowCount() > 0){
    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('P','A4',0);
    $pdf->headerTable();
    $pdf->viewTable($adb,$item_id);
    $Query = "SELECT client_info, order_info, p_method,balance FROM invoice WHERE in_id = $item_id";
    $statement = $adb->prepare($Query);
    $statement->execute();
    if($data = $statement->fetch(PDO::FETCH_OBJ)){
        $client_info = $data->client_info;
        /**Decoding  the JSON data for PHP access as Objects and removing unwanted strings */
        $clientData = stripcslashes($client_info);
        $json_clientObject = json_decode($clientData);
        $pdf->Output("",$json_clientObject->c_name.".pdf","D");
       // $pdf->Output("../Invoice_pdf/",$json_clientObject->c_name.".pdf","F");
    }
    $pdf->Output();

}else{
    echo 2;
}

}else{
echo 1;
$RunQuery->signOut();
}


