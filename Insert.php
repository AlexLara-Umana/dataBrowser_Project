<?php

include('./ChampionForm.php');

function handleUserInsert() {
    $json_str = file_get_contents("./Data/ChampionB.json");
    $objlist = json_decode($json_str);

    $request = new ChampionForm();
    $request->populateFromPostData();
}

handleUserInsert();
?>
