<?php

class ynWidgetFormDoctrineChoiceEmpty extends sfWidgetFormDoctrineChoice
{
  protected function configure( $options = array(), $attributes = array() )
  {
    parent::configure( $options, $attributes );

    $this->addOption( 'with_empty', false );
    $this->addOption( 'empty_label', 'none' );
    $this->addOption( 'template', '%select%<div>%empty_checkbox% %empty_label%</div>' );
  }

  public function render( $name, $value = null, $attributes = array(), $errors = array() )
  {
    $select = parent::render( $name, $value, $attributes, $errors );

    if ( $this->getOption('with_empty') ) {
      $values = array_merge(array('text' => '', 'is_empty' => false), is_array($value) ? $value : array());

      return strtr($this->getOption('template'), array(
        '%select%'         => $select,
        '%empty_checkbox%' => $this->renderTag('input', array('type' => 'checkbox', 'name' => $name.'[is_empty]', 'checked' => $values['is_empty'] ? 'checked' : '')),
        '%empty_label%'    => $this->renderContentTag('label', $this->translate($this->getOption('empty_label')), array('for' => $this->generateId($name.'[is_empty]'))),
      ));
    }
    else {
      return $select;
    }


    return $select;
  }
}
