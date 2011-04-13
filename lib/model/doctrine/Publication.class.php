<?php

/**
 * Publication
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    facpubs2
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7691 2011-02-04 15:43:29Z jwage $
 */
class Publication extends BasePublication
{
  public function setCitation( $v )
  {
    $this->_set( 'citation', $v );

    // process citation_stripped
    $v = strip_tags( $v );
    $v = Doctrine_Inflector::unaccent( $v );

    if (function_exists('mb_strtolower')) {
      $v = mb_strtolower( $v );
    }
    else {
      $v = strtolower( $v );
    }

    $v = preg_replace( '/[^\w\p{L}\p{N}]/u', ' ', $v );
    $v = preg_replace( '/\s{2,}/', ' ', $v );
    $v = trim( $v );

    $this->_set( 'citation_stripped', $v );
  }

  public function getPublicationTypeString()
  {
    return $this->getPublicationType()->getName();
  }

  public function getFacultyString()
  {
    $strings = array();

    foreach ( $this->getFacultys() as $faculty ) {
      $strings[] = $faculty->getLastName();
    }

    return implode( ', ', $strings );
  }

  /**
   * Returns a stripped, shortened form of the citation
   *
   * @return string
   */
  public function getCitationTeaser()
  {
    $ret = $this->getCitation();
    $ret = preg_replace( '/\<a.+?\<\/a>/', '', $ret );
    $ret = strip_tags( $ret );
    $ret = str_replace( '&nbsp;', ' ', $ret );

    if ( strlen($ret) > 150 ) {
      $ret = substr( $ret, 0, 147 ) . '...';
    }

    return $ret;
  }
}
