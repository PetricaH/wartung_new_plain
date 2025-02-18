<?php
// api/fetch_products.php
// This file retrieves products based on the given industry (which corresponds to a category name)
// and returns a JSON array containing each product's ID, name, a short description, 
// the category name, and the subcategory name.

require_once '../configuration.php'; // Include the database configuration file

// Set the response header to JSON so that the client treats the output as JSON
header('Content-Type: application/json');

if (isset($_GET['industry'])) {
    // Retrieve the 'industry' parameter from the URL
    $industry = $_GET['industry'];

    /* 
       In this example, we assume that the industry parameter corresponds to the category name
       stored in the admin_categories table. For example, if the industry is "curatenie", 
       it might be stored as "Curatenie". Adjust the query logic if your mapping is different.
    */
    
    // Prepare an SQL query to select product data along with category and subcategory names.
    // Detailed explanation of each selected field:
    //   - p.product_id: The unique identifier for the product from admin_products.
    //   - p.name: The product name.
    //   - LEFT(p.description, 150) AS short_description: The first 150 characters of the product description.
    //   - c.name AS category_name: The name of the category from admin_categories, aliased as category_name.
    //   - s.name AS subcategory_name: The name of the subcategory from admin_subcategories, aliased as subcategory_name.
    // The query performs LEFT JOINs to include category and subcategory information even if they are missing.
    // The WHERE clause filters the results by the category name (industry).
    $stmt = $connection->prepare("
        SELECT 
          p.product_id,                          -- Product ID from the admin_products table
          p.name,                                -- Product name
          LEFT(p.description, 150) AS short_description,  -- First 150 characters of the product description
          c.name AS category_name,               -- Category name from admin_categories (aliased as category_name)
          s.name AS subcategory_name             -- Subcategory name from admin_subcategories (aliased as subcategory_name)
        FROM admin_products p                     -- Main table: admin_products, aliased as 'p'
        LEFT JOIN admin_categories c ON p.category_id = c.id
                                                 -- Left join with admin_categories based on category_id
        LEFT JOIN admin_subcategories s ON s.subcategory_id = p.subcategory_id
                                                 -- Left join with admin_subcategories based on subcategory_id
        WHERE c.name = ?                         -- Filter products where the category name matches the given industry
    ");
    
    // Format the industry parameter: convert to lowercase then capitalize the first letter
    $industryFormatted = ucfirst(strtolower($industry));
    
    // Bind the formatted industry parameter to the SQL query
    $stmt->bind_param("s", $industryFormatted);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Retrieve the result set from the executed statement
    $result = $stmt->get_result();
    
    // Initialize an empty array to store products
    $products = [];
    
    // Loop through the result set and fetch each row as an associative array
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    // Encode the products array into JSON format and output it
    echo json_encode($products);
    exit;
} else {
    // If no industry parameter is provided, return an empty JSON array
    echo json_encode([]);
    exit;
}
?>
