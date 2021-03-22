getProduct();
loadProducts(products, 'relatedProducts');

function getProduct() {
    const productId = location.search.split('id=')[1];
    if (!productId) window.open('../index.html', '_self');

    selectedProduct = products.filter(product => product.id == productId);

    if (selectedProduct.length !== 0) {
        loadProduct(selectedProduct[0]);
    }
    else {
        alert('Invalid Product!')
        window.open('../index.html', '_self');
    }
}

function loadProduct(product) {

    let rating = '';
    for (var i = 0; i < product.rating; i++) {
        rating += '<span class="fa fa-star fa-lg text-primary"></span>';
    }
    for (var i = 0; i < (5 - product.rating); i++) {
        rating += '<span class="fa fa-star fa-lg"></span>';
    }

    let productImages = '';
    product.pictures.map((img, i) => productImages += `
        <div class="carousel-item ${i !== 0 ? null : 'active'}">
           <img src="./images/${img}" class="d-block w-100">
        </div>`);

    let productDetails = `
        <h3 class="fw-bold">${product.name}</h3>
        <div class="pb-4">
            ${rating}
        </div>

        <p>${product.description}</p>

        <h5><span id="productPrice" class="badge bg-secondary fw-bold px-3 py-2">$ ${product.price}</span></h5>

        <div class="pt-4">
                <div class="row align-items-center">
                    <div class="col-7">
                        <form>
                            <div class="col-4">
                                 <label for="size" class="text-muted fs-6">Items</label>
                                 <input id="ProductQuantity" type="number" onchange="calculatePrice(${product.price})" class="form-control" id="size" min="1" max="5" placeholder="1">
                            </div>
                        </form>
                    </div>
                    <div class="col-5 align-self-center pt-4">
                          <div class="btn btn-outline-primary"><span class="fa fa-cart-plus"></span> Add to cart
                         </div>
                    </div>
                </div>
        </div>

        </div>`;

    document.getElementById('productCarousel').innerHTML += productImages;
    document.getElementById('productDetails').innerHTML += productDetails;
}

function calculatePrice(price) {
    var priceNode = document.getElementById("productPrice");
    var quantity = document.getElementById("ProductQuantity").value;
    
    var totalPrice = eval(price * quantity);
    priceNode.innerHTML = `$ ${totalPrice}`;
}