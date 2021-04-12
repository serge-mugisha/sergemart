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
    <script defer src="./js/upload.js"></script>
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
                        <a class="nav-link fw-bold" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item px-3">
                        <a class="nav-link fw-bold active" href="./search.php">Search</a>
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

    <main class="min-vh-100">

        <!-- Search Section -->
        <section class="parallax">
            <div class="container">
                <div class="row py-3 mt-5 text-light">
                    <div class="col-lg-8 col-md-8 mx-auto">
                        <h3 class="fw-light mt-5 fw-bold">Add New Product</h3>
                        <form name="searchForm">
                            <div class="row py-2">
                                <div class="col">
                                    <label class="form-label">Product Name</label>
                                    <input id="name" type="text" name="name" placeholder="Prod. name" class="form-control">
                                </div>
                                <div class="col">
                                    <label class="form-label">Product Price</label>
                                    <input id="price" type="number" name="price" placeholder="Price (USD)" class="form-control">
                                </div>
                            </div>

                            <div class="row py-2">
                                <div class="col">
                                    <label for="formFile" class="form-label">Product Thumbnail</label>
                                    <input id="thumbnail" name="thumbnail" class="form-control" type="file" accept="image/*" id="formFile">
                                </div>
                                <div class="col">
                                    <label for="formFile" class="form-label">Product Images</label>
                                    <input id="pictures" name="pictures" class="form-control" type="file" multiple accept="image/*" id="formFile">
                                </div>
                            </div>

                            <div class="row py-2">
                                <div class="col">
                                    <label class="form-label">Product Rating</label>
                                    <input id="rating" type="number" name="rating" placeholder="rating (0-5)" class="form-control">

                                    <label class="form-label mt-3">Disabled select menu</label>
                                    <select id="category" class="form-select">
                                        <option>Shoes</option>
                                        <option>Clothes</option>
                                    </select>

                                    <button type="button" onclick="handleUpload()" class="my-2 btn btn-primary py-2">+ Add Product</button>
                                </div>
                                <div class="col">
                                    <label class="form-label">Product Description</label>
                                    <textarea id="description" name="description" placeholder="Description" class="form-control" rows="5"></textarea>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </section>

        <!-- Search Results Section -->
        <div class="container py-4">
            <div class="shop-list pt-3">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4>All Products</h4>
                    </div>
                </div>
                <div id="searchResults" class="row">

                    <!-- Single Product Card -->
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

    </main>

    <!-- Footer -->
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
                                <li class="py-1">Home</li>
                                <li class="py-1">Search</li>
                                <li class="py-1">Products</li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="list-unstyled">
                                <li class="py-1">About</li>
                                <li class="py-1">FAQ</li>
                                <li class="py-1">Report a Bug</li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="list-unstyled">
                                <li class="py-1">Account</li>
                                <li class="py-1">Settings</li>
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