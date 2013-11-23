<?php

require("config.php");
$action = isset($_GET['action']) ? $_GET['action'] : "";

switch ($action){
    case 'archive':
        archive();
        break;
    case 'viewProject':
        viewProject();
        break;
    default:
        homepage();
        break;
    }

/*
 * @brief Function for setting up the archive page
 */

function archive(){
    $results=array();
    $data = Project::getList();
    $results['projects'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "Projects";
    
    require(TEMPLATE_PATH."/archive.template.php");
    
    }

/*
 * @brief Function to prepare the Project Page
 */

function viewProject(){
    if( !isset($_GET['projectID']) || !$_GET['projectID'] ){
        homepage();
        return;
        }
    
    $results = array();
    $results['project'] = Project::getById( (int)$_GET['projectID'] );
    $results['pageTitle'] = result['project']->title;
    
    require(TEMPLATE_PATH."/project.template.php");
    
    }

/*
 * @brief Function to prepare the homepage
 */

function homepage(){
    $results = array();
    $data = Project::getList(HOMEPAGE_NUM_ARTICLES);
    $results['projects'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    $results['pageTitle'] = "HomePage";
    
    require(TEMPLATE_PATH."/homepage.template.php");
    
    }
