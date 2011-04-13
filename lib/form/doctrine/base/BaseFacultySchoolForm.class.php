<?php

/**
 * FacultySchool form base class.
 *
 * @method FacultySchool getObject() Returns the current form's model object
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFacultySchoolForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'faculty_id' => new sfWidgetFormInputHidden(),
      'school_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'faculty_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('faculty_id')), 'empty_value' => $this->getObject()->get('faculty_id'), 'required' => false)),
      'school_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('school_id')), 'empty_value' => $this->getObject()->get('school_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('faculty_school[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FacultySchool';
  }

}
