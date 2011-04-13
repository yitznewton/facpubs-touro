<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php if ( has_slot('title') ): ?>
      <title><?php include_slot('title') ?> | Faculty Publications</title>
    <?php else: ?>
      <title>Faculty Publications</title>
    <?php endif; ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <h1>Faculty Publications Database</h1>

    <?php echo $sf_content ?>
  </body>
</html>
