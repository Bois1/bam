<?php


namespace fingerprint;

require_once("./helpers/helpers.php");
require_once("./querydb.php");

session_start();


if(!empty($_POST["data"])) {
    $user_data = json_decode($_POST["data"]);
    $user_id = $user_data->id;
    //this is not necessarily index_finger it could be
    //any finger we wish to identify
    $pre_reg_fmd_string = $user_data->index_finger[0];

    $hand_data = json_decode(getUserFmds($user_id));

    $enrolled_fingers = [
        "index_finger" => $hand_data[0]->indexfinger,
        "middle_finger" => $hand_data[0]->middlefinger
    ];


    $json_response = verify_fingerprint($pre_reg_fmd_string, $enrolled_fingers);
    $json_response = trim($json_response, '"'); // Remove extra quotes
    if($json_response == "match"){
        $_SESSION['username'] = $hand_data[0]->name;
        echo $json_response;
    }
    else{
        // echo $json_response;
        echo json_encode("failed");
    }
}
else{
    echo "post request with 'data' field required";
}