<?php

/**
 * PublicationSubject form base class.
 *
 * @method PublicationSubject getObject() Returns the current form's model object
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublicationSubjectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'publication_id' => new sfWidgetFormInputHidden(),
      'subject_id'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'publication_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('publication_id')), 'empty_value' => $this->getObject()->get('publication_id'), 'required' => false)),
      'subject_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('subject_id')), 'empty_value' => $this->getObject()->get('subject_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('publication_subject[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PublicationSubject';
  }

}
