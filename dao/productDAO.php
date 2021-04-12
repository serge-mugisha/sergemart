<?php
require_once('abstractDAO.php');
require_once('./model/product.php');

class productDAO extends abstractDAO
{

    function __construct()
    {
        try {
            parent::__construct();
        } catch (mysqli_sql_exception $e) {
            throw $e;
        }
    }

    public function getProduct($productId)
    {
        $query = 'SELECT * FROM products WHERE id = ?';
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $temp = $result->fetch_assoc();
            $product = new product($temp['id'], $temp['name'], $temp['price'], $temp['rating'], $temp['description'], $temp['thumbnail'], $temp['pictures'], $temp['category']);
            $result->free();
            return $product;
        }
        $result->free();
        return false;
    }


    public function getProducts()
    {
        //The query method returns a mysqli_result object
        $result = $this->mysqli->query('SELECT * FROM products');
        $products = array();

        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                //Create a new product object, and add it to the array.
                $product = new Product($row['id'], $row['name'], $row['price'], $row['rating'], $row['description'], $row['thumbnail'], $row['pictures'], $row['category']);
                $products[] = $product;
            }
            $result->free();
            return $products;
        }
        $result->free();
        return false;
    }

    public function searchProduct($searchTerm)
    {

        // query("SELECT * FROM products WHERE name LIKE '%?%'")
        // $search = "%$searchTerm%";
        // echo $search;
        $query = "SELECT * FROM products WHERE (name LIKE '%$searchTerm%')";
        $stmt = $this->mysqli->prepare($query);
        // $stmt->bind_param('s', "%$searchTerm%");
        $stmt->execute();


        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                //Create a new product object, and add it to the array.
                $product = new Product($row['id'], $row['name'], $row['price'], $row['rating'], $row['description'], $row['thumbnail'], $row['pictures'], $row['category']);
                $products[] = $product;
            }
            $result->free();
            return $products;
        }

        $result->free();
        return false;
    }

    public function addProduct($product)
    {

        if (!$this->mysqli->connect_errno) {

            $query = 'INSERT INTO products (name, price, rating, description, thumbnail, pictures, category) VALUES (?,?,?,?,?,?,?)';
            $stmt = $this->mysqli->prepare($query);
            if ($stmt) {
                $name = $product->getName();
                $price = $product->getPrice();
                $rating = $product->getRating();
                $description = $product->getDescription();
                $thumbnail = $product->getThumbnail();
                $pictures = $product->getPictures();
                $category = $product->getCategory();


                $stmt->bind_param(
                    'siissss',
                    $name,
                    $price,
                    $rating,
                    $description,
                    $thumbnail,
                    $pictures,
                    $category
                );
                //Execute the statement
                $stmt->execute();

                if ($stmt->error) {
                    return $stmt->error;
                } else {
                    return $product->getName() . ' added successfully!';
                }
            } else {
                $error = $this->mysqli->errno . ' ' . $this->mysqli->error;
                echo $error;
                return $error;
            }
        } else {
            return 'Could not connect to Database.';
        }
    }
}
