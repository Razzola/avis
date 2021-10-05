<?php


    function checkExistingStory($story_id){
       $storyIdListIS = $GLOBALS['mysqli']->query("SELECT COUNT(*) FROM `tickets` WHERE id ='".$story_id."' ");
       $storyIdCountIS = $storyIdListIS->fetch_row();
       $storyIdTotalIS = $storyIdCountIS[0];
        if($storyIdTotalIS[0]==0){
            return false;
        }else
            return true;
  }
    function insertStory($story, $sprint_id){
        if ($sprint_id==NULL)
            $sprintstring="NULL";
        else
            $sprintstring="'" . $sprint_id. "'";

         $impact=getImpact($story->tags);
         //echo $impact;

        $sqlInsert = "INSERT into tickets (id,environment,summary,date_submitted,reporter, feature, value, effort, sprint_id, tags,impact) values (
        '" . $story->attributes()->uid . "',
        'IceScrum',
        '" . mysqli_real_escape_string($GLOBALS['mysqli'], $story->name) . "',
        '" . date("Y-m-d",strtotime($story->dateCreated)) . "',
        '" . $story->creator->attributes()->uid . "',
        '" . $story->feature->attributes()->uid . "',
        '" . $story->value . "',
        '" . $story->effort . "',
        " . $sprintstring . ",
        '" .$story->tags . "',
        '" . $impact . "'
        )";
        //echo $columnBT[0]."<br/>";
        //echo $sqlInsert."<br/>";
        $result = mysqli_query($GLOBALS['mysqli'], $sqlInsert);

        check_error($result);
    }

     function updateStory($story, $sprint_id){
        if ($sprint_id==NULL)
            $sprintstring="NULL";
        else
            $sprintstring="'" . $sprint_id. "'";

         $impact=getImpact($story->tags);
                 //echo $impact;


        $sqlUpdate = "UPDATE tickets
        SET summary = '" . mysqli_real_escape_string($GLOBALS['mysqli'], $story->name) . "',
        date_submitted ='" . date("Y-m-d",strtotime($story->dateCreated)) . "',
        reporter = '" . $story->creator->attributes()->uid . "',
        feature = '" . $story->feature->attributes()->uid . "',
        value = '" . $story->value . "',
        effort = '" . $story->effort . "',
        sprint_id = " . $sprintstring . ",
        tags = '" . $story->tags. "',
        impact='" . $impact. "'
        WHERE id ='".$story->attributes()->uid."' AND environment = 'Icescrum'";
        //echo $columnBT[2];
        //echo $sqlUpdate."<br/>";
        $result = mysqli_query($GLOBALS['mysqli'], $sqlUpdate);

        check_error($result);
     }


?>