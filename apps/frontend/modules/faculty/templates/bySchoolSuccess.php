<?php slot('title', 'Faculty for '.$school) ?>

<div class="breadcrumb"><?php echo link_to('Faculty Publications Home', '@homepage') ?></div>

<?php if ( $school->getFacultys()->count() ): ?>
<h2>Faculty for <?php echo $school->getName() ?></h2>

<ul>
  <?php foreach ( $school->getFacultys() as $faculty ): ?>
  <li><?php echo link_to( $faculty, 'publication/facultyIndex?slug='.$faculty->getSlug() ) ?></li>
  <?php endforeach; ?>
</ul>

<?php else: ?>
<h2><?php echo $school->getName() ?></h2>

<p>There are no faculty records for <?php echo $school->getName() ?>.</p>

<?php endif; ?>

