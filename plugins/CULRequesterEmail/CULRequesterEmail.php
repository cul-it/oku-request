<?php 
class CULRequesterEmailPlugin extends MantisPlugin {

  function register() {
    $this->name = 'CUL Requester Email';
    $this->description = 'Sends an email to the person who requested a room reservation when status is changed to one of the "final" statuses in the system.';
    $this->version = '1.0';
    $this->requires = array(    # Plugin dependencies, array of basename => version pairs
        'MantisCore' => '1.2.0',  #   Should always depend on an appropriate version of MantisBT
        );
    $this->author = 'Matt Connolly';
    $this->contact = 'mjc12@cornell.edu';
  }
  
  function hooks() {
    return array(
      #'EVENT_UPDATE_BUG_STATUS_FORM' => 'update_bug_form',
      'EVENT_UPDATE_BUG' => 'update_bug_form'
    );
  }
  
  /* This is the plugin's sole purpose: When an item's status is changed to
   * one of the 'final' statuses - 30 (approved) or 40 (disapproved) — then
   * send an email alert to the peroson who originally requested the reservation.
   */
  function update_bug_form($event, $params) {
    
    // Only send if new status is approved or disapproved
    if ($params->status == 30 || $params->status == 40) {
      // Pull the submitter's email out of the description text
      preg_match('/submitted by\: (.+)\r/', $params->description, $matches);
      //error_log('test: ' . $params->status);
      
      $email = $matches[1];
      $id = $params->id;
      $title = $params->summary;
      $result = '';
      if ($params->status == 30) {
        $result = 'APPROVED';
      }
      elseif ($params->status == 40) {
        $result = 'NOT APPROVED';
      }
      
      # Send email to requestor
      $headers = 'From: cul-room-reservation@cornell.edu' . "\r\n" .
                 'Reply-To: cul-room-reservation@cornell.edu' . "\r\n" .
                 'Content-Type: text/html; charset=utf-8' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();
      $emailSubject = "Room reservation application notice";
      $emailText = "<html><head><title>OKU Room Reservation Request Status</title><body><p>The room reservation request you submitted to the online tracking system with ID #$id and title '$title' has been resolved. Your reservation is $result.</p><p>If you have questions about the status of your request, please email <a mailto:cjl10@cornell.edu>CJ Lance</a> (cjl10@cornell.edu).</p></body></html>";
      mail($email, $emailSubject, $emailText, $headers);
      
      
    }


  }
  
}