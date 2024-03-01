<x-app-layout>
    @if (session()->has('message'))
        @stack('scripts')
        <script>
            Swal.fire({
                title: '{{ session('operationSuccessful') ? 'Success' : 'Error' }}!',
                icon: '{{ session('operationSuccessful') ? 'success' : 'error' }}',
                confirmButtonText: 'Ok',
                html: '{{ session('message') }}'
            })
        </script>
    @endif
    <form method="post" action="{{ route('reservation.store') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="screening_date" id="" value="{{ $date }}">
        <input type="text" name="seat_id" value="300">
        <button type="submit">Reserve</button>
    </form>
    @stack('vite')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
