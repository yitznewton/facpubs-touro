<?php use_helper('I18N', 'Date') ?>
<?php include_partial('faculty/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Edit Faculty', array(), 'messages') ?></h1>

  <?php include_partial('faculty/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('faculty/form_header', array('faculty' => $faculty, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('faculty/form', array('faculty' => $faculty, 'publications' => $publications, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('faculty/form_footer', array('faculty' => $faculty, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
