<!--
 * created by     : sagarkumar Meshram
 * created date   : 04-10-2019 -->

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--bootstrap CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-12">
                    <div class="col-md-12">
                        <h1>Library
                            <small>Systems</small>
                        </h1>
                    </div>
                    <table class="table table-striped" id="mydata">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Book Name</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="show_data">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="dropdown">
                <label>Student name</label>

                <select id="sel_depart" class="form-control" class="required">
                    <option value="0">- Select -</option>
                </select>
            </div>

            <div class="dropdown">
                <label>Book name</label>

                <select id="sel_depart2" class="form-control" class="required">
                    <option value="0">- Select -</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" id="check"  class="btn btn-info" data-dismiss="modal">Check availability</button>
                <button type="button" id="issue" class="btn btn-primary">Issue Book</button>
            </div>
        </div>
    </body>
</html>
 <!--Jquery CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/core.js"></script>
 <!--Jquery CDN -->
<script>
    $(document).ready(function () {
        show_book();
        stud_data();
        book_data();

        function show_book() {
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('product/book_data') ?>',
                async: true,
                dataType: 'json',
                success: function (data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                                '<td>' + data[i].name + '</td>' +
                                '<td>' + data[i].b_name + '</td>' +
                                '<td style="text-align:right;">' +
                                '<a href="javascript:void(0);" class="btn btn-success btn-sm item_edit" data-book_id="' + data[i].b_id + '" data>Return Book</a>' + ' ' +
                                '</td>' +
                                '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }

        $('#show_data').on('click', '.item_edit', function () {
            var product_code = $(this).data('book_id');

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('product/return_book') ?>",
                dataType: "JSON",
                data: {product_code: product_code},
                success: function (data) {
                    alert('This book has been returned successfully.');
                    show_book();
                }
            });
        });


        function stud_data() {
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('product/student_data') ?>',
                async: true,
                dataType: 'json',
                success: function (data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }
                    $('#sel_depart').html(html);
                }
            });
        }

        function book_data() {
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('product/book_data2') ?>',
                async: true,
                dataType: 'json',
                success: function (data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id + '">' + data[i].b_name + '</option>';
                    }
                    $('#sel_depart2').html(html);
                }

            });
        }

        $('#check').on('click', function () {
            var stud_id = document.getElementById("sel_depart").value;
            var book_id = document.getElementById("sel_depart2").value;

            $.ajax({
                type: 'ajax',
                type: "POST",
                        url: '<?php echo site_url('product/book_available') ?>',
                dataType: "JSON",
                data: {book_id: book_id},
                success: function (data) {
                    if (data == 0) {
                        alert('Book available...!');
                    } else {
                        alert('This book is not avilable..!');
                    }
                }

            });
        });

        $('#issue').on('click', function () {
            var stud_id = document.getElementById("sel_depart").value;
            var book_id = document.getElementById("sel_depart2").value;

            $.ajax({
                type: 'ajax',
                type: "POST",
                        url: '<?php echo site_url('product/book_issue') ?>',
                dataType: "JSON",
                data: {book_id: book_id, stud_id: stud_id},
                success: function (data) {
                    if (data == false) {
                        alert('Book already issued...!');
                    } else {
                        alert("book issued succesfully");
                    }
                    show_book();
                }

            });

        });

    });
</script>
