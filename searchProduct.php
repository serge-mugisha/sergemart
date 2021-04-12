<?php
require_once('./dao/productDAO.php');

if (isset($_POST['searchQuery'])) {
    
    $productDAO = new productDAO();
    $searchResults = $productDAO->searchProduct($_POST['searchQuery']);
    
    if ($searchResults) {
        $products = array();
        foreach ($searchResults as $product) {
            $prodJson = $product->getProduct();
            array_push($products, $prodJson);
        }
        
        echo json_encode($products);

    }
    else {
        http_response_code(404);
    };

}
?>