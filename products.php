<?php require_once 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php
        // Dynamically set title based on category
        $category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : 'All Products';
        echo "<title>Glow & Grace - $category</title>";
    ?>
</head>
<body>

    <header>
        <div class="logo-container">
            <h1 class="logo">Glow & Grace</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php?category=Flash Sale" class="<?php echo ($category == 'Flash Sale' ? 'active' : ''); ?>">Flash Sale</a></li>
                <li><a href="products.php?category=Mens Care" class="<?php echo ($category == 'Mens Care' ? 'active' : ''); ?>">Mens Care</a></li>
                <li><a href="products.php?category=Womens Care" class="<?php echo ($category == 'Womens Care' ? 'active' : ''); ?>">Womens Care</a></li>
                <li><a href="products.php?category=Baby Care" class="<?php echo ($category == 'Baby Care' ? 'active' : ''); ?>">Baby Care</a></li>
                <li><a href="admin/">Admin</a></li>
                <li><a href="#">About</a></li>
            </ul>
            <div class="theme-switcher">
                <button id="theme-toggle">🌙</button>
            </div>
        </nav>
    </header>

    <main>
        <section class="product-page">
            <h2><?php echo $category; ?></h2>
            <div class="product-grid">
                <?php
                if ($category == 'All') {
                    $sql = "SELECT * FROM products ORDER BY id DESC";
                } else {
                    $sql = "SELECT * FROM products WHERE category = ? ORDER BY id DESC";
                }
                
                $stmt = $conn->prepare($sql);
                if ($category != 'All') {
                    $stmt->bind_param("s", $category);
                }
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="product-card">';
                        echo '  <img src="images/' . htmlspecialchars($row['image']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                        echo '  <h3>' . htmlspecialchars($row['name']) . '</h3>';
                        echo '  <div class="price">';
                        if ($row['old_price'] > 0) {
                            echo '      <span class="old-price">৳' . htmlspecialchars($row['old_price']) . '</span>';
                        }
                        echo '      <span class="new-price">৳' . htmlspecialchars($row['new_price']) . '</span>';
                        echo '  </div>';
                        echo '  <button class="add-to-cart">Add to Cart</button>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No products found in this category.</p>";
                }
                $stmt->close();
                ?>
            </div>
        </section>
    </main>
    
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Glow & Grace. All rights reserved.</p>
    </footer>

    <script src="../script.js"></script>
</body>
</html>