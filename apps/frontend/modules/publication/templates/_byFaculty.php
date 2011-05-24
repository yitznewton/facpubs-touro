<div id="faculty-autocomplete-container">
  <p>Enter a faculty name:</p>

  <form id="faculty-autocomplete-form" action="<?php echo url_for('publication/facultyIndex') ?>" method="GET">
    <input type="text" name="faculty" class="autocomplete" id="faculty-autocomplete" />
    <input type="submit" id="faculty-autocomplete-submit" value="Submit" />
    <span class="metadata" id="faculty-autocomplete-ajax-path" title="<?php echo url_for('faculty/autocomplete') ?>" />
  </form>

  <p>or browse faculty by school:</p>
</div>

<ul>
  <?php foreach ( $schools as $school ): ?>
  <li><?php echo link_to( $school, 'faculty/bySchool?slug='.$school->getSlug() ) ?></li>
  <?php endforeach; ?>
</ul>