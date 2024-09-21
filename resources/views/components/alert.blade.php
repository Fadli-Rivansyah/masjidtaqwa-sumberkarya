<div>
    @if ($message = Session::get('success') )
    <div class="alert alert-success" role="alert">
        {{$message}}
    </div>
    {{-- jika gagal --}}
    @elseif($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">
        {{$mesage}}
    </div>
    @endif
</div>