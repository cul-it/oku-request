<?php



# Bootstrap Mantis core and APIs
require_once('../core.php');
$t_core_path = config_get('core_path');
require_once( $t_core_path.'bug_api.php' );
require_once( $t_core_path.'authentication_api.php' );
require_once( $t_core_path.'email_api.php' );

# Use Hashids libraries to decode request URLs
require_once('../library/Hashids/HashGenerator.php');
require_once('../library/Hashids/Hashids.php');

# Decode request URL 
$cul_ini_array = parse_ini_file('../cul_config.ini');
$hashids = new Hashids\Hashids($cul_ini_array['hashid_salt']);
$id = $_GET['id'];
list($issue_id, $email) = decode_hash($hashids, $id);

# Get bug data from Mantis
#$bugdata = bug_get($issue_id, true);
try {
  $url_base = $cul_ini_array['api_url_base'];
  $client = new SoapClient("http://$url_base/api/soap/mantisconnect.php?wsdl");
  $issueData = $client->mc_issue_get($cul_ini_array['api_user'], $cul_ini_array['api_pass'], $issue_id);
}
catch (SoapFault $exception) {
  echo "ERROR: could not find request (" . $exception->getMessage() . ')';
  return;
}
?>

<html>
<head>
  <title>Request to Use OKU Library Space</title>
  <link rel="shortcut icon" href="img/favicon.png" type="image/png" />
  <link rel="stylesheet" type="text/css" href="css/roomreserve.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>
</head>
<body>
  <div class="cornell-brand">
    <div class="container">
      <a class="visible-xs" href="http://www.cornell.edu"><img src="img/cornell-red.gif" alt="Cornell University"></a>
      <div class="cornell-logo">
        <a href="http://www.cornell.edu"><img src="img/CU-Insignia-White-120.png" alt="Cornell University" class="insignia hidden-xs"></a>
        <div class="library-brand">
          <a href="/">Cornell University Library</a>
        </div>
      </div>
    </div>
  </div>
  
<?php
echo '<div class="jumbotron"><div class="container">';
echo "<h2>Status and details for reservation request #$issue_id:<br/> '" . $issueData->summary . "'</h2>";
echo '</div></div>';

####### convert issue status into something users will understand
$issueStatus = $issueData->status->name;

# Default cases
$statusDisplay = $issueStatus;
$statusDisplayClass = '';

if ($issueStatus == 'queued' || $issueStatus == 'pending') {
  $statusDisplay = 'WAITING';
  $statusDisplayClass = 'bg-info';
}
elseif ($issueStatus == 'disapproved') {
  $statusDisplay = 'NOT APPROVED';
  $statusDisplayClass = 'bg-warning';
}
elseif ($issueStatus == 'cancelled') {
  $statusDisplay = 'CANCELLED';
  $statusDisplayClass = 'bg-warning';
}
elseif ($issueStatus == 'approved') {
  $statusDisplay = 'APPROVED';
  $statusDisplayClass = 'bg-success';
}

echo '<div class="container"><div class="row">';
echo '<div class="col-md-4">';
echo '<h2>Request status</h2><p class="custom-field-status ' . $statusDisplayClass . '">' . $statusDisplay . '</p><p>If you have questions about the status of your request, please email <a mailto:cjl10@cornell.edu>CJ Lance</a>.</p></div>';
echo '<div class="col-md-4"><h2>Approvals</h2>';

# CUSTOM FIELDS
$customFields = $issueData->custom_fields;
foreach ($customFields as $cf) {
  $custom_field_value = $cf->value;
  $field_name = $cf->field->name;
  if ($custom_field_value != '') {
    echo "<div class='custom-field-status bg-success'>$field_name is complete</div>";
  }
  else {
    echo "<div class='custom-field-status bg-warning'>$field_name is INCOMPLETE</div>";
  }
}
echo "</div>";

echo '<div class="col-md-4">';
echo "<h2>Original request information</h2>";
echo "title: " . $issueData->summary;
$date = new DateTime($issueData->date_submitted);
#$date->setTimestamp($issueData->date_submitted);
echo "<br/>" . "submitted at: " . $date->format('g:i A, m-d-Y') . "\n";
//echo "<br/>" . "current status: " . $bugdata->status;

$bugdata = preg_replace('/\\n/', '<br/>', $issueData->description);
echo "<br/><br/>" . print_r($bugdata,1);
echo "</div></div>";

echo "</body></html>";

# Decode an ID created with Hashids. In this case, we're using both
# the issue ID and the user's email address to form the hash
function decode_hash($hashids, $id) {
  $numbers = $hashids->decode($id);
  $issue_id = array_shift($numbers);
  $email = implode(array_map('chr', $numbers));
  return array($issue_id, $email);
}

?>