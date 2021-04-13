<!DOCTYPE html>
<html>
<head>
    <title>Data Employee</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    
<div class="container">
    <h1>Data Employee</h1>
    <!-- <form action="" method="get">
        <div class="form-group col-lg-12 mx-auto mb-0">
            <button type ="submit" class="btn btn-primary">
                <span class="font-weight-bold">Add Employee</span>
            </button>
        </div>
        <br>
    </form> -->
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Start date</th>
                <th>End Date</th>
                <th>idMethod</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- <form action="" method="get">
    <div class="form-group col-lg-12 mx-auto mb-0">
        <button type ="submit" class="btn btn-danger">
            <span class="font-weight-bold">Logout</span>
        </button>
    </div>
</form> -->
</div>
</body>
   
<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard') }}",
        columns: [
            // {data: 'subjectName', name: 'subjectName'},
            {data: 'startDate', name: 'startDate'},
            // {data: 'endDate', name: 'endDate'},
            // {data: 'idMethod', name: 'idMethod'},
            // {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    @if(session()->has('message'))
        swal("session()->get('message') ");
    @endif
  });
</script>
</html>