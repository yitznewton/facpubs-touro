  <ul class="frontend-publication-filter-fields">
    <li>
      <?php echo $filters['q']->renderLabel() ?>
      <?php echo $filters['q']->render() ?>
    </li>
    <li>
      <?php echo $filters['year']->renderLabel() ?>
      <?php echo $filters['year']->render() ?>
    </li>
    <li>
      <?php echo $filters['subject']->renderLabel() ?>
      <?php echo $filters['subject']->render() ?>
    </li>
    <li>
      <?php echo $filters['type']->renderLabel() ?>
      <?php echo $filters['type']->render() ?>
    </li>
  </ul>

  <ul class="frontend-publication-filter-fields suppl">
    <li>
      <?php echo $filters['lang']->renderLabel() ?>
      <?php echo $filters['lang']->render() ?>
    </li>
    <li>
      <?php echo $filters['school']->renderLabel() ?>
      <?php echo $filters['school']->render() ?>
    </li>
  </ul>

