<?php
include 'sqlconnection.php';
$search = $_GET['search'] ?? '';
$class_filter = $_GET['class'] ?? '';

$sql = "SELECT student.*, classes.name AS class_name FROM student 
        JOIN classes ON student.class_id = classes.class_id";

if ($search) {
    $sql .= " WHERE student.name LIKE '%$search%' OR classes.name LIKE '%$search%'";
}

if ($class_filter) {
    $sql .= $search ? " AND" : " WHERE";
    $sql .= " classes.class_id = $class_filter";
}

$result = $mysqli->query($sql);

$classes_result = $mysqli->query("SELECT * FROM classes");
$classes = $classes_result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">School Admin</a>
    </nav>
    <div class="container">
        <h1 class="my-4 text-primary">Students</h1>
        <div class="d-flex justify-content-between mb-4">
            <form method="get">
                <div class="row">
                    <div class="col-lg-5"> <input class="form-control mr-sm-2" type="search" name="search"
                            placeholder="Search By Name" value="<?php echo $search; ?>">
                    </div>
                    <div class="col-lg-4"> <select class="form-control mr-sm-2" name="class">
                            <option value="">All Classes</option>
                            <?php foreach ($classes as $class) { ?>
                                <option value="<?php echo $class['class_id']; ?>" <?php if ($class_filter == $class['class_id'])
                                       echo 'selected'; ?>><?php echo $class['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search <i class="bi bi-search"></i></button>

                    </div>
                </div>
        
        </form>
        <a href="create.php" class="btn btn-primary fs-5">Add Student<i class="bi bi-person-add mx-2"></i></a>
    </div>
    <div class="table-data">
    <table class="table">
        <thead>
            <tr>
            <th class="text-primary">S.No</th>
                <th class="text-primary">Name</th>
                <th class="text-primary">Email</th>
                <th class="text-primary">Class</th>
                <th class="text-primary">Image</th>
                <th class="text-primary">Actions</th>
            </tr>
        </thead>
        <tbody style="overflow:scroll; height:480px;">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['class_name']; ?></td>
                    <td><img src="uploads/<?php echo $row['image']; ?>" alt="Student Image"></td>
                    <td class="action-icons">
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-info fw-bold btn-sm fs-6">
                            <i class="bi bi-eye mx-2"></i>View
                        </a>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-warning fw-bold btn-sm fs-6">
                            <i class="bi bi-pencil mx-2"></i>Edit
                        </a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger fw-bold btn-sm fs-6">
                            <i class="bi bi-trash mx-2"></i> Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
    </div>
    <footer class="footer">
        <p>&copy; 2024 School Admin</p>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>
<?php $mysqli->close(); ?>