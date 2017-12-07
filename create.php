<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit']))
{
	
	require "/config.php";
	require "/common.php";

	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_user = array(
			"topicname" => $_POST['topicname'],
			"topic#"  => $_POST['topic#'],
			"username"     => $_POST['username'],
			"age"       => $_POST['age'],
			"location"  => $_POST['location']
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"users",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_user);
	}

	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<?php require "templates/header.php"; ?>

<?php 
if (isset($_POST['submit']) && $statement) 
{ ?>
	<blockquote><?php echo $_POST['topicname']; ?> successfully added.</blockquote>
<?php 
} ?>

<h2>Add a user</h2>

<form method="post">
	<label for="topicname">Topic Name</label>
	<input type="text" name="topicname" id="topicname">
	<label for="topic#">Topic Number</label>
	<input type="text" name="topic#" id="topic#">
	<label for="username">User Name</label>
	<input type="text" name="username" id="username">
	<label for="age">Age</label>
	<input type="text" name="age" id="age">
	<label for="location">Location</label>
	<input type="text" name="location" id="location">
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>