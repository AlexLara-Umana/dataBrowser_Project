<?php
include "CreateChampClass.php";
include "ConnectDB.php";

// gets a single champion from the db 
if (isset($_POST["Index"])) {
	$index =(int)$_POST["Index"];

	// Selection of data 
	$sql = "SELECT pkey, title, year, length, rating, synopsis, recommended, img_path FROM champTBL WHERE pkey=". $index;
	$result = $conn->query($sql);

	//if the row exists from query, get it and assign row's col-name 
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$newMovie=new Champ();
		$newMovie->movie_id=($row["pkey"]);
		$newMovie->title=($row["title"]);
		$newMovie->year=($row["year"]);
		$newMovie->length=($row["length"]);
		$newMovie->rating=($row["rating"]);
		$newMovie->synopsis=$row["synopsis"];
		$newMovie->recommended=($row["recommended"]);
		$newMovie->img_path=($row["img_path"]);
		}

		$movie = json_encode([$newMovie]);
		echo $movie;
	}else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}
}

// gets the entire table of champions
if (isset($_POST["array"])) {

	$sql = "SELECT COUNT(*) AS Total FROM champTBL;";
	$result = $conn->query($sql);
	$total = $result->fetch_assoc();
	$total = $total["Total"];
	
	// Selection of data 
	$sql = "SELECT pkey, title, year, length, rating, synopsis, recommended, img_path FROM champTBL";
	$result = $conn->query($sql);

   
	$i=0;
	$movies_arr= Array();
	//if the row exists from our query, get it and assign row's col-name 
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$newMovie=new Champ();
		$newMovie->movie_id=($row["pkey"]);
		$newMovie->title=($row["title"]);
		$newMovie->year=($row["year"]);
		$newMovie->length=($row["length"]);
		$newMovie->rating=($row["rating"]);
		$newMovie->synopsis=$row["synopsis"];
		$newMovie->recommended=($row["recommended"]);
		$newMovie->img_path=($row["img_path"]);
		$movies_arr[$i]=$newMovie;
		$i+=1;
		}
		$movies_arr[$i]= $total;
		$movies = json_encode($movies_arr);
		echo $movies;
	}else {
		$bad1=[ 'bad' => 1];
		echo json_encode($bad1);	
	}

	$conn->close();
}
?>