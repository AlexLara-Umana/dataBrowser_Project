
<?php
class ChampionForm {
    function __construct() {
        $this->attributes = [
            "number" => "",
            "name" => "",
            "origin" => "",
            "class" => "",
            "alias" => "",
            "role" => ""
        ];
    }

    function populateFromPostData() {
        foreach ($this->attributes as $key => $value) {
            $this->attributes[$key] = $_POST[$key];
        }
    }
}
?>
