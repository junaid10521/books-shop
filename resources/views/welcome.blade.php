<!DOCTYPE html>
<html lang="en">
<head>
    <title>Filters</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!--  Flatpicker Styles  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Different Filters to Search Book Records</h2>
    <form>

        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" placeholder="Search book by title" name="title">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" class="form-control" id="author" placeholder="Search book by Author's first name" name="author">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" id="price" placeholder="Search book by price" name="price">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group pull-right">
                    <label for="date">Date:</label>
                    <input type="text" id="date" placeholder="Search Book: Published Date" name="date">
                </div>
            </div>
        </div>
        <div class="pull-right">
            <button id="btn-submit" type="submit" class="btn btn-success">Search</button>
        </div>
        <div>
            <button id="btn-reset" class="btn btn-warning">Reset Search</button>
        </div>
    </form>

    <div>
        @include('searchResults')
    </div>
</div>


<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--  Flatpickr  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        $('#btn-reset').click(function (e){
            e.preventDefault();
            $('#title').val('');
            $('#author').val('');
            $('#price').val('');
            $('#date').val('');
            $.ajax({
                url: `/api/allBooks`,
                type: "Get",
                dataType: 'json',
                success: function(response) {
                    var html = '<tr>';
                    for (var i = 0; i < response.data.length; i++) {
                        html += "<td>" + i + "</td>";
                        html += "<td>" + response.data[i].title + "</td>";
                        if (response.data[i].author) {
                            html += "<td>" + response.data[i].author.first_name + "</td>";
                            html += "<td>" + response.data[i].author.last_name + "</td>";
                        } else {
                            html += "<td>N/A</td>";
                            html += "<td>N/A</td>";
                        }
                        html += "<td>" + response.data[i].created_at + "</td>";
                        if (response.data[i].price) {
                            html += "<td>" + response.data[i].price.price + "</td>";
                        } else {
                            html += "<td>N/A</td>";
                        }
                        html += '</tr>';
                    }
                    $("#myTable").html(html);
                }
            });
        });

        $.ajax({
            url: `/api/allBooks`,
            type: "Get",
            dataType: 'json',
            success: function(response) {
                var html = '<tr>';
                for (var i = 0; i < response.data.length; i++) {
                    html += "<td>" + i + "</td>";
                    html += "<td>" + response.data[i].title + "</td>";
                    if (response.data[i].author) {
                        html += "<td>" + response.data[i].author.first_name + "</td>";
                        html += "<td>" + response.data[i].author.last_name + "</td>";
                    } else {
                        html += "<td>N/A</td>";
                        html += "<td>N/A</td>";
                    }
                    html += "<td>" + response.data[i].created_at + "</td>";
                    if (response.data[i].price) {
                        html += "<td>" + response.data[i].price.price + "</td>";
                    } else {
                        html += "<td>N/A</td>";
                    }
                    html += '</tr>';
                }
                $("#myTable").html(html);
            }
        });

    });

    $("#btn-submit").on('click', function(e){
        e.preventDefault();
        let title = $('#title').val();
        let author = $('#author').val();
        let price = $('#price').val();
        let date = $('#date').val();
        $.ajax({
            url: `/api/searchBooks/?title=${title}&author=${author}&price=${price}&date=${date}`,
            type: "Get",
            dataType: 'json',
            success: function(response) {
                    var html = '<tr>';
                    for (var i = 0; i < response.data.length; i++) {
                        html += "<td>" + i + "</td>";
                        html += "<td>" + response.data[i].title + "</td>";
                        if (response.data[i].author) {
                            html += "<td>" + response.data[i].author.first_name + "</td>";
                            html += "<td>" + response.data[i].author.last_name + "</td>";
                        } else {
                            html += "<td>N/A</td>";
                            html += "<td>N/A</td>";
                        }
                        html += "<td>" + response.data[i].created_at + "</td>";
                        if (response.data[i].price) {
                            html += "<td>" + response.data[i].price.price + "</td>";
                        } else {
                            html += "<td>N/A</td>";
                        }
                        html += '</tr>';
                    }
                    $("#myTable").html(html);
            }
        });
    });

    $("#date").flatpickr({
        dateFormat: "Y-m-d"
    });
</script>

</body>
</html>
