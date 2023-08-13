console.clear();
const num = document.querySelector(".num");

const updateNumber = () => {
    let cart = localStorage.getItem("cart");
    if(cart){
        cart = JSON.parse(cart);
        const len = cart.length
        num.innerHTML = len
    }else{
        localStorage.setItem("cart", JSON.stringify([]))
        const len = 0;
        num.innerHTML = len
    }
}

window.addEventListener("load", () => {
    updateNumber();
})


const addToCart = (id) => {
    fetch(`http://localhost/api/product/${id}`)
    .then(response => response.json())
    .then(data => {
        let cart = localStorage.getItem("cart");
        if(cart){
            cart = JSON.parse(cart);
            if( !cart.find(item => item.id == id) ){
                const product = {
                    ...data,
                    count: 1
                }
                cart.push(product);
                localStorage.setItem("cart", JSON.stringify(cart))
                updateNumber();
            }else{
                alert("محصول در سبد خرید وجود دارد.")
            }
        }else{
            const product = {
                ...data,
                count: 1
            }
            localStorage.setItem("cart", JSON.stringify([product]));
        }
    })
    .catch(err => console.log(err))
}