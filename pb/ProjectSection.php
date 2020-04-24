<?php

class ProjectSection extends HtmlComponent
{
    public $name = '';
    public $description = '';
    public $projects = array();

    public function getHtml($renderer)
    {
        return $renderer->renderProjectSection($this);
    }

    private function build_sorter($key)
    {
        return function ($a, $b) use ($key) {
            return strnatcmp($a->{$key}, $b->{$key});
        };
    }

    public function sort($sortBy = 'date')
    {
        usort($this->projects, $this->build_sorter($sortBy));
    }
}