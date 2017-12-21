<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">

    <style>

        table, th, td {
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
        $.ajax({
            url: '?page=' + page,
            dataType: 'json'
        }).done(function (data) {
            $('.posts').html(data);
            location.hash = page;
        });
    }

</script>

</body>
</html>