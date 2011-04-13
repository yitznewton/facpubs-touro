<?php

/**
 * Publication filter form.
 *
 * @package    facpubs2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PublicationFormFilter extends BasePublicationFormFilter
{
  public function configure()
  {
    $this->widgetSchema['publication_type_id']->setOption(
      'order_by', array('name', 'asc'));

    $this->widgetSchema['subjects_list'] = new ynWidgetFormDoctrineChoiceEmpty(array(
      'multiple' => true,
      'model' => 'Subject',
      'with_empty' => true,
      'order_by' => array('name', 'asc'),
    ));

    $this->widgetSchema['facultys_list'] = new sfWidgetFormFilterInput(array('with_empty' => true));

    $this->validatorSchema['subjects_list'] = new ynValidatorDoctrineChoiceEmpty(array(
      'multiple' => true, 'model' => 'Subject', 'required' => false,
    ));

    $this->validatorSchema['facultys_list'] = new sfValidatorPass(array('required' => false));
  }

  public function addSubjectsListColumnQuery( Doctrine_Query $query, $field, $values )
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    if (
      isset( $values['is_empty'] )
      && $values['is_empty'] == 'on'
    ) {
      $query
        ->andWhere('NOT EXISTS (SELECT ps.subject_id '
          . 'FROM PublicationSubject ps WHERE ' . $query->getRootAlias()
          . '.id=ps.publication_id)');
    }
    else {
      $query
        ->leftJoin($query->getRootAlias().'.PublicationSubject PublicationSubject')
        ->andWhereIn('PublicationSubject.subject_id', $values)
      ;
    }
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

    if (
      isset( $values['is_empty'] )
      && $values['is_empty'] == 'on'
    ) {
      $query
        ->andWhere('NOT EXISTS (SELECT fp.faculty_id '
          . 'FROM FacultyPublication fp where ' . $query->getRootAlias()
          . '.id=fp.publication_id)')
      ;
    }
    elseif ( isset( $values['text'] ) && $values['text'] !== '' ) {
      $r = $query->getRootAlias();
      
      if ( ! in_array( "LEFT JOIN $r.Facultys fac", $query->getDqlPart('from'))) {
        $query->leftJoin("$r.Facultys fac");
      }

      $query
        ->andWhere('fac.last_name LIKE ?', $values['text'] . '%' )
        ->orWhere('fac.first_name LIKE ?', $values['text'] . '%' )
      ;
    }
  }
}
