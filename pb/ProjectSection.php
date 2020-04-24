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
}