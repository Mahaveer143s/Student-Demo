<?php
include 'sqlconnection.php';

$id = $_GET['id'];
$sql = "SELECT student.*, classes.name AS class_name FROM student 
        JOIN classes ON student.class_id = classes.class_id 
        WHERE student.id = $id";
$result = $mysqli->query($sql);
$student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">School Admin</a>
</nav>
<div class="container">
    <h1 class="my-4 text-primary">View Student</h1>
    <div class="row">
        <div class="col-md-4 text-center">
            <img class="profile-image" src="uploads/<?php echo $student['image']; ?>" alt="Profile Image">
        </div>
        <div class="col-md-8">
            <p><strong class="text-primary">Name:</strong> <?php echo $student['name']; ?></p>
            <p><strong class="text-primary">Email:</strong> <?php echo $student['email']; ?></p>
            <p><strong class="text-primary">Address:</strong> <?php echo $student['address']; ?></p>
            <p><strong class="text-primary">Class:</strong> <?php echo $student['class_name']; ?></p>
            <p><strong class="text-primary">Created At:</strong> <?php echo $student['created_at']; ?></p>
            <a href="edit.php?id=<?php echo $student['id']; ?>" class="btn btn-warning">Edit</a>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </div>
    </div>
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
