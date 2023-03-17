<html>

<head>
    <title>Global Agility Solutions ID - System</title>
    @include('components.scripts')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-dark">
    @include('components.loader')
    <div class="container-fluid" id="id_form">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <img src="{{ asset('images/Final_Logo_Horizontal_White-1.png') }}" height="200px" width="550px"
                    class="img-fluid">
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 mt-5">
                <h1 class="text-light text-center">ID FORM</h1>
                <div class="card">
                    <div class="card-body">
                        <div class="container px-3 pb-3">
                            <div class="row">
                                <div class="col-12 mx-auto">
                                    <form id="idForm">
                                        <label for="" class="form-label text-danger my-3">Required*</label>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="" class="form-label">ID Number<span
                                                        class="text-danger">*</span></label>
                                                <div class="text text-danger" id="id_number_error"></div>
                                                <input type="text" class="form-control" name="employee_id"
                                                    id="employee_id" placeholder="Employee ID"
                                                    value="{{ request()->segment(2) }}">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="" class="form-label">Name<span
                                                        class="text-danger">*</span></label>
                                                <div class="text text-danger" id="name_error"></div>
                                                <input type="text" class="form-control" name="name" id="name"
                                                    value="{{ request()->segment(3) }}" placeholder="Full Name">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="" class="form-label">Designate<span
                                                        class="text-danger">*</span></label>
                                                <div class="text text-danger" id="designate_error"></div>
                                                <input type="text" class="form-control" name="designate"
                                                    id="designate" value="{{ request()->segment(4) }}"
                                                    placeholder="Designate/Position">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="" class="form-label">Person in-case of
                                                    emergency<span class="text-danger">*</span></label>
                                                <div class="text text-danger" id="emer_error"></div>
                                                <input type="text" class="form-control" name="person_emergency"
                                                    id="person_emergency" placeholder="Emergency Person"
                                                    value="{{ request()->segment(5) }}">
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="" class="form-label">Contact Person<span
                                                        class="text-danger">*</span></label>
                                                <div class="text text-danger" id="contact_error"></div>
                                                <input type="text" class="form-control" name="contact_person"
                                                    id="contact_person" placeholder="Contact Person"
                                                    value="{{ request()->segment(6) }}">
                                            </div>

                                            <div class="col-md-8 mx-auto">
                                                <div class="mb-3 w-50 mx-auto">
                                                    <label class="" for="">Signature<span class="text-danger">*</span></label>
                                                    <div class="text text-danger" id="sig_error"></div>
                                                    <br />
                                                    <div id="sig" style="background-color: black; width:100%; height: 150px;">
                                                    </div>
                                                    <br />
                                                    <small class="text-muted">For best use, please use digital pad for
                                                        e-signature</small>
                                                    <br />
                                                    <button id="clear" class="btn btn-danger btn-sm mt-3">Clear
                                                        Signature</button>
                                                    <textarea id="signature64" name="signature" style="display: none"></textarea>
                                                    <br />
                                                </div>


                                                <div class="row">
                                                    <label class="mt-5" for="">Work Image<span
                                                            class="text-danger">*</span></label>

                                                    <div class="col-12 text-center mx-auto">
                                                        <div class="row d-flex align-content-center">
                                                            <div class="col-12 mx-auto">
                                                                <div id="wrap_video">

                                                                    <div id="video_box">

                                                                        <div id="video_overlays">

                                                                            <img id="image_overlay"
                                                                                src="{{ asset('images/circle.png') }}"
                                                                                alt="" srcset=""
                                                                                class=""
                                                                                style="height: 376px; width: 500px;"
                                                                                >

                                                                        </div>
                                                                        <div>
                                                                            <div id="my_camera" class="mt-2 w-100">
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="text text-danger" id="image_error"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <style>
                                                        #my_camera video {
                                                            max-width: 100%;
                                                            max-height: 100%;
                                                        }

                                                        #results img {
                                                            max-width: 100%;
                                                            max-height: 100%;
                                                        }

                                                        #video_box {
                                                            position: relative;
                                                        }

                                                        #video_overlays {
                                                            position: absolute;
                                                            opacity: .70;
                                                            /* z-index: 300000; */
                                                            /* top: 80px;
                                                            left: 0;
                                                            text-align: center; */
                                                            top: 50%;
                                                            left: 50%;
                                                            transform: translate(-50%, -50%);
                                                        }
                                                    </style>

                                                    <small class="text-muted">If you want to retake your shot, click
                                                        the
                                                        Take Snapshot Button again</small>
                                                    <br>
                                                    <div class="col-12">
                                                        <input type="button" value="Take Snapshot"
                                                            class="btn btn-primary btn-sm mt-3"
                                                            onClick="take_snapshot()" id="snap">
                                                    </div>
                                                    <div class="col-12 text-center">
                                                        <input type="hidden" name="image" class="image-tag img-fluid"
                                                            id="image">
                                                        <div class="col-md-12 text-center mx-auto">
                                                            <div id="results" class="mt-3 w-100">Your captured image
                                                                will appear
                                                                here...</div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mt-3">
                                                        <label class="">ID Font Style: </label>
                                                        <select class="form-select" id="font_style" name="font_style"
                                                            onChange="return fontChange();">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <label class="">ID Font Size: </label>
                                                        <select class="form-select" name="font_size" id="font_size">
                                                            @for ($i = 10; $i <= 30; $i += 2)
                                                                <option value="{{ $i }}">
                                                                    {{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <button class="btn btn-success mt-3" id="generateId"
                                                    type="button">Generate</button>
                                            </div>
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
        <div class="dropup position-absolute bottom-0 end-0 rounded-circle m-5 position-sticky float-end">
            <button type="button" class="btn btn-success btn-lg hide-toggle mb-2" data-bs-toggle="dropdown"
                aria-expanded="false" aria-haspopup="true">
                <i class="fas fa-ellipsis-h"></i>
            </button>
            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="#" onclick="topFunction()" id="btnTop">Top</a>
                </li>
                <li>
                    <a class="dropdown-item" href="/">Back to Home</a>
                </li>
            </ul>
        </div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenLite.min.js"></script>
<script type="text/javascript">
    var fonts = [
        "Calibri Light", "Arial", "Courier", "Helvetica",
        "Times",
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
        width: 500,
        height: 450,
        image_format: 'jpeg',
        jpeg_quality: 90,
        fps: 60
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '" class=\'img-fluid w-50\'/>';
        });
    }

    $(window).on("load", () => {
        $("#loading").fadeOut('slow');
        $('#id_form').removeClass('d-none');
        $('#content').fadeIn('slow');
    });

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#employee_id').keyup(function(e) {
            $('#id_number_error').html("");
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
                        $('#name_error').html("");
                        $('#designate_error').html("");
                        $('#emer_error').html("");
                        $('#contact_error').html("");
                        $('#sig_error').html("");
                        $('#image_error').html("");
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
                                        employee_id: $('#employee_id').val(),
                                        name: $('#name').val(),
                                        designate: $('#designate').val(),
                                        person_emergency: $('#person_emergency').val(),
                                        contact_person: $('#contact_person').val(),
                                        font_style: $('#font_style').val(),
                                        font_size: $('#font_size').val(),
                                        sig_path:  "upload/e-signature/" + $('#employee_id').val()+ ".png",
                                        img_path: "upload/profile/" + $('#employee_id').val()+ ".jpeg",
                                        // image: $('#image').val(),
                                        // signature: $('#signature64').val(),
                                    },
                                    responseType: 'arraybuffer',
                                    success: function(data) {
                                        // clear fields after generating an id
                                        // window.open(
                                        //     "/pdf?employee_id=" + $('#employee_id').val() +
                                        //     "&name=" + $('#name').val() +
                                        //     "&designate=" + $('#designate').val() +
                                        //     "&person_emergency=" + $('#person_emergency').val() +
                                        //     "&contact_person=" + $('#contact_person').val() +
                                        //     "&font_style=" + $('#font_style').val() +
                                        //     "&font_size=" + $('#font_size').val() +
                                        //     "&image=" + $('#image').val() +
                                        //     "&signature=" + $('#signature64').val()
                                        // );
                                        window.open(
                                            "/pdf?employee_id=" + $('#employee_id').val() +
                                            "&name=" + $('#name').val() +
                                            "&designate=" + $('#designate').val() +
                                            "&person_emergency=" + $('#person_emergency').val() +
                                            "&contact_person=" + $('#contact_person').val() +
                                            "&font_style=" + $('#font_style').val() +
                                            "&font_size=" + $('#font_size').val() +
                                            "&img_path=" + "upload/profile/" + $('#employee_id').val()+ ".jpeg" +
                                            "&sig_path=" + "upload/e-signature/" + $('#employee_id').val()+ ".png"
                                        );
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
                    }).then(() => location.reload());
                }
            });
        });
    });
</script>
