<ul>
  <?php foreach ( $publications as $p ): ?>
  <li><?php echo $p->getRaw('citation') ?></li>
  <?php endforeach; ?>
</ul>
