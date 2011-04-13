<?php

class ynValidatorDoctrineChoiceEmpty extends sfValidatorDoctrineChoice
{
  public function configure( $options = array(), $messages = array() )
  {
    parent::configure( $options = array(), $messages = array() );

    $this->addMessage('empty_or_not', 'Select either choices or none');
  }

  protected function doClean( $values )
  {
    if (
      isset( $values['is_empty'] )
      && $values['is_empty'] == 'on'
    ) {
      if ( count( $values ) > 1 ) {
        // 'empty' selected alongside subjects
        throw new sfValidatorError( $this, 'empty_or_not' );
      }

      return $values;
    }
    else {
      return parent::doClean( $values );
    }
  }
}
