<html>

<head>
    <title>Global Agility Solutions ID - System</title>
    @include('components.scripts')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .zoom:hover {
            transform: scale(1.5);
        }
    </style>
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
                                <div class="col-4">
                                    <div class="container">
                                        <div class="row mb-3 p-3">
                                            <div class="zoom">
                                                <img src="{{ asset('template/FRONT.png') }}" id="front_img"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="row p-3">
                                            <div class="zoom">
                                                <img src="{{ asset('template/BACK.jpg') }}" id="back_img"
                                                    class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="row p-3 mt-2">
                                            <button class="btn btn-secondary">Clear Preview</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <form id="idForm">
                                        <label for="" class="form-label text-danger my-3">Required*</label>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="" class="form-label">ID Number<span
                                                        class="text-danger">*</span></label>
                                                <div class="text text-danger" id="id_number_error"></div>
                                                <input type="text" class="form-control" name="employee_id"
                                                    id="employee_id" placeholder="Employee ID"
                                                    value="{{ request()->segment(2) }}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="form-label">RFID<span
                                                        class="text-danger">*</span></label>
                                                <div class="text text-danger" id="rfid_number_error"></div>
                                                <input type="text" class="form-control" name="rfid" id="rfid"
                                                    value="{{ request()->segment(3) }}" placeholder="RFID" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="form-label">Name<span
                                                        class="text-danger">*</span></label>
                                                <div class="text text-danger" id="name_error"></div>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    value="{{ request()->segment(4) }}" placeholder="Full Name"
                                                    readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="form-label">Designate<span
                                                        class="text-danger">*</span></label>
                                                <div class="text text-danger" id="designate_error"></div>
                                                <input type="text" class="form-control" name="designate"
                                                    id="designate" value="{{ request()->segment(5) }}"
                                                    placeholder="Designate/Position" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="form-label">Person in-case of
                                                    emergency<span class="text-danger">*</span></label>
                                                <div class="text text-danger" id="emer_error"></div>
                                                <input type="text" class="form-control" name="person_emergency"
                                                    id="person_emergency" placeholder="">
                                            </div>

                                            <div class="mb-3">
                                                <label for="" class="form-label">Contact Person<span
                                                        class="text-danger">*</span></label>
                                                <div class="text text-danger" id="contact_error"></div>
                                                <input type="text" class="form-control" name="contact_person"
                                                    id="contact_person" placeholder="">
                                            </div>

                                            <label class="" for="">Signature<span
                                                    class="text-danger">*</span></label></label>
                                            <div class="text text-danger" id="sig_error"></div>
                                            <br />
                                            <div id="sig" style="background-color: black;"></div>
                                            <br />
                                            <small class="text-muted">For best use, please use digital pad for
                                                e-signature</small>
                                            <br />
                                            <button id="clear" class="btn btn-danger btn-sm mt-3">Clear
                                                Signature</button>
                                            <textarea id="signature64" name="signature" style="display: none"></textarea>
                                            <br />
                                            <label class="mt-5" for="">Work Image<span
                                                    class="text-danger">*</span></label></label>
                                            <div class="text text-danger" id="image_error"></div>
                                            <div id="my_camera" class="mt-2 w-100"></div>
                                            <br />
                                            <input type="button" value="Take Snapshot"
                                                class="btn btn-primary btn-sm mt-3" onClick="take_snapshot()"
                                                id="snap">
                                            <input type="hidden" name="image" class="image-tag" id="image">
                                            <div class="col-md-6">
                                                <div id="results" class="mt-3">Your captured image will appear
                                                    here...</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label class="">ID Font Style: </label>
                                                    <select class="form-control" id="font_style" name="font_style"
                                                        onChange="return fontChange();">
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="">ID Font Size: </label>
                                                    <select class="form-control" name="font_size" id="font_size">
                                                        @for ($i = 10; $i <= 30; $i += 2)
                                                            <option value="{{ $i }}">{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <button class="btn btn-success btn-sm mt-3" id="generateId"
                                                type="button">Generate</button>
                                            <button class="btn btn-primary btn-sm mt-3 d-none" id="viewId"
                                                type="button">View My ID</button>
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
        <button onclick="topFunction()" class="btn btn-warning float-end mb-5" id="btnTop" title="Go to top">
            <i class="fas fa-caret-up"></i>
        </button>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenLite.min.js"></script>
<script type="text/javascript">
    var fonts = ["Montez", "Lobster", "Josefin Sans", "Shadows Into Light", "Pacifico", "Amatic SC", "Orbitron",
        "Rokkitt", "Righteous", "Dancing Script", "Bangers", "Chewy", "Sigmar One", "Architects Daughter",
        "Abril Fatface", "Covered By Your Grace", "Kaushan Script", "Gloria Hallelujah", "Satisfy", "Lobster Two",
        "Comfortaa", "Cinzel", "Courgette"
    ];
    var string = "";
    var select = document.getElementById("font_style")
    for (var a = 0; a < fonts.length; a++) {
        var opt = document.createElement('option');
        opt.value = opt.innerHTML = fonts[a];
        opt.style.fontFamily = fonts[a];
        select.add(opt);
    }

    function fontChange() {
        var x = document.getElementById("font_style").selectedIndex;
        var y = document.getElementById("font_style").options;
        document.body.insertAdjacentHTML("beforeend", "<style> #text{ font-family:'" + y[x].text + "';}" +
            "#select{font-family:'" + y[x].text + "';</style>");
    }
    fontChange();

    let btnTop = document.getElementById("btnTop");
    window.onscroll = () => scrollFunction();

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            btnTop.style.display = "block";
        } else {
            btnTop.style.display = "none";
        }
    }

    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }

    var sig = $('#sig').signature({
        syncField: '#signature64',
        syncFormat: 'PNG',
        background: 'transparent',
        color: '#FFFFFF', // #000000
        change: function(event, ui) {
            $('#sig_error').html("");
        }
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
        jpeg_quality: 90,
        fps: 60
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
        });
    }

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#employee_id').keyup(function(e) {
            $('#id_number_error').html("");
        });

        $('#rfid').keyup(function(e) {
            $('#rfid_number_error').html("");
        });

        $('#name').keyup(function(e) {
            $('#name_error').html("");
        });

        $('#designate').keyup(function(e) {
            $('#designate_error').html("");
        });

        $('#person_emergency').keyup(function(e) {
            $('#emer_error').html("");
        });

        $('#contact_person').keyup(function(e) {
            $('#contact_error').html("");
        });

        $('#signature64').change(function(e) {
            $('#sig_error').html("");
        });

        $('#snap').click(function(e) {
            $('#image_error').html("");
        });

        $('#generateId').click(function(e) {
            e.preventDefault();
            $('#generateId').prop('disabled', true);
            $('#generateId').html("<i class='fa fa-spinner fa-spin'></i> Loading");

            let idForm = $("#idForm")[0];
            let idFormData = new FormData(idForm);

            $.ajax({
                type: "post",
                url: "{{ route('upload.template') }}",
                data: idFormData,
                enctype: "multipart/form-data",
                processData: false,
                contentType: false,
                cache: false,
                success: function(res) {
                    $('#generateId').prop('disabled', false);
                    $('#generateId').html("Generate");
                    if (res.status === 400) {
                        window.scrollTo(0, 0);

                        if (res.error.employee_id != null) {
                            $('#id_number_error').html(res.error.employee_id);
                        }
                        if (res.error.rfid != null) {
                            $('#rfid_number_error').html(res.error.rfid);
                        }
                        if (res.error.name != null) {
                            $('#name_error').html(res.error.name);
                        }
                        if (res.error.designate != null) {
                            $('#designate_error').html(res.error.designate);
                        }
                        if (res.error.person_emergency) {
                            $('#emer_error').html(res.error.person_emergency);
                        }
                        if (res.error.contact_person != null) {
                            $('#contact_error').html(res.error.contact_person);
                        }
                        if (res.error.signature != null) {
                            $('#sig_error').html(res.error.signature);
                        }
                        if (res.error.image != null) {
                            $('#image_error').html(res.error.image);
                        }
                    }

                    if (res.status === 200) {
                        $('#id_number_error').html("");
                        $('#rfid_number_error').html("");
                        $('#name_error').html("");
                        $('#designate_error').html("");
                        $('#emer_error').html("");
                        $('#contact_error').html("");
                        $('#sig_error').html("");
                        $('#image_error').html("");
                        // $('#viewId').removeClass("d-none");
                        new swal({
                            title: 'Success',
                            text: 'Click the button below to view your ID',
                            icon: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "get",
                                    url: "{{ route('generate.pdf') }}",
                                    data: {
                                        employee_id: $('#employee_id')
                                            .val(),
                                        name: $('#name').val(),
                                        designate: $('#designate').val(),
                                        person_emergency: $(
                                            '#person_emergency').val(),
                                        contact_person: $('#contact_person')
                                            .val(),
                                        rfid: $('#rfid').val(),
                                        font_style: $('#font_style').val(),
                                        font_size: $('#font_size').val(),
                                        image: $('#image').val(),
                                        signature: $('#signature64').val(),
                                    },
                                    success: function(response) {
                                        // clear fields after generating an id
                                        $('#person_emergency').val('');
                                        $('#contact_person').val('')
                                        $('#image').val('');
                                        $('#signature64').val('');
                                        sig.signature('clear');
                                        document.getElementById('results').innerHTML ="";
                                    }
                                });
                            }
                        });
                    }
                },
                error: function() {
                    $('#generateId').prop('disabled', false);
                    $('#generateId').html("Generate");
                    new swal({
                        title: 'Error',
                        text: 'Something Went Wrong While Generating Your Id... Please Try Again!',
                        icon: 'error'
                    });
                }
            });
        });
    });
</script>
