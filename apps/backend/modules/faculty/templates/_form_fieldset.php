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
          <?php for ( $i = 0; $i < $publications->count() && $i < 4; $i++ ): ?>
          <?php // TODO: some broken characters in citation cause whole field to be scrubbed by escaper ?>
          <li><?php echo link_to( $publications[$i]->getCitationTeaser(),
            'publication/edit?id='.$publications[$i]->getId() ) ?></li>
          <?php endfor; ?>
        </ul>
        
        <?php if ( $publications->count() > 4 ): ?>
        <div>
          <?php echo link_to('Show all',
            'publication/index?faculty='.$faculty->getId() ) ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
</fieldset>
