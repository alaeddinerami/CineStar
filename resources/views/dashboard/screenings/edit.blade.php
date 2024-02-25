<x-dashboard-layout>
    @isset($message)
        @stack('scripts')
        <script>
            Swal.fire({
                title: '{{ $operationSuccessful ? 'Success' : 'Error' }}!',
                text: '{{ $message }}',
                icon: '{{ $operationSuccessful ? 'success' : 'error' }}',
                confirmButtonText: 'Ok'
            })
        </script>
    @endisset
    Screenings
    @stack('scripts')
</x-dashboard-layout>
