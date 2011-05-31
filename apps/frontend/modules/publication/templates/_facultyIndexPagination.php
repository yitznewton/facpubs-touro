<?php echo link_to( 'First', $route.'&page=1' ) ?>

<?php echo link_to( 'Prev', $route.'&page='.$pager->getPreviousPage() ) ?>

<?php foreach ($pager->getLinks(10) as $page): ?>
  <?php if ($page == $pager->getPage()): ?>
    <?php echo $page ?>
  <?php else: ?>
    <?php echo link_to( $page, $route.'&page='.$page ) ?>
  <?php endif; ?>
<?php endforeach; ?>

<?php echo link_to( 'Next', $route.'&page='.$pager->getNextPage() ) ?>

<?php echo link_to( 'Last', $route.'&page='.$pager->getLastPage() ) ?>
