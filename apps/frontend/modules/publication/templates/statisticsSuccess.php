<div class="breadcrumb"><?php echo link_to('Faculty Publications Home', '@homepage') ?></div>

<h2><?php include_slot('title') ?></h2>
<?php if ( $by_subject->count() ): ?>

<h3>Publications by subject</h3>

<table class="statistics">
<?php foreach ( $by_subject as $subject ): ?>
  <tr>
    <td><?php echo $subject->getName() ?></td>
    <td class="numeric"><?php echo $subject->getNumPublications() ?></td>
  </tr>
<?php endforeach; ?>
</table>

<?php endif; ?>

<?php if ( $by_school->count() ): ?>

<h3>Publications by school</h3>

<table class="statistics">
<?php foreach ( $by_school as $school ): ?>
  <tr>
    <td><?php echo $school->getName() ?></td>
    <td class="numeric"><?php echo $school->getNumPublications() ?></td>
  </tr>
<?php endforeach; ?>
</table>

<?php endif; ?>
