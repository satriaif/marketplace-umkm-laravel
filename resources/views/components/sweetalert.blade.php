<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
<script>
Swal.fire({
   icon: 'success',
   title: 'Berhasil',
   text: '{{ session("success") }}',
   timer: 2000,
   showConfirmButton: false
});
</script>
@endif