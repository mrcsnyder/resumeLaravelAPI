@if ($errors->any())
    <div class="alert bg-secondary text-white">
        @foreach ($errors->all() as $error)
            <span>{{ $error }}<br/></span>
        @endforeach
    </div>
@endif
