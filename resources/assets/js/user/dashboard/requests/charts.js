(() => {
    'use strict';
    window.app.user.dashboard.charts = () => {
        // get charts data from server
        window.axios.get('/user/dashboard/requests/chart/data')
            .then(response => {
                getData(response.data);
            })
            .catch(error => console.log(error));

        //handle data
        function getData(data) {


          if(data.body !== undefined && Object.entries(data.body).length>0){
              let requestPercentageCurrYear = data.body.requestPercentageCurrYear;
              makeAreaCharts(requestPercentageCurrYear);


              let requestPercentageLastYear = data.body.requestPercentageLastYear;

              createBarChart(requestPercentageCurrYear, requestPercentageLastYear);

          }





        }

        // create area chart
        function makeAreaCharts(requestPercentageCurrYear) {
            let menData = [];

            let labels = [];

            requestPercentageCurrYear.forEach(obg => {
                menData.push(obg.count);
                labels.push(obg.month);
            });


            let areaChartData = {
                labels: labels,
                datasets: [
                    {
                        label: 'requests',
                        data: menData,
                        borderColor: '#3E348C',
                        backgroundColor: 'rgba(202,197,255,0.51)',
                        fill: true,
                    },

                ]
            };
            let areaChartConfig = {
                type: 'line',
                data: areaChartData,
                options: {
                    animations: {
                        radius: {
                            duration: 400,
                            easing: 'linear',
                            loop: (context) => context.active
                        }
                    },
                    hoverRadius: 7,
                    hoverBackgroundColor: 'black',
                    lineTension: 0.45,
                    plugins: {
                        legend: {
                            position: "top",

                        },
                        filler: {
                            propagate: false,
                        },
                        title: {
                            display: true,
                            text: 'Percentage of your requests per month in ' + new Date().getFullYear(),
                            position: "top",
                            align: "center",
                            fontSize: 16
                        }
                    },

                    radius: 4,
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Months',
                                align: 'center'
                            },
                            grid: {
                                display: false
                            }
                        },
                        y:
                            {
                                title: {
                                    display: true,
                                    text: 'number of requests',
                                    align: 'center'
                                },
                                grid: {
                                    display: false
                                }
                            }
                    },

                },
            };
            if ($('#area-chart').length) {

                let thisChart = $('#area-chart').get(0).getContext('2d');
                new Chart(thisChart, areaChartConfig);


            }
        }

        // create bar chart
        function createBarChart(requestsCurrYear, requestsLastYear) {
            let currYearData = [];
            let lastYearData = [];
            let labels = [];
            requestsCurrYear.forEach(obg => {

                currYearData.push(obg.count);
                labels.push(obg.month);
            });
            requestsLastYear.forEach(obg => {
                lastYearData.push(obg.count);
            });

            const barChartData = {
                labels: labels,
                datasets: [
                    {
                        label:   (new Date().getFullYear() - 1),
                        data: lastYearData,
                        backgroundColor: 'rgba(233,193,33,0.7)',
                        borderColor: '#E9C121',
                        fill: true
                    },
                    {
                        label:   new Date().getFullYear(),
                        data: currYearData,
                        borderColor: '#5f50d7',
                        backgroundColor: 'rgba(95,80,215,0.7)',
                        fill: true
                    },

                ]
            };
            const barChartConfig = {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        bar: {
                            borderWidth: 2,
                        }
                    },
                    plugins: {
                        filler: {
                            propagate: false,
                        },
                        title: {
                            display: true,
                            text: 'Percentage of your requests per month  in ' + new Date().getFullYear() + '/' + (new Date().getFullYear() - 1)
                        }
                    },
                    pointBackgroundColor: '#fff',
                    radius: 10,
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Months',
                                align: 'center'
                            },
                            grid: {
                                display: false
                            }
                        },
                        y:
                            {
                                title: {
                                    display: true,
                                    text: 'number of requests',
                                    align: 'requests'
                                },
                                grid: {
                                    display: false
                                }
                            }
                    }
                },
            };

            if ($('#bar-chart').length) {
                new Chart($('#bar-chart').get(0).getContext('2d'), barChartConfig);
            }
        }

    };
})();
