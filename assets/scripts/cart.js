console.clear();

const productsContainer = document.querySelector(".products-container");
const sumElem = document.querySelector("#sum");
const checkout = document.querySelector(".checkout");

checkout.addEventListener("click" , () => {
    let cart = localStorage.getItem("cart");
    if(cart){
        cart = JSON.parse(cart);
        if(cart.length){
            const temp =  [];
            cart.forEach(item => {
                temp.push({id: item.id, count: item.count})
            })
            fetch("http://localhost/api/checkout", {
                method: "POST",
                headers: {
                    "content-type": "application/json",
                },
                body: JSON.stringify({items: temp})
            }).then(res => res.json())
            .then(data => {
                if(data.status == 200){
                    window.location = "/payment?order_id=" + data.order_id
                }
            })
        }else{
            alert("سبد خرید خالی ست")
        }
    }
})

window.addEventListener("load", () => {
    let cart = localStorage.getItem("cart");

    if (cart) {
        cart = JSON.parse(cart);
        render(cart)
    }
})

const render = (cart) => {
    updatePrice();
    productsContainer.innerHTML = ""
    cart.forEach(item => {
        const product = generateTemplate("https://picsum.photos/640/640?r=4133", item.title, item.price, item.count, item.id);
        productsContainer.innerHTML += product
    })
}


const updatePrice = () => {

    let sum = 0;

    let cart = localStorage.getItem("cart");
    if(cart){
        cart = JSON.parse(cart);
        cart.forEach(item => {
            sum += (Number(item.count) * Number(item.price))
        })
        sumElem.innerHTML = sum
    }
}

const generateTemplate = (src, title, price, number, id) => {
    const temp = `
    <section class="cart">
        <section class="cart-image">
            <img src="${src}" alt="${title}">
        </section>
        <section class="details">
            <section class="cart-title">${title}</section>
            <section class="cart-price">${price}$</section>
            <section class="amount" id='${id}'>
                <section class="minus" onclick="removeHandler(event)"> - </section>
                <p class="number">${number}</p>
                <section class="plus" onclick="addHandler(event)"> + </section>
            </section>
        </section>
    </section>    
    `;

    return temp;
}



const removeHandler = (event) => {
    const amount = event.target.parentElement;
    let number = amount.children[1];
    let inner = Number(number.innerHTML);
    const id = amount.id;
    if (inner > 1) {

        number.innerHTML = inner - 1;
        
        let cart = localStorage.getItem("cart");
        cart = JSON.parse(cart);
        const index = cart.findIndex(item => item.id == id);
        cart[index].count = Number(cart[index].count) - 1;
        localStorage.setItem("cart", JSON.stringify(cart));

        updatePrice();
        
    }else if(inner == 1){
        number.innerHTML = inner - 1;
        let cart = localStorage.getItem("cart");
        cart = JSON.parse(cart);
        const index = cart.findIndex(item => item.id == id);
        cart.splice(index , 1)
        localStorage.setItem("cart" , JSON.stringify(cart))
        render(cart)
    } else {
        alert("تعداد محصول نمیتواند کمتر از صفر باشد")
    }

}
const addHandler = (event) => {
    const amount = event.target.parentElement;
    let number = amount.children[1];
    let inner = number.innerHTML;
    number.innerHTML = Number(inner) + 1;

    const id = amount.id;
    let cart = localStorage.getItem("cart");
    cart = JSON.parse(cart);
    const index = cart.findIndex(item => item.id == id);
    cart[index].count = Number(cart[index].count) + 1;
    localStorage.setItem("cart", JSON.stringify(cart));


    updatePrice();
}