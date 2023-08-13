console.clear();

const chartContainer = document.querySelector(".chart");
const selectElem = document.querySelector("#selectElem");


const fetchChartData = (time = "") => {

    chartContainer.innerHTML = "";

    const config = {
        type: 'bar',
        data: {

            labels: [],
            datasets: [
                {

                    label: 'فروش محصولات',
                    data: [],
                }
            ]

        },

        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'نمودار فروش محصولات'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };


    const queryString = `?time=${time}`

    fetch(`http://localhost/api/stats/${time ? queryString : ""}`)
        .then(res => res.json())
        .then(dataObj => {
            if(dataObj.data){
                dataObj.data.reverse().forEach(item => {
                    let date = "";
                    if (item.year) {
                        if (item.month) {
                            date += (item.year + "/");
                            if (item.day) {
                                date += (item.month + "/");
                                date += item.day
                            } else {
                                date += item.month;
                            }
                        } else {
                            date += item.year;
                        }
                    }
    
                    config.data.labels.push(date);
                    config.data.datasets[0].data.push(Number(item.productCount))
                });
    
                const canvasElem = document.createElement("canvas");
                canvasElem.id = "myChart";
                new Chart(canvasElem, config);
                chartContainer.appendChild(canvasElem)
            }
        })
        .catch(err => console.log(err))

}

fetchChartData();



selectElem.addEventListener("change", (e) => {
    fetchChartData(e.target.value)
})