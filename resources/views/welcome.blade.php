<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Enviozapp - Exam</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <script
                src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- Fonts -->


        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
     <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            #map {
                width: 800px;
                height: 500px;
            }

            /* chk-btn CSS from
            http://stackoverflow.com/questions/30100978/how-to-make-a-check-button-hidden-checkbox-with-label-as-a-button-css-only
            */

            input.chk-btn {
                display: none;
            }
            input.chk-btn + label {
                border: 1px solid grey;
                background: ghoswhite;
                padding: 5px 8px;
                cursor: pointer;
                border-radius: 5px;

            }
            input.chk-btn:not(:checked) + label:hover {
                box-shadow: 0px 1px 3px;

            }
            input.chk-btn + label:active,
            input.chk-btn:checked + label {
                box-shadow: 0px 0px 3px inset;
                background: #8cc472;

            }
            .filter {
                margin-top: 25px;
            }
        </style>
        <script>
            let peoplaArray = @json($people);
        </script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <br>
                    <div class="row" style="padding: 15px; background-color: aliceblue">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="people" class="col-sm-4 col-form-label" style="font-weight: bold">Filtar por Persona</label>
                                <select class="form-control form-control-md col-sm-6" name="people" id="people">
                                </select>
                            </div>
                        </div>
                    </div>
                <div id="map"></div>
            </div>
        </div>
    </body>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnX6uQ7MiRiMvteFckcZYg1IWJYzvkfVg&callback=initMap"
            type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('js/map.js') }}"></script>
</html>
