<?php

    function checkExistingTasks($task_id){
           $taskIdListIS = $GLOBALS['mysqli']->query("SELECT COUNT(*) FROM `tasks` WHERE id = '".$task_id."'");
           $tasksIdCountIS = $taskIdListIS->fetch_row();
           $tasksIdTotalIS = $tasksIdCountIS[0];
            if($tasksIdTotalIS[0]==0){
                return false;
            }else
                return true;
    }


  function insertTasks($story_id,$task, $sprint_id){
                if ($story_id==NULL)
                    $storystring="NULL";
                else
                    $storystring="'" . $story_id. "'";

                if ($sprint_id==NULL)
                    $sprintstring="NULL";
                else
                    $sprintstring="'" . $sprint_id. "'";

                $impact=getImpact($task->tags);
                //echo $impact;

                 $sqlInsert = "INSERT into tasks (id,summary,date_submitted,reporter,story_id, sprint_id,environment, assigned_to, tags, impact) values (
                 '" . $task->attributes()->uid . "',
                 '" . mysqli_real_escape_string($GLOBALS['mysqli'], $task->name) . "',
                 '" . date("Y-m-d",strtotime($task->dateCreated)) . "',
                 '" . $task->creator->attributes()->uid . "',
                 " . $storystring . ",
                 " . $sprintstring . ",
                 'IceScrum',
                 '" . $task->responsible->attributes()->uid . "',
                 '" . $task->tags . "',
                 '" . $impact . "')";
                 //echo $sqlInsert."<br/>";
                 $resultISTask = mysqli_query($GLOBALS['mysqli'], $sqlInsert);

                 check_error($resultISTask);

    }
    function updateTaskEfforts($story_id, $effort){
                    if ($story_id==NULL)
                        $storystring="NULL";
                    else
                        $storystring="'" . $story_id. "'";

                    $sqlUpdate = "UPDATE tasks
                    SET effort = " . $effort . "
                    WHERE story_id =".$storystring;
                    //echo $sqlUpdate;
                    $result = mysqli_query($GLOBALS['mysqli'], $sqlUpdate);

                    check_error($result);

        }


    function updateTask($story_id,$task, $sprint_id){
            $impact="";
            if ($story_id==NULL)
                $storystring="NULL";
            else
                $storystring="'" . $story_id. "'";

            if ($sprint_id==NULL)
                $sprintstring="NULL";
            else
                $sprintstring="'" . $sprint_id. "'";


            $impact=getImpact($task->tags);
            //echo $impact;

            $sqlUpdate = "UPDATE tasks
            SET summary = '" . mysqli_real_escape_string($GLOBALS['mysqli'], $task->name) . "',
            date_submitted ='" . date("Y-m-d",strtotime($task->dateCreated)) . "',
            reporter = '" . $task->creator->attributes()->uid . "',
            story_id =" . $storystring . ",
            sprint_id =" . $sprintstring . ",
            environment = 'IceScrum',
            assigned_to = '" . $task->responsible->attributes()->uid . "',
            tags = '" . $task->tags. "',
            impact='" . $impact. "'
            WHERE id ='".$task->attributes()->uid."'";
            //echo $sqlUpdate;
            $result = mysqli_query($GLOBALS['mysqli'], $sqlUpdate);

            check_error($result);
     }

     function getImpact($tags){
        $impact="";

        if((strpos($tags, "#frontend")) && (strpos($tags, "#BackEnd"))){
                     $impact="FE + BE";
        }elseif (strpos($tags, "#BackEnd")) {
             $impact="BE";
         }elseif(strpos($tags, "#frontend")){
             $impact="FE";
         }
         return $impact;
     }



?>