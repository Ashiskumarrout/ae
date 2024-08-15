document.getElementById("add-to-cart-btn").onclick = function() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    
    // Example product data - Replace with dynamic product data as needed
    const product = {
        name: "KOTTY Top Pant Western Set",
        image: "Ecmerse photos/kuta.png",
        price: 139.00,
        quantity: 1
    };

    // Check if product already exists in cart
    const existingProduct = cart.find(item => item.name === product.name);
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push(product);
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    alert("Product added to cart!");

    // Redirect to the cart page
    window.location.href = "cart.html";
};

// Image switching functionality
var MainImg = document.getElementById("mainimg");
var smallimg = document.getElementsByClassName("small-img");

for (let i = 0; i < smallimg.length; i++) {
    smallimg[i].onclick = function() {
        MainImg.src = smallimg[i].src;
    };
}