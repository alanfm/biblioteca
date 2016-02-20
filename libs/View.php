<?php

class View
{
    private $content;
    private $data;

    public function get_content()
    {
        return $this->content? $this->content: false;
    }

    public function set_content($content, $data = null)
    {
        $this->data = $data;
        $this->content = DIR_VIEW . $content . '.php';
    }

    public function show()
    {
        if ($this->get_content()) {
            if (count($this->data)) {
                foreach ($this->data as $k => $v) {
                    $$k = $v;
                }
            }
            if (file_exists($this->get_content())) {
                include $this->content;
            }
        }
    }
}