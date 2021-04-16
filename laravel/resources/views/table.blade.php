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
    <h1>BTP Test</h1>
    <a href="#" class="btn btn-success my-2" onClick = "callInputModalInput()">Add Subject</a>
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
                <th>Metode</th>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <!-- <th width="100px">Action</th> -->
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


    <!-- Modal -->
    <div class="modal fade" id="subjectInputModal" tabindex="-1" role="dialog" arialabelledby="subjectInputModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"><h3>Input Subject</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form id="modal-input-form" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="modal-input-form-subject-id" name="id">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Subject Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-input-form-subjectname" placeholder="Subject Name" name="subjectname" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-input-form-startdate" placeholder="Start Date" name="startdate" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-input-form-enddate" placeholder="End Date" name="enddate" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">id Method</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="modal-input-form-idmethod" placeholder="id Method" name="idmethod" required>
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
    var month_name = function(dt){
        mlist = [ "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ];
        return mlist[dt.getMonth()];
    };
    var myData;
    var beforeMethod = '';
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('table') }}",
        columns: [
            {
                data: 'methodname', 
                name : 'methodname',
                render : function(data,type,row,meta){
                    var output = data;

                    return data;
                }
            },
            {
                data: null, 
                name: 'startdate',
                render : function(data,type,row,meta){
                    var result = [];
                    data.subject_array.map(function(item){
                        if( (new Date(item.date)).getMonth() == 0 ){
                            result.push('<li>'+item.data+'</li>');
                        }

                    });
                    return result;
                }
            },
            {
                data: null, 
                name: 'startdate',
                render : function(data,type,row,meta){
                    var result = [];
                    data.subject_array.map(function(item){
                        if( (new Date(item.date)).getMonth() == 1 ){
                            result.push('<li>'+item.data+'</li>');
                        }

                    });
                    return result;
                }
            },
            {
                data: null, 
                name: 'startdate',
                render : function(data,type,row,meta){
                    var result = [];
                    data.subject_array.map(function(item){
                        if( (new Date(item.date)).getMonth() == 2 ){
                            result.push('<li>'+item.data+'</li>');
                        }

                    });
                    return result;
                }
            },
            {
                data: null, 
                name: 'startdate',
                render : function(data,type,row,meta){
                    var result = [];
                    data.subject_array.map(function(item){
                        if( (new Date(item.date)).getMonth() == 3 ){
                            result.push('<li>'+item.data+'</li>');
                        }

                    });
                    return result;
                }
            },
            {
                data: null, 
                name: 'startdate',
                render : function(data,type,row,meta){
                    var result = [];
                    data.subject_array.map(function(item){
                        if( (new Date(item.date)).getMonth() == 4 ){
                            result.push('<li>'+item.data+'</li>');
                        }

                    });
                    return result;
                }
            },
            {
                data: null, 
                name: 'startdate',
                render : function(data,type,row,meta){
                    var result = [];
                    data.subject_array.map(function(item){
                        if( (new Date(item.date)).getMonth() == 5 ){
                            result.push('<li>'+item.data+'</li>');
                        }

                    });
                    return result;
                }
            },
            // {data: 'subjectname', name: 'subjectname'},
            
            // {
            //     data: 'startdate', 
            //     name: 'startdate',
                
            // },
            // {data: 'enddate', name: 'enddate'},
            // {data: 'idmethod', name: 'idmethod'},
        ]
    });
  });

</script>
</html>