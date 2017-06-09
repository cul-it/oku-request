<?php

# Use Hashids libraries to decode request URLs and timestamp
require_once('../library/Hashids/HashGenerator.php');
require_once('../library/Hashids/Hashids.php');

$cul_ini_array = parse_ini_file('../cul_config.ini');
$hashids = new Hashids\Hashids($cul_ini_array['hashid_salt']);
$timestamp = $hashids->decode($_POST['formLoaded3fk7sa11']);

// Check honeypot and timestamp. The timestamp must be at least 15 seconds in the past -
// otherwise it's safe to assume that a bot submitted the form.
if ($_POST['submitter_name'] || (time() - (int)join('',$timestamp) < 15)) {
  $t_orig = $timestamp;
  $timestamp = date("Y-m-d H:i", time());
  file_put_contents('spam_log', "Blocked suspected spam at $timestamp:\nYour_name: " . $_POST['your_name'] . "\nSubmitter name: " . $_POST['submitter_name'] . "\nTime diff: " . (time() - (int)join('',$t_orig)) .  "\nIP: " . $_SERVER['REMOTE_ADDR'] . "\n\n", FILE_APPEND);
  header( 'Location: rooms.html' );
  exit(0);
}
else {
  $timestamp = date("Y-m-d H:i", time());
  file_put_contents('ham_log', "Let through submission at $timestamp:\nYour_name: " . $_POST['your_name'] . "\nSubmitter name: " . $_POST['submitter_name'] . "\nTime diff: " . (time() - (int)join('',$timestamp)) .  "\nIP: " . $_SERVER['REMOTE_ADDR'] . "\n\n", FILE_APPEND);
  header( 'Location: rooms.html' );
}

// echo "got back: " . print_r($_POST,1);
// return 0;
$text = '';

# Preliminary questions
$text .= title('General Information');
# title
$text .= add_text('title');
# email
$text .= 'submitted by: ' . $_POST['your_name'] . ' (' . $_POST['submitter_email'] . ")\n";
#phone
$text .= 'phone number: ' . $_POST['submitter_phone'] . "\n";
# sponsor
$text .= add_text('sponsor');
# cu_affiliate
$text .= add_text('Sponsor is a Cornell affiliate', 'sponsor_is_cu_affiliate');
# start date
$text .= add_text('start date');
# end date
$text .= add_text('end date');
# start time
$text .= add_text('Start time (setup)', 'start_time_setup');
$text .= add_text('Start time (event)', 'start_time_event');
# end time
$text .= add_text('End time (event)', 'end_time_event');
$text .= add_text('End time (cleanup/takedown)', 'end_time_cleanup');
# items for sale
$text .= add_text('uses items for sale');
# using Cornell's good name
$text .= add_text('uses Cornell identity', 'uses_cornell_name');
# amplified sound
$text .= add_text('uses sound');
# food
$text .= add_text('uses food');
# alcohol
$text .= add_text('uses alcohol');

// # Sponsor information
// $text .= title('Sponsor Information');
// # name
// $text .= add_text('Sponsoring group/department', 'sponsor2');
// # contact
// $text .= add_text('sponsor contact');
// # local address
// $text .= add_text('sponsor address');
// # local phone
// $text .= add_text('sponsor phone');

# Event information
$text .= title('Event Information');
# title
// $text .= add_text('Title', 'title2');

// Locations
$location_text = '';
if (isset($_POST['olin_locations'])) {
  foreach (array_keys($_POST['olin_locations']) as $loc) {
    $location_text .= "\n$loc";
  }
  if ($_POST['olin_other_val']) {
    $location_text .= "\nOther location: " . $_POST['olin_other_val'];
  }
}
if (isset($_POST['kroch_locations'])) {
  foreach (array_keys($_POST['kroch_locations']) as $loc) {
    $location_text .= "\n$loc";
  }
  if ($_POST['kroch_other_val']) {
    $location_text .= "\nOther location: " . $_POST['kroch_other_val'];
  }
}
if (isset($_POST['uris_locations'])) {
  foreach (array_keys($_POST['uris_locations']) as $loc) {
    $location_text .= "\n$loc";
  }
  if ($_POST['uris_other_val']) {
    $location_text .= "\nOther location: " . $_POST['uris_other_val'];
  }
}
if ($location_text != '') {
  $text .= "\nLocations:" . $location_text . "\n\n";
}


// # uses a guest
$text .= add_text('Names of speakers/artists', 'performers');
# politician?
// $text .= add_text('Guest is a politician or elected official', 'politicians');
# building
#$text .= add_text('Location (building/outdoor area)', 'location_building');
# room
#$text .= add_text('Location (room/specific area)', 'location_room');
# already reserved?
// $text .= add_text('already reserved');
// # reservation person
// $text .= add_text('reserved with');
// # start date
// $text .= add_text('start date', 'start_date2');
// # end date
// $text .= add_text('end date', 'end_date2');

