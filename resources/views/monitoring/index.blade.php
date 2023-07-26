@extends('layouts.main')
@section('content')
    <style>
        /* Styling for the label */
        .gauge-label {
            margin-left: 120px;
            text-align: center;
            font-size: 20px;
            color: #515151;
            padding: 5px;
        }

        .gauge-label-kelembapan {
            margin-left: 80px;
            margin-top: 30px;
            text-align: center;
            font-size: 20px;
            color: #515151;
            padding: 5px;
        }

        .gauge-label-volt {
            margin-left: 125px;
            margin-top: 30px;
            text-align: center;
            font-size: 20px;
            color: #515151;
            padding: 5px;
        }

        .gauge-label-amper {
            margin-left: 175px;
            text-align: center;
            font-size: 20px;
            color: #515151;
            padding: 5px;
        }

        .gauge-label-arus {
            margin-left: 185px;
            margin-top: 30px;
            text-align: center;
            font-size: 20px;
            color: #515151;
            padding: 5px;
        }

        #chart1,
        #chart2,
        #chart3,
        #chart4,
        #chart5 {
            margin-top: -40px;
        }
    </style>

    <div class="page-titles">
        <ol class="breadcrumb">
            
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Monitoring</a></li>
        </ol>
    </div>
    <div class="container-fluid mh-auto">

        <div class="row">
            <div class="col-lg-12 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row m-b-30">
                            <div class="col-md-5 col-xxl-12">
                                <div class="new-arrival-product mb-4 mb-xxl-4 mb-md-0">
                                    <div>
                                        <div class="d-inline-block position-relative donut-chart-sale mb-3">




                                            <!-- Element to contain the chart and the label -->
                                            <div id="chart1-container">
                                                <!-- Element to render the gauge chart -->
                                                <label class="gauge-label">Suhu</label>
                                                <div id="chart1"></div>
                                                <!-- Label above the gauge chart -->
                                            </div>
                                            <div id="chart2-container">
                                                <!-- Element to render the gauge chart -->
                                                <label class="gauge-label-kelembapan">Kelembapan</label>
                                                <div id="chart2">
                                                </div>
                                            </div>

                                            <div id="chart5-container">
                                                <!-- Element to render the gauge chart -->
                                                <label class="gauge-label-volt">Volt</label>
                                                <div id="chart5">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-xxl-12">
                                <div class="new-arrival-content position-relative">
                                    <div id="chart3-container">
                                        <!-- Element to render the gauge chart -->
                                        <label class="gauge-label-amper">Amper</label>
                                        <div id="chart3">
                                        </div>
                                    </div>
                                    <div id="chart4-container">
                                        <!-- Element to render the gauge chart -->
                                        <label class="gauge-label-arus">Arus</label>
                                        <div id="chart4">
                                        </div>
                                    </div>

                                    
                                        <div class="card box-hover mt-5">
                                            <div class="card-header">
                                                <h5 class="mb-0">ID : A1.01</h5>
                                            </div>
                                            <div class="card-body">
                                               <ul>
                                                <li>Lokasi : Rg.Staff</li>
                                                <li>Type : Cassete</li>
                                                <li>Jenis : Inverter</li>
                                               </ul>                                 
                                            </div>                                            
                                        </div>
                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6 col-xxl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row m-b-30">
                            <div class="col-md-5 col-xxl-12">
                                <div class="new-arrival-product mb-4 mb-xxl-4 mb-md-0">
                                    
                                </div>
                            </div>
                            <div class="col-md-7 col-xxl-12">
                                <div class="new-arrival-content position-relative">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        var temperatureValue = 22; // Your temperature value in Celsius
        var minTemperature = 0; // Minimum value of the temperature range (Celsius)
        var maxTemperature = 100; // Maximum value of the temperature range (Celsius)

        // Calculate the percentage value
        var percentageValue = (temperatureValue - minTemperature) / (maxTemperature - minTemperature) * 100;
        var color;
        if (temperatureValue > 50) {
            color = "#FF0000"; // Red color when temperature is above 50 degrees Celsius
        } else {
            color = "#20E647"; // Green color for other cases
        }
        var options1 = {
            chart: {
                height: 280,
                type: "radialBar",
            },
            series: [percentageValue], // Use the calculated percentage value here
            colors: [color],
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    track: {
                        background: '#333',
                        startAngle: -135,
                        endAngle: 135,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            fontSize: "30px",
                            show: true,
                            formatter: function(val) {
                                return temperatureValue + "°C"; // Display the temperature value with the unit
                            }
                        }
                    }
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    gradientToColors: [color],
                    stops: [0, 100]
                }
            },
            stroke: {
                lineCap: "butt"
            },
            labels: ["Progress"]
        };

        new ApexCharts(document.querySelector("#chart1"), options1).render();




        var options2 = {
            chart: {
                height: 280,
                type: "radialBar",
            },
            series: [67],
            colors: ["#20E647"],
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    track: {
                        background: '#333',
                        startAngle: -135,
                        endAngle: 135,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            fontSize: "30px",
                            show: true
                        }
                    }
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    gradientToColors: ["#87D4F9"],
                    stops: [0, 100]
                }
            },
            stroke: {
                lineCap: "butt"
            },
            labels: ["Progress"]
        };

        new ApexCharts(document.querySelector("#chart2"), options2).render();



        var amperValue = 8.1;
        var maxAmper = 9.7;
        var color;
        if (amperValue > 8) {
            color = "#FF0000"; // Red color when temperature is above 50 degrees Celsius
        } else {
            color = "#20E647"; // Green color for other cases
        }
        // Limit the power value to the maximum value
        powerValue = Math.min(amperValue, maxAmper);


        var options3 = {
            chart: {
                height: 280,
                type: "radialBar",
            },
            series: [amperValue / maxAmper * 100], // Use the calculated percentage value here
            colors: [color],
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    track: {
                        background: '#333',
                        startAngle: -135,
                        endAngle: 135,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            fontSize: "30px",
                            show: true,
                            formatter: function(val) {
                                return amperValue + "A"; // Display the amper value with the unit
                            }
                        }
                    }
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    gradientToColors: [color],
                    stops: [0, 100]
                }
            },
            stroke: {
                lineCap: "butt"
            },
            labels: ["Progress"]
        };

        // Create the chart
        var chart3 = new ApexCharts(document.querySelector("#chart3"), options3).render();


        var powerValue = 2.6; // Your power value in kilowatt (kW)
        var maxPower = 5; // Maximum power value in kilowatt (kW)

        // Limit the power value to the maximum value
        powerValue = Math.min(powerValue, maxPower);

        var color;
        if (powerValue >= 4.5) {
            color = "#FF0000"; // Red color when voltage value is within the threshold
        } else {
            color = "#20E647"; // Green color for other cases
        }

        var options4 = {
            chart: {
                height: 280,
                type: "radialBar",
            },
            series: [powerValue / maxPower * 100], // Use percentage of power value relative to the maximum value
            colors: [color],
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    track: {
                        background: '#333',
                        startAngle: -135,
                        endAngle: 135,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            fontSize: "30px",
                            show: true,
                            formatter: function(val) {
                                return powerValue * 1000 + "W"; // Display the power value in watts with the unit
                            }
                        }
                    }
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    gradientToColors: [color],
                    stops: [0, 100]
                }
            },
            stroke: {
                lineCap: "butt"
            },
            labels: ["Progress"]
        };

        // Create the chart
        var chart4 = new ApexCharts(document.querySelector("#chart4"), options4).render();


        var voltValue = 220; // Your voltage value
        var maxVolt = 230; // Maximum voltage value

        var diff = maxVolt - voltValue;
        var threshold = 10; // Define a threshold value for color change

        var color;
        if (diff <= threshold) {
            color = "#FF0000"; // Red color when voltage value is within the threshold
        } else {
            color = "#20E647"; // Green color for other cases
        }

        var percentageValue = (voltValue / maxVolt) * 100;

        var options5 = {
            chart: {
                height: 280,
                type: "radialBar",
            },
            series: [percentageValue], // Use the calculated percentage value here
            colors: [color], // Set the color based on the calculated value
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    track: {
                        background: '#333',
                        startAngle: -135,
                        endAngle: 135,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            fontSize: "30px",
                            show: true,
                            formatter: function(val) {
                                return voltValue + " Volt"; // Display the voltage value with the unit
                            }
                        }
                    }
                }
            },
            fill: {
                type: "gradient",
                gradient: {
                    shade: "dark",
                    type: "horizontal",
                    gradientToColors: [color],
                    stops: [0, 100]
                }
            },
            stroke: {
                lineCap: "butt"
            },
            labels: ["Progress"]
        };

        // Create the chart
        var chart4 = new ApexCharts(document.querySelector("#chart5"), options5).render();
    </script>
@endsection
