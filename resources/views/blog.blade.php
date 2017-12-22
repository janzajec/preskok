<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">

    <style>

        table.table-bordered, th.table-bordered, td.table-bordered {
            border: 1px solid black;
        }

        .pagination {
            display: inline-block;
        }

        .pagination {
            list-style-type: none;
        }

        .pagination li {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }
    </style>

</head>
<body>

<h1>Posts</h1>

<hr />


<div class="search">
    <form>
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" id="first_name" name="first_name" /></td>
            </tr>
            <tr>
                <td>Surname</td>
                <td><input type="text" name="last_name" /></td>
            </tr>
            <tr>
                <td>Sale date</td>
                <td><input type="text" name="sale_date" /></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="button" onclick="getPosts(1)">Submit</button></td>
            </tr>
        </table>
    </form>
</div>

<hr />

<div class="posts">
    @include('posts')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

    $(window).on('hashchange', function () {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getPosts(page);
            }
        }
    });

    $(document).ready(function () {
        $(document).on('click', '.pagination a', function (e) {
            getPosts($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });

    function getPosts(page) {

        var first_name = $("#first_name").val();
        var last_name = $("#last_name").val();
        var sale_date = $("#sale_date").val();

        $.ajax({
            url: '?page=' + page + '&first_name=' + first_name + '&last_name=' + last_name + '&sale_date=' + sale_date,
            dataType: 'json'
        }).done(function (data) {
            $('.posts').html(data);
            location.hash = page;
        });
    }

</script>

</body>
</html>