<?php
include('./ChampionForm.php');

class ChampionDB {
    function __construct($collection) {
        $this->collection = $collection;
    }

    function findNumber($num) {
        if ($num == null) {
            return $this;
        }
        $newColl = [];
        foreach ($this->collection as $Champion) {
            if ($Champion->num == $num) {
                array_push($newColl, $Champion);
            }
        }
        return new ChampionDB($newColl);
    }

    function findName($name) {
        $newColl = [];
        foreach ($this->collection as $Champion) {
            if (str_contains(strtolower($Champion->name), strtolower($name))) {
                array_push($newColl, $Champion);
            }
        }
        return new ChampionDB($newColl);
    }

    function findOrigin($origin) {
        $newColl = [];
        foreach ($this->collection as $Champion) {
            if (str_contains(strtolower($Champion->origin), strtolower($origin))) {
                array_push($newColl, $Champion);
            }
        }
        return new ChampionDB($newColl);
    }

    function findClass($class) {
        $newColl = [];
        foreach ($this->collection as $Champion) {
            if (str_contains(strtolower($Champion->class), strtolower($class))) {
                array_push($newColl, $Champion);
            }
        }
        return new ChampionDB($newColl);
    }

    function findAlias($alias) {
        $newColl = [];
        foreach ($this->collection as $Champion) {
            if (str_contains(strtolower($Champion->alias), strtolower($alias))) {
                array_push($newColl, $Champion);
            }
        }
        return new ChampionDB($newColl);
    }

    function findRole($role) {
        $newColl = [];
        foreach ($this->collection as $Champion) {
            if (str_contains(strtolower($Champion->role), strtolower($role))) {
                array_push($newColl, $Champion);
            }
        }
        return new ChampionDB($newColl);
    }

function handleUserQuery() {

    // get data from json db and store in champion db class to allow easy searching
    $json_str = file_get_contents("./Data/ChampionB.json");
    $objlist = json_decode($json_str);
    $db = new ChampionDB($objlist);

    $request = new ChampionForm();
    $request->populateFromPostData();

    $queryResult = $db->findNumber($request->attributes["number"])
                        ->findName($request->attributes["name"])
                        ->findOrigin($request->attributes["origin"])
                        ->findClass($request->attributes["class"])
                        ->findAlias($request->attributes["alias"])
                        ->findRole($request->attributes["role"]);
    echo json_encode($queryResult);
}

handleUserQuery();
?>
