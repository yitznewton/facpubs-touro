<?php
/**
 * publication actions.
 *
 * @package    facpubs2
 * @subpackage publication
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class publicationActions extends sfActions
{
  public function executeIndex( sfWebRequest $request )
  {
    // filter
    $this->filters = new PublicationFrontendFilterForm();

    $this->filters->bind( $request->getGetParameters() );

    if ( $this->filters->isValid() ) {
      $query = Doctrine_Core::getTable('Publication')
        ->queryFromFrontendFilters( $this->filters );
    }

    $page = $request->getParameter( 'page', 1 );

    if ( ! is_numeric($page) || $page < 1 ) {
      $this->forward404();
    }

    $this->buildPager( $query, $page );

    $filter_param_keys = array(
      'q' => true,
      'type' => true,
      'subject' => true,
      'year' => true,
    );

    $this->filter_params = array_intersect_key(
      $request->getGetParameters(), $filter_param_keys );

    if ( $page > $this->pager->getLastPage() && $this->pager->getLastPage() > 0 ) {
      $this->forward404();
    }

    $this->schools = Doctrine_Core::getTable('School')->createQuery('s')
      ->orderBy('s.name')
      ->where('EXISTS (SELECT fs.faculty_id FROM FacultySchool fs WHERE fs.school_id=s.id)')
      ->execute()
      ;
    
    $this->publication_count = Doctrine_Core::getTable('Publication')->findAll()->count();
  }
  
  public function executeStatistics( sfWebRequest $request )
  {
    $this->by_subject = Doctrine_Core::getTable('Subject')->createQuery('s')
      ->select('count(p.id) as num_publications')
      ->addSelect('s.id')
      ->addSelect('s.name')
      ->leftJoin('s.Publications p')
      ->groupBy('s.id')
      ->orderBy('s.name')
      ->execute()
      ;
    
    $this->by_school = Doctrine_Core::getTable('School')->createQuery('s')
      ->select('count(p.id) as num_publications')
      ->addSelect('s.slug')
      ->addSelect('s.name')
      ->leftJoin('s.Facultys f')
      ->leftJoin('f.Publications p')
      ->groupBy('s.id')
      ->orderBy('s.name')
      ->execute()
      ;
    
    $this->publication_count = Doctrine_Core::getTable('Publication')->findAll()->count();
    $this->getResponse()->setSlot('title', 'Statistics');
  }

  public function executeFacultyIndex( sfWebRequest $request )
  {
    $this->faculty = Doctrine_Core::getTable('Faculty')
      ->findOneBySlug( $request->getParameter('slug') );

    $this->forward404Unless( $this->faculty );

    $query = Doctrine_Core::getTable('Publication')
      ->createQuery('p')
      ->leftJoin('p.Facultys f')
      ->where('f.slug = ?', $request->getParameter('slug'))
      ->andWhere('f.deleted_at IS NULL')
      ->orderBy('p.citation_stripped asc')
      ;

    $page = $request->getParameter( 'page', 1 );

    if ( ! is_numeric($page) || $page < 1 ) {
      $this->forward404();
    }

    $this->buildPager( $query, $page );
  }
  
  public function execute404( sfWebRequest $request )
  {
    $this->getResponse()->setSlot('title', 'Page not found');
  }

  protected function buildPager( Doctrine_Query $query, $page )
  {
    $this->pager = new sfDoctrinePager( 'Publication', 25 );
    $this->pager->setQuery( $query );
    $this->pager->setPage( $page );
    $this->pager->init();

    return $this->pager;
  }
}
