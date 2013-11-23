<?php

    require("config.php");
    session_start();
    $action = isset($_GET['action']) ? $_GET['action'] : "";
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
    
    switch ($action){
        case "login":
            login();
            break;
        
        case "logout":
            logout();
            break;
        
        case "newProject":
            newProject();
            break;
        
        case "editProject":
            editProject();
            break;
        
        case "delProject":
            delProject();
            break;
        
        default:
            listProjects();
            break;
        
        }

    /*
     * @brief Function to login
     */

    function login(){
        
        $results = array();
        $results['pageTitle'] = "Admin Page";
        
        /* Check if there is a login */
        if(isset($_POST['login'])){
            
            /* Check ADMIN credentials */ 
            if($_POST['username']==ADMIN_USERNAME && hash("sha512",$_POST['password'])==ADMIN_PASSWORD){
                $_SESSION['username'] = ADMIN_USERNAME;
                header("Location: admin.php");
            
            /* USERNAME AND PASSWORD MISSMATCH include the loginform view*/
            } else {
                $results['errorMessage'] = "Incorrect Username and/or Password. Please Try Again";
                require(TEMPLATE_PATH."/admin/loginform.view.php")
                }
                
        /* If no login then include the loginform view */
        } else {
            require(TEMPLATE_PATH."/admin/loginform.view.php");
        }
        
        }
     
    /*
     * @brief function to logout the admin user
     */ 
        
    function logout(){
        unset($_SESSION['username']);
        header("Location: admin.php");
        }

    /*
     * @brief Functon to creat a new project
     */

    function newProject(){
        
        $results = array();
        $results['pageTitle'] = "New Project";
        $results['formAction'] = "newProject";
        
        /* Check if the changes are saved */
        
        if(isset($_POST['saveChanges'])){
            $project = new Project();
            $project->storeValues($_POST);
            $project->insert();
            header("Location: admin.php");
        
        /* If changes are canceled */
        
        } elif (isset($_POST['cancel'])){
            
            header("Location: admin.php");
        
        /* If the user has not posted the article yet  */
        
        } else {
            $results['project'] = new Project();
            require( TEMPLATE_PATH."/admin/editProject.view.php");
        }
        
    }
    
    /*
     * @breif Function to edit a project
     */
     
    function editProject(){
        $results=array();
        $results['pageTitle']="Edit Projecy";
        $results['formAction'] = "editProject";
        
        if(isset($_POST['saveChanges'])){
            
            if(!$article=Project::getById((int) $_POST['projectID'])){
                header("Location: admin.php?error=projectNotFound");
                return;
                }
            
            $article->storeValues($POST);
            $article->update();
            header("Location: admin.php?status=changesSaved");
            
            } elseif (isset( $_POST['cancel'])){
                
                header("Location: admin.php");
                
            } else {
                $results['project']=Project::getById((int)$_GET['projectID']);
                require(TEMPLATE_PATH."/admin/editProject.view.php");
            }
     
     }
     
     /*
      * @brief Function to delete the current Project
      */
      
      function delProject(){
          
          if(!$article=Project::getById((int)$_GET['projectID'])){
              header("Location: admin.php?error=articleNotFound");
              return;
              }
            $article->delete();
            header("Location: admin.php?status=projectDeleted");
          
          }
    
    /*
     * @brief Function to get All Articles
     */
     
     function listProjects(){
         $results=array();
         $data = Project::getList();
         $results['projects']=$data['results'];
         $results['totalRows']=$data['totalRows'];
         $results['pageTitle']="All Projects";
         
         if(isset($_GET['error'])){
             if($_GET['error']=="projectNotFound") $results['errorMessage']="Error: Project Not Found";
        }
        
        if(isset($_GET['status'])){
            if($_GET['status']=="changesSaved") $results['statusMessage']="Changes Saved";
            if($_GET['status']=="projectDeleted") $results['statusMessage']="Project Deleted";
        }
        
        require(TEMPLATE_PATH."/admin/listProjects.view.php");

    }
