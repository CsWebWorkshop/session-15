const report = document.querySelector("#report");
const manage = document.querySelector("#manage");

fetch("http://localhost/api/admin/")
.then(res => res.json())
.then(data => {
    if(data === 0){
        report.style.display = "none"
        manage.style.display = "none"
    }
})