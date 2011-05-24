<h1>Faculty Publications</h1>

<p>We are proud to host this database of works published by Touro faculty. To submit your work for inclusion, please
<?php echo link_to('click here', 'http://www.tourolib.org/resources/faculty-publications') ?>.</p>

<p class="publication-total">
  Total number of publications:
  <?php echo link_to( $publication_count, 'publication/statistics' ) ?>
</p>

<div id="publication-tabs">

<ul>
  <li><a href="#faculty">By Faculty</a></li>
  <li><a href="#publications">By Publication</a></li>
</ul>

<div id="faculty">
<?php include_partial( 'publication/byFaculty', array('schools' => $schools) ) ?>
</div>

<div id="publications">

<form class="frontend-publication-filter">
  <ul class="frontend-publication-filter-fields">
  <?php echo $filters ?>
  </ul>
  
  <input type="submit" id="filter-submit" value="Submit" />
  <?php echo link_to( 'Reset', 'publication/index') ?>
  <div class="clear"></div>
</form>

<?php if ( $pager->haveToPaginate() ): ?>
<?php include_partial('publication/pagination', array('pager' => $pager, 'filter_params' => $filter_params)) ?>
<?php endif; ?>

<?php if ( $pager->getLastPage() === 0 ): ?>
<p>No publications were found matching your search.</p>
<?php else: ?>
<?php include_partial('publication/results', array('publications' => $pager->getResults())) ?>
<?php endif; ?>

<?php if ( $pager->haveToPaginate() ): ?>
<?php include_partial('publication/pagination', array('pager' => $pager, 'filter_params' => $filter_params)) ?>
<?php endif; ?>

</div>

</div>
