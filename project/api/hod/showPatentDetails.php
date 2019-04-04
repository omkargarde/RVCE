<?php
session_start();
if(!isset($_SESSION['hodId']))
  {
    header("Location:hodLogin.html");
    die();
  }
$client = curl_init('http://localhost/project/api/hod/getAllPatent.php?action=encodeData');
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($client);
$result = json_decode($response);
$output = '<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <!--Animate CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

  <link rel="stylesheet" href="css/main.css">
  </head>
    <body class="bg-1">
    <div class="d-flex justify-content-end">
      <button type="button" class="btn btn-danger">Log Out</button>
      </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6"></div>
        <div class="">
    <div class = "table">
    <table class = "table-responsive">
    <thead class = "thead-dark">
      <tr>
      <th scope = "col">Faculty ID</th>
      <th scope = "col">Faculty Name</th>
      <th scope = "col">Patent ID</th>
      <th scope = "col">Patent Title</th>
      <th scope = "col">Patent Status</th>
      <th scope = "col">Patent Amount</th>
      <th scope = "col">Patent Filing Date</th>
      </tr>
    </thead>
    <tbody>
    ';
if(count($result) > 0){
    foreach($result as $row){
        $output .=
                '<tr>
                <td class="text-white bg-dark">'.$row->faculty_id.'</td>
                <td class="text-white bg-dark">'.$row->faculty_name.'</td>
                <td class="text-white bg-dark">'.$row->patent_id.'</td>
                <td class="text-white bg-dark">'.$row->patent_title.'</td>
                <td class="text-white bg-dark">'.$row->patent_status.'</td>
                <td class="text-white bg-dark">'.$row->patent_author.'</td>
                <td class="text-white bg-dark">'.$row->patent_filing_date.'</td>
            </tr>';
    }
  $output.= ' </tbody>
    </table>
    </div>
    </center>
    </body>
    </html>';

}else{
    $output .= '<tr><td colspan="3" align="center">Not found!</td></tr>';
}
echo $output;
/*$result = file_get_contents("http://localhost/project/api/faculty/getAllFaculty.php?action=encodeData");
// Will dump a beauty json :3
var_dump(json_decode($result, true));*/
?>
