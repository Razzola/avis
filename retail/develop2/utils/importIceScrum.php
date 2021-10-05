<?php

    include "checkError.php";
    include "importISSprints.php";
    include "importISStories.php";
    include "importISTasks.php";
    include "importISUsers.php";

    if (isset($_POST["importIS"])) {

        $fileNameIS = $_FILES["fileIS"]["tmp_name"];
        $environment="IceScrum";

        if ($_FILES["fileIS"]["size"] > 0) {

            $xml = simplexml_load_file($fileNameIS) or die("Error: Cannot create object");
            $i=0;

            import_users($xml->project->teams->team->members);
            foreach($xml->project->releases->release->sprints->sprint as $sprint)
            {
                $sprint_id=$sprint->attributes()->id;
                if(!checkExistingSprint($sprint_id))
                    insertSprint($sprint);
                else
                    updateSprint($sprint);

                //Importing sprint's stories
                foreach($sprint->stories->story as $story){
                    $story_id=$story->attributes()->uid;
                    if(!checkExistingStory($story_id))
                        insertStory($story, $sprint_id);
                    else
                        updateStory($story, $sprint_id);

                    //Ingest story's tasks
                    $i=0;
                    foreach($story->tasks->task as $task)
                    {
                        $i++;
                        $task_id=$task->attributes()->uid;
                        if(!checkExistingTasks($task_id))
                            insertTasks($story_id,$task, $sprint_id);
                        else
                            updateTask($story_id,$task, $sprint_id);
                    }
                    if ($story->effort!=0 && $i!=0){
                        $effort=$story->effort/$i;
                        updateTaskEfforts($story_id, $effort);
                    //    echo round($effort,2,PHP_ROUND_HALF_UP)."<br/>";
                    }
                    $i=0;
                    $effort=0;
                }
                //Importing sprint's tasks
                foreach($sprint->tasks->task as $task){
                    $task_id=$task->attributes()->uid;
                    if(!checkExistingTasks($task_id))
                        insertTasks(NULL,$task, $sprint_id);
                    else
                        updateTask(NULL,$task, $sprint_id);
                }
            }

            foreach($xml->project->stories->story as $story)
            {
                $story_id=$story->attributes()->uid;
                if(!checkExistingStory($story_id))
                    insertStory($story, NULL);
                else
                    updateStory($story, NULL);

                //Ingest tasks
                foreach($story->tasks->task as $task)
                {
                    $task_id=$task->attributes()->uid;
                    if(!checkExistingTasks($task_id))
                        insertTasks($story_id,$task, NULL);
                    else
                        updateTask($story_id,$task, NULL);
                }
            }
            echo "pippo";

        }
    }
?>