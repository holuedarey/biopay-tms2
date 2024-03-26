
(function () {
    // terminals chart
    let terminalValues = $('#terminalschart').data('values');
    let terminalsData = {
        labels: ["Active", "Inactive"],
        series: terminalValues,
        chart: {
            type: "donut",
            height: 300,
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "bottom",
            fontSize: "14px",
            fontFamily: "Rubik, sans-serif",
            fontWeight: 500,
            labels: {
                colors: ["var(--chart-text-color)"],
            },
            markers: {
                width: 6,
                height: 6,
            },
            itemMargin: {
                horizontal: 7,
                vertical: 0,
            },
        },
        stroke: {
            width: 10,
            colors: ["var(--light2)"],
        },
        plotOptions: {
            pie: {
                expandOnClick: false,
                donut: {
                    size: "83%",
                    labels: {
                        show: true,
                        name: {
                            offsetY: 4,
                        },
                        total: {
                            show: true,
                            fontSize: "20px",
                            fontFamily: "Rubik, sans-serif",
                            fontWeight: 500,
                            label: terminalValues.reduce((accumulator, value) => (accumulator + value), 0),
                            formatter: () => "Total",
                        },
                    },
                },
            },
        },
        states: {
            normal: {
                filter: {
                    type: "none",
                },
            },
            hover: {
                filter: {
                    type: "none",
                },
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: "none",
                },
            },
        },
        colors: ["#54BA4A", "var(--theme-deafult)", "#ce0101"],
        responsive: [
            {
                breakpoint: 1630,
                options: {
                    chart: {
                        height: 360,
                    },
                },
            },
            {
                breakpoint: 1584,
                options: {
                    chart: {
                        height: 400,
                    },
                },
            },
            {
                breakpoint: 1473,
                options: {
                    chart: {
                        height: 250,
                    },
                },
            },
            {
                breakpoint: 1425,
                options: {
                    chart: {
                        height: 270,
                    },
                },
            },
            {
                breakpoint: 1400,
                options: {
                    chart: {
                        height: 320,
                    },
                },
            },
            {
                breakpoint: 480,
                options: {
                    chart: {
                        height: 250,
                    },
                },
            },
        ],
    };

    let terminalsChart = new ApexCharts(
        document.querySelector("#terminalschart"),
        terminalsData
    );

    terminalsChart.render();

    let chartDiv = $('#stats-chart');
    let options = {
        series: [
            {
                name: "NGN",
                data: chartDiv.data('values'),
            },
        ],
        chart: {
            type: "bar",
            height: 300,
            stacked: true,
            toolbar: {
                show: false,
            },
            dropShadow: {
                enabled: true,
                top: 8,
                left: 0,
                blur: 10,
                color: "#7064F5",
                opacity: 0.1,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "25px",
                borderRadius: 0,
            },
        },
        grid: {
            show: true,
            borderColor: "var(--chart-border)",
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 2,
            dashArray: 0,
            lineCap: "butt",
            colors: "#fff",
        },
        fill: {
            opacity: 1,
        },
        legend: {
            show: false,
        },
        states: {
            hover: {
                filter: {
                    type: "darken",
                    value: 1,
                },
            },
        },
        colors: [CubaAdminConfig.primary, "#AAAFCB"],
        yaxis: {
            tickAmount: 3,
            labels: {
                show: true,
                style: {
                    fontFamily: "Rubik, sans-serif",
                },
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        xaxis: {
            categories: chartDiv.data('labels'),
            labels: {
                style: {
                    fontFamily: "Rubik, sans-serif",
                },
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
        },
        responsive: [
            {
                breakpoint: 1661,
                options: {
                    chart: {
                        height: 290,
                    },
                },
            },
            {
                breakpoint: 767,
                options: {
                    plotOptions: {
                        bar: {
                            columnWidth: "35px",
                        },
                    },
                    yaxis: {
                        labels: {
                            show: false,
                        },
                    },
                },
            },
            {
                breakpoint: 481,
                options: {
                    chart: {
                        height: 200,
                    },
                },
            },
            {
                breakpoint: 420,
                options: {
                    chart: {
                        height: 170,
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "40px",
                        },
                    },
                },
            },
        ],
    };

    let statsChart = new ApexCharts(
        document.querySelector("#stats-chart"),
        options
    );
    statsChart.render();

    window.addEventListener("dashboard-transaction-chart", event => {
        statsChart.updateSeries([{
            data: event.detail.values
        }])
    });
})()