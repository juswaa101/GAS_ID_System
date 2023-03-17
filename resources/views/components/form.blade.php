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



    var sig = $('#sig').signature({
        syncField: '#signature64',
        syncFormat: 'PNG',
        background: 'transparent',
        color: '#FFFFFF', // #000000
        thickness: 4,
        change: function(event, ui) {
            $('#sig_error').html("");
        }
    });

    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });

    $(document).keydown(function (e) {
        if(e.key == "Delete"){
            sig.signature('clear');
            $("#signature64").val('');
        }
    });


    // async function getDisplay() {
    //     $("video").
    // }

    // getDisplay();
    Webcam.set({
        width: 400,
        height: 400,
        image_format: 'jpeg',
        jpeg_quality: 90,
        fps: 60
    });

    Webcam.attach('#my_camera');

    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri +
                '" style=\'height:275px;\' class=\'img-fluid w-75\'/>';
        });
    }

    let i = 0;
    $(document).ready(function() {


        $('#signature_form').addClass('d-none');
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
                        new swal({
                            title: 'Validation Error',
                            text: 'Please fill up the form properly!',
                            icon: 'error',
                        });

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
                                        employee_id: $('#employee_id')
                                            .val(),
                                        name: $('#name').val(),
                                        designate: $('#designate').val(),
                                        person_emergency: $(
                                            '#person_emergency').val(),
                                        contact_person: $('#contact_person')
                                            .val(),
                                        font_style: $('#font_style').val(),
                                        font_size: $('#font_size').val(),
                                        sig_path: "upload/e-signature/" + $(
                                                '#employee_id').val() +
                                            ".png",
                                        img_path: "upload/profile/" + $(
                                                '#employee_id').val() +
                                            ".jpeg",
                                    },
                                    responseType: 'arraybuffer',
                                    success: function(data) {
                                        // clear fields after generating an id
                                        window.open(
                                            "/pdf?employee_id=" + $(
                                                '#employee_id')
                                            .val() +
                                            "&name=" + $('#name')
                                            .val() +
                                            "&designate=" + $(
                                                '#designate')
                                            .val() +
                                            "&person_emergency=" +
                                            $('#person_emergency')
                                            .val() +
                                            "&contact_person=" + $(
                                                '#contact_person')
                                            .val() +
                                            "&font_style=" + $(
                                                '#font_style')
                                            .val() +
                                            "&font_size=" + $(
                                                '#font_size')
                                            .val() +
                                            "&img_path=" +
                                            "upload/profile/" + $(
                                                '#employee_id')
                                            .val() + ".jpeg" +
                                            "&sig_path=" +
                                            "upload/e-signature/" +
                                            $('#employee_id')
                                            .val() + ".png"
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


        $('#next').click(function(e) {
            e.preventDefault();
            if ($('#emp_form').hasClass('current') && i == 0) {
                $('#emp_form').removeClass('current').addClass('d-none');
                $('#signature_form').addClass('current').removeClass('d-none');
                $('#step2').addClass('completed');
                $('#prev').removeClass('d-none');
                i++;
            } else if ($('#signature_form').hasClass('current') && i == 1) {
                $('#signature_form').removeClass('current').addClass('d-none');
                $('#camera_form').addClass('current').removeClass('d-none');
                $('#step3').addClass('completed');
                $('#generateId').removeClass('d-none');
                $('#next').addClass('d-none');
                i++;
            }
        });


        $('#prev').click(function(e) {
            e.preventDefault();
            if ($('#camera_form').hasClass('current') && i == 2) {
                $('#camera_form').removeClass('current').addClass('d-none');
                $('#signature_form').addClass('current').removeClass('d-none');
                $('#step3').removeClass('completed');
                $('#generateId').addClass('d-none');
                $('#next').removeClass('d-none');
                i--;
            } else if ($('#signature_form').hasClass('current') && i == 1) {
                $('#signature_form').removeClass('current').addClass('d-none');
                $('#emp_form').addClass('current').removeClass('d-none');
                $('#step2').removeClass('completed');
                $('#prev').addClass('d-none');
                i--;
            } else if ($('#emp_form').hasClass('current') && i == 0) {
                $('#step1').addClass('completed');
            }
        });
    });
</script>
