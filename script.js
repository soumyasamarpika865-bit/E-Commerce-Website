function confirmDelete() {
    return confirm("Are you sure you want to delete this product?");
}

function changeQty(id, type) {

    let input = document.getElementById("qty-" + id);

    let value = parseInt(input.value);

    if (type === "plus") {
        input.value = value + 1;
    }

    if (type === "minus" && value > 1) {
        input.value = value - 1;
    }
}