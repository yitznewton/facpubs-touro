var facpubs_backend_changed = false;

$( function() {
  $('.sf_admin_form select, .sf_admin_form input, .sf_admin_form select textarea').change( function() {
    facpubs_backend_changed = true;
  });

  $('a').live( 'click', function() {
    if ( facpubs_backend_changed && this.target != '_blank' ) {
      return confirm('It looks like you have unsaved changes. Are you sure you want to leave?');
    }
  });
});
