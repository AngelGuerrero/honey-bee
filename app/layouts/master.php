<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $this->title ?></title>
    <link rel="stylesheet" href=<?php echo STATICPATH."css/master.css" ?> >
  </head>
  <body>
    <!-- load a portion of code -->
    <?php $this->obj->include('header') ?>

    <!-- load the main content -->
    <?php $this->obj->include('index', 'views/'); ?>

  </body>
</html>
