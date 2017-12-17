<?php
if (isset($_POST['submit']))
{

	try
	{
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);
        // fetch data code will go here

		$sql = "SELECT *
						FROM users
						WHERE location = :location";


// POST in a variable called location
		$location = $_POST['location'];

// Prepares, binds, executes the statement
		$statement = $connection->prepare($sql);
		$statement->bindParam(':location', $location, PDO::PARAM_STR);
		$statement->execute();

//fetches the result
		$result = $statement->fetchAll();

	}

	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<?php include "templates/header.php"; ?>

<h2>Find user based on location</h2>

<form method="post">
	<label for="location">Location</label>
	<input type="text" id="location" name="location">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
