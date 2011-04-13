<?php

/**
 * faculty actions.
 *
 * @package    facpubs2
 * @subpackage faculty
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class facultyActions extends sfActions
{
  public function executeBySchool( sfWebRequest $request )
  {
    $schools = Doctrine_Core::getTable('School')->createQuery('s')
      ->leftJoin('s.Facultys f')
      ->where('s.slug = ?', $request->getParameter('slug'))
      ->orderBy('f.last_name asc, f.first_name asc')
      ->execute()
      ;

    $this->forward404Unless( $schools->count() );

    $this->school = $schools->getFirst();
  }

  public function executeAutocomplete( sfWebRequest $request )
  {
    $this->getResponse()->setContentType('application/json');

    $this->forward404Unless(
      $term = $request->getParameter('term'));

    $faculties = Doctrine_Core::getTable('Faculty')->retrieveForYnAjax( $term );

    $result = array();

    foreach ( $faculties as $faculty ) {
      $result[] = array(
        'id' => $faculty->getSlug(),
        'value' => $faculty->__toString(),
      );
    }

    return $this->renderText( json_encode( $result ) );
  }
}
