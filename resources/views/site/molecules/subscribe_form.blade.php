<form id="subscribe-form" action="{{ route('subscribe') }}" method="POST" >
    @csrf
    @include('site.atoms.input-email')
</form>
