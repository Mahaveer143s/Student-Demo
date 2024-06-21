<?php
include'sqlconnection.php';

$class_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM classes WHERE class_id = $class_id";
    if ($mysqli->query($sql) === TRUE) {
        header("Location: classes.php");
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

$sql = "SELECT * FROM classes WHERE class_id = $class_id";
$result = $mysqli->query($sql);
$class = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">School Admin</a>
</nav>
<div class="container">
    <h1 class="my-4 text-primary">Delete Class</h1>
    <p>Are you sure you want to delete the following class?</p>
    <p><strong class="text-primary">Class Name:</strong> <?php echo $class['name']; ?></p>
    <form method="post">
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="classes.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<footer class="footer">
    <p>&copy; 2024 School Admin</p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script></body>
</body>
</html>
<?php $mysqli->close(); ?>
