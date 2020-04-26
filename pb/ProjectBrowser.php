<?php
include(__DIR__ . '/HtmlComponent.php');
include(__DIR__ . '/HtmlRenderer.php');
include(__DIR__ . '/Project.php');
include(__DIR__ . '/ProjectSection.php');

/**
 * Class ProjectBrowser
 * Main class for creating the project page
 */
class ProjectBrowser extends HtmlComponent
{
    public $sections = array();
    public $errorMessages = array();
    public $title = 'Project Browser';
    public $copyright = '';

    function loadProjectSection($path)
    {
        if (!isset($path) or $path == null or !file_exists($path)) {
            $this->errorMessages[] = "The load project section parameter $path is not valid";
            return null;
        }

        $projectSection = new ProjectSection();
        $projectSection->name = $path;
        $dirs = scandir($path);
        foreach ($dirs as $kay => $value) {
            if ($value == '.' or $value == '..') {
                continue;
            }
            $proj = $this->loadProject("$path/$value");
            if ($proj) {
                $projectSection->projects[] = $proj;
            }
        }
        $projectSection->sort();

        return $projectSection;
    }

    function loadProject($path)
    {
        if (!isset($path) or $path == null or !file_exists($path)) {
            $this->errorMessages[] = "The load project parameter $path is not valid";
            return null;
        }

        $project = new Project();
        $info_file = $path . '/.pb/info.json';
        if (file_exists($info_file)) {
            $data = json_decode(file_get_contents($info_file));
            foreach ($data as $key => $value) $project->{$key} = $value;
        } else {
            $this->errorMessages[] = $info_file . ' was not found and the project was loaded empty';
            $project->name = $path;
        }
        if ($project->link == null) {
            $project->link = "./$path";
        }

        if ($project->thumbnail == null) {
            $project->thumbnail = "./$path/.pb/thumbnail.png";
        }

        return $project;
    }

    public function addSection($Section)
    {
        $this->sections[] = $Section;
    }

    public function getHtml($renderer)
    {
        return $renderer->renderProjectBrowser($this);
    }
}