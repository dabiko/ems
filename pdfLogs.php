<?php
require_once 'resources/session.php';
require_once 'resources/utilities.php';
require_once 'resources/pdf/fpdf.php';

$adb = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

class myPDF extends FPDF{

    function header(){
        $this->image('resources/pdf/logo.png',10,6);
        $this->SetFont('Arial','B',14);
        $this->Cell(200,5,'SYSTEM LOGS',0,0,'C');
        $this->Ln(5);
        $this->SetFont('Times','',12);
        $this->Cell(200,10,'Equipment Management System - EMS',0,0,'C');
        $this->Ln(5);
        $this->Cell(200,10,'2886 Douala, Bonabery',0,0,'C');
        $this->Ln(20);
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(10,8,'#No',1,0,'C');
        $this->Cell(30,8,'Admin User',1,0,'C');
        $this->Cell(30,8,'Active Hours',1,0,'C');
        $this->Cell(60,8,'LogIn Time',1,0,'C');
        $this->Cell(60,8,'LogOut Time',1,0,'C');

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

    function viewTable($adb){
        $number = 1;
        $this->SetFont('Times','',12);
        $Query = "SELECT * FROM users_logs".
            " INNER JOIN users As u USING(users_id) ORDER BY names ASC";
        $statement = $adb->prepare($Query);
        $statement->execute();
        while($data = $statement->fetch(PDO::FETCH_OBJ)){
            $pdf = new myPDF();

            $active = $data->log_status;
            $loginTime = $data->login_time;
            $logOutTime = $data->logout_time;

            /** implementing the Ago time*/
            $date = $active;
            $posted_at = $date;
            $unit_timestamp = $pdf->convert_datetime($posted_at);
            $ago_active = $pdf->makeAgo($unit_timestamp);

            $update = $loginTime;
            $update_at = $update;
            $unitTimestamp = $pdf->convert_datetime($update_at);
            $login_Ago = $pdf->makeAgo($unitTimestamp);

            $logOut = $logOutTime;
            $update_at = $logOut;
            $unitTimestamp = $pdf->convert_datetime($update_at);
            $logOut_Ago = $pdf->makeAgo($unitTimestamp);


            /** Formatting the join date and today's date */
            $active_date = @strftime("%b %d, %Y", @strtotime($active));
            $logIn_date = @strftime("%b %d, %Y", @strtotime($loginTime));
            $logOut_date = @strftime("%b %d, %Y", @strtotime($logOutTime));


            $this->Cell(10,6,$number++,1,0,'C');
            $this->Cell(30,6,$data->names,1,0,'C');
            $this->Cell(30,6,$active_date,1,0,'L');
            $this->Cell(60,6,$logIn_date ,1,0,'C');
            $this->Cell(60,6,$logOut_date ,1,0,'C');
            $this->Ln();



        }

        $this->Cell(180,10,"Access By: Administrator",0,0,"C");

        $this->Ln();

        $this->Cell(180,10,"Signature",0,0,"R");


    }

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable($adb);
$pdf->Output("","EMS_system_logs.pdf","I");
$pdf->Output();

