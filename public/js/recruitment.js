document.getElementById('tag_name').addEventListener('change', function() {
    var selectedValue = this.value;
    var items = document.querySelectorAll('#item_list .item');

    items.forEach(function(item) {
        if (selectedValue === "" || item.getAttribute('data-value') === selectedValue) {
            item.classList.remove('hidden');
        } else {
            item.classList.add('hidden');
        }
    });
});