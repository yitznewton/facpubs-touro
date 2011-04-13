<?php

/**
 * School form base class.
 *
 * @method School getObject() Returns the current form's model object
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSchoolForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'slug'          => new sfWidgetFormInputText(),
      'facultys_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Faculty')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'slug'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'facultys_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Faculty', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'School', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('school[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'School';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['facultys_list']))
    {
      $this->setDefault('facultys_list', $this->object->Facultys->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveFacultysList($con);

    parent::doSave($con);
  }

  public function saveFacultysList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['facultys_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Facultys->getPrimaryKeys();
    $values = $this->getValue('facultys_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Facultys', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Facultys', array_values($link));
    }
  }

}
