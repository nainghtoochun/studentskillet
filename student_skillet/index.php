<?php include 'includes/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Skillet</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav>
        <a href="index.php">Student Skillet HAhahah</a>
        <a href="submit_recipe.php">Add Recipe</a>
        <a href="documentation.php">Documentation</a>
    </nav>

    <main class="container">
        <h1>Recipe Box</h1>
        <input type="text" id="search" placeholder="Search recipes..." style="padding:10px; width:100%; max-width:400px;">
        
        <div class="recipe-grid">
            <?php
            $stmt = $pdo->query("SELECT * FROM recipes ORDER BY id DESC");
            while ($row = $stmt->fetch()) {
                $img = $row['image_path'] ? htmlspecialchars($row['image_path']) : 'https://placehold.co/300x200';
                echo "<div class='recipe-card' data-title='" . strtolower($row['title']) . "'>";
                echo "<img src='$img' alt='Recipe Image'>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p>Time: " . htmlspecialchars($row['prep_time']) . " mins</p>";
                echo "<a href='recipe_details.php?id=" . $row['id'] . "'>View Details</a>";
                echo "</div>";
            }
            ?>
        </div>
    </main>
    <script src="js/script.js"></script>
</body>
</html>