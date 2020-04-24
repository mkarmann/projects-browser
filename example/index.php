<?php
include(dirname(__DIR__) . '/pb/ProjectBrowser.php');
include(dirname(__DIR__) . '/renderers/SimpleListRenderer.php');

// create a new browser
$pb = new ProjectBrowser();
$pb->title = 'Example Projects';
$pb->copyright = '&copy; 2020 John Doe';

// load the projects from the directory
$projectSection = $pb->loadProjectSection('projects');
if (!$projectSection) {
    print_r($pb->errorMessages);
    exit('Could not load project section');
}

// add some additional notes
$projectSection->name = 'Projects';
$projectSection->description = 'Some example projects';

// add the section to the project browser
$pb->addSection($projectSection);

// return the html to the client
echo $pb->getHtml(new SimpleListRenderer());