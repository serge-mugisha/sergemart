<?php require_once('./dao/productDAO.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SergeMart - Fashion Store</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="./js/utils.js"></script>
    <script defer src="./js/script.js"></script>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-3">
        <div class="container">
            <a class="navbar-brand" href="./index.php">
                <img src="./images/logo.png" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item px-3">
                        <a class="nav-link fw-bold active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link fw-bold" href="./search.php">Search</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link fw-bold" href="./addProduct.php">Add Product</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="btn btn-outline-primary" href="./login.html">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>

        <!-- Hero Section -->
        <section class="parallax py-5 text-center">
            <div class="container">
                <div class="row py-lg-5 mt-5 text-light">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h1 class="fw-light mt-5">SergeMart - Fashion Store</h1>
                        <p class="lead">Discover thousands of new Fashion Designs and Look like the future in Public!
                        </p>
                        <form name="searchForm">
                            <div class="row pt-4 justify-content-center">
                                <div class="col-10">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control rounded-0" placeholder="eg. Nike Shoes">
                                        <div class="input-group-append">
                                            <button type="button" onclick="homeSearch()" class="btn btn-primary py-2">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        <!-- Products Section -->
        <div class="container pt-5">
            <!-- Tab navigation -->
            <div class="row justify-content-center align-items-center">
                <div class="col">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="pills-featured-tab" data-bs-toggle="pill" data-bs-target="#pills-featured" type="button" role="tab" aria-controls="pills-featured" aria-selected="true">Featured</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-shoes-tab" data-bs-toggle="pill" data-bs-target="#pills-shoes" type="button" role="tab" aria-controls="pills-shoes" aria-selected="false">Shoes</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-clothes-tab" data-bs-toggle="pill" data-bs-target="#pills-clothes" type="button" role="tab" aria-controls="pills-clothes" aria-selected="false">Clothing</button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Tab content -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-featured" role="tabpanel" aria-labelledby="pills-featured-tab">
                    <div class="container">
                        <div id="newProducts" class="row py-4">
                            <h2>New & Noteworthy</h2>

                            <?php
                            $productDAO = new productDAO();
                            $products = $productDAO->getProducts();
                            if ($products) {

                                foreach ($products as $product) {

                                    $id = $product->getId();
                                    $name = $product->getName();
                                    $price = $product->getPrice();
                                    $rating = $product->getRating();
                                    $description = $product->getDescription();
                                    $thumbnail = $product->getThumbnail();
                                    $pictures = $product->getPictures();
                                    $category = $product->getCategory();

                                    $description = substr($description, 0, 80) . '...';

                                    $rateStars = '';

                                    for ($i = 0; $i < $rating; $i++) {
                                        $rateStars = $rateStars . '<span class="fa fa-star text-primary"></span>';
                                    }
                                    for ($i = 0; $i < (5 - $rating); $i++) {
                                        $rateStars = $rateStars . '<span class="fa fa-star"></span>';
                                    }

                                    $prod = <<<EOF
                                        <div class="col-sm-3 py-4 prod-card">
                                            <div class="card shadow">
                                                <a class="link" href="./product.php?id={$id}">
                                                    <img src="./{$thumbnail}" class="card-img-top">
                                                </a>
                                                <div class="card-body">
                                                    <a href="./product.php?id={$id}" class="h5 card-title link">{$name}</a>
                                                    <div class="">
                                                        {$rateStars}
                                                    </div>
                                                    <p class="card-text text-muted fs-6">{$description}</p>

                                                    <div class="row align-items-center">
                                                        <div class="col-5">
                                                            <span class="badge bg-secondary">$ {$price}</span>
                                                        </div>
                                                        <div class="col-7">
                                                            <a href="#" class="btn btn-sm btn-outline-primary"><span
                                                                    class="fa fa-cart-plus"></span> add to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    EOF;
                                    echo $prod;
                                }
                            } else {
                                echo '<div class="alert alert-danger"><em>No Products found.</em></div>';
                            }
                            $productDAO->getMysqli()->close();
                            ?>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-shoes" role="tabpanel" aria-labelledby="pills-shoes-tab">
                    <div class="container">
                        <div id="shoeProducts" class="row py-4">
                            <h2>Drip Shoes</h2>

                            <!-- Single Product Card -->

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-clothes" role="tabpanel" aria-labelledby="pills-clothes-tab">
                    <div class="container">
                        <div id="clothProducts" class="row py-4">
                            <h2>Trending Clothes</h2>

                            <!-- Single Product Card -->

                        </div>
                    </div>
                </div>

                <!-- Accessorie -->

            </div>

            <!-- Section Divider -->
            <div class="parallax py-5 text-white text-center">
                <h3 class="py-2 fw-bold">Trending Fashions</h3>
            </div>

            <!-- Trending Products Section -->
            <div class="container">
                <div id="allProducts" class="row py-4">
                    <h2>Trending Now</h2>

                    <!-- Single Product Card -->

                </div>
            </div>



        </div>

    </main>



    <!-- Page Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <img src="./images/logo.png" class="img-fluid">
                    <p class="text-muted">Copyright SergeMart 2021 All Rights Reserved.</p>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col">
                            <ul class="list-unstyled">
                                <li class="py-1">
                                    <a href="#" class="link">Home</a>
                                </li>
                                <li class="py-1">
                                    <a href="#" class="link">Search</a>
                                </li>
                                <li class="py-1">
                                    <a href="#" class="link">Products</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="list-unstyled">
                                <li class="py-1">
                                    <a href="#" class="link">About</a>
                                </li>
                                <li class="py-1">
                                    <a href="#" class="link">FAQ</a>
                                </li>
                                <li class="py-1">
                                    <a href="#" class="link">Report a Bug</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="list-unstyled">
                                <li class="py-1">
                                    <a href="#" class="link">Account</a>
                                </li>
                                <li class="py-1">
                                    <a href="#" class="link">Settings</a>
                                </li>
                                <li class="btn btn-sm btn-outline-primary">Log Out</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="./js/bootstrap.min.js"></script>
</body>

</html>