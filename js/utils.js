let products = [
    {
        id: 1,
        name: "Nike Air",
        price: 230,
        rating: 3,
        description: `Get that special game day look. The unlocked PG 5 By You gives you the freedom to create left and
            right shoes independently for a totally custom pair. Graphics that nod to PG's love of fishing and the outdoors.
        `,
        thumbnail: 'nike1.png',
        pictures: ['nike1.png', 'prodBig2.png', 'prodBig3.png'],
        category: 'shoes',
    },
    {
        id: 2,
        name: "Ray-Ban",
        price: 50,
        rating: 3,
        description: `Get that special game day look. The unlocked PG 5 By You gives you the freedom to create left and
            right shoes independently for a totally custom pair. Graphics that nod to PG's love of fishing and the outdoors.
        `,
        thumbnail: 'ray1.png',
        pictures: ['ray1.png', 'suit.png', 'suit1.png'],
        category: 'clothes',
    },
    {
        id: 3,
        name: "Sneakers",
        price: 430,
        rating: 3,
        description: `Get that special game day look. The unlocked PG 5 By You gives you the freedom to create left and
            right shoes independently for a totally custom pair. Graphics that nod to PG's love of fishing and the outdoors.
        `,
        thumbnail: 'sneaker1.png',
        pictures: ['prodBig.png', 'prodBig2.png', 'prodBig3.png'],
        category: 'shoes',
    },
    {
        id: 4,
        name: "Black Suit",
        price: 700,
        rating: 5,
        description: `Get that special game day look. The unlocked PG 5 By You gives you the freedom to create left and
        right shoes independently for a totally custom pair Graphics that nod to PG's love of fishing and the outdoors.
        `,
        thumbnail: 'suit.png',
        pictures: ['suit2.png', 'suit.png', 'suit1.png'],
        category: 'clothes',
    },
    {
        id: 5,
        name: "Red Suit",
        price: 950,
        rating: 3,
        description: `Get that special game day look. The unlocked PG 5 By You gives you the freedom to create left and
            right shoes independently for a totally custom pair. Graphics that nod to PG's love of fishing and the outdoors.
        `,
        thumbnail: 'suit3.png',
        pictures: ['suit.png', 'suit1.png', 'suit2.png'],
        category: 'clothes',
    },
    {
        id: 6,
        name: "Blair Boost",
        price: 200,
        rating: 3,
        description: `Get that special game day look. The unlocked PG 5 By You gives you the freedom to create left and
            right shoes independently for a totally custom pair. Graphics that nod to PG's love of fishing and the outdoors.
        `,
        thumbnail: 'prod2.png',
        pictures: ['prodBig.png', 'prodBig2.png', 'prodBig3.png'],
        category: 'clothes',
    },
    {
        id: 7,
        name: "Blue Suit",
        price: 550,
        rating: 2,
        description: `Get that special game day look. The unlocked PG 5 By You gives you the freedom to create left and
            right shoes independently for a totally custom pair. Graphics that nod to PG's love of fishing and the outdoors.
        `,
        thumbnail: 'suit2.png',
        pictures: ['suit1.png', 'suit2.png', 'suit.png'],
        category: 'clothes',
    },
    {
        id: 8,
        name: "Nike Huarache",
        price: 150,
        rating: 3,
        description: `Get that special game day look. The unlocked PG 5 By You gives you the freedom to create left and
            right shoes independently for a totally custom pair. Graphics that nod to PG's love of fishing and the outdoors.
        `,
        thumbnail: 'cartImg.png',
        pictures: ['prodBig.png', 'prodBig2.png', 'prodBig3.png'],
        category: 'shoes',
    }
];

let searchResults = [];
let filteredProducts = [];


function loadProducts(products, location) {
    products.map(product => {
        let rating = '';
        for (var i=0; i<product.rating; i++){
            rating += '<span class="fa fa-star text-primary"></span>';
        }
        for (var i=0; i<(5 - product.rating); i++){
            rating += '<span class="fa fa-star"></span>';
        }
        let prodCard = `<div class="col-sm-3 py-4 prod-card">
        <div class="card shadow">
        <a class="link" href="./product.html">
            <img src="./images/${product.thumbnail}" class="card-img-top">
        </a>
        <div class="card-body">
            <a href="./product.html?id=${product.id}" class="h5 card-title link">${product.name}</a>
            <div class="">
                ${rating}
            </div>
            <p class="card-text text-muted fs-6">${product.description.slice(0, 30)} ${product.category}... </p>
            <div class="row align-items-center">
                <div class="col-5">
                    <span class="badge bg-secondary">$ ${product.price}</span>
                </div>
                <div class="col-7">
                    <a href="#" class="btn btn-sm btn-outline-primary">
                        <spanclass="fa fa-cart-plus"></span> add to cart</a>
                </div>
            </div>
        </div>
    </div>`

        if (location === 'home') {
            document.getElementById('newProducts').innerHTML += prodCard;
            document.getElementById('allProducts').innerHTML += prodCard;
            if (product.category === 'shoes') document.getElementById('shoeProducts').innerHTML += prodCard;
            else if (product.category === 'clothes') document.getElementById('clothProducts').innerHTML += prodCard;
        }
        else document.getElementById(location).innerHTML += prodCard;
    });
}

function clearProducts(location) {
    document.getElementById(location).innerHTML = '';
}