loadProducts(products, 'home');

function homeSearch() {
    let form = document.forms["searchForm"];
    let keyword = form["search"].value.toLowerCase();
    window.open(`../search.html?search=${keyword}`, '_self');
}