console.clear();

const pagination = document.querySelector(".pagination");
const list = document.querySelector(".list");
const createProduct = document.querySelector("#create-product");

createProduct.addEventListener("click", () => {
    window.location.href = "/products/create";
})

const createProductTemplate = (id, src, title, price, ) => {
    const template =`
    <section class="cart">
        <section class="cart-image">
            <img src="./../uploads/download.jpg" alt="test">
        </section>
        <section class="cart-title">${title}</section>
        <section class="cart-price">${price}</section>
        <section class="btn-container">
            <section class="btn-primary" onclick="editHandler(${id})">Edit</section>
            <section class="btn-red">Delete</section>
        </section>
    </section> 
    `;

    return template;
}


const editHandler = id => {
    window.location.href = `/products/${id}/update`;
}



const fetchProductsData = (page = "1") => {
    const queryString = `?page=${page}`;
    pagination.innerHTML = "";
    list.innerHTML = "";

    fetch(`http://localhost/api/products/${queryString}`)
    .then(res => res.json())
    .then(productsData => {
        for(let i=1; i<= productsData.totalpages; i++){
            const page = document.createElement("section");
            page.innerHTML = i;
            page.addEventListener("click", (event) => {
                fetchProductsData(event.target.innerHTML)
            })
            pagination.appendChild(page)

        }
        if(productsData.data){
            productsData.data.forEach(item => {
                const product = createProductTemplate(item.id, item.photo, item.title, item.price);
                list.innerHTML += product;
            })
        }
    })
    .catch(err => console.log(err))

}

fetchProductsData()