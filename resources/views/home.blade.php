<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            color: #1f2937;
        }

        button {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 12px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            margin-bottom: 20px;
        }

        button:hover {
            opacity: 0.95;
        }

        #hasil-data {
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #e5e7eb;
        }

        .info {
            color: #374151;
            margin: 0 0 10px;
        }

        .error {
            color: #b91c1c;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Halaman Utama Data Mahasiswa</h1>
        <button id="btn-tampilkan">Tampilkan Data</button>

        <div id="hasil-data">
            <p class="info">Data belum ditampilkan.</p>
        </div>
    </div>

    <script>
        const btnTampilkan = document.getElementById('btn-tampilkan');
        const hasilData = document.getElementById('hasil-data');

        btnTampilkan.addEventListener('click', async function () {
            hasilData.innerHTML = '<p class="info">Memuat data...</p>';

            try {
                const response = await fetch(`{{ route('mahasiswa.data') }}`);

                if (!response.ok) {
                    throw new Error('Gagal mengambil data dari server.');
                }

                const data = await response.json();

                if (!Array.isArray(data) || data.length === 0) {
                    hasilData.innerHTML = '<p class="info">Tidak ada data mahasiswa.</p>';
                    return;
                }

                let table = `
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Kelas</th>
                                <th>Prodi</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                data.forEach((item, index) => {
                    table += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.nama}</td>
                            <td>${item.nim}</td>
                            <td>${item.kelas}</td>
                            <td>${item.prodi}</td>
                        </tr>
                    `;
                });

                table += `
                        </tbody>
                    </table>
                `;

                hasilData.innerHTML = table;
            } catch (error) {
                hasilData.innerHTML = `<p class="error">${error.message}</p>`;
            }
        });
    </script>
</body>
</html>
