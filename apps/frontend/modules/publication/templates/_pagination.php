<?php $filter_params = http_build_query( $filter_params->getRawValue() ) ?>

<?php echo link_to( 'First', 'publication/index?'.$filter_params.'&page=1' ) ?>

<?php echo link_to( 'Prev', 'publication/index?'.$filter_params.'&page='.$pager->getPreviousPage() ) ?>

<?php foreach ($pager->getLinks(10) as $page): ?>
  <?php if ($page == $pager->getPage()): ?>
    <?php echo $page ?>
  <?php else: ?>
    <?php echo link_to( $page, 'publication/index?'.$filter_params.'&page='.$page ) ?>
  <?php endif; ?>
<?php endforeach; ?>

<?php echo link_to( 'Next', 'publication/index?'.$filter_params.'&page='.$pager->getNextPage() ) ?>

<?php echo link_to( 'Last', 'publication/index?'.$filter_params.'&page='.$pager->getLastPage() ) ?>
