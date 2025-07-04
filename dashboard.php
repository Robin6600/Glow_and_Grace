<?php
require_once '../db_config.php';

// Security check: if not logged in, redirect to login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-dashboard">
    <header class="admin-header">
        <h1>Admin Dashboard</h1>
        <a href="logout.php">Logout</a>
    </header>

    <main class="admin-main">
        <div class="form-container">
            <h2>Add New Product</h2>
            <form action="manage_product.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="category">Category:</label>
                <select id="category" name="category" required>
                    <option value="Mens Care">Mens Care</option>
                    <option value="Womens Care">Womens Care</option>
                    <option value="Baby Care">Baby Care</option>
                    <option value="Flash Sale">Flash Sale</option>
                </select>
                
                <label for="old_price">Old Price (Optional):</label>
                <input type="number" id="old_price" name="old_price" step="0.01">
                
                <label for="new_price">New Price:</label>
                <input type="number" id="new_price" name="new_price" step="0.01" required>

                <label for="image">Product Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <label for="is_highlighted">Highlight on Homepage?</label>
                <input type="checkbox" id="is_highlighted" name="is_highlighted" value="1">
                
                <button type="submit">Add Product</button>
            </form>
        </div>

        <div class="product-list">
            <h2>Manage Products</h2>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM products ORDER BY id DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><img src='../images/" . htmlspecialchars($row['image']) . "' width='50'></td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                            echo "<td>৳" . htmlspecialchars($row['new_price']) . "</td>";
                            echo "<td><a href='manage_product.php?action=delete&id=" . $row['id'] . "&img=" . $row['image'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No products found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>