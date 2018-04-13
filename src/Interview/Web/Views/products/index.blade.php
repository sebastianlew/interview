@extends('interview::master')

@section('content')
    <form id="filter" class="mb-5">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="filter" id="inlineRadio1" value="" checked>
            <label class="form-check-label" for="inlineRadio1">Wszystkie</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="filter" id="inlineRadio1" value="in_stock">
            <label class="form-check-label" for="inlineRadio1">Na stanie</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="filter" id="inlineRadio2" value="out_of_stock">
            <label class="form-check-label" for="inlineRadio2">Brak na stanie</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="filter" id="inlineRadio3" value="more_than_5">
            <label class="form-check-label" for="inlineRadio3">Ilość > 5</label>
        </div>
    </form>
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
        loadData();

        $('.form-check-input').on('change', function(e) {
            switch (e.target.value) {
                case "in_stock":
                    loadData({ in_stock: 1 });
                    break;
                case "out_of_stock":
                    loadData({ out_of_stock: 1 });
                    break;
                case "more_than_5":
                    loadData({ amount_greater_than: 5 });
                    break;
                default:
                    loadData();
            }
        });

        function loadData(filter) {
            $('.table tbody').html('');

            var params = filter ? $.param(filter) : null;

            axios.get('/api/products?' + params).then(function(response) {
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
        }

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