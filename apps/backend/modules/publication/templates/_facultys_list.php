<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_facultys_list<?php $form['facultys_list']->hasError() and print ' errors' ?>">
  <?php echo $form['facultys_list']->renderError() ?>
  <div>
    <label for="publication_faculty_list">Faculty</label>

    <div class="content">
      <?php echo $form['facultys_list']->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
    </div>
    
    <ul class="publication-faculty-links">
      <?php foreach ( $form->getObject()->getFacultys() as $faculty ): ?>
      <li><?php echo link_to( $faculty, 'faculty/edit?id='.$faculty->getId() ) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
