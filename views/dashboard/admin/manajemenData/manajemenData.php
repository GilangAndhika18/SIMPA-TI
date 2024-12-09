<?php

use app\cores\Session;

$user = Session::get('user');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPA-TI</title>
    <style>
        body {
            font-family: Galatea, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 8px;
            background-color: #0039C8;
            color: white;
            align-items: center;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            width: 60px;
            height: 60px;
            margin-right: 8px;
        }

        .navbar .logo h1 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 0.32px;
        }

        .navbar .menu {
            display: flex;
            gap: 16px;
        }

        .navbar .menu a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            font-weight: 500;
        }

        .navbar .menu a:hover {
            color: #AFFA08;
            /* Warna hijau saat hover */
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .navbar .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .navbar .user-info .notifications {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* Konten Utama */
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 30px auto;
            position: relative;
        }

        .content-header {
            font-size: 24px;
            font-weight: 700;
            color: #0039C8;
            margin-bottom: 20px;
        }

        /* Management Data Section */
        .management-section {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .management-option {
            background-color: #0039C8;
            color: white;
            padding: 15px;
            border-radius: 10px;
            width: 200px;
            text-align: center;
            cursor: pointer;
        }

        .management-option:hover {
            background-color: #1e3c94;
        }

        /* Tabel Data */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            text-align: left;
        }

        th,
        td {
            padding: 10px;
            font-size: 16px;
        }

        th {
            background-color: #0039C8;
            color: white;
        }

        /* Form Add Data */
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
        }

        .form-container input,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .form-container button {
            background-color: #0039C8;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        .form-container button:hover {
            background-color: #1e3c94;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="../../../public/component/logoHijau.png" alt="Logo">
            <h1>SIMPA-TI</h1>
        </div>
        <div class="menu">
            <a href="<?php echo '/dashboard/admin/' . Session::get("user") ?>">Home</a>
            <a href="<?php echo '/dashboard/admin/' . Session::get("user") . '/prestasi' ?>">Prestasi</a>
            <a href="#">Leaderboard</a>
            <a href="#">Management Data</a> <!-- Menu Management Data -->
        </div>
        <div class="user-info">
            <!-- Notification Bubble -->
            <div class="notification-bubble" onclick="window.location.href='notifikasi.html'">
                <img src="../../../public/component/notifikasi-03.png" alt="Notifikasi">
            </div>

            <a href="<?php echo '/dashboard/admin/' . Session::get("user") . '/profil' ?>">
                <img src="../../../public/component/profilpic.png" alt="Profile">
            </a>

        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="content-header">
            Management Data
        </div>

        <!-- Menu untuk pilih jenis data -->
        <div class="management-section">
            <div class="management-option" onclick="showData('admin')">Data Admin</div>
            <div class="management-option" onclick="showData('mahasiswa')">Data Mahasiswa</div>
            <div class="management-option" onclick="showData('dosen')">Data Dosen</div>
            <div class="management-option" onclick="showData('lomba')">Data Info Lomba</div>
            <div class="management-option" onclick="showData('log')">Log Data</div>
        </div>

        <!-- Tabel dan Form untuk menambah data -->
        <div id="data-container" class="data-container"></div>
    </div>

    <script>
        var adminData = <?php echo json_encode($adminData); ?>;
        var mahasiswaData = <?php echo json_encode($mahasiswaData); ?>;

        // Additional data arrays can be added similarly

        function showData(type) {
            let dataContainer = document.getElementById('data-container');
            let dataHTML = '';

            // Admin
            if (type === 'admin') {
                let tableRows = '';
                adminData.forEach(function(item) {
                    tableRows += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.email}</td>
                        <td>${item.name}</td>
                        <td>${item.nip}</td>
                        <td><img src="${item.profile}" alt="Profil" width="40" height="40"></td>
                    </tr>
                `;
                });

                dataHTML = `
                <h3>Data Admin</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Profil</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${tableRows}
                    </tbody>
                </table>
                <h4>Tambah Data Admin Baru</h4>
                <div class="form-container">
                    <input type="text" placeholder="ID Admin" id="admin-id">
                    <input type="email" placeholder="Email Admin" id="admin-email">
                    <input type="text" placeholder="Nama Admin" id="admin-name">
                    <input type="text" placeholder="NIP" id="admin-nip">
                    <input type="file" id="admin-profile">
                    <button onclick="addData('admin')">Tambah Data</button>
                </div>
            `;
            }

            // Mahasiswa
            else if (type === 'mahasiswa') {
                let tableRows = '';
                mahasiswaData.forEach(function(item) {
                    tableRows += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td>${item.nim}</td>
                        <td><img src="${item.profile}" alt="Profil" width="40" height="40"></td>
                        <td>${item.tanggal_lahir}</td>
                        <td>${item.prodi}</td>
                        <td>${item.total_skor}</td>
                    </tr>
                `;
                });

                dataHTML = `
                <h3>Data Mahasiswa</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIM</th>
                            <th>Profil</th>
                            <th>Tanggal Lahir</th>
                            <th>Prodi</th>
                            <th>Total Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${tableRows}
                    </tbody>
                </table>
                <h4>Tambah Data Mahasiswa Baru</h4>
                <div class="form-container">
                    <input type="text" placeholder="ID Mahasiswa" id="mahasiswa-id">
                    <input type="text" placeholder="Nama Mahasiswa" id="mahasiswa-name">
                    <input type="email" placeholder="Email Mahasiswa" id="mahasiswa-email">
                    <input type="text" placeholder="NIM" id="mahasiswa-nim">
                    <input type="date" placeholder="Tanggal Lahir" id="mahasiswa-tanggal-lahir">
                    <input type="text" placeholder="Prodi" id="mahasiswa-prodi">
                    <input type="number" placeholder="Total Skor" id="mahasiswa-total-skor">
                    <input type="file" id="mahasiswa-profile">
                    <button onclick="addData('mahasiswa')">Tambah Data</button>
                </div>
            `;
            }

            // Add similar blocks for 'dosen', 'lomba', and 'log'

            dataContainer.innerHTML = dataHTML;
        }

        // The rest of the JavaScript remains unchanged
    </script>


</body>

</html>