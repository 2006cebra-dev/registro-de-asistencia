@auth
    <script>window.location = "{{ route('dashboard') }}";</script>
@else
    <script>window.location = "{{ route('login') }}";</script>
@endauth
