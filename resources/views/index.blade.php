<html>

<head>
    <title>Global Agility Solutions ID - System</title>
    @include('components.scripts')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
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
                        <form method="POST" action="{{ route('upload.store') }}">
                            @csrf
                            <div class="col-md-12">
                                <label class="" for="">Signature:</label>
                                @error('signed')
                                    <label class="text text-danger mt-2">{{ $message }}</label>
                                @enderror
                                <br />
                                <div id="sig"></div>
                                <br />
                                <small class="text-muted">For best use, please use digital pad for e-signature</small>
                                <br />
                                <button id="clear" class="btn btn-danger btn-sm mt-3">Clear Signature</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                                <br />
                                <label class="mt-5" for="">Work Image:</label>
                                @error('image')
                                    <label class="text text-danger mt-2">{{ $message }}</label>
                                @enderror
                                <div id="my_camera" class="mt-2 w-100"></div>
                                <br />
                                <input type="button" value="Take Snapshot" class="btn btn-primary btn-sm mt-3"
                                    onClick="take_snapshot()">
                                <input type="hidden" name="image" class="image-tag">
                                <div class="col-md-6">
                                    <div id="results" class="mt-3">Your captured image will appear here...</div>
                                </div>

                                <button class="btn btn-success btn-sm mt-3">Save</button>
                            </div>
                            <br />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });

        Webcam.set({
            width: 490,
            height: 350,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script>
</body>

</html>
