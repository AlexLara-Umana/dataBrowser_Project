<?php
    include "ConnectDB.php";

    // gets the id of the current champion that matches the pkey in our db, then access the db and delete the row it's on
    if (isset($_POST['movie_id'])){$input_movie_id = $_POST['movie_id'];};

    $sql = "DELETE FROM champTBL WHERE pkey = $input_movie_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
      } else {
        echo "delete champion Error: " . $sql . "<br>" . $conn->error;
      }
    $conn->close();

    header("Location:./Champ.html");
?>
