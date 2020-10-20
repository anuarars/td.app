<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Протокол</title>
</head>
<body>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 12px;
        }

        h2 {
            font-family: DejaVu Sans, sans-serif; 
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h2 style="font-family: DejaVu Sans, sans-serif; ">Протокол - {{$order->name}}</h2> 
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            @foreach ($users as $user)
                                <th>{{$user}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($names as $name)
                            <tr>
                                @foreach ($name as $price)     
                                    <td>{{$price}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>