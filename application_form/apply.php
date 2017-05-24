<?php
# Use Hashids libraries to encode timestamp
require_once('../library/Hashids/HashGenerator.php');
require_once('../library/Hashids/Hashids.php');

$cul_ini_array = parse_ini_file('../cul_config.ini');
$hashids = new Hashids\Hashids($cul_ini_array['hashid_salt']);
$hashed_time = $hashids->encode(time());
?>

<html lang="en">
<head>
  <title>Request to Use OKU Library Space</title>
  <link rel="stylesheet" type="text/css" href="css/roomreserve.css"/>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css"/>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/overcast/jquery-ui.css"/>
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
    <h1>Request to Use Olin/Kroch/Uris Library Space</h1>
    <div class="alert alert-warning" role="alert">NOTE: This request has not been approved until you receive official confirmation from Library Administration, either by phone, email, or in print. Until then, please do not assume this is a contract or that you have a reservation.</div>
    <div class="container" id="request_form">
    <form id="request_form" action="rooms.php" method="post" enctype="multipart/form-data" class="form">
      <input type="hidden" name="formLoaded3fk7sa11" value="<?php echo $hashed_time; ?>" />
      <div class="form-group">
        <label for="submitter_name" class="control-label required">Your name</label>
        <input type="text" class="form-control" name="submitter_name" value="" required>
      </div>
      <div class="form-group">
        <label for="submitter_email" class="control-label required">Your email</label>
        <input type="email" class="form-control" name="submitter_email" value="" required>
      </div>
      <div class="form-group">
        <label for="submitter_phone" class="control-label required">Your phone number</label>
        <input type="text" class="form-control" name="submitter_phone" value="" required>
      </div>
      <h4>Preliminary Questions</h4>
      <div class="form-group">
        <label for="title" class="control-label required">Title of Event</label>
        <input type="text" class="form-control" name="title" value="" required>
      </div>
      <div class="form-group de-visual" aria-hidden="true">
        <label for="username" class="control-label required">Username</label>
        <input type="text" class="form-control" name="username" value="" placeholder="Leave this field blank" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="sponsor" class="control-label">Sponsoring group/department</label>
        <input type="text" class="form-control" name="sponsor" value="">
      </div>
      <div class="form-group">
        <label for="sponsor_is_cu_affiliate" class="control-label">Is the sponsoring organization a part of the Cornell community?</label>
        <input type="radio" name="sponsor_is_cu_affiliate" value="yes">Yes</input>
        <input type="radio" name="sponsor_is_cu_affiliate" value="no">No</input>    
      </div>
      <div class="form-group">
        <label for="account_number" class="control-label">Please provide an account number for any incurred charges:</label>
        <input type="text" class="form-control" name="account_number" value="">
      </div>  
      <div class="form-group">
        <label for="start_date" class="control-label required">Event start date</label>
        <input type="text" id="start_date" name="start_date" value="" required>
      </div>
      <div class="form-group">
        <label for="end_date" class="control-label required">Event end date</label>
        <input type="text" id="end_date" name="end_date" value="" required>
      </div>
      <div class="form-group">
        <label for="start_time" class="control-label required">Start time for setup</label>
        <input type="text" name="start_time_setup" value="" required>
      </div>
      <div class="form-group">
        <label for="start_time" class="control-label required">Start time for event</label>
        <input type="text" name="start_time_event" value="" required>
      </div>
      <div class="form-group">
        <label for="end_time" class="control-label required">End time for event</label>
        <input type="text" name="end_time_event" value="" required>
      </div>
      <div class="form-group">
        <label for="end_time" class="control-label required">End time for take-down</label>
        <input type="text" name="end_time_cleanup" value="" required>
      </div>
      <div id="things_being_used">
        <div class="form-group">
          <label for="uses_items_for_sale" class="control-label required">Will there be items for sale or distribution?</label>
          <input type="radio" name="uses_items_for_sale" value="yes" required>Yes</input>
          <input type="radio" name="uses_items_for_sale" value="no">No</input>
        </div>  
        <div class="form-group">
          <label for="uses_cornell_name" class="control-label required">Will any part of Cornell's name (or affiliations), nickname, logo, or artwork be used?</label>
          <input type="radio" name="uses_cornell_name" value="yes" required>Yes</input>
          <input type="radio" name="uses_cornell_name" value="no">No</input>
        </div> 
        <div class="form-group">
          <label for="uses_sound" class="control-label required">Will there be amplified sound at your event?</label>
          <input type="radio" name="uses_sound" value="yes" required>Yes</input>
          <input type="radio" name="uses_sound" value="no">No</input>
        </div> 
        <div class="form-group">
          <label for="uses_food" class="control-label required">Will there be food at your event?</label>
          <input type="radio" name="uses_food" value="yes" required>Yes</input>
          <input type="radio" name="uses_food" value="no">No</input>
        </div> 
        <div class="form-group">
          <label for="uses_alcohol" class="control-label required">Will there be alcohol at your event?</label>
          <input type="radio" name="uses_alcohol" value="yes" required>Yes</input>
          <input type="radio" name="uses_alcohol" value="no">No</input>
        </div> 
      </div>
      
      <div id="uup_info" class="text-warning">
        <p>If you will be selling or distributing items, using the Cornell identity, or providing amplified sound, food, or alcohol, you will also have to complete an <a href="https://activities.cornell.edu/EventReg/">Event Registration Form</a> before your event can be approved.
      </div>

      <h4>Locations</h4>
      <p>Room capacities are noted in parentheses. Room setup must be approved; some rooms have restrictions. If possible, provide a detailed description below or attach a floor plan.</p>
      <div class="form-group">
        <label class="control-label" for "Olin">Olin Library</label>
        <label class="checkbox-inline" for="olin_703">
          <input type="checkbox" name="olin_locations[olin_703]" id="olin_703"/>703 Olin (49)
        </label>
        <label class="checkbox-inline" for="olin_702">
          <input type="checkbox" name="olin_locations[olin_702]" id="olin_702"/>702 Olin (15)
        </label>
        <label class="checkbox-inline" for="olin_106G">
          <input type="checkbox" name="olin_locations[olin_106G]" id="olin_106G"/>106G Olin (40)
        </label>
        <label class="checkbox-inline" for="olin_cafe">
          <input type="checkbox" name="olin_locations[olin_cafe]" id="olin_cafe"/>Libe Caf&#233; (150 with chairs)
        </label>
        <label class="checkbox-inline" for="olin_other">
          <input type="checkbox" name="olin_locations[olin_other]" id="olin_other"/>Other:
          <input type="text" name="olin_other_val" id="olin_other_val"/>
        </label>
        <br/><label class="control-label" for "Kroch">Kroch Library (restrictions)</label>
        <label class="checkbox-inline" for="kroch_2b48">
          <input type="checkbox" name="kroch_locations[kroch_2b48]" id="kroch_2b48"/>2B48 Kroch (75 with chairs)
        </label>
        <label class="checkbox-inline" for="kroch_2b49">
          <input type="checkbox" name="kroch_locations[kroch_2b49]" id="kroch_2b49"/>2B49 Kroch (conf) (20)
        </label>
        <label class="checkbox-inline" for="kroch_other">
          <input type="checkbox" name="kroch_locations[kroch_other]" id="kroch_other"/>Other:
          <input type="text" name="kroch_other_val" id="kroch_other_val"/>
        </label>
        <br/><label class="control-label" for "Uris">Uris Library</label>
        <label class="checkbox-inline" for="uris_cafe">
          <input type="checkbox" name="uris_locations[uris_cafe]" id="uris_cafe"/>Tower Caf&#233; (49)
        </label>
        <label class="checkbox-inline" for="uris_kinkeldey">
          <input type="checkbox" name="uris_locations[uris_kinkeldey]" id="uris_kinkeldey"/>Kinkeldey Room (45 - restrictions)
        </label>
        <label class="checkbox-inline" for="uris_cocktail">
          <input type="checkbox" name="uris_locations[uris_cocktail]" id="uris_cocktail"/>Cocktail Lounge (125)
        </label>
        <label class="checkbox-inline" for="uris_adwhite">
          <input type="checkbox" name="uris_locations[uris_adwhite]" id="uris_adwhite"/>A.D. White Library (49 - restrictions)
        </label>
        <label class="checkbox-inline" for="uris_other">
          <input type="checkbox" name="uris_locations[uris_other]" id="uris_other"/>Other:
          <input type="text" name="uris_other_val" id="uris_other_val"/>
        </label>
      </div>
      <div id="adwhite_notice" class="text-warning">
        <p>Use of the A.D. White Library may result in charges. Charges are $100 for the first hour and $50 for each additional hour.</p>
      </div>
      
      <h4>Additional Details</h4>
      <div class="form-group">
        <label for="performers" class="control-label">If this event includes a speaker, musical group(s), or other performing artist(s), please list the names here</label>
        <textarea class="form-control" name="performers" value=""></textarea>
      </div>  
    
      <div class="form-group">
        <label for="event_description" class="control-label required">Description of event (please be specific)</label>
        <textarea class="form-control" name="event_description" required></textarea>
      </div>        
      <div class="form-group">
        <label for="event_setup" class="control-label required">Describe your event setup (please be specific)</label>
        <textarea class="form-control" name="event_setup" required></textarea>
      </div>  
      
    
      <div class="form-group">
        <label for="number_expected" class="control-label required">Number of people expected</label>
        <input type="text" name="number_expected" value="" required>
      </div>
      
      <div id="special_needs">
        <div class="form-group">
          <label for="needs_overtime" class="control-label required">Will the event take place beyond the regular hours of 8:00 am - 4:00 pm, Monday - Friday (including setup and takedown)?</label>
          <input type="radio" name="needs_overtime" value="yes" required>Yes</input>
          <input type="radio" name="needs_overtime" value="no">No</input>
        </div>  
        <div class="form-group">
          <label for="needs_furniture" class="control-label required">Will furniture need to be moved, removed, or brought into the space?</label>
          <input type="radio" name="needs_furniture" value="yes" required>Yes</input>
          <input type="radio" name="needs_furniture" value="no">No</input>
        </div>  
        <div class="form-group">
          <label for="needs_special_access" class="control-label required">Will you need special access to the event space, including handicapped or loading dock?</label>
          <input type="radio" name="needs_special_access" value="yes" required>Yes</input>
          <input type="radio" name="needs_special_access" value="no">No</input>
        </div>  
        <div class="form-group">
          <label for="needs_cleaning" class="control-label required">Will you need cleaning services either before or after the event?</label>
          <input type="radio" name="needs_cleaning" value="yes" required>Yes</input>
          <input type="radio" name="needs_cleaning" value="no">No</input>
          <input type="radio" name="needs_cleaning" value="TBD">TBD (we reserve the right to determine if cleaning services are needed)</input>
        </div>  
        <div class="form-group">
          <label for="needs_staff_setup" class="control-label required">Will any setup or takedown by library staff be required?</label>
          <input type="radio" name="needs_staff_setup" value="yes" required>Yes</input>
          <input type="radio" name="needs_staff_setup" value="no">No</input>
        </div>
        <div class="form-group">
          <label for="needs_equipment" class="control-label required">Will any tech equipment be needed?</label>
          <input type="radio" name="needs_equipment" value="yes" required>Yes</input>
          <input type="radio" name="needs_equipment" value="no">No</input>
        </div>  
        <div class="form-group">
          <label for="equipment_provider" class="control-label">If so, who will be providing the equipment? Please list equipment needs.</label>
          <input type="text" class="form-control" name="equipment_provider" value="">
        </div>   
      </div> 
      
      <div class="form-group">
        <label for="attachment" class="control-label">Attach a file (maximum file size is 1 MB)</label>
        <input type="file" name="attachment" />
      </div>
      
      <div class="pull-right">
        <input type="submit" label="submit" class="btn btn-primary">
      </div>
    </form>
  </div>
</div>
  
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
  <script src="rooms.js"></script>
</body>
</html>
