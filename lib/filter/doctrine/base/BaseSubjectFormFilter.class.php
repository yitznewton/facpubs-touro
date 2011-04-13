<?php

/**
 * Subject filter form base class.
 *
 * @package    facpubs2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSubjectFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'publications_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Publication')),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'publications_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Publication', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('subject_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addPublicationsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.PublicationSubject PublicationSubject')
      ->andWhereIn('PublicationSubject.publication_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Subject';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'name'              => 'Text',
      'publications_list' => 'ManyKey',
    );
  }
}
