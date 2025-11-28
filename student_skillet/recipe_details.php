<?php
// -------------------------------------------------------------------------
// DEBUGGING: Force errors to show
// -------------------------------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// -------------------------------------------------------------------------
// 1. DATABASE CONNECTION (Directly inside this file to prevent include errors)
// -------------------------------------------------------------------------
$host = 'localhost';
$db   = 'student_skillet';
$user = 'root'; 
$pass = '';     // Leave empty for XAMPP default
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("<h1>Database Connection Failed</h1><p>" . $e->getMessage() . "</p>");
}

// -------------------------------------------------------------------------
// 2. GET RECIPE DATA
// -------------------------------------------------------------------------
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$recipe = null;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = ?");
    $stmt->execute([$id]);
    $recipe = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 20px auto; padding: 20px; }
        img { max-width: 100%; height: auto; border-radius: 8px; }
        .btn { display: inline-block; background: #333; color: #fff; padding: 10px 20px; text-decoration: none; margin-top: 20px; }
        .error { color: red; border: 1px solid red; padding: 20px; background: #ffe6e6; }
    </style>
</head>
<body>

    <nav>
        <a href="index.php">Back to Home</a>
    </nav>

    <?php if ($recipe): ?>
        <h1><?php echo htmlspecialchars($recipe['title']); ?></h1>
        
        <?php if(!empty($recipe['image_path'])): ?>
            <img src="<?php echo htmlspecialchars($recipe['image_path']); ?>" alt="Recipe Image">
        <?php endif; ?>

        <p><strong>Prep Time:</strong> <?php echo htmlspecialchars($recipe['prep_time']); ?> mins</p>
        <p><strong>Category:</strong> <?php echo htmlspecialchars($recipe['category']); ?></p>

        <h3>Ingredients</h3>
        <p><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>

        <h3>Instructions</h3>
        <p><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>

        <a href="edit_recipe.php?id=<?php echo $recipe['id']; ?>" class="btn">Edit Recipe</a>

    <?php else: ?>
        <div class="error">
            <h2>Recipe Not Found</h2>
            <p>Could not find a recipe with ID: <?php echo $id; ?></p>
            <p><strong>Debug Hint:</strong> Make sure you clicked a link from the homepage (e.g., <code>recipe_details.php?id=1</code>).</p>
            <p><a href="index.php">Return Home</a></p>
        </div>
    <?php endif; ?>

</body>
</html>