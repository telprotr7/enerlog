@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .border-box {
            border-radius: 20px !important;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
        }

        .led-on {
            margin: 10px 30px;
            width: 24px;
            height: 24px;
            background-color: #ABFF00;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #304701 0 -1px 9px, #89FF00 0 2px 12px;
        }

        .led-off {
            margin: 10px 30px;
            width: 24px;
            height: 24px;
            background-color: red;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.2) 0 -1px 7px 1px, inset #582222 0 -1px 9px, rgba(119, 25, 25, 0.5) 0 2px 12px;
        }

        /* tombol remote */
        .containerPanah,
        .containerMode,
        .containerFan,
        .containerPower {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kiri,
        .kanan,
        .fan-auto,
        .fan-high {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            outline: none;
            border: none;
            background-color: #e5e5e5;
            box-shadow: 1px 1px 3px rgba(100, 100, 100, 0.7), inset -1px -1px 3px rgba(65, 64, 64, 0.5);
            border-radius: 50%;
            cursor: pointer;
        }

        .power {
            width: 60px;
            height: 60px;
            outline: none;
            border: none;
            background-color: #e5e5e5;
            box-shadow: 1px 1px 3px rgba(100, 100, 100, 0.7), inset -1px -1px 3px rgba(65, 64, 64, 0.5);
            border-radius: 50%;
            cursor: pointer;
        }

        .power i {
            font-size: 35px;
        }


        .fan,
        .cool,
        .dry {
            outline: none;
            border: none;
            padding-left: 5px;
            padding-right: 5px;
            background-color: #e5e5e5;
            box-shadow: 1px 1px 3px rgba(100, 100, 100, 0.7), inset -1px -1px 3px rgba(65, 64, 64, 0.5);
            border-radius: 100%;
            cursor: pointer;
        }

        .cool,
        .fan,
        .dry,
        .fan-auto,
        .fan-high {
            margin: 5px;
        }

        .kiri i,
        .kanan i,
        .cool i,
        .fan i,
        .dry i,
        .fan-auto i,
        .fan-high i {
            font-size: 24px;
            /* Ukuran ikon */
            margin: 2px;
            /* Jarak antara ikon dan tepi tombol */
        }


        .suhu {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 20px;
            /* Jarak antara tombol panah dan suhu */
            font-size: 24px;
            /* Ukuran teks suhu */
            font-weight: bold;
        }

        .suhu p {
            margin: 0;
        }

        .kiri:active,
        .kanan:active,
        .cool:active,
        .fan:active,
        .dry:active,
        .fan-auto:active,
        .fan-high:active,
        .power:active {
            box-shadow: -1px -1px 3px rgba(100, 100, 100, 0.7), inset 1px 1px 3px rgba(65, 64, 64, 0.5);
        }

        .power-off {
            color: red;
        }

        .power-on {
            color: rgb(9, 238, 9);
        }
    </style>

    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Control</a></li>
        </ol>
    </div>
    <div class="container-fluid mh-auto">

        <div class="row">
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card border-box">
                    <div class="card-body">
                        <div class="new-arrival-product">
                            <div class="new-arrivals-img-contnent">
                                <div class="label">
                                    <strong>ID : A1.01</strong>
                                </div>
                                <div class="led-box">
                                    <div class="led-off" id="led" data-led=""></div>
                                </div>
                                <div class="containerPower mt-5 mb-5">
                                    <button class="power power-off" id="power" data-status="">
                                        <i class="fa-solid fa-power-off" id="iconPower"></i></button>
                                </div>

                                <div class="containerPanah">
                                    <button class="kiri" onclick="playSound('{{ asset('assets/sounds/remote.wav') }}')">
                                        <i class="bi bi-chevron-up"></i>
                                    </button>
                                    <div class="suhu">
                                        <p id="suhudownValue">28</p>
                                    </div>
                                    <button class="kanan" onclick="playSound('{{ asset('assets/sounds/remote.wav') }}')">
                                        <i class="bi bi-chevron-down"></i>
                                    </button>
                                </div>

                                <div class="containerMode mt-5">
                                    <button class="cool" id="cool"><i class="bi bi-snow"></i></button>
                                    <button class="fan" id="fan"><i class="bi bi-life-preserver"></i></button>
                                    <button class="dry" id="dry"><i class="bi bi-droplet"></i></button>
                                </div>

                                <div class="containerFan mt-5">
                                    <button class="fan-auto" id="fanAuto"><i
                                            class="fa-solid fa-circle-radiation"></i></button>
                                    <button class="fan-high" id="fanHigh"><i class="bi bi-flower1"></i></button>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-sm-6">
                <div class="card border-box">
                    <div class="card-body">
                        <div class="new-arrivals-img-contnent">
                            <div class="label">
                                <strong>ID : B1.01</strong>
                            </div>
                            <div class="led-box">
                                <div class="led-on" id="led" data-led=""></div>
                            </div>
                            <div class="containerPower mt-5 mb-5">
                                <button class="power power-on" id="power" data-status="">
                                    <i class="fa-solid fa-power-off" id="iconPower"></i></button>
                            </div>

                            <div class="containerPanah">
                                <button class="kiri" onclick="playSound('{{ asset('assets/sounds/remote.wav') }}')">
                                    <i class="bi bi-chevron-up"></i>
                                </button>
                                <div class="suhu">
                                    <p id="suhudownValue">16</p>
                                </div>
                                <button class="kanan" onclick="playSound('{{ asset('assets/sounds/remote.wav') }}')">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>

                            <div class="containerMode mt-5">
                                <button class="cool" id="cool"><i class="bi bi-snow"></i></button>
                                <button class="fan" id="fan"><i class="bi bi-life-preserver"></i></button>
                                <button class="dry" id="dry"><i class="bi bi-droplet"></i></button>
                            </div>

                            <div class="containerFan mt-5">
                                <button class="fan-auto" id="fanAuto"><i
                                        class="fa-solid fa-circle-radiation"></i></button>
                                <button class="fan-high" id="fanHigh"><i class="bi bi-flower1"></i></button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <audio id="buttonSound"></audio>


    <script>
        function playSound(soundUrl) {
            var buttonSound = document.getElementById("buttonSound");
            buttonSound.src = soundUrl;
            buttonSound.play();
        }
    </script>
@endsection
