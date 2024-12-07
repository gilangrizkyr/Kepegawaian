<!-- Main Container -->
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="card-box mb-30">
                <div class="pd-20" style="display: flex; justify-content: space-between; align-items: center;">
                    <h4 class="text-blue h4">Informasi Cuti Karyawan</h4>
                    <div>
                        <button class="btn btn-primary" onclick="printTable()" title="Print Laporan">
                            <i class="icon-copy dw dw-print"></i>
                        </button>
                        <button class="btn btn-secondary" onclick="downloadTableAsCSV()" title="Download CSV">
                            <i class="icon-copy dw dw-download"></i>
                        </button>
                    </div>
                </div>
                <div class="pb-20">
                    <table class="data-table table stripe hover nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Nama Karyawan</th>
                                <th>Jumlah Cuti</th>
                                <th>Rincian Cuti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rangkuman)): ?>
                                <?php foreach ($rangkuman as $cuti): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($cuti->nama_karyawan) ?></td>
                                        <td><?= htmlspecialchars($cuti->jumlah_cuti) ?>X</td>
                                        <td>
                                            <?php
                                            // Mengganti '; ' dengan '<br>' untuk pemisahan baris
                                            $rincianCuti = str_replace('; ', '<br>', htmlspecialchars($cuti->rincian_cuti));
                                            echo nl2br($rincianCuti); // Menampilkan rincian cuti
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Saat ini belum terdapat data cuti yang diinputkan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function printTable() {
        const rows = document.querySelectorAll('.data-table tr');
        let printContent = `
        <div style="text-align: center; display: flex; align-items: center; justify-content: center;">
            <img src="assets/master/vendors/images/ptptk1.png" alt="Logo Perusahaan" style="max-width: 100px; margin-right: 20px;"/>
            <div>
                <h2 style="margin: 0;">Laporan Kepegawaian</h2>
                <h4 style="margin: 0;">Tanggal: ${new Date().toLocaleDateString()}</h4>
            </div>
        </div>
        <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jumlah Cuti</th>
                <th>Rincian Cuti</th>
            </tr>`;

        rows.forEach((row, rowIndex) => {
            const cols = row.querySelectorAll('td, th');
            if (rowIndex > 0) {
                const no = rowIndex;
                const name = cols[0].innerText;
                const jumlahCuti = cols[1].innerText;
                const rincianCuti = cols[2].innerText.replace(/<br>/g, '\n'); // Ganti <br> dengan newline
                printContent += `<tr><td>${no}</td><td>${name}</td><td>${jumlahCuti}</td><td>${rincianCuti}</td></tr>`;
            }
        });

        printContent += '</table>';
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print Laporan</title>');
        printWindow.document.write('<style>table { border-collapse: collapse; } th, td { padding: 8px; text-align: left; border: 1px solid #000; }</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.onload = function() {
            printWindow.print();
        };
    }

    function downloadTableAsCSV() {
        const rows = document.querySelectorAll('.data-table tr');
        let csvContent = "data:text/csv;charset=utf-8,";

        rows.forEach((row, rowIndex) => {
            const cols = row.querySelectorAll('td, th');

            if (rowIndex === 0) {
                csvContent += "No,Nama Karyawan,Jumlah Cuti,Rincian Cuti\r\n";
            } else {
                const no = rowIndex;
                const name = cols[0].innerText;
                const jumlahCuti = cols[1].innerText;
                const rincianCuti = cols[2].innerText.replace(/<br>/g, ' | '); // Ganti <br> dengan ' | '
                csvContent += `${no},"${name}","${jumlahCuti}","${rincianCuti}"\r\n`;
            }
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement('a');
        link.setAttribute('href', encodedUri);
        link.setAttribute('download', 'laporan_karyawan.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>