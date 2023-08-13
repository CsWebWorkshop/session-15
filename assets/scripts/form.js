{/* <section class="result-item">
    <section>
        <p>1</p>
    </section>
    <section>
        <p>name</p>
    </section>
    <section>
        <p>100</p>
    </section>
</section> */}
console.clear();

const d = document;
const modal = d.querySelector(".modal");
const parent_id = d.querySelector("#parent_id");
const btnClose = d.querySelector(".btn-close");
const pagination = d.querySelector(".pagination");
const showRes = d.querySelector("#show-res");
const searchInput = d.querySelector("#search-product");


const fetchProducts = (page, query) => {

    showRes.innerHTML = "";
    pagination.innerHTML = "";

    const queryString = `?page=${page}&query=${query}`;

    fetch(`http://localhost/api/products/${queryString}`)
    .then(res => res.json())
    .then(productsData => {
        console.log(productsData)
        for(let i = 1; i<= productsData.totalpages; i++){
            const page = document.createElement("section");
            page.innerHTML = i;
            page.addEventListener("click", (event) => {
                fetchProducts(event.target.innerHTML, searchInput.value);
            })
            pagination.appendChild(page)
        }

        return productsData.data;
    })
    .then(data => {
        console.log(data);
        data.forEach(item => {
            const line = createTemplate(item.id, item.title, item.price);
            showRes.innerHTML += line;
        })
    })
}


const createTemplate = (id, title, price) => {
    const template = `
    <section class="result-item" onclick="selectID(${id})">
        <section>
            <p>${id}</p>
        </section>
        <section>
            <p>${title}</p>
        </section>
        <section>
            <p>${price}</p>
        </section>
    </section>
    `;

    return template;
}


const selectID = id => {
    parent_id.value = id;
    modal.style.display = "none";
    searchInput.value = "";
    showRes.innerHTML = "";
    pagination.innerHTML = "";
}

btnClose.addEventListener("click", () => {
    modal.style.display = "none";
})


parent_id.addEventListener("focus", () => {
    modal.style.display = "flex";
    fetchProducts("1", "");
})



searchInput.addEventListener("keypress" , (event) => {
    fetchProducts("1", event.target.value);
})