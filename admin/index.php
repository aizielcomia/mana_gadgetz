<?php
session_start();
include('db.php'); 

// Fetch the list of products
if ($db) {
    $products = $db->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
} else {
    die("Database connection error.");
}


// Handle form submission to add a product
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    // Validate the form inputs
    if (empty($name) || empty($description) || empty($category) || empty($price) || empty($image)) {
        $_SESSION['error'] = "All fields are required!";
    } else {
        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert new product into database
            $stmt = $db->prepare("INSERT INTO products (image, name, description, category, price) VALUES (?, ?, ?, ?, ?)");

            $stmt->execute([$target_file, $name, $description, $category, $price]);


            // Redirect to refresh the page
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Failed to upload image.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <style>
        /* General styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin-top: 20px;
        }

        .container {
            margin-top: 30px;
        }

        /* Product Card Styles */
        .card {
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-img-top {
            border-radius: 8px 8px 0 0;
            object-fit: cover;
            height: 200px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
            color: #555;
        }

        button {
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #6f42c1;
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 12px;
            overflow: hidden;
        }

        .modal-header {
            background-color: #6f42c1;
            color: white;
            border-bottom: none;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            border-top: none;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Form Input Styles */
        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
        }
    </style>
</head>
<body>

<!-- Display error messages if any -->
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="container">
    <h1 class="text-center my-4">Product Management</h1>

    <!-- Button to trigger modal for adding a product -->
    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

    <!-- Product List -->
    <div class="product-list mt-4">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= $product['image'] ?>" class="card-img-top" alt="<?= $product['name'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text"><?= $product['description'] ?></p>
                            <p class="card-text"><?= $product['category'] ?> - $<?= number_format($product['price'], 2) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Modal for Adding Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control" id="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-3">
                        <label for="category" class="form-label">Select Category</label>
                        <select name="category" class="form-control" id="category" required>
                            <option value="iphone16">iPhone 16</option>
                            <option value="iphone15">iPhone 15</option>
                            <option value="iphone14">iPhone 14</option>
                            <option value="iphone13">iPhone 13</option>
                            <option value="iphone12">iPhone 12</option>
                            <option value="iphone11">iPhone 11</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price" step="0.01" required>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-success w-100">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
