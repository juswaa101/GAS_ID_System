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
                {{-- <h1 class="text-light text-center">IMPORT EMPLOYEE RECORD</h1> --}}
                <div class="card p-5">
                    {{-- <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="close"></button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                    </div> --}}
                    {{-- <div class="container">
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
                    </div> --}}

                    <div class="container">
                        <div class="row">
                            <form action="{{ route("mass-generate.generatePDF") }}" method="post">
                                @csrf
                                <div class="col-sm-12">
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
                                    <button class="btn btn-success" type="submit">Generate</button>
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
                    order: [[5, 'desc']],
                });

                $.ajax({
                    type: "GET",
                    contentType: "application/json; charset=utf-8",
                    url: "/getGASID",
                    data: "",
                    dataType: "JSON",
                    success: function (data) {
                        // console.log(data);
                        $.map(data.data, function(record){
                            console.log(record.employee_id);
                            const tr = $(
                                "<tr>" +
                                    "<td scope=\"row\">" +

                                        "<div class=\"form-check\"\>"+
                                            "<input class=\"form-check-input\" name=\"checked[]\" type=\"checkbox\" value=\""+ record.employee_id +"\" id=\"\"\>"+
                                        "</div>"+
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
                        // $.map(data.d, function (product) {
                        //     $('<tr> <td>' + product.Name + '</td> <td>' + product.ProductNumber + ' </td> <td>' + product.SafetyStockLevel + ' </td> <td>' + product.ReorderPoint + ' </td></tr>').appendTo(".tblData");
                        // });
                    },
                    error: function (response) {
                        new swal({
                            title: 'Error',
                            text: 'Something went wrong',
                            icon: 'error'
                        });
                    }
                });
            });
        </script>

    </div>
</body>

</html>
