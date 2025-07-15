# Sistem Upload Gambar Timeline

## Cara Kerja

Sistem upload gambar timeline telah dimodifikasi untuk mengoptimalkan penggunaan storage dan mencegah penumpukan file yang tidak terpakai.

### Alur Kerja:

1. **Upload Gambar Sementara**
   - Saat user menambahkan gambar ke editor Summernote, gambar akan diupload ke folder `storage/app/public/uploads/timeline/temp/`
   - URL gambar sementara disimpan di hidden input `temp_images`
   - Gambar dapat dilihat di editor untuk preview

2. **Form Submit**
   - Saat form disubmit, sistem akan:
     - Memindahkan semua gambar dari folder `temp` ke folder permanen `uploads/timeline/`
     - Mengupdate URL di konten dari URL sementara ke URL permanen
     - Menyimpan timeline ke database dengan konten yang sudah diupdate
     - Membersihkan gambar sementara yang tidak digunakan

3. **Pembersihan Otomatis**
   - Jika user refresh halaman atau menutup browser tanpa submit form, gambar sementara akan dihapus
   - Sistem juga membersihkan gambar sementara yang berusia lebih dari 1 jam

### File yang Dimodifikasi:

1. **resources/views/timeline.blade.php**
   - Menambahkan hidden input untuk menyimpan path gambar sementara
   - Mengubah JavaScript untuk upload ke endpoint sementara
   - Menambahkan event listener untuk cleanup saat halaman unload

2. **app/Http/Controllers/TimelineController.php**
   - Menambahkan method `uploadTempImage()` untuk upload gambar sementara
   - Memodifikasi method `store()` untuk memindahkan gambar dari temp ke permanen
   - Menambahkan method `cleanupTempImages()` dan `cleanupSpecificTempImages()`

3. **routes/web.php**
   - Menambahkan route untuk upload gambar sementara dan cleanup

### Struktur Folder:

```
storage/app/public/uploads/timeline/
├── temp/           # Gambar sementara (akan dihapus otomatis)
└── [gambar permanen]  # Gambar yang sudah disubmit
```

### Keuntungan:

1. **Menghemat Storage**: Gambar yang tidak disubmit tidak akan menumpuk di server
2. **Preview Real-time**: User dapat melihat gambar di editor sebelum submit
3. **Pembersihan Otomatis**: Sistem membersihkan file yang tidak terpakai secara otomatis
4. **Backward Compatibility**: Tetap mendukung upload langsung ke folder permanen

### Catatan:

- Pastikan folder `storage/app/public/uploads/timeline/temp/` sudah dibuat
- Pastikan symbolic link storage sudah dibuat dengan `php artisan storage:link`
- Sistem ini hanya berlaku untuk form timeline, tidak mempengaruhi upload gambar lainnya 