const param = location.search.split('search=')[1];
//if (param) searchProduct(param);
if (param) handleSearch();
else {
    document.getElementById('searchKeyword').innerHTML = 'Popular Searches';
    // loadProducts(products, 'searchResults');
}

function handleSearch() {
    let form = document.forms["searchForm"];
    let keyword = param ? param : form["search"].value.toLowerCase();
    //searchProduct(keyword);

    clearProducts('searchResults');
    var searchForm = new FormData();
    searchForm.append('searchQuery', keyword);

    var search = new XMLHttpRequest();
    search.open('POST', 'searchProduct.php');
    search.onreadystatechange = function () {
        if (this.readyState == 4) {
            console.log("Response: ", this);
            if (this.status == 200) {
                var results = this.response;
                console.log(results);

                searchResults = JSON.parse(results);
                console.log(searchResults);

                document.getElementById('searchKeyword').innerHTML = `Search results for <b>'${keyword}'</b>`;
                loadProducts(searchResults, 'searchResults');
            }
            else {
                console.log("No Products Found");
                document.getElementById('searchKeyword').innerHTML = `No search results for <b>'${keyword}'</b>`;
            }
        }
    };

    search.send(searchForm);

}

function searchProduct(searchTerm) {
    let keyword = searchTerm;

    clearProducts('searchResults');
    searchResults = products.filter(product => product.name.toLowerCase().includes(keyword));

    if (searchResults.length !== 0) {
        document.getElementById('searchKeyword').innerHTML = `Search results for <b>'${keyword}'</b>`;
        loadProducts(searchResults, 'searchResults');
    }
    else {
        document.getElementById('searchKeyword').innerHTML = `No search results for <b>'${keyword}'</b>`;
    }
}

function handleFilter() {
    var filterValue = document.getElementById("selectFilter").value;
    let filteredProducts = [];
    switch (filterValue) {
        case 'shoes':
            filteredProducts = searchResults.filter(product => product.category === 'Shoes');
            break;
        case 'clothes':
            filteredProducts = searchResults.filter(product => product.category === 'Clothes');
            break;
        default:
            filteredProducts = searchResults;
            break;
    }
    clearProducts('searchResults');
    loadProducts(filteredProducts, 'searchResults');
}

function handleSort() {
    var sortValue = document.getElementById("selectSort").value;
    let sortedProducts = [];
    switch (sortValue) {
        case 'low':
            sortedProducts = searchResults.sort((a, b) => a.price - b.price);
            break;
        case 'high':
            sortedProducts = searchResults.sort((a, b) => b.price - a.price);
            break;
        case 'rating':
            sortedProducts = searchResults.sort((a, b) => b.rating - a.rating);
            break;
        // default:
        //     sortedProducts = searchResults;
        //     break;
    }
    clearProducts('searchResults');
    loadProducts(sortedProducts, 'searchResults');
}