# description of event
$text .= add_text('event description');
# setup
$text .= add_text('event setup');
# uses things?
// $text .= uses('tents');
// $text .= uses('stakes');
// $text .= uses('gas');
// $text .= uses('charcoal');
// $text .= uses('candles');
// $text .= uses('fire');
// $text .= uses('sterno');
// $text .= uses('decorations');
// $text .= uses('generator');
// # parking/traffic
// $text .= add_text('parking/traffic issues', 'parking');
// # accessibility
// $text .= add_text('accessibility');
// # sustainability
// $text .= add_text('environmental impact', 'sustainability');
# number of people
$text .= add_text('number of people expected', 'number_expected');
# admission?
// $text .= add_text('will admission be charged', 'charge_admission');
// # how much admission?
// $text .= add_text('admission fee');
// # proceeds
// $text .= add_text('how proceeds will be used', 'proceeds');
// # alt location
// $text .= add_text('alternate location');
// # alt start date
// $text .= add_text('alternate start date');
// # alt end date
// $text .= add_text('alternate end date');

// Special setup
$text .= add_text('Requires overtime', 'needs_overtime');
// Furniture
$text .= add_text('Requires furniture', 'needs_furniture');
// Special access
$text .= add_text('Requires special access', 'needs_special_access');
// Cleaning
$text .= add_text('Requires cleaning', 'needs_cleaning');
// Staff setup
$text .= add_text('Requires staff setup', 'needs_staff_setup');
// Equipment
$text .= add_text('Requires equipment', 'needs_equipment');
// Equipment provider
$text .= add_text('equipment provider');
// Account number
$text .= add_text('account number');

// # Sale items
// $text .= title('Sale Items');
// # items for sale?
// $text .= add_text('will there be items for sale', 'for_sale');
// # description of items
// $text .= add_text('items for sale');
// # who supplies items
// $text .= add_text('item supplier');
// 
// # Cornell identity
// $text .= title('Use of Cornell Identity');
// # using identity?
// $text .= add_text('using Cornell identity', 'use_logo');
// # description
// $text .= add_text('description', 'logo_use_description');

// # Amplified sound
// $text .= title('Amplified Sound');
// # amplified sound?
// $text .= uses('amplified sound');
# speakers where
// $text .= add_text('speaker location');
// # external source?
// $text .= uses('external sound vendor');
// # sound vendor
// $text .= add_text('sound vendor');

# Food
// $text .= title('Food');
// # using food?
// $text .= uses('food');
// # what food?
// $text .= add_text('food');
// # from where?
// $text .= add_text('who provides the food', 'food_vendor');
// 
// # Alcohol
// $text .= title('Alcohol');
// # using alcohol?
// $text .= uses('alcohol');
// # id checks
// $text .= add_text('id check');
// # plans for underage
// $text .= add_text('underage plans');
// # responsible person
// $text .= add_text('responsible party');
// # title
// $text .= add_text('responsible party title');
// # id number
// $text .= add_text('responsible party id');


#print $text; 

# Bootstrap Mantis core and APIs
require_once('../core.php');
$t_core_path = config_get('core_path');

#require_once( $t_core_path.'bug_api.php' );
#require_once( $t_core_path.'authentication_api.php' );
require_once( $t_core_path.'email_api.php' );




# Create a new Mantis issue (based on e-nerf code)
// $bugdata = new BugData;
// $bugdata->project_id = 1;
// $bugdata->reporter_id = 'test';
// $bugdata->summary = $_POST['title'];
// $bugdata->description = $text;
// 
// # Add issue to tracker database
// $id = $bugdata->create();

$issueTitle = $_POST['title'];

# Use built-in SOAP service to create new issue
$cul_ini_array = parse_ini_file('../cul_config.ini');
$url_base = $cul_ini_array['api_url_base'];
$client = new SoapClient("http://$url_base/api/soap/mantisconnect.php?wsdl");
$project = new StdClass;

########################## DEBUG ONLY, should be 1 ##################################
$project->id = 2;
#####################################################################################
$dateToPost = strtotime($_POST['start_date']);
# IDs for custom fields:
#   4 => date of event
#   5 => room requested
#   6 => requested by (name)
$issueData = array('project' => $project, 
                   'summary' => $issueTitle, 
                   'description' => $text, 
                   'category' => 'General',
                   # NOTE: using additional_information to store submitter email
                   'additional_information' => $_POST['submitter_email'],
                   'custom_fields' => array(array('field' => array('id' => 5), 
                                                  'value' => $location_text),
                                            array('field' => array('id' => 4),
                                                  'value' => $dateToPost),
                                            array('field' => array('id' => 6),
                                                  'value' => $_POST['your_name'])));
$newIssueId = $client->mc_issue_add($cul_ini_array['api_user'], $cul_ini_array['api_pass'], $issueData);

