var FP = {
  $$: function(id) {
    var el = document.getElementById( id );

    if ( el === null ) {
      return {};
    }
    else {
      return el;
    }
  }
};
