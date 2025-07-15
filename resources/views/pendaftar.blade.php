<x-layout>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <style>
        
        th, td{
            white-space: nowrap;
        }
    </style>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data Calon Peserta Didik</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th class="no-export">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            
                    @foreach ($dataSiswa as $item => $siswa)
                        @php $no = $item + 1; @endphp
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $siswa->name }}</td>
                                <td>{{ $siswa->email }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item text-primary" href="{{ route('edit_siswa', $siswa->id) }}">Detail</a>
                                            <a class="dropdown-item text-danger" data-nama="{{ $siswa->name }}" data-id="{{ $siswa->id }}" onclick="hapus(this)" href="#">Hapus</a>    <!-- warna merah -->
                                        </div>
                                    </div>
        
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <!-- DataTables & Buttons -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <!-- JSZip (for Excel export) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function hapus(hapus){
            let nama = hapus.getAttribute('data-nama');
            let id = hapus.getAttribute('data-id');
            Swal.fire({
                title: "Tindakan ini tidak dapat dibatalkan.",
                html: 'Apakah anda yakin ingin menghapus <strong>' + nama + '</strong>?',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, hapus!",
                cancelButtonText: "Batalkan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Terhapus!",
                        text: "Data telah dihapus dengan sukses.",
                        icon: "success",
                        timer: 1500, 
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '/hapus_siswa/' + id;
                    });
                }

            });
        }
        let table = new DataTable('#myTable');
    </script>
</x-layout>