<table>
    <thead>
    <tr>
        <td>#</td>
        <td>Vehicle ID</td>
        <td>Inhouse seller ID</td>
        <td>Buyer ID</td>
        <td>Model ID</td>
        <td>Sale date</td>
        <td>Buy date</td>
    </tr>
    </thead>
    <tbody>

    @foreach ($posts as $post)

        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->vehicle_id}}</td>
            <td>{{$post->inhouse_seller_id}}</td>
            <td>{{$post->buyer_id}}</td>
            <td>{{$post->model_id}}</td>
            <td>{{$post->sale_date}}</td>
            <td>{{$post->buy_date}}</td>
        </tr>

    @endforeach

    </tbody>
</table>

{{ $posts->links() }}