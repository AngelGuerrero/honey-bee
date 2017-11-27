<?php


namespace System\Core;

/**
 * View class
 *
 * This class tries to 'render' a layout, and tries to
 * work like a template engine
 */
class View
{
    /**
     * Save the name of the template
     * @var string
     */
    public $template;


    /**
     * Save the name file to load
     * @var string
     */
    public $file;


    // -----------------------------------------------------------------

    public function __construct()
    {
    }

    // -----------------------------------------------------------------


    /**
     * Load a template file
     *
     * @param  string $template layout
     * @return void
     */
    public function render($template)
    {
        $template_path = 'public/app/layouts/'.$template.'.php';

        if (file_exists($template_path)) {
            ob_start();

            require($template_path);

            $output = ob_get_contents();
        }
    }


    /**
     * Include function, tries to includes a part of code
     * of another file.
     *
     * @param  string $file   Name of the file to load
     * @param  string $place Path of the file to load
     * @return void
     */
    public function include($file, $place = "layouts/_includes/")
    {
        $file_path = 'public/app/'.$place.$file.'.php';

        ob_start();

        require($file_path);

        $output = ob_get_contents();
    }
}
