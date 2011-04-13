<?php

/**
 * Publication form base class.
 *
 * @method Publication getObject() Returns the current form's model object
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePublicationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'citation'            => new sfWidgetFormInputText(),
      'citation_stripped'   => new sfWidgetFormInputText(),
      'publication_date'    => new sfWidgetFormInputText(),
      'publication_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PublicationType'), 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'deleted_at'          => new sfWidgetFormDateTime(),
      'subjects_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Subject')),
      'facultys_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Faculty')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'citation'            => new sfValidatorPass(),
      'citation_stripped'   => new sfValidatorPass(array('required' => false)),
      'publication_date'    => new sfValidatorInteger(),
      'publication_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PublicationType'))),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'deleted_at'          => new sfValidatorDateTime(array('required' => false)),
      'subjects_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Subject', 'required' => false)),
      'facultys_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Faculty', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('publication[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Publication';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['subjects_list']))
    {
      $this->setDefault('subjects_list', $this->object->Subjects->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['facultys_list']))
    {
      $this->setDefault('facultys_list', $this->object->Facultys->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveSubjectsList($con);
    $this->saveFacultysList($con);

    parent::doSave($con);
  }

  public function saveSubjectsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['subjects_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Subjects->getPrimaryKeys();
    $values = $this->getValue('subjects_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Subjects', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Subjects', array_values($link));
    }
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
