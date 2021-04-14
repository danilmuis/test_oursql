<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alasql/0.6.2/alasql.min.js" integrity="sha512-2avn8of9zz17ejnalEodjUd2blM2VEwSixFrGc0BNDXBlkGBNof9w8/ajoDquplOw/RrExjv4kXQ709719C2Ng==" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">Method</th>
            <th scope="col">Subject</th>
            </tr>
        </thead>
        <tbody>
            @php
                $before = "x";
            @endphp
            @foreach($data as $item)
                @if($before != $item->methodname)
                    <tr>
                        <th scope="row">{{$item->methodname}}</th>
                    @php
                        $before = $item->methodname;
                    @endphp
                @endif
                    <td>
                        <li>{{$item->subjectname}}</li>
                    </td>
            @endforeach
            </tr>
        </tbody>
        </table>


    </div>
    <script>
        var data = <?php echo json_encode($data) ?>;
        console.log(data);
    </script>
</body>
</html>