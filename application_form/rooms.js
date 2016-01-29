$(function() {
  $('#start_date').datepicker();
  $('#end_date').datepicker();
  $('#uup_info').hide();
  $('#adwhite_notice').hide();
  $('#uris_other_val').hide();
  $('#olin_other_val').hide();
  $('#kroch_other_val').hide();
  $('#things_being_used input:radio').click(function() {
    var showUUP = false;
    $('#things_being_used input:radio:checked').each(function() {
      if ($(this).val() == 'yes') {
        showUUP = true;
      }
    });
    if (showUUP) {
      $('#uup_info').show();
    }
    else {
      $('#uup_info').hide();
    }
  });
  
  // Validate form submission
  $('#request_form').submit(function(e) {
    var ref = $(this).find('[required]');
    var errors = ''
    $(ref).each(function() {
      if ($(this).val() == '') {
        alert('Please fill out all required fields');
        $(this).focus();
        e.preventDefault();
        return false;
      }
    });
    return true;
  });
  
  $('#uris_adwhite').click(function() {
    
    ($(this).prop('checked') ? $('#adwhite_notice').show() : $('#adwhite_notice').hide() );
    
  });
  
  $('#uris_other').click(function() {
    ($(this).prop('checked') ? $('#uris_other_val').show() : $('#uris_other_val').hide() );
  });
  
  $('#olin_other').click(function() {
    ($(this).prop('checked') ? $('#olin_other_val').show() : $('#olin_other_val').hide() );
  });
  
  $('#kroch_other').click(function() {
    ($(this).prop('checked') ? $('#kroch_other_val').show() : $('#kroch_other_val').hide() );
  });
  
  // For some reason, clicking to focus on the 'other' text boxes triggers the
  // 'other' checkbox and hides the text box. This prevents that, but it seems
  // like it shouldn't be necessary
  $('#uris_other_val').click(function(e) { e.preventDefault(); });
  $('#olin_other_val').click(function(e) { e.preventDefault(); });
  $('#kroch_other_val').click(function(e) { e.preventDefault(); });
});
