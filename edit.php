<?php

include 'sqlconnection.php';
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $class_id = $_POST['class_id'];
    $image = $_FILES['image']['name'];
    $target = "uploads/" . basename($image);

    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE student SET name='$name', email='$email', address='$address', class_id='$class_id', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE student SET name='$name', email='$email', address='$address', class_id='$class_id' WHERE id=$id";
    }

    if ($mysqli->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

$sql = "SELECT * FROM student WHERE id = $id";
$result = $mysqli->query($sql);
$student = $result->fetch_assoc();

$sql = "SELECT * FROM classes";
$classes = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">School Admin</a>
</nav>
<div class="container">
    <h1 class="my-4 text-primary">Edit Student</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $student['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $student['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" class="form-control"><?php echo $student['address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="class_id">Class</label>
                    <div class="row">
                        <div class="col-9">
                        <select name="class_id" class="form-control" id="class-select">
                            <?php while ($row = $classes->fetch_assoc()) { ?>
                                <option value="<?php echo $row['class_id']; ?>" <?php if ($row['class_id'] == $student['class_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                        </div>
                        <div class="col-3">
                        <a href="classes.php" type="button" class="btn btn-outline-primary ml-2" >Add Class</a>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
            <div class="col-md-6 text-center">
                <img id="image-preview" class="profile-image" src="uploads/<?php echo $student['image']; ?>" alt="Profile Image">
                <div class="choose-image-btn">
                    <input type="file" name="image" class="form-control-file" onchange="previewImage(event)">
                </div>
            </div>
        </div>
    </form>
</div>
<footer class="footer">
    <p>&copy; 2024 School Admin</p>
</footer>

<!-- Add Class Modal -->
<div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="classes.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addClassModalLabel">Add Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="class-name">Class Name</label>
                        <input type="text" name="name" class="form-control" id="class-name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add Class</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script></body>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('image-preview');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
</body>
</html>
<?php $mysqli->close(); ?>
