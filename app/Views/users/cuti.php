<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay"></div>

<!-- Main Container -->
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20 text-center">
                    <h4 class="text-blue h4">Informasi Cuti Karyawan</h4>
                </div>
                <div class="pb-20">
                    <div class="search-container mb-4">
                        <form id="searchForm" class="d-flex flex-wrap justify-content-center">
                            <input type="text" id="search_name" class="form-control mx-2 mb-2" placeholder="Masukan Nama Lengkap" style="max-width: 250px;">
                            <input type="text" id="search_nip" class="form-control mx-2 mb-2" placeholder="NIP" style="max-width: 250px;">
                            <button type="submit" class="btn btn-primary mx-2 mb-2">Cari</button>
                        </form>
                    </div>

                    <!-- Hasil Pencarian -->
                    <div id="results" class="row mt-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let debounceTimer;

    const fetchResults = () => {
        const name = document.getElementById('search_name').value.trim();
        const nip = document.getElementById('search_nip').value.trim();
        if (name.length < 3 && nip.length < 3) {
            document.getElementById('results').innerHTML = '';
            return;
        }

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetch(`<?= base_url('cuti/search') ?>?search_name=${encodeURIComponent(name)}&search_nip=${encodeURIComponent(nip)}`)
                .then(response => response.json())
                .then(data => {
                    let resultsHtml = '';

                    if (data.length > 0) {
                        data.forEach(user => {
                            resultsHtml += `
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <h5 class="card-title">${user.name}</h5>
                                        <p class="card-text"><strong>NIP:</strong> ${user.nip}</p>
                                        <p class="card-text"><strong>Sisa Cuti:</strong> ${user.sisa_cuti}</p>
                                        <p class="card-text"><strong>Histori Cuti:</strong></p>
                                        <ul class="list-unstyled">
                                            ${user.histori.map(h => `${h.tanggal_mulai} sd ${h.tanggal_akhir} (${h.jumlah_hari} hari) | ${h.tahun_cuti}`).join('<br>')}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            `;
                        });
                    } else {
                        resultsHtml = '<div class="alert alert-warning">Tidak ada hasil yang ditemukan untuk pencarian Anda.</div>';
                    }

                    document.getElementById('results').innerHTML = resultsHtml;
                })
                .catch(error => console.error('Error fetching data:', error));
        }, 300);
    };

    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();
        fetchResults();
    });
</script>

<style>
    .search-container {
        margin-bottom: 20px;
    }

    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .text-blue {
        color: #007bff;
    }

    .list-unstyled {
        padding-left: 0;
        margin-top: 10px;
    }
</style>
