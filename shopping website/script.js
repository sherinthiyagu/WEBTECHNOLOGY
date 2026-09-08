
let cart = [];

let wishlist = [];

let discount = 0;



const cartButton = document.getElementById("cartButton");

const cartSidebar = document.getElementById("cartSidebar");

const closeCart = document.getElementById("closeCart");

const cartItems = document.getElementById("cartItems");

const cartCount = document.getElementById("cartCount");

const subTotal = document.getElementById("subTotal");

const gst = document.getElementById("gst");

const discountText = document.getElementById("discount");

const cartTotal = document.getElementById("cartTotal");



const wishlistButton = document.getElementById("wishlistButton");

const wishlistSidebar = document.getElementById("wishlistSidebar");

const closeWishlist = document.getElementById("closeWishlist");

const wishlistItems = document.getElementById("wishlistItems");

const wishlistCount = document.getElementById("wishlistCount");



const searchInput = document.getElementById("searchInput");



const categories = document.querySelectorAll(".category");

const productCards = document.querySelectorAll(".product-card");


const addCartButtons = document.querySelectorAll(".add-cart");

const buyButtons = document.querySelectorAll(".buy-btn");

const wishlistIcons = document.querySelectorAll(".wishlist-icon");

const quickViewButtons = document.querySelectorAll(".view-btn");


const overlay = document.getElementById("overlay");

const productModal = document.getElementById("productModal");

const closeProductModal = document.getElementById("closeProductModal");



cartButton.addEventListener("click", () => {

    cartSidebar.classList.add("active");

    overlay.classList.add("active");

});



closeCart.addEventListener("click", () => {

    cartSidebar.classList.remove("active");

    overlay.classList.remove("active");

});



wishlistButton.addEventListener("click", () => {

    wishlistSidebar.classList.add("active");

    overlay.classList.add("active");

});


closeWishlist.addEventListener("click", () => {

    wishlistSidebar.classList.remove("active");

    overlay.classList.remove("active");

});



overlay.addEventListener("click", () => {

    cartSidebar.classList.remove("active");

    wishlistSidebar.classList.remove("active");

    productModal.classList.remove("active");

    overlay.classList.remove("active");

});



searchInput.addEventListener("keyup", () => {

    const value = searchInput.value.toLowerCase();

    productCards.forEach(card => {

        const productName =
        card.dataset.name.toLowerCase();

        if(productName.includes(value)){

            card.style.display = "block";

        }

        else{

            card.style.display = "none";

        }

    });

});



categories.forEach(category => {

    category.addEventListener("click", () => {

        const selected =
        category.dataset.category;

        productCards.forEach(card => {

            if(

                selected === card.dataset.category

            ){

                card.style.display = "block";

            }

            else{

                card.style.display = "none";

            }

        });

    });

});



function showAllProducts(){

    productCards.forEach(card=>{

        card.style.display="block";

    });

}



categories.forEach(category=>{

    category.addEventListener("dblclick",()=>{

        showAllProducts();

    });

});


addCartButtons.forEach(button=>{

button.addEventListener("click",()=>{

const card=button.closest(".product-card");

const id=card.dataset.id;

const name=card.dataset.name;

const price=parseInt(card.dataset.price);

const image=card.querySelector("img").src;

const existing=cart.find(item=>item.id===id);

if(existing){

existing.quantity++;

}

else{

cart.push({

id,

name,

price,

image,

quantity:1

});

}

updateCart();

});

});



wishlistIcons.forEach(icon=>{

icon.addEventListener("click",()=>{

const card=icon.closest(".product-card");

const id=card.dataset.id;

const name=card.dataset.name;

const price=parseInt(card.dataset.price);

const image=card.querySelector("img").src;

const exist=wishlist.find(item=>item.id===id);

if(exist){

alert("Already in Wishlist ❤️");

return;

}

wishlist.push({

id,

name,

price,

image

});

updateWishlist();

});

});


function updateCart(){

cartItems.innerHTML="";

let subtotal=0;

let totalItems=0;

cart.forEach(item=>{

subtotal+=item.price*item.quantity;

totalItems+=item.quantity;

cartItems.innerHTML+=`

<div class="cart-item">

<img src="${item.image}">

<div class="cart-details">

<h3>${item.name}</h3>

<p>₹${item.price}</p>

<div class="quantity">

<button onclick="decreaseQuantity('${item.id}')">-</button>

<span>${item.quantity}</span>

<button onclick="increaseQuantity('${item.id}')">+</button>

</div>

<button class="remove-item"

onclick="removeItem('${item.id}')">

Remove

</button>

</div>

</div>

`;

});

cartCount.textContent=totalItems;

subTotal.textContent=subtotal;

const gstValue=Math.round(subtotal*0.05);

gst.textContent=gstValue;

const serviceCharge = 40;

const finalTotal =
subtotal + gstValue + serviceCharge - discount;

cartTotal.textContent=finalTotal;

if(cart.length===0){

cartItems.innerHTML="<p class='empty'>Your cart is empty.</p>";

cartCount.textContent=0;

subTotal.textContent=0;

gst.textContent=0;

cartTotal.textContent=0;

}
saveCart();

}


