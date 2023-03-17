<html>

<head>
    <title>Global Agility Solutions ID - System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('components.scripts')
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
                                    <form id="importCsv">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Import File</label><br />
                                            <input type="file" class="form-control" name="upload_file">
                                            <small class="text-muted mt-2">Note: Use the following format below in the
                                                table, click download format</small>
                                            <div class="text text-danger mt-2 d-none" id="error"></div>
                                        </div>
                                        <button class="btn btn-success mt-3 float-end" id="importBtn">Import</button>

                                    </form>
                                    <button class="btn btn-primary mt-3 float-end mx-2" id="downloadCsv">Download
                                        Format</button>
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
                                        <tbody></tbody>
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
@include('components.home_form')
