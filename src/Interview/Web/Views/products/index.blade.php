@extends('interview::master')

@section('content')
    <table class="table table-striped text-center">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nazwa</th>
                <th>Ilość</th>
                <th>Akcja</th>
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
                $('.table tbody').append('<tr id="' + product.id + '"><td>' + product.id + '</td>' +
                    '<td>' + product.name + '</td>' +
                    '<td>' + product.amount + '</td>' +
                    '<td>' +
                    '<a href="/products/edit/'+ product.id +'" class="btn btn-primary btn-sm">Edytuj</a>' +
                    '<button data-id="' + product.id + '" class="remove btn btn-danger btn-sm ml-1">Usuń</button>' +
                    '</td></tr>');
            });
            onClickDelete();
        });

        function onClickDelete() {
            $('.remove').on('click', function(e) {
                e.preventDefault();
                var id = $(e.target).data('id');

                axios.delete('/api/products/' + id)
                    .then(function (response) {
                        if (response.status === 204) {
                            $('#' + id).remove();
                        }
                    });
            });
        }
    </script>
@endpush