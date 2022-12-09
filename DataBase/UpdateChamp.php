<?php
    include 'ConnectDB.php';
    include 'UploadFile.php';

    // gets form post inputs
    if (isset($_POST['title'])){$set_title =  mysqli_real_escape_string($conn, $_POST['title']);};
    if (isset($_POST['year'])){$set_year = $_POST['year'];};
    if (isset($_POST['rating'])){$set_rating = $_POST['rating'];};
    if (isset($_POST['length'])){$set_length = $_POST['length'];};
    if (isset($_POST['recommended'])){$set_rec = $_POST['recommended'];};
    if (isset($_POST['synopsis'])){$set_synopsis =  mysqli_real_escape_string($conn, $_POST['synopsis']);};
    if (isset($_POST['movie_id'])){$set_movie_id = $_POST['movie_id'];};
 
    // gets the current image
    $sql = "SELECT img_path AS Img_path FROM champTBL WHERE pkey = $set_movie_id";
    $result = $conn->query($sql);
    $curr_img = $result->fetch_assoc();
    $curr_img = $curr_img["Img_path"];

    // gets the input image
    $input_path = basename($_FILES["img_path"]["name"]);

    // if the image exists in the table, but it was not updated, keep the same image
    if($input_path == NULL && $curr_img != NULL){
      echo '<br> not chosen but img already in db:'.$curr_img.'<br>';
      $set_img_path = $curr_img;
    }
    // if no image is chosen and/or it doesn't exist in the table, then no image is shown
    else if($input_path == NULL && $curr_img == NULL){
      echo '<br> not chosen, no img in db:'.$curr_img.'<br>';
      $set_img_path = NULL;
    }
    // if image is chosen, but already exists in our local folder or it was uploaded correctly
    else if(file_exists('Assets/'.$input_path) || $uploadOk == 1){
      echo '<br> img already in folder or it was uploaded correctly:'.'Assets/'.$input_path.'<br>';
      $set_img_path = 'Assets/'.$input_path;
    }
    else{
      // the image to folder upload failed
      if ($uploadOk == 0){echo ($message);} 
    }
    
    $sql = "UPDATE champTbL SET title ='$set_title', year='$set_year', rating='$set_rating', length='$set_length', recommended='$set_rec', synopsis='$set_synopsis',img_path='$set_img_path' WHERE pkey = $set_movie_id";
    
    if ($conn->query($sql) === TRUE) {
      echo $set_title . " record updated successfully";
    } else {
        echo "add_item Error: " . $sql . "<br>" . $conn->error;
    }
  
    $conn->close();
    header("Location: ./Champ.html");
?>