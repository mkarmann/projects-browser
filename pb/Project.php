<?php


class Project extends HtmlComponent
{

    public $name = '';
    public $shortDescription = '';
    public $description = '';
    public $thumbnail = '';
    public $date = '';
    public $link = null;
    public $tags = array();

    public function getHtml($renderer)
    {
        return $renderer->renderProject($this);
    }
}