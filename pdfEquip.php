<?php
require_once 'resources/session.php';
require_once 'resources/utilities.php';
require_once 'resources/pdf/fpdf.php';

$adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

class myPDF extends FPDF{

    function header(){
        $this->image('resources/pdf/logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'EQUIPMENTS/ITEMS',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','',12);
        $this->Cell(276,10,'Equipment Management System - EMS',0,0,'C');
        $this->Ln(5);
        $this->Cell(276,10,'2886 Douala, Bonabery',0,0,'C');
        $this->Ln(20);
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function headerTable1(){
        $this->SetFont('Times','B',12);
        $this->setFillColor(153, 153, 204);
        $this->Cell(10,10,'#No',1,0,'C');
        $this->Cell(45,10,'Item',1,0,'C');
        $this->Cell(60,10,'Description',1,0,'C');
        $this->Cell(40,10,'Main Category',1,0,'C');
        $this->Cell(40,10,'Sub Category',1,0,'C');
        $this->Cell(40,10,'Manufacturer',1,0,'C');
        $this->Cell(40,10,'Model',1,0,'C');

        $this->Ln();
    }


    function headerTable2(){
        $this->SetFont('Times','B',12);
        $this->Cell(10,10,'#No',1,0,'C');
        $this->Cell(45,10,'Item',1,0,'C');
        $this->Cell(60,10,'Code',1,0,'C');
        $this->Cell(40,10,'Quantity',1,0,'C');
        $this->Cell(40,10,'C.O.Gs',1,0,'C');
        $this->Cell(40,10,'Total C.O.Gs',1,0,'C');
        $this->Cell(40,10,'Unit Price',1,0,'C');

        $this->Ln();
    }

    function headerTable3(){
        $this->SetFont('Times','B',12);
        $this->Cell(10,10,'#No',1,0,'C');
        $this->Cell(45,10,'Item',1,0,'C');
        $this->Cell(60,10,'Date Added',1,0,'C');
        $this->Cell(80,10,'Date Updated',1,0,'C');

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

    function viewTable1($adb){
        $number = 1;
        $this->SetFont('Times','',12);

        $SelectData = "SELECT * FROM equipments".
                      " LEFT JOIN main_category AS ma USING(main_id)".
                      " LEFT JOIN sub_category AS su USING(sub_id) ORDER BY e_id DESC";
        $statement = $adb->prepare($SelectData);
        $statement->execute();
        while($data = $statement->fetch(PDO::FETCH_OBJ)){


            $this->Cell(10,10,$number++,1,0,'C');
            $this->Cell(45,10,$data->e_name,1,0,'L');
            $this->Cell(60,10,$data->des,1,0,'L');
            $this->Cell(40,10,$data->main_cat,1,0,'L');
            $this->Cell(40,10,$data->sub_cat,1,0,'L');
            $this->Cell(40,10,$data->e_manu,1,0,'L');
            $this->Cell(40,10,$data->e_model,1,0,'C');

            $this->Ln();



        }

        $this->Cell(150,10,"Access By: Administrator",0,0,"C");

        $this->Ln();

        $this->Cell(180,10,"Signature",0,0,"R");

        $this->Ln();

    }


    function viewTable2($adb){
        $number = 1;
        $this->SetFont('Times','',12);

        $SelectData = "SELECT * FROM equipments".
            " LEFT JOIN main_category AS ma USING(main_id)".
            " LEFT JOIN sub_category AS su USING(sub_id) ORDER BY e_id DESC";
        $statement = $adb->prepare($SelectData);
        $statement->execute();
        while($data = $statement->fetch(PDO::FETCH_OBJ)){


            $this->Cell(10,10,$number++,1,0,'C');
            $this->Cell(45,10,$data->e_name,1,0,'L');
            $this->Cell(60,10,$data->e_code,1,0,'C');
            $this->Cell(40,10,$data->qty,1,0,'C');
            $this->Cell(40,10,@number_format($data->cogs)." FCFA",1,0,'L');
            $this->Cell(40,10,@number_format($data->cogs * $data->qty)." FCFA",1,0,'L');
            $this->Cell(40,10,@number_format($data->u_price)." FCFA",1,0,'L');

            $this->Ln();



        }

        $this->Cell(150,10,"Access By: Administrator",0,0,"C");

        $this->Ln();

        $this->Cell(180,10,"Signature",0,0,"R");

        $this->Ln();
    }



    function viewTable3($adb){
        $number = 1;
        $this->SetFont('Times','',12);

        $SelectData = "SELECT * FROM equipments".
            " LEFT JOIN main_category AS ma USING(main_id)".
            " LEFT JOIN sub_category AS su USING(sub_id) ORDER BY e_id DESC";
        $statement = $adb->prepare($SelectData);
        $statement->execute();
        while($data = $statement->fetch(PDO::FETCH_OBJ)){
            $pdf = new myPDF();
            $date_added = $data->add_date;
            $date_updated = $data->updated;

            /** implementing the Ago time*/
            $date = $date_added;
            $posted_at = $date;
            $unit_timestamp = $pdf->convert_datetime($posted_at);
            $ago = $pdf->makeAgo($unit_timestamp);

            $update = $date_updated;
            $update_at = $update;
            $unitTimestamp = $pdf->convert_datetime($update_at);
            $update_Ago = $pdf->makeAgo($unitTimestamp);


            /** Formatting the join date and today's date */
            $add_date = @strftime("%b %d, %Y", @strtotime($date_added));
            $u_date = @strftime("%b %d, %Y", @strtotime($date_updated));


            $this->Cell(10,10,$number++,1,0,'C');
            $this->Cell(45,10,$data->e_name,1,0,'L');
            $this->Cell(60,10,$add_date. " (".$ago.")" ,1,0,'C');
            $this->Cell(80,10,$u_date. " (".$update_Ago.")",1,0,'C');

            $this->Ln();



        }

        $this->Cell(150,10,"Access By: Administrator",0,0,"C");

        $this->Ln();

        $this->Cell(180,10,"Signature",0,0,"R");

        $this->Ln();
    }

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable1();
$pdf->viewTable1($adb);
$pdf->headerTable2();
$pdf->viewTable2($adb);
$pdf->headerTable3();
$pdf->viewTable3($adb);
$pdf->Output("","EMS_items.pdf","D");
$pdf->Output();

