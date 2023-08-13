const pagination = document.querySelector(".pagination");
const list = document.querySelector(".list");
const pay = document.querySelector("#pay");
const totalPrice = document.querySelector("#total-price");
const productCount = document.querySelector("#product-count");
const modal = document.querySelector(".modal");
const productList = document.querySelector(".product-list");
const btnClose = document.querySelector(".btn-close");


const createListItem = (id, payment, totalPrice, productCount) => {
    const template = `
    <section class="list-item" onclick="showModal(${id})">
        <section class="pay">
            <p>شماره سفارش:</p>
            <p class="payment-status">${id}</p>
        </section>
        <section class="pay">
            <p>وضعیت پرداخت:</p>
            <p class="payment-status">${payment}</p>
        </section>
        <section class="pay">
            <p>مجموع قیمت:</p>
            <p class="payment-status">${totalPrice}</p>
        </section>
        <section class="pay">
            <p>تعداد محصول خریداری شده:</p>
            <p class="payment-status">${productCount - 1}</p>
        </section>
    </section>
    `;

    return template
}


const createCartTemplate = (src, title, price) => {
    const template = `
    <section class="cart">
        <section class="cart-image">
            <img src=${src} alt=${title}>
        </section>
        <section class="cart-title">${title}</section>
        <section class="cart-price">${price}$</section>
    </section> 
    `;
    return template;
}


btnClose.addEventListener("click", () => {
    modal.style.display = "none"
})


const showModal = (id) => {
    modal.style.display = "flex";
    productList.innerHTML = "                    "

    fetch(`http://localhost/api/orders/${id}`)
        .then(res => res.json())
        .then(orderData => {
            if (orderData.status === 200) {
                // return orderData.data;
                if (orderData.data) {
                    pay.innerHTML = orderData.data.name;
                    productCount.innerHTML = orderData.data.productCount - 1;
                    totalPrice.innerHTML = orderData.data.total;
                    return orderData.data.products;
                }
            }
        })
        .then(products => {
            products.forEach(item => {
                const cart = createCartTemplate("./../../uploads/download.jpg", item.title, item.price);
                productList.innerHTML += cart;
            })

        })
        .catch(err => console.log(err))
}




const fetchOrderData = (page = "1") => {

    pagination.innerHTML = "";
    list.innerHTML = ""

    const queryString = `?page=${page}`
    fetch(`http://localhost/api/orders/${queryString}`)
        .then(res => res.json())
        .then(orderData => {
            for (let i = 1; i <= orderData.totalpages; i++) {
                const page = document.createElement("section");
                page.innerHTML = i;
                page.addEventListener("click", (e) => {
                    console.log(e.target.innerHTML);
                    fetchOrderData(e.target.innerHTML)
                })
                pagination.appendChild(page);
            }

            if (orderData.data) {
                orderData.data.forEach(item => {
                    const template = createListItem(item.id, item.name, item.total, item.productCount);
                    list.innerHTML += template;
                })
            }
        })
        .catch(err => console.log(err))

}

fetchOrderData();

