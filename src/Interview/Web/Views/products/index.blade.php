@extends('interview::master')

@section('content')
    <table class="table table-striped text-center">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nazwa</th>
                <th>Ilość</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection

@push('javascript')
    <script type="text/javascript">
        axios.get('/api/products').then(function(response) {
            response.data.map(function(product) {
                $('.table tbody').append('<tr><td>' + product.id + '</td><td>' + product.name + '</td><td>' + product.amount + '</td></tr>');
            });
        });
    </script>
@endpush