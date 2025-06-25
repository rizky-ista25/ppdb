// Data Kabupaten/Kota untuk Provinsi Aceh
    const kabupatenAceh = [
        'Aceh Barat', 'Aceh Besar', 'Aceh Jaya', 'Aceh Selatan', 'Aceh Singkil', 
        'Aceh Tamiang', 'Aceh Tengah', 'Aceh Tenggara', 'Aceh Utara', 'Bener Meriah', 
        'Bireuen', 'Gayo Lues', 'Langsa', 'Lhokseumawe', 'Nagan Raya', 'Pidie', 
        'Pidie Jaya', 'Simeulue'
    ];

    // Event listener untuk provinsi_ayah
    document.getElementById('provinsi_ayah').addEventListener('change', function() {
        const provinsi = this.value;
        const kabKotaSelect = document.getElementById('kab_kota_ayah');

        // Kosongkan dropdown kab_kota_ayah
        kabKotaSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';

        // Jika Provinsi Aceh dipilih, tampilkan kabupaten/kota Aceh
        if (provinsi === 'Aceh') {
            kabupatenAceh.forEach(function(kabupaten) {
                const option = document.createElement('option');
                option.value = kabupaten;
                option.textContent = kabupaten;
                kabKotaSelect.appendChild(option);
            });
        }
    });

    // Jika sebelumnya sudah dipilih Aceh, tampilkan kabupaten/kota Aceh
    if (document.getElementById('provinsi_ayah').value === 'Aceh') {
        document.getElementById('provinsi_ayah').dispatchEvent(new Event('change'));
    }