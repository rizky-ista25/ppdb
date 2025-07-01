document.addEventListener('DOMContentLoaded', function () {
        const provinsi = document.getElementById('provinsi_ayah');
        const kabupaten = document.getElementById('kab_kota_ayah');
        const kecamatan = document.getElementById('kecamatan_ayah');
        const kelurahan = document.getElementById('kel_des_ayah');

        // Saat user mulai mengetik, aktifkan input berikutnya
        provinsi.addEventListener('input', function () {
            kabupaten.disabled = this.value.trim() === '';
        });

        kabupaten.addEventListener('input', function () {
            kecamatan.disabled = this.value.trim() === '';
        });

        kecamatan.addEventListener('input', function () {
            kelurahan.disabled = this.value.trim() === '';
        });

        // Cek kondisi saat halaman dimuat, agar old() tidak menyebabkan disabled
        if (provinsi.value.trim() !== '') kabupaten.disabled = false;
        if (kabupaten.value.trim() !== '') kecamatan.disabled = false;
        if (kecamatan.value.trim() !== '') kelurahan.disabled = false;
    });

    // Ibu
    document.addEventListener('DOMContentLoaded', function () {
        const provinsiIbu = document.getElementById('provinsi_ibu');
        const kabupatenIbu = document.getElementById('kab_kota_ibu');
        const kecamatanIbu = document.getElementById('kecamatan_ibu');
        const kelurahanIbu = document.getElementById('kel_des_ibu');

        // Aktifkan field berikutnya saat mulai diketik
        provinsiIbu.addEventListener('input', function () {
            kabupatenIbu.disabled = this.value.trim() === '';
        });

        kabupatenIbu.addEventListener('input', function () {
            kecamatanIbu.disabled = this.value.trim() === '';
        });

        kecamatanIbu.addEventListener('input', function () {
            kelurahanIbu.disabled = this.value.trim() === '';
        });

        // Kondisi saat halaman dimuat (untuk old() Laravel)
        if (provinsiIbu.value.trim() !== '') kabupatenIbu.disabled = false;
        if (kabupatenIbu.value.trim() !== '') kecamatanIbu.disabled = false;
        if (kecamatanIbu.value.trim() !== '') kelurahanIbu.disabled = false;
    });

    // Siswa
    document.addEventListener('DOMContentLoaded', function () {
        const provinsiSiswa = document.getElementById('provinsi_siswa');
        const kabupatenSiswa = document.getElementById('kab_kota_siswa');
        const kecamatanSiswa = document.getElementById('kecamatan_siswa');
        const kelurahanSiswa = document.getElementById('kel_des_siswa');

        // Aktifkan field berikutnya saat diketik
        provinsiSiswa.addEventListener('input', function () {
            kabupatenSiswa.disabled = this.value.trim() === '';
        });

        kabupatenSiswa.addEventListener('input', function () {
            kecamatanSiswa.disabled = this.value.trim() === '';
        });

        kecamatanSiswa.addEventListener('input', function () {
            kelurahanSiswa.disabled = this.value.trim() === '';
        });

        // Aktifkan jika ada old() dari Laravel saat reload
        if (provinsiSiswa.value.trim() !== '') kabupatenSiswa.disabled = false;
        if (kabupatenSiswa.value.trim() !== '') kecamatanSiswa.disabled = false;
        if (kecamatanSiswa.value.trim() !== '') kelurahanSiswa.disabled = false;
    });

    // Wali
    document.addEventListener('DOMContentLoaded', function () {
        const provinsiWali = document.getElementById('provinsi_wali');
        const kabupatenWali = document.getElementById('kab_kota_wali');
        const kecamatanWali = document.getElementById('kecamatan_wali');
        const kelurahanWali = document.getElementById('kel_des_wali');

        // Event ketika pengguna mengetik di provinsi
        provinsiWali.addEventListener('input', function () {
            kabupatenWali.disabled = this.value.trim() === '';
        });

        // Event ketika pengguna mengetik di kabupaten/kota
        kabupatenWali.addEventListener('input', function () {
            kecamatanWali.disabled = this.value.trim() === '';
        });

        // Event ketika pengguna mengetik di kecamatan
        kecamatanWali.addEventListener('input', function () {
            kelurahanWali.disabled = this.value.trim() === '';
        });

        // Inisialisasi jika ada nilai dari old() (pengisian ulang form)
        if (provinsiWali.value.trim() !== '') kabupatenWali.disabled = false;
        if (kabupatenWali.value.trim() !== '') kecamatanWali.disabled = false;
        if (kecamatanWali.value.trim() !== '') kelurahanWali.disabled = false;
    });