<?php slot('title', sprintf('Publications for %s %s', $faculty->getFirstName(), $faculty->getLastName())) ?>

<div class="breadcrumb"><?php echo link_to('Faculty Publications Home', '@homepage') ?></div>

<h2>Publications for <?php echo $faculty->getFirstName() ?> <?php echo $faculty->getLastName() ?></h2>

<?php if ( $pager->getLastPage() === 0 ): ?>
<p>No publications were found matching your search.</p>
<?php else: ?>
<?php include_partial('publication/results', array('publications' => $pager->getResults())) ?>
<?php endif; ?>

<?php if ( $pager->haveToPaginate() ): ?>
<?php include_partial('publication/facultyIndexPagination', array('pager' => $pager, 'route' => $route)) ?>
<?php endif; ?>
