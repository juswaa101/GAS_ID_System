<!doctype html>
<html lang="en">

<head>
    <title>Global Agility Solutions ID - System</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('components.scripts')
</head>

<body class="bg-dark">

    @include('components.loader')
    {{-- STEP1 --}}
    <div class="container" id="id_form">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <img src="{{ asset('images/Final_Logo_Horizontal_White-1.png') }}" height="200px" width="550px"
                    class="img-fluid">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card p-5 my-3">
                    <div class="container padding-bottom-3x mb-1">
                        <div
                            class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                            <div class="step completed" id="step1">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="pe-7s-info"></i></div>
                                </div>
                                <h4 class="step-title">Employee Information</h4>
                            </div>
                            <div class="step" id="step2">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="pe-7s-pen"></i></div>
                                </div>
                                <h4 class="step-title">Take Signature</h4>
                            </div>
                            <div class="step" id="step3">
                                <div class="step-icon-wrap">
                                    <div class="step-icon"><i class="pe-7s-camera"></i></div>
                                </div>
                                <h4 class="step-title">Take a Photo</h4>
                            </div>
                        </div>
                    </div>
                    <form id="idForm">
                        <input type="hidden" value="0" name="form_position" id="form_position">
                        {{-- SIGNATURE --}}
                        <div class="container" id="signature_form">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <div class="w-100" id="sig_div">
                                        <label class="" for="">Signature<span
                                                class="text-danger">*</span></label>
                                        <div class="text text-danger" id="sig_error"></div>
                                        <br />
                                        <div id="sig" style="background-color: black; width:100%; height: 200px;">
                                        </div>
                                        <small class="text-muted">For best use, please use digital pad for
                                            e-signature</small>
                                        <br />
                                        <button id="clear" class="btn btn-danger btn-sm mt-3">Clear
                                            Signature</button>
                                        <textarea id="signature64" name="signature" style="display: none"></textarea>
                                        <br />
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- SIGNATURE --}}

                        {{-- FORM --}}
                        <div class="container current" id="emp_form">
                            <div class="row mb-3">
                                <div class="col-md-6 mx-auto">
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <label for="" class="form-label fw-bold">Personal Details</label>
                                        </div>
                                        <div class="col-8 mx-auto">
                                            <label for="" class="form-label">ID Number<span
                                                    class="text-danger">*</span></label>
                                            <div class="text text-danger" id="id_number_error"></div>
                                            <input type="text" class="form-control" name="employee_id"
                                                id="employee_id" placeholder="20230101####"
                                                value="{{ $id }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4"></div>
                                        <div class="col-8 mx-auto">
                                            <label for="" class="form-label">Name<span
                                                    class="text-danger">*</span> (FN MI. LN)</label>
                                            <div class="text text-danger" id="name_error"></div>
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $name }}" placeholder="JUAN D. DELA CRUZ">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4"></div>
                                        <div class="col-8 mx-auto">
                                            <label for="" class="form-label">Designation</label>
                                            <div class="text text-danger" id="designate_error"></div>
                                            <input type="text" class="form-control" name="designate"
                                                id="designate" value="{{ $designation }}"
                                                placeholder="DATA ENTRY SPECIALIST">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 mx-auto">
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <label for="" class="form-label fw-bold">Contact Person in-case of
                                                Emergency</label>
                                        </div>
                                        <div class="col-8 mx-auto">
                                            <label for="" class="form-label">Name<span
                                                    class="text-danger">*</span></label>
                                            <div class="text text-danger" id="emer_error"></div>
                                            <input type="text" class="form-control" name="person_emergency"
                                                id="person_emergency" placeholder="JUANA C. DELA CRUZ"
                                                value="{{ $contact_name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4"></div>
                                        <div class="col-8 mx-auto">
                                            <label for="" class="form-label">Contact Number<span
                                                    class="text-danger">*</span></label>
                                            <div class="text text-danger" id="contact_error"></div>
                                            <input type="text" class="form-control" name="contact_person"
                                                id="contact_person" placeholder="09123456789"
                                                value="{{ $contact_number }}">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        {{-- FORM --}}

                        {{-- CAMERA --}}
                        <div class="container d-none" id="camera_form">
                            <div class="row">
                                <div class="col-md-6 mx-auto mb-3">
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
                                                                    alt="" srcset="" class=""
                                                                    style="height: 390px; width: 400px;">

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
                                                opacity: .20;
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
                                                class="btn btn-primary btn-sm mt-3" onClick="take_snapshot()"
                                                id="snap">
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
                                </div>
                            </div>
                        </div>
                        {{-- CAMERA --}}
                    </form>

                    <div class="container my-3">
                        <div class="row">
                            <div class="col-6 mx-auto">
                                <div class="row">
                                    <div class="col-6 text-start">
                                        <button class="btn btn-secondary d-none" id="prev">Previous</button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn btn-success" id="next">Next</button>
                                        <button class="btn btn-success d-none" id="generateId"
                                            type="button">Generate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- STEP1 --}}
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenLite.min.js"></script>
<script>
    $(window).on("load", () => {
        $("#loading").fadeOut('slow');
        $('#id_form').removeClass('d-none');
        $('#content').fadeIn('slow');
    });
</script>

@include('components.form')
