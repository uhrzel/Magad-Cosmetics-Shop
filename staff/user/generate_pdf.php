<?php
require_once('./../../config.php');
require './../../vendor/autoload.php';

use setasign\Fpdi\Tcpdf\Fpdi;

if (isset($_POST['id'])) {
  $user = $conn->query("SELECT * FROM users WHERE id = " . $_POST['id'])->fetch_assoc();
  /* 

  $userproduction = $conn->query("SELECT * FROM production_harvesting  WHERE user_id = " . $_POST['id'])->fetch_assoc();
 */


  if ($user) {
    // Create a new PDF instance
    $pdf = new Fpdi();

    $pdf->AddPage();
    $pdf->setSourceFile('pdf-layout/f1-finalform.pdf');
    $template = $pdf->importPage(1);
    $pdf->useTemplate($template);

    $pdf->SetFont('Helvetica', '', 12);

    // done
    $pdf->SetXY(70, 53);
    $pdf->Write(0, $user['farm_name']);

    // done
    $pdf->SetXY(70, 63);
    $pdf->Write(0, $user['firstname'] . ' ' . $user['lastname']);


    $pdf->SetFont(
      'Helvetica',
      '',
      10
    );

    $pdf->SetXY(88, 74);
    $pdf->Write(0, $user['mobile_number']);


    $pdf->SetXY(144, 74);
    $pdf->Write(0, $user['email_address']);

    $pdf->SetXY(25, 89);
    $pdf->Write(0, $user['hectarage_farm_size']);


    $pdf->SetXY(53, 89);
    $pdf->Write(0, $user['street']);

    $pdf->SetXY(87, 89);
    $pdf->Write(0, $user['barangay']);

    $pdf->SetXY(125, 89);
    $pdf->Write(0, $user['city']);


    $pdf->SetXY(160, 89);
    $pdf->Write(0, $user['province']);


    //2
    $pdf->SetXY(25, 96.5);
    $pdf->Write(0, $user['hectarage_farm_size2']);


    $pdf->SetXY(53, 96.5);
    $pdf->Write(0, $user['street2']);


    $pdf->SetXY(87, 96.5);
    $pdf->Write(0, $user['barangay2']);

    $pdf->SetXY(125, 96.5);
    $pdf->Write(0, $user['city2']);


    $pdf->SetXY(160, 96.5);
    $pdf->Write(0, $user['province2']);

    //3

    $pdf->SetXY(25, 103);
    $pdf->Write(0, $user['hectarage_farm_size3']);

    $pdf->SetXY(53, 103);
    $pdf->Write(0, $user['street3']);


    $pdf->SetXY(87, 103);
    $pdf->Write(0, $user['barangay3']);

    $pdf->SetXY(125, 103);
    $pdf->Write(0, $user['city3']);


    $pdf->SetXY(160, 103);
    $pdf->Write(0, $user['province3']);


    //proodution and harvesting
    /*     $pdf->SetXY(25, 120);
    $pdf->Write(0, $userproduction['crops']); */

    $pdf->SetXY(18, 127);
    $pdf->Write(0, $user['crop']);

    $pdf->SetXY(60, 127);
    $pdf->Write(0, $user['variety']);

    $pdf->SetXY(94, 127);
    $pdf->Write(0, $user['hectarage_crop']);

    $pdf->SetXY(127, 127);
    $pdf->Write(0, $user['harvest']);

    $pdf->SetXY(166, 127);
    $pdf->Write(0, $user['purpose']);

    $current_date = date('F d, Y');

    $pdf->SetXY(135, 253);
    $pdf->Write(0, $current_date);


    $application_types = json_decode($user['type_application'], true);
    if (!is_array($application_types)) {
      $application_types = [$application_types];
    }
    $required_documents = json_decode($user['required_documents'], true);
    if (!is_array($required_documents)) {
      $required_documents = [$required_documents];
    }
    $additional_documents = json_decode($user['additional_documents'], true);
    if (!is_array($additional_documents)) {
      $additional_documents = [$additional_documents];
    }



    $pdf->SetFont(
      'Helvetica',
      '',
      20
    );

    if (in_array('New', $application_types)) {

      $pdf->SetXY(69.5, 40);
      $pdf->Write(0, '.');
    }

    if (in_array('Renewal', $application_types)) {

      $pdf->SetXY(88.5, 40);
      $pdf->Write(0, '.');
    }

    if (in_array('Farm or organization profile', $required_documents)) {
      $pdf->SetXY(14, 162);
      $pdf->Write(0, '.');
    }
    if (in_array(
      'Farm map',
      $required_documents
    )) {
      $pdf->SetXY(14, 165);
      $pdf->Write(0, '.');
    }


    if (in_array(
      'Farm layout',
      $required_documents
    )) {
      $pdf->SetXY(14, 169);
      $pdf->Write(0, '.');
    }
    if (in_array(
      'Field operation Procedures',
      $required_documents
    )) {
      $pdf->SetXY(14, 173);
      $pdf->Write(0, '.');
    }


    if (in_array(
      'Production and Harvesting Records',
      $required_documents
    )) {
      $pdf->SetXY(14, 177);
      $pdf->Write(0, '.');
    }


    if (in_array(
      'List of Farm inputs (Annex B)',
      $required_documents
    )) {
      $pdf->SetXY(14, 180.5);
      $pdf->Write(0, '.');
    }

    if (in_array(
      'Certificate of Nutrient Soil Analysis',
      $required_documents
    )) {
      $pdf->SetXY(14, 184);
      $pdf->Write(0, '.');
    }
    if (in_array(
      'Certificate of training on GAP conducted by ATI, BPI, LGU, DA RFO, SUCs or by ATI accredited service providers',
      $required_documents
    )) {
      $pdf->SetXY(14, 188);
      $pdf->Write(0, '.');
    }
    if (in_array(
      'Certification of Registration and other permits e.g. RSBSA, SEC, DTI, CDA (as applicable)',
      $required_documents
    )) {
      $pdf->SetXY(14, 196);
      $pdf->Write(0, '.');
    }


    if (in_array(
      'Quality Management System/Internal Control System',
      $additional_documents
    )) {
      $pdf->SetXY(109.5, 161.5);
      $pdf->Write(0, '.');
    }

    if (in_array(
      'Procedure for accreditation of farmers/growers',
      $additional_documents
    )) {
      $pdf->SetXY(109.5, 168);
      $pdf->Write(0, '.');
    }

    if (in_array(
      'Manual of Procedure for outgrowership scheme',
      $additional_documents
    )) {
      $pdf->SetXY(109.5, 172);
      $pdf->Write(0, '.');
    }

    $pdf->AddPage();
    $pdf->setSourceFile('pdf-layout/f1-finalform.pdf');
    $template = $pdf->importPage(2);
    $pdf->useTemplate($template);

    $pdf->Output('farmer_details.pdf', 'I');
  } else {
    echo "No user found with this ID.";
  }
} else {
  echo "Invalid request. No user ID provided.";
}
