<?php

require_once dirname(__FILE__).'/../bootstrap/doctrine.php';

$t = new lime_test();

$p = new Publication();
$p->setCitation('<p>This,. is à tאst</p>');

$t->is( $p->citation, '<p>This,. is à tאst</p>' );
$t->is( $p->citation_stripped, 'this is a tאst' );

$p->setCitation(" this is a non-HTML example.\n" );

$t->is( $p->citation, " this is a non-HTML example.\n" );
$t->is( $p->citation_stripped, 'this is a non html example' );

