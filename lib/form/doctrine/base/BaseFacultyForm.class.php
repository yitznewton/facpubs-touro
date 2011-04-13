<?php

/**
 * Faculty form base class.
 *
 * @method Faculty getObject() Returns the current form's model object
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFacultyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'last_name'         => new sfWidgetFormInputText(),
      'first_name'        => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'slug'              => new sfWidgetFormInputText(),
      'deleted_at'        => new sfWidgetFormDateTime(),
      'publications_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Publication')),
      'schools_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'School')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'last_name'         => new sfValidatorString(array('max_length' => 100)),
      'first_name'        => new sfValidatorString(array('max_length' => 100)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'slug'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'deleted_at'        => new sfValidatorDateTime(array('required' => false)),
      'publications_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Publication', 'required' => false)),
      'schools_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'School', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Faculty', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('faculty[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Faculty';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['publications_list']))
    {
      $this->setDefault('publications_list', $this->object->Publications->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['schools_list']))
    {
      $this->setDefault('schools_list', $this->object->Schools->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePublicationsList($con);
    $this->saveSchoolsList($con);

    parent::doSave($con);
  }

  public function savePublicationsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['publications_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Publications->getPrimaryKeys();
    $values = $this->getValue('publications_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Publications', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Publications', array_values($link));
    }
  }

  public function saveSchoolsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['schools_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Schools->getPrimaryKeys();
    $values = $this->getValue('schools_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Schools', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Schools', array_values($link));
    }
  }

}
