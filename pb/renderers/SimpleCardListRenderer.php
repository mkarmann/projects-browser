<?php

class SimpleCardListRenderer extends HtmlRenderer
{

    public function renderProjectBrowser($projectBrowser)
    {
        $body_content = '';
        foreach ($projectBrowser->sections as $section) {
            $body_content .= $section->getHtml($this);
        }
        $main_css = file_get_contents(__DIR__ . '/css/light.css');
        $page = "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"utf-8\" /> 
        <meta name=\"viewport\" content=\"initial-scale=0.5, maximum-scale=0.5\">
        <title>$projectBrowser->title</title>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"//fonts.googleapis.com/css?family=Open+Sans\" />
        <style>
        $main_css
        </style>
    </head>
    <body>
    $body_content
    </body>
</html>";
        return $page;
    }

    public function renderProject($project)
    {
        $tags = implode(' - ', $project->tags);
        $date = date_create_from_format('Y-m-d', $project->date)->format('M. Y');
        return "<a href=\"$project->link\">
            <div class=\"proj-container\">
                <img src=\"$project->thumbnail\" class=\"thumbnail\">
                <div class=\"command\">
                    Open
                </div>
                <div class=\"text\">
                    <div class=\"headline\">$project->name</div>
                    $project->shortDescription
                </div>
                <div class=\"hint-bot\">
                    $tags
                </div>
                <div class=\"hint-top\">
                    $date
                </div>
            </div>
        </a>";
    }

    public function renderProjectSection($projectSection)
    {
        $section_content = '';
        foreach ($projectSection->projects as $project) {
            $section_content .= $project->getHtml($this);
        }
        return "
<h2 class=\"title\">$projectSection->name</h2>
<div style=\"text-align: center; color: #777; line-height: 3em;\">$projectSection->description</div>
<div class=\"list\">
    $section_content
</div>";
    }
}