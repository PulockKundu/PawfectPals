<?php
include "../Model/databaseConnection.php";
$db = new DatabaseConnection();
$conn = $db->openConnection();

$q = $_GET["q"] ?? "";

if ($q !== "") {
    $sql = "SELECT product_name, category, image_path FROM productitem WHERE product_name LIKE '%$q%' LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $name = $row['product_name'];
            $cat  = $row['category'];
            $img  = $row['image_path']; 
            
            echo "<div onclick='selectSuggestion(\"$name\", \"$cat\")' 
                  style='display: flex; align-items: center; border-bottom: 1px solid #ccc; padding: 8px; cursor: pointer; background: white; color: black;'>";
            
            echo "<img src='$img' style='width: 35px; height: 35px; object-fit: cover; margin-right: 12px; border-radius: 3px;'>";
            
            echo "<span>" . $name . "</span>";
            echo "</div>";
        }
    } else {
        echo "<div style='padding:10px; background:white; color:red;'>No suggestions found</div>";
    }
}
$conn->close();
?>