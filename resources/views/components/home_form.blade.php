<script>
    $(window).on("load", () => {
        $("#loading").fadeOut('slow');
        $('#content').removeClass('d-none');
    });

    $(document).ready(function() {
        $('#content').fadeIn('slow');
        let tableName = $('#records').DataTable();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#downloadCsv').click(function(e) {
            e.preventDefault();
            $('#downloadCsv').prop('disabled', true);
            $('#downloadCsv').html("<i class='fa fa-spinner fa-spin'></i> Loading");
            setTimeout(() => {
                location.href = "{{ asset('template/employee.csv') }}";
                $('#downloadCsv').prop('disabled', false);
                $('#downloadCsv').html("Download Format");
            }, 500);
        });

        $('#importBtn').click(function(e) {
            e.preventDefault();
            tableName.clear().draw();
            $('#importBtn').prop('disabled', true);
            $('#importBtn').html("<i class='fa fa-spinner fa-spin'></i> Loading");
            let csvForm = $("#importCsv")[0];
            let csvFormData = new FormData(csvForm);
            $.ajax({
                type: "post",
                url: "{{ route('csv.import') }}",
                data: csvFormData,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function(res) {
                    if (res.status === 200) {
                        $('#importBtn').prop('disabled', false);
                        $('#importBtn').html("Import");
                        $('#error').addClass('d-none');
                        $('#error').html("");
                        for (const [key, value] of Object.entries(res.data)) {
                            const tr = $(
                                '<tr>' +
                                '<td>' + value[0] + '</td>' +
                                '<td>' + value[1] + '</td>' +
                                '<td>' + value[2] + '</td>' +
                                '<td>' + value[3] + '</td>' +
                                '<td>' + value[4] + '</td>' +
                                '<td scope="row">' +
                                '<a class="btn btn-primary" target="_blank"' +
                                'href ="id-template/' + value[0] + '/' + value[1] +
                                '/' + value[2] + '/' + value[3] + '/' + value[4] +
                                '" role = "button">Generate</a></td > ' +
                                '</tr>'
                            );
                            tableName.row.add(tr[0]).draw();
                        }
                    }
                    if (res.status === 400) {
                        $('#error').removeClass('d-none');
                        $('#error').html(res.error);
                        $('#importBtn').prop('disabled', false);
                        $('#importBtn').html("Import");
                    }
                },
                error: function(res) {
                    $('#importBtn').prop('disabled', false);
                    $('#importBtn').html("Import");
                    new swal({
                        title: 'Error',
                        text: 'Something went wrong',
                        icon: 'error'
                    });
                }
            });
        });

        $('#massGenerate').click(function(e) {
            e.preventDefault();
            $('#massGenerate').prop('disabled', true);
            $('#massGenerate').html("<i class='fa fa-spinner fa-spin'></i> Loading");
            setTimeout(() => {
                $('#massGenerate').prop('disabled', false);
                $('#massGenerate').html("Mass Generate");
            }, 500);
            setTimeout(() => {
                window.open('/mass-generate', '_blank')
            }, 500);

        });

        $('#fillUpForm').click(function(e) {
            e.preventDefault();
            $('#fillUpForm').prop('disabled', true);
            $('#fillUpForm').html("<i class='fa fa-spinner fa-spin'></i> Loading");
            setTimeout(() => {
                $('#fillUpForm').prop('disabled', false);
                $('#fillUpForm').html("Fill Up Without CSV");
            }, 500);
            setTimeout(() => {
                window.open('/id-template', '_blank')
            }, 500);
        });
    });
</script>
