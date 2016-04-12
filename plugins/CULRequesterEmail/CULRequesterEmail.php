<?php 
class CULRequesterEmailPlugin extends MantisPlugin {

  function register() {
    $this->name = 'CUL Requester Email';
    $this->description = 'Sends an email to the person who requested a room reservation when status is changed to one of the "final" statuses in the system.';
    $this->version = '0.1dev';
    $this->requires = array(    # Plugin dependencies, array of basename => version pairs
        'MantisCore' => '1.2.0',  #   Should always depend on an appropriate version of MantisBT
        );
    $this->author = 'Matt Connolly';
    $this->contact = 'mjc12@cornell.edu';
  }
  
  
  
  
}
