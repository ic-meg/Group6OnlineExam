document.getElementById('saveChangesBtn').addEventListener('click', function() {
    var selectedCategory = document.getElementById('categorySelect').value;
    if (selectedCategory) {
        document.getElementById('selectedCategory').innerText = selectedCategory;
        $('#category').modal('hide');
    } else {
        alert('Please select a category.');
    }
});