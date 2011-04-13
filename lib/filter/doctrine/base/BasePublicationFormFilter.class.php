<?php

/**
 * Publication filter form base class.
 *
 * @package    facpubs2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePublicationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'citation'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'citation_stripped'   => new sfWidgetFormFilterInput(),
      'publication_date'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'publication_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PublicationType'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'subjects_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Subject')),
      'facultys_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Faculty')),
    ));

    $this->setValidators(array(
      'citation'            => new sfValidatorPass(array('required' => false)),
      'citation_stripped'   => new sfValidatorPass(array('required' => false)),
      'publication_date'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'publication_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PublicationType'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'subjects_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Subject', 'required' => false)),
      'facultys_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Faculty', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('publication_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addSubjectsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('PublicationSubject.subject_id', $values)
    ;
  }

  public function addFacultysListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.FacultyPublication FacultyPublication')
      ->andWhereIn('FacultyPublication.faculty_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Publication';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'citation'            => 'Text',
      'citation_stripped'   => 'Text',
      'publication_date'    => 'Number',
      'publication_type_id' => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'deleted_at'          => 'Date',
      'subjects_list'       => 'ManyKey',
      'facultys_list'       => 'ManyKey',
    );
  }
}
