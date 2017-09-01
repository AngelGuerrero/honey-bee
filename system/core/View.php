<?php

/**
 * Class view
 *
 * This class will save the data for send at the template,
 * and will render one given template, the main idea with this
 * is try to create a Template Engine.
 *
 */
class View
{
  /**
   * Name or path of template to use
   * @var string
   */
  public $template;


  /**
   * Save the name of the file to load
   * @var string
   */
  public $filename;


  // -----------------------------------------------------------------


  function __construct()
  {
  }

  // -----------------------------------------------------------------


  /**
   * Render method will load the given template as parameter
   *
   *
   * @param  string $template Name or path or the template to load
   * @return void
   */
  public function render($template)
  {
    $template_path = 'app/layouts/'.$template.'.php';

    if (file_exists($template_path))
    {
      ob_start();
      // you can access $this->data in template
      require ($template_path);

      $output = ob_get_contents();
    }
  }

  public function include($file, $folder = "layouts/_includes/")
  {

    $file_path = 'app/'.$folder.$file.'.php';

    ob_start();

    require($file_path);

    $output = ob_get_contents();
  }
}
