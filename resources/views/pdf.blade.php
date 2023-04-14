<!DOCTYPE html>
<html lang="en">
<head>    
    <title>Datatables</title>    
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <table class="tabel table-bordered data-table text-center">                    
                    <thead>
                        <tr>
                            <th>S.No</th>                            
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)                        
                        <tr>
                            <td>{{ $user['id'] }}</td>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['action'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                

            </div>

        </div>
    </div>
    
</body>
</html>