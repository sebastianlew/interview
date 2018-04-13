@extends('interview::master')

@section('content')
    <div class="content">
        @include('interview::products.partials._form')
    </div>
@endsection


@push('javascript')
    <script type="text/javascript">
        axios.get('/api/products/{{ $id }}')
            .then(function(response) {
                var data = response.data;
                $('#name').val(data.name);
                $('#amount').val(data.amount);
            })
            .catch(function(response) {
                $('.content').html('<h1>Produkt nie istnieje</h1>')
            });
    </script>

    <script type="text/javascript">
        $('form').on('submit', function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var amount = $('#amount').val();
            axios.put('/api/products/{{ $id }}', { name: name, amount: amount })
                .then(function(response) {
                    if (response.status === 200) {
                        alert('Produkt został zapisany!');
                    }
                });
        });
    </script>
@endpush