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

const param = location.search.split('search=')[1];
if (param) searchProduct(param);
else {
    document.getElementById('searchKeyword').innerHTML = 'Popular Searches';
    loadProducts(products, 'searchResults');
}

function handleSearch() {
    let form = document.forms["searchForm"];
    let keyword = form["search"].value.toLowerCase();
    searchProduct(keyword);
}

function handleFilter() {
    var filterValue = document.getElementById("selectFilter").value;
    let filteredProducts = [];
    switch (filterValue) {
        case 'shoes':
            filteredProducts = searchResults.filter(product => product.category === 'shoes');
            break;
        case 'clothes':
            filteredProducts = searchResults.filter(product => product.category === 'clothes');
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