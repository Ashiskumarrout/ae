const bar= document.getElementById('bar');
const close= document.getElementById('close');
const nav=document.getElementById('navbar');
if(bar){
    bar.addEventListener('click', ()=>{
        nav.classList.add('active');
    })

}
if(close){
    close.addEventListener('click', ()=>{
        nav.classList.remove('active');
    })

}





const heroElement = document.querySelector('#hero');
const offerText = document.getElementById('offer-text');
const dealText = document.getElementById('deal-text');
const productText = document.getElementById('product-text');
const promoText = document.getElementById('promo-text');
const shopButton = document.getElementById('shop-button');

let currentImage = 0;

const images = [
    {
        url: "url('Ecmerse photos/hero-2.png')",
        color: "white",  // First background color
        offer: "Tread-in-offer",
        deal: "Super value deals",
        product: "on all products",
        promo: "Save more with coupons & up to 70% off!",
        button: "Shop Now"
    },
    {
        url: "url('Ecmerse photos/hero-1.png')",
        color: "#f5f5dc",  // Second background color
        offer: "New Collections",
        deal: "Trending Now",
        product: "Men's and Women's Style",
        promo: "Explore the latest trends and styles!",
        button: "Discover Now"
    }
    // You can add more objects for additional collections
];

function updateHeroContent() {
    // Add slide-out class to current elements
    offerText.classList.add('slide-out-left');
    dealText.classList.add('slide-out-left');
    productText.classList.add('slide-out-left');
    promoText.classList.add('slide-out-left');
    shopButton.classList.add('slide-out-left');
    
    setTimeout(() => {
        // Update the content after the slide-out animation
        currentImage = (currentImage + 1) % images.length;
        heroElement.style.backgroundImage = images[currentImage].url;
        heroElement.style.backgroundColor = images[currentImage].color; // Change background color
        offerText.textContent = images[currentImage].offer;
        dealText.textContent = images[currentImage].deal;
        productText.textContent = images[currentImage].product;
        promoText.textContent = images[currentImage].promo;
        shopButton.textContent = images[currentImage].button;
        
        // Remove the slide-out class and add slide-in class
        offerText.classList.remove('slide-out-left');
        dealText.classList.remove('slide-out-left');
        productText.classList.remove('slide-out-left');
        promoText.classList.remove('slide-out-left');
        shopButton.classList.remove('slide-out-left');
        
        offerText.classList.add('slide-in-right');
        dealText.classList.add('slide-in-right');
        productText.classList.add('slide-in-right');
        promoText.classList.add('slide-in-right');
        shopButton.classList.add('slide-in-right');
    }, 500); 
}
updateHeroContent(); 
setInterval(updateHeroContent,  5000); 



