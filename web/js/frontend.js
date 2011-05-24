$( function() {
  var source = FP.$$('faculty-autocomplete-ajax-path').title;

  if ( source ) {
    FP.$$('faculty-autocomplete-container').style.display = 'block';
    FP.$$('faculty-autocomplete-submit').style.display = 'none';

    $( FP.$$('faculty-autocomplete') ).autocomplete({
      source: source,
      delay: 10,
      minLength: 2,
      select: function(e, ui) {
        this.item_id = ui.item.id;
        
        // "submit" the form programatically using the redirect in onsubmit()
        this.parentNode.onsubmit();
      }
    });

    FP.$$('faculty-autocomplete-form').onsubmit = function() {
      var item_id = FP.$$('faculty-autocomplete').item_id;

      if ( item_id ) {
        var matches = this.action.match( /^(.*)publication/ );

        var url = matches[1] + 'publications/faculty/' + item_id;
                
        window.location = url;
        
        return false;
      }
    };

    var $tabs = $('#publication-tabs').tabs({
      cookie: { expires: 5 }
    });

    if ( window.location.search.match(/=/) ) {
      $tabs.tabs( 'select', 1 );
    }
  }
});
