function handleUpload() {
    var uploadForm = new FormData();
    

    uploadForm.append('name', document.querySelector('#name').value);
    uploadForm.append('price', document.querySelector('#price').value);
    uploadForm.append('rating', document.querySelector('#rating').value);
    uploadForm.append('thumbnail', document.querySelector('#thumbnail').files[0]);
    uploadForm.append('pictures', document.querySelector('#pictures').files[0]);
    uploadForm.append('description', document.querySelector('#description').value);
    uploadForm.append('category', document.querySelector('#category').value);


    var search = new XMLHttpRequest();
    search.open('POST', 'upload.php');
    search.onreadystatechange = function () {
        console.log(this.responseText);
        if (this.readyState == 4) {
            console.log("Response: ", this);
            if (this.status == 200) {
                alert("Product Added Successfully!");
                location.reload();
            }
            else {
                alert("An error occured. Product Not Added!");
            }
        }
    };

    search.send(uploadForm);

}