<?php

namespace Core\Page;

use Exception;

class View
{

    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData($data)
    {
        return $this->data;
    }

    /**
     * Renders the View (template)
     * to a string
     * @param string $tpl_path Full path to the template file
     * @return false|string
     * @throws Exception
     */
    public function render($tpl_path = null)
    {
        // Check if template file exists
        if (!file_exists($tpl_path)) {
            throw new Exception(strtr(
                'Template with filename: @tpl_path does not exist!',
                ['@tpl_path' => $tpl_path]
            ));
        }

        // Pass arguments to the view-***-***.tpl.php as $view variable
        // so it is easier to print the values
        $view = $this->data;

        // Start buffering output to memory
        ob_start();

        // Load the view (template)
        require $tpl_path;

        // Baigiame bufferinti ir tai kas buvo 'subufferinta', 
        // returniname kaip tekstą
        return ob_get_clean();
    }

}
