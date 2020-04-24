<?php
include(dirname(__DIR__) . '/pb/ProjectBrowser.php');
include(dirname(__DIR__) . '/pb/renderers/SimpleCardListRenderer.php');

// create a new browser
$pb = new ProjectBrowser();
$pb->title = 'My Projects';
$pb->copyright = '&copy; 2020 John Doe';

// load the projects from the directory
$projectSection = $pb->loadProjectSection('projects');
if (!$projectSection) {
    print_r($pb->errorMessages);
    exit('Could not load project section');
}

// add some additional notes
$projectSection->name = 'My Projects';
$projectSection->description = 'Here are my projects';

// add the section to the project browser
$pb->addSection($projectSection);

// return the html to the client
echo $pb->getHtml(new SimpleCardListRenderer());