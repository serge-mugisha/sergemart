<?php require_once('./dao/productDAO.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SergeMart - Fashion Store</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="./js/utils.js"></script>
    <script defer src="./js/product.js"></script>
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

        <!-- Store Section -->
        <section class="parallax text-center">
            <div class="container">
                <div class="row py-lg-5 mt-5 text-light">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <h3 class="fw-bold mt-5">Shoes - Store</h3>
                    </div>
                </div>
            </div>
        </section>



        <?php
        $productDAO = new productDAO();

        $prodID = $_GET['id'];

        $product = $productDAO->getProduct($prodID);
        if ($product) {

            $id = $product->getId();
            $name = $product->getName();
            $price = $product->getPrice();
            $rating = $product->getRating();
            $description = $product->getDescription();
            $thumbnail = $product->getThumbnail();
            $pictures = $product->getPictures();
            $category = $product->getCategory();

            $rateStars = '';

            for ($i = 0; $i < $rating; $i++) {
                $rateStars = $rateStars . '<span class="fa fa-star fa-lg text-primary"></span>';
            }
            for ($i = 0; $i < (5 - $rating); $i++) {
                $rateStars = $rateStars . '<span class="fa fa-star fa-lg"></span>';
            }

            $prod = <<<EOF
            <h3 class="fw-bold">{$name}</h3>
            <div class="pb-4">
                {$rateStars}
            </div>
    
            <p>{$description}</p>
    
            <h5><span id="productPrice" class="badge bg-secondary fw-bold px-3 py-2">$ {$price}</span></h5>
    
            <div class="pt-4">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <form>
                                <div class="col-4">
                                     <label for="size" class="text-muted fs-6">Items</label>
                                     <input id="ProductQuantity" type="number" onchange="calculatePrice({$price})" class="form-control" id="size" min="1" max="5" placeholder="1">
                                </div>
                            </form>
                        </div>
                        <div class="col-5 align-self-center pt-4">
                              <div class="btn btn-outline-primary"><span class="fa fa-cart-plus"></span> Add to cart
                             </div>
                        </div>
                    </div>
            </div>
    
            </div>
        EOF;

        $images = <<<EOF
            <div class="carousel-item active">
                <img src="./{$pictures}" class="d-block w-100">
            </div>
        EOF;
        } else {
            echo '<div class="alert alert-danger"><em>No Products found.</em></div>';
        }
        $productDAO->getMysqli()->close();
        ?>


        <!-- Product Section -->
        <div class="container">
            <!-- align-items-center -->
            <div class="row pt-5">
                <div class="col-7">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div id="productCarousel" class="carousel-inner">
                            <!-- Images Here -->
                            <?php
                            echo $images;
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-5">
                    <div id="productDetails">
                        <!-- Product Details -->
                        <?php
                        echo $prod;
                        ?>
                    </div>
                </div>
            </div>

            <!-- Related Products Section -->
            <div class="container pt-3 py-4">
                <h4>Related Products</h4>
                <div id="relatedProducts" class="row">
                    <!-- Single Product Card -->
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

    <script defer src="./js/bootstrap.min.js"></script>
</body>

</html>