function updateWishlist(){

wishlistItems.innerHTML="";

wishlist.forEach(item=>{

wishlistItems.innerHTML+=`

<div class="cart-item">

<img src="${item.image}">

<div class="cart-details">

<h3>${item.name}</h3>

<p>₹${item.price}</p>

<button class="remove-item"

onclick="removeWishlist('${item.id}')">

Remove

</button>

</div>

</div>

`;

});

wishlistCount.textContent=wishlist.length;

if(wishlist.length===0){

wishlistItems.innerHTML="<p class='empty'>Wishlist Empty</p>";

wishlistCount.textContent=0;

}
saveWishlist();
}


function increaseQuantity(id){

const item=cart.find(i=>i.id===id);

item.quantity++;

updateCart();

}


function decreaseQuantity(id){

const item=cart.find(i=>i.id===id);

item.quantity--;

if(item.quantity<=0){

cart=cart.filter(i=>i.id!==id);

}

updateCart();

}


function removeItem(id){

cart=cart.filter(item=>item.id!==id);

updateCart();

}


function removeWishlist(id){

wishlist=wishlist.filter(item=>item.id!==id);

updateWishlist();

}


const couponInput = document.getElementById("couponInput");
const applyCoupon = document.getElementById("applyCoupon");

applyCoupon.addEventListener("click", () => {

    const code = couponInput.value.trim().toUpperCase();

    if(code === "CAFE10"){

        discount = 100;

    }

    else if(code === "BREW20"){

        discount = 200;

    }

   else{

    discount = 0;

    alert("❌ Invalid Coupon Code");

    couponInput.value="";

}
    discountText.textContent = discount;

    updateCart();

});


function saveCart(){

    localStorage.setItem("cart", JSON.stringify(cart));

}



function saveWishlist(){

    localStorage.setItem("wishlist", JSON.stringify(wishlist));

}


window.addEventListener("load", () => {

    const savedCart = localStorage.getItem("cart");

    const savedWishlist = localStorage.getItem("wishlist");

    if(savedCart){

        cart = JSON.parse(savedCart);

    }

    if(savedWishlist){

        wishlist = JSON.parse(savedWishlist);

    }

    updateCart();

    updateWishlist();
    discountText.textContent = discount;

});





const modalImage = document.getElementById("modalImage");

const modalTitle = document.getElementById("modalTitle");

const modalDescription = document.getElementById("modalDescription");

const modalPrice = document.getElementById("modalPrice");

quickViewButtons.forEach(button=>{

button.addEventListener("click",()=>{

const card = button.closest(".product-card");

modalImage.src = card.querySelector("img").src;

modalTitle.textContent = card.dataset.name;

modalDescription.textContent =
card.querySelector("p").textContent;

modalPrice.textContent =
"₹" + card.dataset.price;

productModal.classList.add("active");

overlay.classList.add("active");

});

});

closeProductModal.addEventListener("click",()=>{

productModal.classList.remove("active");

overlay.classList.remove("active");

});


buyButtons.forEach(button=>{

button.addEventListener("click",()=>{

const card = button.closest(".product-card");

const id = card.dataset.id;

const name = card.dataset.name;

const price = parseInt(card.dataset.price);

const image = card.querySelector("img").src;

cart = [];

cart.push({

id,

name,

price,

image,

quantity:1

});

updateCart();

cartSidebar.classList.add("active");

overlay.classList.add("active");

});

});



const offerTitle = document.querySelector(".offer-left h2");

const offerText = document.querySelector(".offer-left p");
if(offerTitle && offerText){

const today = new Date().getDay();

if(today !== 3){

offerTitle.textContent = "Weekend Café Combo";

offerText.textContent =
"Buy 1 Pizza and Get Garlic Bread Free.";

}
}

// Elements
const checkoutBtn = document.getElementById("checkoutBtn");
const invoiceModal = document.getElementById("invoiceModal");
const invoiceItems = document.getElementById("invoiceItems");
const invoiceTotal = document.getElementById("invoiceTotal");

const closeInvoice = document.getElementById("closeInvoice");
const printInvoice = document.getElementById("printInvoice");
const confirmOrder = document.getElementById("confirmOrder");

const successPopup = document.getElementById("successPopup");
const continueShopping = document.getElementById("continueShopping");


checkoutBtn.addEventListener("click", () => {

    if(cart.length === 0){

        alert("🛒 Your cart is empty!");

        return;

    }

    invoiceItems.innerHTML = "";

    let total = 0;

    cart.forEach(item => {

        const amount = item.price * item.quantity;

        total += amount;

        invoiceItems.innerHTML += `

        <div class="invoice-row">

            <p>${item.name}</p>

            <p>${item.quantity} x ₹${item.price}</p>

            <p>₹${amount}</p>

        </div>

        `;

    });

    const gstAmount = Math.round(total * 0.05);

    const serviceCharge = 40;

    const grandTotal = total + gstAmount + serviceCharge - discount;

    invoiceTotal.textContent = grandTotal;

    invoiceModal.classList.add("active");

    overlay.classList.add("active");

});



closeInvoice.addEventListener("click", () => {

    invoiceModal.classList.remove("active");

    overlay.classList.remove("active");

});



printInvoice.addEventListener("click", () => {

    window.print();

});


confirmOrder.addEventListener("click", () => {

    invoiceModal.classList.remove("active");

    overlay.classList.remove("active");

    successPopup.classList.add("active");

});


continueShopping.addEventListener("click", () => {

    successPopup.classList.remove("active");

    cart = [];

    discount = 0;

    couponInput.value = "";

    updateCart();

    localStorage.removeItem("cart");

});