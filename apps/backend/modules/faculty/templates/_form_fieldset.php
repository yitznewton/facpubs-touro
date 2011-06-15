<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
  <?php if ('NONE' != $fieldset): ?>
    <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
  <?php endif; ?>

  <?php foreach ($fields as $name => $field): ?>
    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
    <?php include_partial('faculty/form_field', array(
      'name'       => $name,
      'attributes' => $field->getConfig('attributes', array()),
      'label'      => $field->getConfig('label'),
      'help'       => $field->getConfig('help'),
      'form'       => $form,
      'field'      => $field,
      'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
    )) ?>
  <?php endforeach; ?>

  <?php if ( isset($publications) && $publications->count() ): ?>
  <div class="sf_admin_form_row">
    <div>
      <span class="label">Publications</span>
      <div class="content">
        <ul>
          <?php foreach ( $publications as $publication ): ?>
          <?php // TODO: some broken characters in citation cause whole field to be scrubbed by escaper ?>
          <li><?php echo link_to( $publication->getRaw('citation'),
            'publication/edit?id='.$publication->getId() ) ?></li>
          <?php endforeach; ?>
        </ul>
        
        <div>
          <?php echo link_to('Add publication', 'publication/new?faculty='.$faculty->getId()) ?>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</fieldset>
