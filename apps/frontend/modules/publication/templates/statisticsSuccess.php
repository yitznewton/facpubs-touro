<div class="breadcrumb"><?php echo link_to('Faculty Publications Home', '@homepage') ?></div>

<h2><?php include_slot('title') ?></h2>

<p>Because each publication may have no subjects or multiple subjects,
values may not add up to the total.</p>

<?php if ( $by_subject->count() ): ?>

<h3>Publications by subject</h3>

<table class="statistics">
  <tbody>
  <?php foreach ( $by_subject as $subject ): ?>
    <tr>
      <td><?php echo link_to( $subject->getName(), '@homepage?subject='.$subject->getId() ) ?></td>
      <td class="numeric"><?php echo number_format($subject->getNumPublications()) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  
  <tfoot>
    <tr>
      <td><strong>Total publications</strong></td>
      <td class="numeric"><?php echo $publication_count ?></td>
    </tr>
  </tfoot>
</table>

<?php endif; ?>

<?php if ( $by_school->count() ): ?>

<h3>Publications by school</h3>

<table class="statistics">
  <tbody>
  <?php foreach ( $by_school as $school ): ?>
    <tr>
      <td><?php echo link_to( $school->getName(), 'school/'.$school->getSlug() ) ?></td>
      <td class="numeric"><?php echo number_format($school->getNumPublications()) ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  
  <tfoot>
    <tr>
      <td><strong>Total publications</strong></td>
      <td class="numeric"><?php echo $publication_count ?></td>
    </tr>
  </tfoot>
</table>

<?php endif; ?>
