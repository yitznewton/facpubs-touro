<?php

/**
 * Subject form base class.
 *
 * @method Subject getObject() Returns the current form's model object
 *
 * @package    facpubs2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSubjectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'publications_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Publication')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 100)),
      'publications_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Publication', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('subject[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Subject';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['publications_list']))
    {
      $this->setDefault('publications_list', $this->object->Publications->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePublicationsList($con);

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

}
