<?php

/**
 * FacultyPublication form base class.
 *
 * @method FacultyPublication getObject() Returns the current form's model object
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFacultyPublicationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'faculty_id'     => new sfWidgetFormInputHidden(),
      'publication_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'faculty_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('faculty_id')), 'empty_value' => $this->getObject()->get('faculty_id'), 'required' => false)),
      'publication_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('publication_id')), 'empty_value' => $this->getObject()->get('publication_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('faculty_publication[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FacultyPublication';
  }

}
