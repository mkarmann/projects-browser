<?php


abstract class HtmlRenderer
{
    abstract public function renderProjectBrowser($projectBrowser);

    abstract public function renderProject($project);

    abstract public function renderProjectSection($projectSection);
}