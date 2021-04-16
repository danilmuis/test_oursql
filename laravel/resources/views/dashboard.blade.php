<!DOCTYPE html>
<html>
<head>
    <title>OUR SQL</title>
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
    <h1>Test Oursql</h1>
    <a href="#" class="btn btn-success my-2" onClick = "callInputModalInput()">Add Something</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Data</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

    <!-- Modal -->
    <div class="modal fade" id="subjectInputModal" tabindex="-1" role="dialog" arialabelledby="subjectInputModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"><h3 id="judul"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form id="modal-input-form" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="modal-input-form-subject-id" name="id">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Data</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-input-form-subjectname" placeholder="HTML TAG" name="data" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                        <button type="submit" id="modal-input-form-submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
   
<script type="text/javascript">
  $(function () {
    var myData;
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard') }}",
        columns: [
            {data: 'id', name : 'id'},
            {data: 'data', name: 'data'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    @if(session()->has('message'))
        swal("session()->get('message') ");
    @endif
  });

    function getSubjects(){
        var url = "route('listSubject')";
        $.ajax({
            type: 'GET',
            url: url,
            beforeSend: function( xhr ) {
                xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        })
        .done(function(data) {
        myData = JSON.parse(data);
        });
    }

    function callInputModalInput(){
        $('#subjectInputModal').modal('show');
        $('#judul').html("Input Data");
        $( "#modal-input-form-subject-id" ).val("");
        $( "#modal-input-form-subjectname" ).val("");
    
    }

    function callInputModal(id, data){
        $('#subjectInputModal').modal('show');
        $('#judul').html("Update Data");
        $("#modal-input-form-subject-id" ).val(id);
        $("#modal-input-form-subjectname" ).val(data);
       
    }

    function insertSubject(data){
        $.ajax({
            type: 'POST',
            url: "{{route('addDummy')}}",
            dataType: "JSON",
            data: new FormData(data),
            processData: false,
            contentType: false,
            beforeSend: function( xhr ) {
                xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        })
        .done(function( data ) {
            $('#subjectInputModal').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
        })
    }

    function updateSubject(data,id){
        $.ajax({
            type: 'POST',
            url: "{{route('addDummy')}}/"+id,
            dataType: "JSON",
            data: new FormData(data),
            processData: false,
            contentType: false,
            beforeSend: function( xhr ) {
                xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        })
        .done(function( data ) {
            $('#subjectInputModal').modal('toggle');
            $('.data-table').DataTable().ajax.reload();
        })
    }

    function deleteSubject(id){
        $.ajax({
            type: 'GET',
            url: "{{route('addDummy')}}/"+id,
            beforeSend: function( xhr ) {
                xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            },
            error: function(xhr, status, error) {
                console.log(xhr);
            }
        })
        .done(function( data ) {
            $('.data-table').DataTable().ajax.reload();
        })
    }

    $(document).ready(function(){
        getSubjects();
        $('#modal-input-form').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            if(formData[0].value == ""){
                insertSubject(this);
            }
            else{
                updateSubject(this,formData[0].value);
            }
        })
    })
</script>
</html>