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
                <h1 class="text-light text-center">MASS GENERATE EMPLOYEE ID</h1>
                <div class="card p-5">
                    <div class="container">
                        <div class="row">
                            <form action="{{ route('mass-generate.generatePDF') }}" method="post">
                                @csrf
                                <div class="col-sm-12">
                                    <span id="note" class="mx-2 text-danger"></span>
                                    <div class="table-responsive m-3 border p-3">
                                        <table class="table my-3" id="records">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">ID Number</th>
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Designation</th>
                                                    <th scope="col">Contact Person</th>
                                                    <th scope="col">Contact Number</th>
                                                    <th scope="col">Date Created</th>

                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit" id="generate">Generate</button>
                                    <button class="btn btn-secondary" type="button" id="back">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(window).on("load", () => {
                $("#loading").fadeOut('slow');
                $('#content').removeClass('d-none');
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                $('#content').fadeIn('slow');
                let tableName = $('#records').DataTable({
                    order: [
                        [6, 'desc']
                    ],
                });

                $.ajax({
                    type: "GET",
                    contentType: "application/json; charset=utf-8",
                    url: "/getGASID",
                    data: "",
                    dataType: "JSON",
                    success: function(data) {
                        if (data.data.length === 0 || typeof data.data === "undefined" || typeof data
                            .data === null) {
                                $('#note').html('&nbsp; <i class="fa fa-warning"></i>&nbsp; No existing record yet to generate!');
                            $('#generate').prop('disabled', true);
                        } else {
                            $('#generate').prop('disabled', false);
                            $.map(data.data, function(record) {
                                const tr = $(
                                    "<tr>" +
                                    "<td scope=\"row\">" +

                                    "<div class=\"form-check\"\>" +
                                    "<input class=\"form-check-input\" name=\"checked[]\" type=\"checkbox\" value=\"" +
                                    record.employee_id + "\" id=\"\"\>" +
                                    "</div>" +
                                    "</td >" +
                                    "<td>" + record.employee_id + "</td>" +
                                    "<td>" + record.name + "</td>" +
                                    "<td>" + record.designation + "</td>" +
                                    "<td>" + record.contact_person + "</td>" +
                                    "<td>" + record.contact_person_number + "</td>" +
                                    "<td>" + record.created_at + "</td>" +
                                    "</tr>"
                                );
                                tableName.row.add(tr[0]).draw();
                            });
                        }
                    },
                    error: function(response) {
                        new swal({
                            title: 'Error',
                            text: 'Something went wrong',
                            icon: 'error'
                        });
                    }
                });

                $('#back').click(function(e) {
                    e.preventDefault();
                    $('#back').prop('disabled', true);
                    $('#back').html("<i class='fa fa-spinner fa-spin'></i> Loading");
                    setTimeout(() => {
                        $('#back').prop('disabled', false);
                        $('#back').html("Cancel");
                    }, 750);
                    location.href = "/";
                });
            });
        </script>

    </div>
</body>

</html>
