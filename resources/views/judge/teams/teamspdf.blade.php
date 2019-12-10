<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Equipos</title>
    <style>
        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            padding: 0 1%;
            margin: 0;
        }

        .container {
            display: table;
            width: 100%;
            margin-top: 25px;
        }

        .card {
            display: table-cell;
            width: 33%;
            min-height: 100px;
            border: 1px dashed;
            padding: 10px;
            line-height: 0.4;
        }

        .card > h4 {
            text-align: center;
        }

        .row {
            display: table-row;
        }

    </style>
</head>

<body>
    <div class="container">
        @php
            $x = 0;
        @endphp
        @foreach ($teams as $team)
        @if($x == 0)
        <div class="row">
        @endif
            <div class="card">
                <h4>{{$team->name}}</h4>
                <p><b>Username:</b> {{$team->User->username}}</p>
                <p><b>Password:</b> {{$team->teamPassword}}</p>
            </div>
        @if($x == 2)
        </div>
        @php
            $x = 0;
        @endphp
        @endif
        @php
            $x++;
        @endphp
        @endforeach
    </div>
</body>

</html>
