<?php

namespace Core\Page;

class Controller
{

    /**
     * Page data container
     * @var array
     */
    protected $page;

    public function __construct()
    {

        // Init Page Defaults
        $this->page = [
            'title' => 'Durden\'s Framework v1.0',
            'stylesheets' => [],
            'scripts' => [
                'head' => [],
                'body_start' => [],
                'body_end' => []
            ],
            'header' => true,
            'footer' => false,
            'content' => 'This is core controller!'
                . 'You need to extend this class in your App!',
        ];
    }

    public function onRender()
    {
        return (new View($this->page))->render(ROOT_DIR . '/core/views/layout.tpl.php');
    }

}
