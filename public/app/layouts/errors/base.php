<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->title ?></title>
  </head>
  <body>
    <section>
        <?php $this->view->include($this->page, $this->place) ?>
    </section>
  </body>
</html>
