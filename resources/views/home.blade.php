<html>

<head>
    <title>Global Agility Solutions ID - System</title>
    @include('components.scripts')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

</head>

<body class="bg-dark">
    <script>
        $(document).ready(function() {
            $('#records').DataTable();
        });
    </script>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 mx-auto mt-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Global Agility Solutions ID - System</h5>
                    </div>
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
                            <div class="col-6 mx-auto">
                                <form method="POST" action="{{ route('csv.import') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <div class="mb-3">

                                            <label for="" class="form-label">Import File</label>
                                            <input type="file" class="form-control" name="upload_file"
                                                placeholder="">

                                            @error('upload_file')
                                                <div class="text text-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button class="btn btn-success btn-sm mt-3">Import</button>
                                        </div>

                                    </div>
                                    <br />
                                </form>
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
                                                        {{-- @foreach ($row as $key => $item)
                                                            <td scope="row">{{ $item }}</td>
                                                        @endforeach --}}
                                                        <td>{{ $data[$key][0] }}</td>
                                                        <td>{{ $data[$key][1] }}</td>
                                                        <td>{{ $data[$key][2] }}</td>
                                                        <td>{{ $data[$key][3] }}</td>
                                                        <td>{{ $data[$key][4] }}</td>
                                                        <td scope="row">
                                                            <a class="btn btn-primary"
                                                                href="id-template/{{ $data[$key][0] }}/{{ $data[$key][0] }}/{{ $data[$key][1] }}/{{ $data[$key][2] }}"
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
    </div>
</body>

</html>
