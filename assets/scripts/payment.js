const checkout = document.querySelector("#success");


checkout.addEventListener("click" , () => {
    const params = new Proxy(new URLSearchParams(window.location.search), {
        get: (searchParams, prop) => searchParams.get(prop),
    });
    let order_id = params.order_id;
    localStorage.setItem("cart", JSON.stringify([]))
    Swal.fire({
        title: "موفقیت آمیز",
        icon: "success",
        text: "پرداخت با موفقیت انجام شد"
    }).then(() => {
        window.location.href = "/success?order_id=" + order_id;
    })
})