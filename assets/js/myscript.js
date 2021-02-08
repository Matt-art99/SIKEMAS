// User Sweet Alert
// Alert CRUD
const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal.fire({
    icon: 'success',
    title: 'Data Berhasil ' + flashData,
    text: ''
  });
}

// Confirm hapus data
$('.tombol-hapus').on('click', function(e){

  e.preventDefault();
  const href = $(this).attr('href');

  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success ml-1',
    cancelButton: 'btn btn-danger mr-1'
  },
  buttonsStyling: false
  });

  swalWithBootstrapButtons.fire({
    title: 'Apakah Kamu Yakin?',
    text: "Ingin menghapus ini",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Hapus!',
    cancelButtonText: 'Batal!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Dibatalkan',
        'Data tidak dihapus',
        'error'
      )
    }
  });

});

// Confirm Logout
$('.tombol-logout').on('click', function(e){
  e.preventDefault();
  const href = $(this).attr('href');

  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success ml-1',
    cancelButton: 'btn btn-danger mr-1'
  },
  buttonsStyling: false
  });

  swalWithBootstrapButtons.fire({
    title: 'Apakah Kamu Yakin?',
    text: "Ingin Logout",
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: 'Ya!',
    cancelButtonText: 'tidak!',
    reverseButtons: true
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    } else if (
      /* Read more about handling dismissals below */
      result.dismiss === Swal.DismissReason.cancel
    ) {
      swalWithBootstrapButtons.fire(
        'Dibatalkan',
        '',
        'error'
      )
    }
  });

});

// Alert logout
const logout = $('.logout').data('logout');

if (logout) {
    Swal.fire({
    icon: 'success',
    title: 'Anda Berhasil ' + logout,
    text: ''
  });
}
