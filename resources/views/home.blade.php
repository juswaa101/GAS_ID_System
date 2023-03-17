<html>

<head>
    <title>Global Agility Solutions ID - System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('components.scripts')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body class="bg-dark">
    @include('components.loader')

    <div class="container d-none" id="content">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 mx-auto">
                <img src="{{ asset('images/Final_Logo_Horizontal_White-1.png') }}" height="200px" width="550px"
                    class="img-fluid">
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 mx-auto mt-5 mb-3">
                <h1 class="text-light text-center">IMPORT EMPLOYEE RECORD</h1>
                <div class="card">
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="close"></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <div class="col-12">
                                    <form method="POST" action="{{ route('csv.import') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="" class="form-label">Import File</label><br/>
                                            <input type="file" class="form-control" name="upload_file">
                                            <small class="text-muted mt-2">Note: Use the following format below in the table, click download format</small>
                                            @if(Session::has('error'))
                                                <div class="text text-danger mt-2">
                                                    {{ Session::get('error') }}
                                                </div>
                                            @endif
                                        </div>
                                        <button class="btn btn-success mt-3 float-end" type="submit">Import</button>
                                    </form>
                                    <a href="{{ asset('template/employee.csv') }}"
                                        class="btn btn-primary mt-3 float-end mx-2" download>Download Format</a>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive m-3 border p-3">
                                    <table class="table my-3" id="records">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Contact Person</th>
                                                <th scope="col">Contact Number</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($data != '')
                                                @foreach ($data as $key => $row)
                                                    <tr>
                                                        <td>{{ $data[$key][0] }}</td>
                                                        <td>{{ $data[$key][1] }}</td>
                                                        <td>{{ $data[$key][2] }}</td>
                                                        <td>{{ $data[$key][3] }}</td>
                                                        <td>{{ $data[$key][4] }}</td>
                                                        <td scope="row">
                                                            <a class="btn btn-primary" target="_blank"
                                                                href="id-template/{{ $data[$key][0] }}/{{ $data[$key][1] }}/{{ $data[$key][2] }}/{{ $data[$key][3] }}/{{ $data[$key][4] }}"
                                                                role="button">Generate</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(window).on("load", () => {
        $("#loading").fadeOut('slow');
        $('#content').removeClass('d-none');
    });

    $(document).ready(function() {
        $('#content').fadeIn('slow');
        $('#records').DataTable();
    });
</script>
