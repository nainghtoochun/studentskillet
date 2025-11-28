<?php
include 'includes/db_connect.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $prep = (int)$_POST['prep_time'];
    $cat = $_POST['category'];
    $ing = trim($_POST['ingredients']);
    $ins = trim($_POST['instructions']);
    $img = $_POST['image_path'];

    if (empty($title) || empty($ing) || $prep < 1) {
        $error = "Please fill all fields correctly.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO recipes (title, prep_time, category, ingredients, instructions, image_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $prep, $cat, $ing, $ins, $img]);
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav><a href="index.php">Home</a></nav>
    <main class="container">
        <h1>Add New Recipe</h1>
        <?php if($error) echo "<p class='error'>$error</p>"; ?>
        
        <form method="POST" id="recipeForm">
            <label>Title:</label>
            <input type="text" name="title" required>
            
            <label>Prep Time (mins):</label>
            <input type="number" name="prep_time" required>
            
            <label>Category:</label>
            <select name="category">
                <option>Breakfast</option>
                <option>Lunch</option>
                <option>Dinner</option>
            </select>
            
            <label>Ingredients:</label>
            <textarea name="ingredients" rows="4" required></textarea>
            
            <label>Instructions:</label>
            <textarea name="instructions" rows="4" required></textarea>
            
            <label>Image URL (Optional):</label>
            <input type="text" name="image_path">
            
            <button type="submit">Submit Recipe</button>
        </form>
    </main>
    <script src="js/script.js"></script>
</body>
</html>