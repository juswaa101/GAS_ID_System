<html>

<head>
    <title>Global Agility Solutions ID - System</title>
    @include('components.scripts')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

</head>

<body class="bg-dark">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Global Agility Solutions ID - System</h5>
                    </div>
                    <div class="card-body">
                        <div class="container px-3 pb-3">
                            <div class="row">
                                <div class="col-4 border">

                                </div>
                                <div class="col-8">
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="close"></button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif
                                    <form method="POST" action="">
                                        @csrf
                                        <div class="col-md-12">
                                            @error('signed')
                                                <label class="text text-danger mt-2">{{ $message }}</label>
                                            @enderror
                                            <div class="mb-3">
                                              <label for="" class="form-label">ID Number</label>
                                              <input type="text"
                                                class="form-control" name="" id="" placeholder="">
                                            </div>

                                            @error('signed')
                                                <label class="text text-danger mt-2">{{ $message }}</label>
                                            @enderror
                                            <div class="mb-3">
                                              <label for="" class="form-label">Name</label>
                                              <input type="text"
                                                class="form-control" name="" id="" placeholder="">
                                            </div>

                                            @error('signed')
                                                <label class="text text-danger mt-2">{{ $message }}</label>
                                            @enderror
                                            <div class="mb-3">
                                              <label for="" class="form-label">Person in-case of emergency</label>
                                              <input type="text"
                                                class="form-control" name="" id="" placeholder="">
                                            </div>


                                            @error('signed')
                                                <label class="text text-danger mt-2">{{ $message }}</label>
                                            @enderror
                                            <div class="mb-3">
                                              <label for="" class="form-label">Contact Person</label>
                                              <input type="text"
                                                class="form-control" name="" id="" placeholder="">
                                            </div>

                                            @error('signed')
                                                <label class="text text-danger mt-2">{{ $message }}</label>
                                            @enderror
                                            <div class="mb-3">
                                              <label for="" class="form-label">RFID</label>
                                              <input type="text"
                                                class="form-control" name="" id="" placeholder="">
                                            </div>



                                            <button class="btn btn-success btn-sm mt-3">Generate</button>
                                        </div>
                                        <br />
                                    </form>
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
