<?php

namespace App\View;

use Core\Page\View;

class Footer extends View
{

    public function render($tpl_path = ROOT_DIR . '/app/views/footer.tpl.php')
    {
        return parent::render($tpl_path);
    }

    public function addLink($href, $title)
    {
        $this->data[] = [
            'link' => $href,
            'title' => $title
        ];
    }

    public function addLinks($links)
    {
        foreach ($links as $link) {
            $this->addLink($link['link'], $link['title']);
        }
    }

    public function removeLink($href)
    {
        foreach ($this->data as $key => $link) {
            if ($link['link'] == $href) {
                unset($this->data[$key]);
            }
        }
    }

    public function removeLinks()
    {
        return $this->data = [];
    }

}
