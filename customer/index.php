<?php
$title = "หน้าแรก";
include("navbar.php");

$sql = "SELECT * FROM restaurant";
$result = $conn->query($sql);

if (isset($_POST["restaurant_name"])) {
    $restaurant_name = $_POST["restaurant_name"];
    $sql = "SELECT * FROM restaurant WHERE restaurant_name LIKE '%$restaurant_name%'";
    $result = $conn->query($sql);
}
?>

<body data-bs-theme="dark">
    <div class="d-flex justify-content-center flex-wrap">
        <form class="input-group mt-3 mb-3 container" action="" method="post">
            <input type="text" class="form-control" placeholder="Search Restaurant" name="restaurant_name">
            <button type="submit" class="btn btn-primary bg-primary-subtle text-primary-emphasis">Search</button>
        </form>
        <?php
        while ($row = $result->fetch_assoc()) {
            $image = $row['image'];
            $restaurant_name = $row['restaurant_name'];
            $restaurant_type = $row['restaurant_type'];
            $restaurant_address = $row['address'];
            $id = $row['id'];
            echo "
            <div class='card m-2' style='min-width:25vw;'>
                <img src='../restaurant/$image' class='card-img-top' alt='...' style='max-height: 250px;'>
                <div class='card-body position-relative'>
                    <span class='bg-warning badge rounded-pill position-absolute translate-middle-y top-0 fs-6'>
                        $restaurant_type
                    </span>
                    <h2 class='card-title'>$restaurant_name</h2>
                    <p class='card-subtitle'>$restaurant_address</p>
                    <div class='btn-group float-end'>
                        <a href='restaurant.php?id=$id' class='btn btn-primary bg-primary-subtle text-primary-emphasis'>View</a>
                        <a class='btn btn-warning bg-warning-subtle text-warning-emphasis'>Review</a>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>