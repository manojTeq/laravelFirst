<!DOCTYPE html>
<html lang="en">
<head>    
    <title>Datatables</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap-grid.css" />
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

    <!-- https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js -->

    <!-- https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js -->
</head>
<body>

    <div class="container">

        <a href="/excel" class="download btn btn-primary btn-sm">Download</a>
        <div class="row">
            <div class="col-md-12 mt-5">
                <table class="tabel table-bordered data-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>

        </div>
    </div>

<script>
    $(function(){
      var table = $(".data-table").DataTable({
        processing:true,
        serverSide:true,
        ajax:"{{ route('users.index') }}",
        columns:[
            {data:'DT_RowIndex',name:'DT_RowIndex'},
            {data:'name',name:'name'},
            {data:'email',name:'email'},
            {data:'action',name:'action'}
        ]
      });
    });

    
    // $('.download').click(function(){
    //     var data = $('.input-sm').val();
    //     alert(data);
    // })
</script>
    
</body>
</html>