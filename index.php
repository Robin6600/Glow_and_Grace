<?php require_once 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glow & Grace - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="logo-container">
            <h1 class="logo">Glow & Grace</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="products.php?category=Flash Sale">Flash Sale</a></li>
                <li><a href="products.php?category=Mens Care">Mens Care</a></li>
                <li><a href="products.php?category=Womens Care">Womens Care</a></li>
                <li><a href="products.php?category=Baby Care">Baby Care</a></li>
                <li><a href="admin/">Admin</a></li>
                <li><a href="#">About</a></li>
            </ul>
            <div class="theme-switcher">
                <button id="theme-toggle">🌙</button>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h2>Highlighted Products</h2>
            <div class="product-grid">
                <?php
                // Fetch highlighted products from the database
                $sql = "SELECT * FROM products WHERE is_highlighted = 1 LIMIT 2";
                $result = $conn->query($sql);

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
                    echo "<p>No highlighted products found.</p>";
                }
                ?>
            </div>
        </section>

        <section class="all-products-link">
             <a href="products.php?category=All" class="btn-view-all">View All Products →</a>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Glow & Grace. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>