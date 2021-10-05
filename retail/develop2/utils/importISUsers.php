<?php


        function checkExistingUsers($user_id){
                   $userIdListIS = $GLOBALS['mysqli']->query("SELECT COUNT(*) FROM `users` WHERE uid ='".$user_id."' ");
                   $usersIdCountIS = $userIdListIS->fetch_row();
                   $usersIdTotalIS = $usersIdCountIS[0];
                    if($usersIdTotalIS[0]==0){
                        return false;
                    }else
                        return true;
            }


          function insertUsers($user){
                         $sqlInsert = "INSERT into users (uid,id,firstname,lastname, user) values (
                         '" . $user->attributes()->uid . "',
                         '" . $user->id . "',
                         '" . $user->firstName . "',
                         '" . $user->lastName . "',
                         '" . $user->username . "')";
                         //echo $sqlInsert."<br/>";
                         $resultISTask = mysqli_query($GLOBALS['mysqli'], $sqlInsert);

                         check_error($resultISTask);

            }


            function updateUsers($user){
                    $sqlUpdate = "UPDATE users
                    SET id = '" . $user->id . "',
                    firstname ='".$user->firstName."',
                    lastname ='".$user->lastName."',
                    user ='".$user->username."'
                    WHERE uid ='".$user->attributes()->uid."'";
                    //echo $sqlUpdate;
                    $result = mysqli_query($GLOBALS['mysqli'], $sqlUpdate);

                    check_error($result);
                 }


            function import_users($users){
                foreach($users->user as $user)
                {
                    $user_id=$user->attributes()->uid;
                    if(!checkExistingUsers($user_id))
                        insertUsers($user);
                    else
                        updateUsers($user);
                }
            }
?>