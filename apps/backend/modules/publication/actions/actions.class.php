<?php

require_once dirname(__FILE__).'/../lib/publicationGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/publicationGeneratorHelper.class.php';

/**
 * publication actions.
 *
 * @package    facpubs2
 * @subpackage publication
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class publicationActions extends autoPublicationActions
{
  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    if ( $request->hasParameter('faculty') ) {
      $q = $this->buildFacultyQuery( $request->getParameter('faculty') );
    }
    else {
      // use standard query
      $q = $this->buildQuery();
    }

    $this->pager = $this->configuration->getPager('publication');
    $this->pager->setQuery( $q );
    $this->pager->setPage( $this->getPage() );
    $this->pager->init();
    
    $this->sort = $this->getSort();
  }

  public function executeNew( sfWebRequest $request )
  {
    $this->publication = new Publication();
    
    $faculty_collection = Doctrine_Core::getTable('Faculty')
      ->createQuery('f')
      ->where('f.id = ?', $request->getParameter('faculty'))
      ->execute()
      ;
    
    if ( $faculty_collection->count() ) {
      $this->publication->setFacultys( $faculty_collection );
    }
    
    $this->form = new PublicationForm( $this->publication );
  }
  
  protected function buildFacultyQuery( $faculty_id )
  {
    // override last filter settings stored in session
    $this->filters = $this->configuration->getFilterForm(
      $this->configuration->getFilterDefaults() );

    $q = $this->buildQuery();

    $q->leftJoin( $q->getRootAlias().'.Facultys f' )
      ->andWhere( 'f.id = ?', $faculty_id )
      ;

    return $q;
  }
}
