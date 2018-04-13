@extends('interview::master')


@section('content')
    @include('interview::products.partials._form')
@endsection

@push('javascript')
    <script type="text/javascript">
        $('form').on('submit', function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var amount = $('#amount').val();
            axios.post('/api/products', { name: name, amount: amount })
                .then(function(response) {
                    if (response.status === 201) {
                        alert('Produkt został utworzony!');
                        e.target.reset();
                    }
                });
        });
    </script>
@endpush