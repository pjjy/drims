<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$this->load->model('drimsmodel'); //drimsmodel
$data = $this->drimsmodel->pdf_gata_data_mod($_GET['rosit'], $_GET['drmd_id']); //drimsmodel to pull all data

$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$pdf->SetTitle('title');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');

$pdf->AddPage('P', 'A4');
// $pdf->Cell(0, 0, 'REQUISITION AND ISSUANCE SLIP RIS', 1, 1, 'C');

$html = '
    <table border="1" cellspacing="0" cellpadding="4" style="width:100%">
    
    <tr>
        <th style="width:25%; border-right-color:#ffffff;"><img src="assets/images/dswd_logo_new.jpg" height="30" width="110"></th>
        <th style="width:40%; border-left-color:#ffffff;"><img src="assets/images/DSWD-FO7-INSIGNIA.jpg" height="35" width="110"></th>
        <th style="width:35%; border-left-color:#ffffff; font-size:85% ;text-align:center;"><p><small>DISASTER RESPONSE AND MANAGEMENT DIVISION FIELD OFFICE VII</small></p></th>
    </tr>
    

    <tr>
        <th style="width:100% ;text-align:right;"><small>DRN: '.$_GET['drn'].'</small></th>
    </tr>

    <tr>
    
        <th>'.$data['field_office'].'-'.substr($data['provDesc'],0,3).'-'.$data['ris_no'].'</th>
    </tr>

    <tr>
        <th style="width:100% "><h4 style="text-align:center;">REQUISITION AND ISSUANCE SLIP (RIS)</h4></th>
    </tr>
    <tr>
        <th style="width:17%"><small><b>Office / Bureau:</b></small></th>
        <th style="width:33%"><small>Negros Oriental Warehouse</small></th>
        <th style="width:25%"><small><b>Fund Cluster:</b></small></th>
        <th><small></small></th>
    </tr>
    <tr>
        <th style="width:17%"><small><b>Division:</b></small></th>
        <th style="width:33%"><small>DRMD</small></th>
        <th style="width:25%"><small><b>Responsibility Center Code:</b></small></th>
        <th><small></small></th>
    </tr>
    <tr>
        <th style="width:17%"><small><b>Addess:</b></small></th>
        <th style="width:33%"><small>One Rescue Compund Brgy. Tabuc-Tubig, Dumaguete, Negros Oriental</small></th>
        <th style="width:50%"><small><b>RIS No.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data['field_office'].'-'.substr($data['provDesc'],0,3).'-'.$data['ris_no'].'</small></b></th>
    </tr>
    <tr>
        <th style="width:50% ; font-size:17px ; text-align:center ; background-color:#f2f4ff;"><i><b><small>Requisition</small>  </b></i></th>
        <th style="width:50% ; font-size:17px ; text-align:center ; background-color:#f2f4ff;"><i><b><small>Stocks Available?</small>  </b></i></th>
    </tr>

    <tr>
        <th style="width:8.5% ;text-align:center; background-color:#f2f4ff;"><small><b>Stock No.</b></small></th>
        <th style="width:8.5% ;text-align:center; background-color:#f2f4ff;"><small><b>Unit</b></small></th>
        <th style="width:24.5% ;text-align:center; background-color:#f2f4ff;"><small><b>Description</b></small></th>
        <th style="width:8.5% ;text-align:center; background-color:#f2f4ff;"><small><b>Quantity</b></small></th>
        <th style="width:8.5% ;text-align:center; background-color:#f2f4ff;"><small><b>Yes</b></small></th>
        <th style="width:8.5% ;text-align:center; background-color:#f2f4ff;"><small><b>No</b></small></th>
        <th style="width:8.5% ;text-align:center; background-color:#f2f4ff;"><small><b>Quantity</b></small></th>
        <th style="width:24.5% ;text-align:center; background-color:#f2f4ff;"><small><b>Remarks</b></small></th>
    </tr>
    
    <tr>
        <th style="width:8.5% ;text-align:center;"><small><b>WGF-025</b></small></th>
        <th style="width:8.5% ;text-align:center;"><small><b>Packs</b></small></th>
        <th style="width:24.5% ;text-align:center;"><small><b>FAMILY FOOD PACKS</b></small></th>
        <th style="width:8.5% ;text-align:center;"><small><b>598</b></small></th>
        <th style="width:8.5% ;text-align:center;"><img src="assets/images/checkbox.png" height="15" width="15"></th>
        <th style="width:8.5% ;text-align:center;"><small><b></b></small></th>
        <th style="width:8.5% ;text-align:center;"><small><b></b></small></th>
        <th style="width:24.5% ;text-align:center;"><small><b></b></small></th>
    </tr>

    <tr>
        <th style="width:8.5% ;text-align:center;"><small><b></b></small></th>
        <th style="width:8.5% ;text-align:center;"><small><b></b></small></th>
        <th style="width:24.5% ;text-align:center;"><small>(6 Kilos Rice, 4 tins canned meat, 2 tins sardines, 4 tins canned tuna, 5 sachets coffee and 5 sachets powdered cereal milk)</small></th>
        <th style="width:8.5% ;text-align:center;"></th>
        <th style="width:8.5% ;text-align:center;"></th>
        <th style="width:8.5% ;text-align:center;"></th>
        <th style="width:8.5% ;text-align:center; "></th>
        <th style="width:24.5% ;text-align:center; "></th>
    </tr>

    <tr>
        <th style="width:8.5% ;text-align:center;"></th>
        <th style="width:8.5% ;text-align:center;"></th>
        <th style="width:24.5% ;text-align:center;"><small><b>*****NOTHING FOLLOWS*****</b></small></th>
        <th style="width:8.5% ;text-align:center;"></th>
        <th style="width:8.5% ;text-align:center;"></th>
        <th style="width:8.5% ;text-align:center;"></th>
        <th style="width:8.5% ;text-align:center;"></th>
        <th style="width:24.5% ;text-align:center;"></th>
    </tr>


    <tr>
        <th style="width:17% ;text-align:left;"><small><b>Delivery Site:</b></small></th>
        <th style="width:33% ;text-align:left;"><small>Vallehermoso, Negros Oriental</small></th>
        <th style="width:50% ;text-align:center;"><small><b>Returned / Cancelled Items:</b></small></th>
    </tr>

    <tr>
        <th style="width:17% ;text-align:left;"><small><b>Delivery Date:</b></small></th>
        <th style="width:33% ;text-align:center;"><small></small></th>
        <th style="width:10% ;text-align:center;"><small><b>Date</b></small></th>
        <th style="width:17% ;text-align:center;"><small><b>Paticular</b></small></th>
        <th style="width:10% ;text-align:center;"><small><b>Quantity</b></small></th>
        <th style="width:13% ;text-align:center;"><small><b>Certified by:</b></small></th>
    </tr>
    
    <tr>
        <th style="width:17% ;text-align:left;"><small><b>Contact Person:</b></small></th>
        <th style="width:33% ;text-align:left;"><small>'.$_GET['contactperson'].'</small></th>
        <th style="width:10% ;text-align:center;"><small><b></b></small></th>
        <th style="width:17% ;text-align:center;"><small><b></b></small></th>
        <th style="width:10% ;text-align:center;"><small><b></b></small></th>
        <th style="width:13% ;text-align:center;"><small><b></b></small></th>
    </tr>

    <tr>
        <th style="width:17% ; text-align:left;"><small><b>Contact Number:</b></small></th>
        <th style="width:33% ; text-align:left;"><small>'.$_GET['contactnumber'].'</small></th>
        <th style="width:50% ; text-align:center;"><small><b>Remarks</b></small></th>
    </tr>

    <tr>
        <th style="width:17% ; text-align:left;"><small><b>Purpose:</b></small></th>
        <th style="width:33% ; text-align:left;"><small>'.$_GET['purpose'].'</small></th>
        <th style="width:50% ; height:40px; text-align:center;"><small><b></b></small></th>
    </tr>

    <tr>
        <th style="width:17% ; text-align:center;"><small><b></b></small></th>
        <th style="width:20% ; text-align:center;"><small><b>Requested by:</b></small></th>
        <th style="width:25% ; text-align:center;"><small><b>Approved by</b></small></th>
        <th style="width:20% ; text-align:center;"><small><b>Issued by:</b></small></th>
        <th style="width:18% ; text-align:center;"><small><b>Received by:</b></small></th>
    </tr>

    <tr>
        <th style="width:17% ; vertical-align:bottom; text-align:left;"><small><b>Signature:</b></small></th>
        <th style="width:20% ; text-align:center;"></th>
        <th style="width:25% ; text-align:center;"></th>
        <th style="width:20% ; text-align:center;"></th>
        <th style="width:18% ; height:40px; text-align:center;"></th>
    </tr>

    <tr>
        <th style="width:17% ; text-align:left;"><small><b>Printed Name:</b></small></th>
        <th style="width:20% ; text-align:center;"><small><b>LILIBETH A. CABIARA</b></small></th>
        <th style="width:25% ; text-align:center;"><small><b>SHALAINE MARIE S. LUCERO</b></small></th>
        <th style="width:20% ; text-align:center;"><small><b>AIMEE FEI V. BINONGO</b></small></th>
       
    </tr>

    <tr>
        <th style="width:17% ; text-align:left;"><small><b>Designation:</b></small></th>
        <th style="width:20% ; text-align:center;"><small>SWO IV/DRMD Chief</small></th>
        <th style="width:25% ; text-align:center;"><small>OIC-Regional Director</small></th>
        <th style="width:20% ; text-align:center;"><small>AO/RROS Head</small></th>
    </tr>

    <tr>
        <th style="width:17% ; text-align:left;"><small><b>Date:</b></small></th>
        <th style="width:20% ; text-align:center;"></th>
        <th style="width:25% ; text-align:center;"></th>
        <th style="width:20% ; text-align:center;"></th>
</tr>



</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('ris_report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+