<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('db.php');

// Check if the user is logged in and if they are an admin
if (!isset($_SESSION['user_email']) || $_SESSION['user_email'] != 'admin@managadgetz.com') {
    echo "<script>window.location.href = '../index.php';</script>";
    exit();
}

// Fetch the list of products if the user is an admin
if ($conn) {
    $products = [];
    $result = $conn->query("SELECT * FROM products");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        die("Error fetching products: " . $conn->error);
    }
} else {
    die("Database connection error.");
}

// Handle form submission to add a product
if (isset($_POST['add_product'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);
    $price = $conn->real_escape_string($_POST['price']);
    $image = $_FILES['image']['name'];

    // Validate the form inputs
    if (empty($name) || empty($description) || empty($category) || empty($price) || empty($image)) {
        $_SESSION['error'] = "All fields are required!";
    } else {
        // Define the upload directories
        $target_dir_current = "uploads/";      // Current folder
        $target_dir_parent = "../uploads/";    // Parent folder

        // Generate the full paths for both locations
        $target_file_current = $target_dir_current . basename($image);
        $target_file_parent = $target_dir_parent . basename($image);

        // Ensure both directories exist
        if (!file_exists($target_dir_current)) {
            mkdir($target_dir_current, 0755, true);
        }
        if (!file_exists($target_dir_parent)) {
            mkdir($target_dir_parent, 0755, true);
        }

        // Attempt to move the uploaded file to both directories
        $upload_current_success = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_current);
        $upload_parent_success = copy($target_file_current, $target_file_parent);

        if ($upload_current_success && $upload_parent_success) {
            // Save the path from the current directory to the database
            $relative_path = $target_file_current;

            // Insert new product into the database
            $stmt = $conn->prepare("INSERT INTO products (image, name, description, category, price) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssd", $relative_path, $name, $description, $category, $price);

            if ($stmt->execute()) {
                // Redirect to refresh the page
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['error'] = "Error adding product: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $_SESSION['error'] = "Failed to upload image to both directories.";
        }
    }
}

// Handle product update
if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);
    $price = $conn->real_escape_string($_POST['price']);

    // If a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target_dir_current = "uploads/";
        $target_dir_parent = "../uploads/";

        // Ensure directories exist
        if (!file_exists($target_dir_current)) mkdir($target_dir_current, 0755, true);
        if (!file_exists($target_dir_parent)) mkdir($target_dir_parent, 0755, true);

        // Generate the full paths
        $target_file_current = $target_dir_current . basename($image);
        $target_file_parent = $target_dir_parent . basename($image);

        // Validate image file
        $file_type = strtolower(pathinfo($target_file_current, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_type, $allowed_types)) {
            $_SESSION['error'] = "Only image files (jpg, jpeg, png, gif) are allowed.";
            exit();
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_current)) {
            if (copy($target_file_current, $target_file_parent)) {
                $relative_path = $target_file_current; // Use the new image
            } else {
                $_SESSION['error'] = "Failed to copy image to the parent directory.";
                exit();
            }
        } else {
            $_SESSION['error'] = "Failed to upload image.";
            exit();
        }
    }

    // Update the product details in the database
    $stmt = $conn->prepare("UPDATE products SET image = ?, name = ?, description = ?, category = ?, price = ? WHERE id = ?");
    $stmt->bind_param("ssssdi", $relative_path, $name, $description, $category, $price, $product_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Product updated successfully.";
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
    } else {
        $_SESSION['error'] = "Error updating product: " . $stmt->error;
        echo "<script>window.location.href = 'index.php';</script>";
        exit();
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
    <div class="d-flex justify-content-between align-items-center">
    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
    <form action="logout.php" method="POST">
        <button type="submit" style="background-color: red; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">Logout</button>
    </form>
</div>


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
                        
                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <!-- Edit Button -->
                            <button 
                                class="btn btn-primary me-2" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editProductModal<?= $product['id'] ?>">
                                Edit
                            </button>
                            
                            <!-- Delete Button -->
                            <form action="delete_product.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <button type="submit" name="delete_product" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Editing Product -->
            <div class="modal fade" id="editProductModal<?= $product['id'] ?>" tabindex="-1" aria-labelledby="editProductModalLabel<?= $product['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel<?= $product['id'] ?>">Edit Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                
                                <div class="mb-3">
                                    <label for="image<?= $product['id'] ?>" class="form-label">Product Image</label>
                                    <input type="file" name="image" class="form-control" id="image<?= $product['id'] ?>">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="name<?= $product['id'] ?>" class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control" id="name<?= $product['id'] ?>" value="<?= $product['name'] ?>" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description<?= $product['id'] ?>" class="form-label">Product Description</label>
                                    <textarea name="description" class="form-control" id="description<?= $product['id'] ?>" rows="4" required><?= $product['description'] ?></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="category<?= $product['id'] ?>" class="form-label">Select Category</label>
                                    <select name="category" class="form-control" id="category<?= $product['id'] ?>" required>
                                        <option value="iphone16" <?= $product['category'] === 'iphone16' ? 'selected' : '' ?>>iPhone 16</option>
                                        <option value="iphone15" <?= $product['category'] === 'iphone15' ? 'selected' : '' ?>>iPhone 15</option>
                                        <option value="iphone14" <?= $product['category'] === 'iphone14' ? 'selected' : '' ?>>iPhone 14</option>
                                        <option value="iphone13" <?= $product['category'] === 'iphone13' ? 'selected' : '' ?>>iPhone 13</option>
                                        <option value="iphone12" <?= $product['category'] === 'iphone12' ? 'selected' : '' ?>>iPhone 12</option>
                                        <option value="iphone11" <?= $product['category'] === 'iphone11' ? 'selected' : '' ?>>iPhone 11</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="price<?= $product['id'] ?>" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" id="price<?= $product['id'] ?>" step="0.01" value="<?= $product['price'] ?>" required>
                                </div>
                                
                                <button type="submit" name="update_product" class="btn btn-success w-100">Save Changes</button>
                            </form>
                        </div>
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