# Handle attachments
$errorMessage = '';
if ($_FILES['attachment']['error'] != 4) {
  # TODO: the file upload routine is kludgy. It would be better to read the 
  # temporary file directly and pass it to the soap request, rather than saving 
  # a file to the server only to delete it again a few steps later.
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  // Check if image file is a actual image or fake image
  // $check = getimagesize($_FILES["attachment"]["tmp_name"]);
  // if($check !== false) {
  //     echo "File is an image - " . $check["mime"] . ".";
  //     $uploadOk = 1;
  //     
  // } else {
  //     echo "File is not an image.";
  //     $uploadOk = 0;
  // }

  // Check if file already exists
  if (file_exists($target_file)) {
      $errorMessage = "Your file could not be uploaded (file already exists)";
      $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > (1048576)) {
      $errorMessage = "Your file could not be uploaded (file size too large)";
      $uploadOk = 0;
  }

  // Allow only certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" && $imageFileType != 'pdf' && $imageFileType != 'txt') {
      $errorMessage = "Your file could not be uploaded (bad file type)";
      $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      $errorMessage = "Your file could not be uploaded";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
        
        # Add attachment to issue via SOAP
        $attachmentContent = file_get_contents($target_file);
        $result = $client->mc_issue_attachment_add('Administrator', 'root', $newIssueId, $_FILES["attachment"]["name"], $imageFileType, $attachmentContent);
        unlink($target_file);
        
        #echo "The file ". basename( $_FILES["attachment"]["name"]). " has been uploaded.";
      } else {
        $errorMessage = "Your file could not be uploaded";
      }
  }
}
?>

<html>
<head>
  <title>Request to Use OKU Library Space</title>
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
  <div class="container">
<?php

if ($errorMessage != '') {
  echo "<p>$errorMessage";
}

# Not sure if id < 1 is an accurate error flag — the create function
# doesn't say what happens if the write fails.
if ($newIssueId < 1) {
  print "\nSomething went wrong -- your request could not be submitted.";
}
else { 

  # Create a hashed link ID from the new issue number and the requestor's
  # email address (this can be de-hashed to retrieve the original values)
  $hashids = new Hashids\Hashids($cul_ini_array['hashid_salt']);
  $hash_array = encode_link($newIssueId, $_POST['submitter_email']);
  $link_id = $hashids->encode($hash_array);
  
  echo "<p>You have created request #$newIssueId: $issueTitle</p>";
  
?>
  <br><br><p>Thank you for submitting your request using the online Library Space Request Form.</p> 
  <p>It is your responsibility to check the status of your event by going to the following address and checking the list of approvers, their approval, and their comments about your event. If the approver requires more information about your event, please contact him/her immediately.</p>
  <p>Use the following link to access your request:

<?php
  
  echo '<strong><a href="' .  url_for_client($link_id) . '">' . url_for_client($link_id) . '</a></strong>';
  echo '<p>A confirmation email with this information will be sent to you shortly.</p>';
  echo '</div>';
  
  send_email($issueTitle, $_POST['submitter_email'], $newIssueId, $link_id);
}

function title($label) {
  return "\n\n" . str_repeat('-', 10) . ' ' . $label . ' ' . str_repeat('-', 10) . "\n";
}

function add_text($label, $value = null) {
  # If $value is not set, assume it's the same as $label
  if ($value && array_key_exists($value, $_POST)) {
    $value = $_POST[$value];
  }
  else {
    $label2 = preg_replace('/ /', '_', $label);
    if (array_key_exists($label2, $_POST)) {
      $value = $_POST[$label2];
    }
    else {
      $value = '';
    }
  }
  
  return($label . ': ' . $value . "\n");
}

function uses($thing) {
  $thing2 = preg_replace('/ /', '_', $thing);
  if (array_key_exists('use_'.$thing2, $_POST)) {
    return "uses $thing\n";
  }
  else {
    return '';
  }
}

function needs($thing) {
  $thing2 = preg_replace('/ /', '_', $thing);
  if (array_key_exists('needs_'.$thing2, $_POST)) {
    return "needs $thing\n";
  }
  else {
    return '';
  }
}

# Encode the new issue ID and requestor's email into a numeric array
# that the Hashids library can use to create an 'unguessable' link
function encode_link($issue_id, $email) {
  $results = array($issue_id);
  $chars = str_split($email);
  foreach ($chars as $c) {
    array_push($results, ord($c));
  }
  return $results;
}

function url_for_client($issue_id){
  $cul_ini_array = parse_ini_file('../cul_config.ini');
  $url_base = $cul_ini_array['api_url_base'];
  $protocol = (isset($_SERVER['HTTPS']) ? 'https' : 'http');
  #$hostname = $_SERVER['SERVER_NAME'];
  return "$protocol://$url_base/application_form/view_request.php?id=$issue_id";
}

# Send email to requestor
function send_email($title, $email, $issue_id, $link_id) {
  $headers = 'From: cul-room-reservation@cornell.edu' . "\r\n" .
             'Reply-To: cul-room-reservation@cornell.edu' . "\r\n" .
             'Content-Type: text/html; charset=utf-8' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();
	$emailSubject = "Room reservation application notice";
	$emailText = "<html><head><title>Room Reservation Confirmation</title><body><p>You have submitted a new room reservation to the online tracking system with ID #$issue_id and title '$title'. You may view the item in the system by clicking on the following link:";
	$emailText .= '<a href="' .  url_for_client($link_id) . '">' . url_for_client($link_id) . '</a></p></body></html>';
	mail($email, $emailSubject, $emailText, $headers);

}

?>
