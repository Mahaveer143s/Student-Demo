<?php

include 'sqlconnection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $sql = "INSERT INTO classes (name) VALUES ('$name')";
    if ($mysqli->query($sql) === TRUE) {
        header("Location: classes.php");
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

$sql = "SELECT * FROM classes";
$classes = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">School Admin</a>
</nav>
<div class="container">
    <h1 class="my-4 text-primary">Manage Classes</h1>
    <form method="post">
        <div class="form-group">
            <label for="name">Class Name</label>
            <input placeholder="Class Name" type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Class</button>
    </form>
    <a href="index.php" class="btn btn-secondary my-2">Back</a>
    <h2 class="mt-5">Class List</h2>
    <table class="table">
        <thead>
            <tr>
            <th class="text-primary">S.No</th>
                <th class="text-primary">Class Name</th>
                <th class="text-primary">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $classes->fetch_assoc()) { ?>
                <tr>
                    
                <td><?php echo $row['class_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                        <a href="edit_class.php?id=<?php echo $row['class_id']; ?>" class="btn btn-outline-warning btn-sm fs-6 fw-bold"><i class="bi bi-pencil mx-2"></i>Edit</a>
                        <a href="delete_class.php?id=<?php echo $row['class_id']; ?>" class="btn btn-outline-danger btn-sm fs-6 fw-bold"><i class="bi bi-trash mx-2"></i>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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
