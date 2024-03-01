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
    show reservations
    @stack('vite')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
</x-app-layout>
