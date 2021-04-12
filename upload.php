<?php
require_once('./dao/productDAO.php');

if (isset($_POST['name'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $thumbnail = $_POST['thumbnail'];
    $pictures = $_POST['pictures'];
    $description = $_POST['description'];
    $category = $_POST['category'];


    $folder = "images/";
    $thumbPath = $folder . basename($_FILES["thumbnail"]["name"]);
    $picsPath = $folder . basename($_FILES["pictures"]["name"]);
    $extensions = array('gif', 'png', 'jpg');
    $thumbExtension = pathinfo($thumbPath, PATHINFO_EXTENSION);
    $picsExtension = pathinfo($picsPath, PATHINFO_EXTENSION);

    if (in_array($thumbExtension, $extensions) && in_array($picsExtension, $extensions)) {

        if (!file_exists($thumbPath) && !file_exists($picsPath)) {

            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $thumbPath)) {
                if (move_uploaded_file($_FILES["pictures"]["tmp_name"], $picsPath)) {

                    $productDAO = new productDAO();
                    $product = new Product(0, $name, $price, $rating, $description, $thumbPath, $picsPath, $category);
                    $addProd = $productDAO->addProduct($product);

                    echo "Product Added Successfully";

                    echo $addProd;
                } else {
                    print "Image not uploaded! Unexpected error occured.";
                    http_response_code(500);
                }
            } else {
                print "Image not uploaded! Unexpected error occured.";
                http_response_code(501);
            }
        } else {
            print "The Image already exists! Choose another image";
            http_response_code(502);
        }
    } else {
        print "Not an Image file";
        http_response_code(502);
    }
} else {
    print "Invalid Form";
    http_response_code(502);
}
