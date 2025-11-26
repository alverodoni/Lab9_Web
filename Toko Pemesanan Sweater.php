<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pemesanan Sweater & Dashboard</title>
  <style>
    /* === STYLE LOGIN & UMUM === */
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: #f5f7fa;
    }

    .login-page {
      /* Latar belakang hitam */
      background: #000000;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: #fff;
      border-radius: 15px;
      width: 350px;
      padding: 20px 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      text-align: center;
      position: relative;
    }

    .container img { width: 100px; margin-bottom: 15px; }

    h2 { margin: 0; color: #2c2c2c; font-size: 22px; margin-bottom: 20px; }

    input[type="email"], input[type="password"], input[type="text"], input[type="number"], select {
      width: 90%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    
    .form-tambah input[type="text"], .form-tambah input[type="number"], .form-tambah select {
        width: 100%; /* Override default width 90% in small form */
    }

    button {
      width: 95%;
      padding: 10px;
      background-color: #4c51bf;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
    }

    button:hover { background-color: #434190; }

    .links { margin-top: 15px; display: flex; justify-content: space-around; }
    .links a { color: #4c51bf; cursor: pointer; text-decoration: underline; }

    .modal { display: none; position: fixed; z-index: 30; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); }
    .modal-content {
      background: #fff; margin: 5% auto; padding: 20px; width: 420px; border-radius: 10px; text-align: left;
      position: relative; overflow-y: auto; max-height: 90vh;
    }
    .close { position: absolute; top: 8px; right: 10px; cursor: pointer; color: #555; font-weight: bold; font-size: 18px; }
    .close:hover { color: red; }

    .btn-secondary { background-color: #ccc; color: black; border: none; width: 45%; border-radius: 6px; padding: 8px; cursor: pointer; }
    .btn-primary { background-color: #4c51bf; color: white; border: none; width: 45%; border-radius: 6px; padding: 8px; cursor: pointer; }
    .btn-primary:hover { background-color: #434190; }

    /* === DASHBOARD === */
    .dashboard-page { display: none; background: #f5f7fa; min-height: 100vh; color: #333; }
    header {
      background: linear-gradient(90deg, #4a90e2, #007bff);
      color: white; padding: 20px; text-align: center; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;
      position: relative; /* Untuk posisi tombol logout */
    }
    
    /* Tombol Logout */
    .logout-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background: white;
        color: black;
        padding: 8px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
        width: auto; /* Override button width: 95% */
        margin-top: 0;
    }
    .logout-btn:hover {
        background: #e2e8f0;
        color: #333;
    }

    .container-dashboard { padding: 20px; }
    .menu { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 20px; margin-top: 30px; }
    .menu button {
      background: white; border: 2px solid #007bff; border-radius: 15px; padding: 20px; font-size: 16px; font-weight: 600;
      cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    .menu button:hover { background: #007bff; color: white; transform: scale(1.05); }

    footer { text-align: center; margin-top: 40px; color: #777; font-size: 14px; }

    /* === KATALOG & LAPORAN === */
    #katalogSection, #laporanPemesananSection, #historyTransaksiSection, #aboutSection { display: none; margin-top: 30px; }
    table { width: 100%; border-collapse: collapse; background: white; margin-bottom: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: center; vertical-align: middle; }
    th { background-color: #007bff; color: white; }
    td img { max-height:100px; max-width: 120px; object-fit: contain; display:block; margin:0 auto; }
    .table-responsive { overflow-x: auto; }

    .form-tambah { background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .form-tambah input { width: 100%; margin: 5px 0; padding: 8px; }

    /* === TRACKING PENGIRIMAN === */
    #trackingSection { display: none; margin-top: 30px; }
    .small-btn { padding:8px 12px; border-radius:6px; border:none; cursor:pointer; background:#4c51bf; color:white; }
    /* Perubahan warna/padding sesuai permintaan */
    .small-btn.delete-btn { background:#ef4444; color:white; padding: 6px 10px; font-size: 13px; margin-top: 4px; } /* Margin-top ditambahkan agar tombol tidak terlalu rapat */
    .small-btn.edit-btn { background:#f59e0b; color:white; padding: 6px 10px; font-size: 13px; margin-right: 5px;}
    .small-btn.detail-btn { background:#10b981; color:white; padding: 6px 10px; font-size: 13px; margin-right: 5px;}
    .small-btn.delete-btn:hover { background: #dc2626; }
    .small-btn.edit-btn:hover { background: #d97706; }
    .small-btn.detail-btn:hover { background: #059669; }
    .small-btn:hover { background:#434190; }
    
    /* === STYLE KHUSUS ABOUT SECTION === */
    .card-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    .card-item {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        padding: 15px;
        text-align: center;
    }
    .card-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .card-item p {
        font-size: 14px;
        color: #555;
        margin: 5px 0 0;
        font-weight: 600;
        min-height: 40px; /* Untuk konsistensi tinggi kartu */
        display: flex;
        align-items: center;
        justify-content: center;
    }


    /* responsive */
    @media (max-width:600px){
      .modal-content { width: 92%; }
      .container { width: 92%; }
      .tracking-controls { flex-direction: column; align-items: stretch; }
      td img { max-height:70px; }
      .table-responsive table { font-size: 12px; }
      .table-responsive th, .table-responsive td { padding: 6px; }
      .logout-btn { top: 10px; right: 10px; padding: 6px 10px; font-size: 12px; }
      .card-gallery { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>

  <div class="login-page" id="loginPage">
    <div class="container">
      <img src="Toko Pemesanan Sweater.png" alt="Logo">
      <h2>Login Pemesanan Sweater</h2>

      <input type="email" id="email" placeholder="Email"><br>
      <input type="password" id="password" placeholder="Password"><br>
      <button onclick="login()">Login</button>

      <div class="links">
        <a onclick="openModal('forgotModal')">Lupa Password</a>
        <a onclick="openModal('registerModal')">Daftar</a>
      </div>

      <div class="footer-text">
        Baca <a onclick="openModal('syaratKetentuanModal')">Syarat & Ketentuan</a> atau <a onclick="openModal('kebijakanPrivasiModal')">Kebijakan Privasi</a>
      </div>
    </div>
  </div>

  <div id="forgotModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('forgotModal')">&times;</span>
      <h3>Lupa Password</h3>
      <p>Masukkan email Anda untuk reset password:</p>
      <input type="email" placeholder="Email"><br><br>
      <button class="btn-primary">Kirim</button>
    </div>
  </div>

  <div id="registerModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('registerModal')">&times;</span>
      <h3>Lengkapi Identitas Anda</h3>
      <p>Silahkan lengkapi data diri Anda.</p>
      <input type="email" placeholder="Email Anda">
      <input type="text" placeholder="Nama Lengkap">
      <input type="text" placeholder="Nomor Ponsel">
      <input type="text" placeholder="Alamat Sesuai Identitas">
      <select>
        <option value="">Kecamatan</option>
        <option value="Gambir">Gambir</option>
        <option value="Menteng">Menteng</option>
        <option value="Tebet">Tebet</option>
      </select>
      <input type="password" placeholder="Kata Sandi">
      <input type="password" placeholder="Konfirmasi Kata Sandi">

      <p class="footer-text">
        Dengan mendaftar, saya menyetujui <a onclick="openModal('syaratKetentuanModal')">Syarat & Ketentuan</a> serta <a onclick="openModal('kebijakanPrivasiModal')">Kebijakan Privasi</a>
      </p>

      <div style="display:flex; justify-content:space-around; margin-top:15px;">
        <button class="btn-secondary" onclick="closeModal('registerModal')">Sebelumnya</button>
        <button class="btn-primary">Selanjutnya</button>
      </div>
    </div>
  </div>

  <div id="syaratKetentuanModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('syaratKetentuanModal')">&times;</span>
      <h3>Syarat & Ketentuan Toko Buku Online</h3>
      <p>Konten Syarat & Ketentuan</p>
    </div>
  </div>

  <div id="kebijakanPrivasiModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('kebijakanPrivasiModal')">&times;</span>
      <h3>Kebijakan Privasi Toko Buku Online</h3>
      <p>Konten Kebijakan Privasi</p>
    </div>
  </div>

  <div id="updateStatusModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('updateStatusModal')">&times;</span>
      <h3>Update Status Pengiriman</h3>
      <p id="modalResiInfo" style="font-weight:600;"></p>
      <label>Status Baru</label>
      <select id="newStatusSelect">
        <option value="Dalam Proses">Dalam Proses</option>
        <option value="Dikirim">Dikirim</option>
        <option value="Dalam Transit">Dalam Transit</option>
        <option value="Diterima">Diterima</option>
        <option value="Dibatalkan">Dibatalkan</option>
      </select>
      <label style="margin-top:8px;">Catatan (opsional)</label>
      <input type="text" id="statusNote" placeholder="Contoh: Paket di gudang cabang"/>
      <div style="display:flex; justify-content:space-between; margin-top:12px;">
        <button class="btn-secondary" onclick="closeModal('updateStatusModal')">Batal</button>
        <button class="btn-primary" onclick="saveStatusUpdate()">Simpan</button>
      </div>
    </div>
  </div>
  
  <div id="editPemesananModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('editPemesananModal')">&times;</span>
      <h3>Edit Status Pemesanan</h3>
      <p id="modalPesananInfo" style="font-weight:600;"></p>
      <label>Status Pembayaran</label>
      <select id="editStatusBayar">
        <option value="Lunas">Lunas</option>
        <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
        <option value="Dibatalkan">Dibatalkan</option>
      </select>
      
      <label style="margin-top:8px;">Jasa Kurir</label>
      <select id="editJasaKurir">
        <option value="JNE">JNE</option>
        <option value="J&T">J&T</option>
        <option value="SiCepat">SiCepat</option>
        <option value="POS">POS Indonesia</option>
        <option value="TIKI">TIKI</option>
        <option value="Lainnya">Lainnya</option>
      </select>
      
      <label style="margin-top:8px;">Kode Informasi Stok / Katalog Sweater (Ganti jika ada kesalahan)</label>
      <input type="text" id="editKodeBarang" placeholder="Masukkan kode barang (contoh: ORD001)"/>
      
      <div style="display:flex; justify-content:space-between; margin-top:12px;">
        <button class="btn-secondary" onclick="closeModal('editPemesananModal')">Batal</button>
        <button class="btn-primary" onclick="savePemesananUpdate()">Simpan Perubahan</button>
      </div>
    </div>
  </div>
  
    <div id="historyTrackingModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal('historyTrackingModal')">&times;</span>
      <h3>History Pengiriman <span id="historyResiInfo"></span></h3>
      <div id="historyContent" style="max-height: 400px; overflow-y: auto; padding-right: 10px;">
        </div>
    </div>
  </div>

  <div class="dashboard-page" id="dashboardPage">
    <header>
      <h1 id="greeting">Selamat Datang!</h1>
      <p>Toko Sweater Online</p>
      <button class="logout-btn" onclick="logout()">Logout</button> </header>

    <div class="container-dashboard">
      <h2>Dashboard Menu</h2>
      <div class="menu">
        <button onclick="tampilkanAbout()">💡 Tentang Kami</button> <button onclick="tampilkanKatalog()">📚 Informasi Katalog</button>
        <button onclick="tampilkanTracking()">📦 Tracking Pengiriman</button>
        <button onclick="tampilkanLaporanPemesanan()">🧾 Laporan Pemesanan</button>
        <button onclick="tampilkanHistoryTransaksi()">💳 History Transaksi</button>
      </div>
      
      <div id="aboutSection">
        <h2 style="margin-bottom: 20px;">Tentang Kami & Pemesanan Online</h2>
        
        <div style="background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
            <p style="font-size: 16px; line-height: 1.6;">
                Memesan sweater secara online adalah proses yang praktis dan mudah. Mulailah dengan menelusuri galeri digital kami dikatalog sweater di platform web ini dengan memilih model, warna, dan ukuran yang diinginkan. Setelah menemukan item yang disukai, Anda dapat melanjutkan ke proses pemesanan.
            </p>
        </div>
        
        <h3 style="margin-top: 30px; border-bottom: 2px solid #007bff; padding-bottom: 10px;">Katalog Sweater Pilihan Kami</h3>
        
        <div class="card-gallery" id="sweaterGallery">
            </div>
      </div>
      <div id="katalogSection">
        <h2>📚 Informasi Stok / Katalog Sweater</h2>
        <div class="table-responsive">
          <table id="tabelKatalog">
            <thead>
              <tr>
                <th>Kode</th>
                <th>Ukuran</th> <th>Nama Sweater</th>
                <th>Jenis</th>
                <th>Edisi</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Foto</th>
                <th>Aksi</th> 
                </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="form-tambah">
          <h3>Tambah Sweater Baru</h3>
          <input type="text" id="kodeBarang" placeholder="Kode Barang">
          <select id="ukuranInput"> <option value="">Pilih Ukuran</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
          </select> 
          <input type="text" id="namaBarang" placeholder="Nama Sweater">
          <input type="text" id="jenisBarang" placeholder="Jenis Sweater">
          <input type="text" id="edisi" placeholder="Edisi">
          <input type="number" id="stok" placeholder="Jumlah Stok">
          <input type="text" id="harga" placeholder="Harga (contoh: Rp 200.000)">
          <input type="text" id="pathFoto" placeholder="(Opsional) Nama file atau URL, contoh: kepemimpinan.jpg">
          <label style="font-size:13px;color:#555;margin-top:6px;display:block;">Atau upload file foto:</label>
          <input type="file" id="fotoUpload" accept="image/*">
          <div style="display:flex; gap:8px; margin-top:8px;">
            <button onclick="tambahBuku()" class="small-btn" style="width:100%;">Tambah Sweater</button>
            </div>
          <div id="previewFoto" style="margin-top:8px; font-size:13px; color:#333;"></div>
        </div>
      </div>

      <div id="trackingSection">
        <h2>📦 Tracking Pengiriman</h2>

        <div style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:12px;">
          <div style="flex:1; min-width:220px;">
            <div class="form-tambah">
              <h3>Tambah Pengiriman Baru</h3>
              <input type="text" id="inputResi" placeholder="Nomor Resi (wajib)">
              <input type="text" id="inputPenerima" placeholder="Nama Penerima (wajib)">
              <input type="text" id="inputNoHp" placeholder="Nomor Ponsel Penerima (wajib)"> <input type="text" id="inputAlamat" placeholder="Alamat Lengkap">
              
              <label style="margin-top:8px; display:block; text-align:left; font-size:14px; color:#555;">Jasa Kurir</label>
              <select id="inputKurir">
                <option value="JNE">JNE</option>
                <option value="J&T">J&T</option>
                <option value="SiCepat">SiCepat</option>
                <option value="POS">POS Indonesia</option>
                <option value="TIKI">TIKI</option>
                <option value="Lainnya">Lainnya</option>
              </select>
              
              <label style="margin-top:8px; display:block; text-align:left; font-size:14px; color:#555;">Status Awal</label>
              <select id="inputStatus">
                <option value="Dalam Proses">Dalam Proses</option>
                <option value="Dikirim">Dikirim</option>
                <option value="Dalam Transit">Dalam Transit</option>
                <option value="Diterima">Diterima</option>
                <option value="Dibatalkan">Dibatalkan</option>
              </select>
              <div style="display:flex; gap:8px; margin-top:8px;">
                <button onclick="tambahPengiriman()">Tambah Pengiriman</button>
              </div>
            </div>
          </div>

          <div style="flex:2; min-width:300px;">
            <div style="background:#fff; padding:12px; border-radius:10px; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
              
              <div class="table-responsive">
                <table id="tabelTracking">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Kode Katalog (Resi)</th>
                      <th>Penerima</th>
                      <th>HP</th> <th>Alamat</th>
                      <th>Kurir</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
              
              </div>
          </div>
        </div>
      </div>
      
      <div id="laporanPemesananSection">
        <h2>🧾 Laporan Pemesanan (Detail Katalog + Tracking)</h2>
        <div class="table-responsive">
          <table id="tabelLaporanPemesanan">
            <thead>
              <tr>
                <th>ID Pesanan</th>
                <th>Tanggal</th>
                <th>Pembeli</th>
                <th>Nama Sweater</th>
                <th>Jml</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Status Bayar</th>
                <th>Status Kirim & Aksi</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

      <div id="historyTransaksiSection">
        <h2>💳 History Transaksi (Ringkasan)</h2>
        <div class="table-responsive">
          <table id="tabelHistoryTransaksi">
            <thead>
              <tr>
                <th>ID Pesanan</th>
                <th>Tanggal</th>
                <th>Pembeli</th>
                <th>Total Pembayaran</th>
                <th>Status Bayar</th>
                <th>Jasa Kurir</th>
                <th>Status Pengiriman</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>

    </div>

    <footer>
      © 2025 Toko Sweater Online. Semua Hak Dilindungi.
    </footer>
  </div>

<script>
    /* === === DATA MODELLING (DIUBAH) === === */
    function uid() { return 'id-' + Math.random().toString(36).slice(2, 9); }

    var dataPengguna = [
      { id: 1, nama: "Rina Wulandari", email: "rina@gmail.com", password: "rina123", role: "User" },
      { id: 2, nama: "Agus Pranoto", email: "agus@gmail.com", password: "agus123", role: "User" },
      // ADMIN ACCOUNT - PASTIKAN EMAIL DAN PASSWORD SAMA PERSIS DENGAN INPUT
      { id: 3, nama: "Siti Marlina", email: "siti@gmail.com", password: "siti123", role: "Admin" }
    ];
    
    // Key untuk persistensi status login
    const LOGIN_STATUS_KEY = "tokoBuku_loginStatus";
    const LOGGED_IN_USER_KEY = "tokoBuku_loggedInUser";

    const KATALOG_LS_KEY = "tokoBuku_dataKatalog_v3_sweater"; // Version bump
    const DEFAULT_KATALOG = [
      // KODE ISBN telah diperbarui menjadi Ukuran
      { kodeBarang: "ORD001", namaBarang: "Adidas Adicolor Oversize Full-Zip Hoodie", jenisBarang: "Sweater", edisi: "1", stok: 10, harga: "Rp 800.000", hargaNumerik: 800000, pathFoto: "adidas Adicolor Oversize Full-Zip Hoodie.png", ukuran: "M" },
      { kodeBarang: "ORD002", namaBarang: "Hoodie Full-Zip Small Logo Future Icons", jenisBarang: "Hoodie", edisi: "1", stok: 20, harga: "Rp 840.000", hargaNumerik: 840000, pathFoto: "Hoodie Full-Zip Small Logo Future Icons.png", ukuran: "L" },
      { kodeBarang: "ORD003", namaBarang: "Hoodie French Terry Essentials 3-Stripes", jenisBarang: "Hoodie", edisi: "3", stok: 30, harga: "Rp 665.000", hargaNumerik: 665000, pathFoto: "Hoodie  French Terry Essentials 3-Stripes.png", ukuran: "S" },
      { kodeBarang: "ORD004", namaBarang: "Sweatshirt Essentials Big Logo French Terry", jenisBarang: "Sweatshirt", edisi: "2", stok: 40, harga: "Rp 560.000", hargaNumerik: 560000, pathFoto: "Sweatshirt Essentials Big Logo French Terry.png", ukuran: "XL" },
      { kodeBarang: "ORD005", namaBarang: "Hoodie Full-Zip Future Icons 3-Stripes", jenisBarang: "Hoodie", edisi: "4", stok: 50, harga: "Rp 780.000", hargaNumerik: 780000, pathFoto: "Hoodie Full-Zip Future Icons 3-Stripes.png", ukuran: "XXL" } 
    ];

    let dataKatalogBuku = JSON.parse(localStorage.getItem(KATALOG_LS_KEY) || "null");
    if (!Array.isArray(dataKatalogBuku) || dataKatalogBuku.length === 0 || !dataKatalogBuku.every(b => 'ukuran' in b)) {
        // Cek jika data lama masih ada atau field ukuran belum ada, maka gunakan default
        dataKatalogBuku = DEFAULT_KATALOG;
        localStorage.removeItem(KATALOG_LS_KEY); // Hapus LS lama
    }
    saveKatalogLS(); // Simpan data terbaru

    const TRACKING_LS_KEY = "tokoBuku_dataTracking_v3_nohp"; // Version bump
    const PEMESANAN_LS_KEY = "tokoBuku_dataPemesanan_v2";

    let dataTracking = JSON.parse(localStorage.getItem(TRACKING_LS_KEY) || "null");
    if (!Array.isArray(dataTracking) || !dataTracking.every(t => 'noHpPenerima' in t)) { // Cek field noHpPenerima
      dataTracking = [
        // TAMBAH FIELD noHpPenerima
        { id: uid(), resi: "RES456JNE", penerima: "Rina Wulandari", noHpPenerima: "081234567890", alamat: "Jl. Merdeka 1", kurir: "JNE", status: "Dikirim", tanggal: "2025-10-01", history: [{status: "Dikirim", tanggal: "2025-10-01", catatan: "Paket di drop off"}] },
        { id: uid(), resi: "RES789POS", penerima: "Agus Pranoto", noHpPenerima: "085678901234", alamat: "Jl. Sudirman 42", kurir: "POS", status: "Dalam Transit", tanggal: "2025-10-03", history: [{status: "Dalam Transit", tanggal: "2025-10-03", catatan: "Transit di Jakarta"}] },
        { id: uid(), resi: "RES101TIKI", penerima: "Siti Marlina", noHpPenerima: "087890123456", alamat: "Jl. Thamrin 10", kurir: "TIKI", status: "Diterima", tanggal: "2025-09-28", history: [{status: "Diterima", tanggal: "2025-09-28", catatan: "Telah diterima penerima"}] },
        { id: uid(), resi: "RES222SCT", penerima: "Rina Wulandari", noHpPenerima: "081234567890", alamat: "Jl. Merdeka 1", kurir: "SiCepat", status: "Dalam Proses", tanggal: "2025-10-06", history: [{status: "Dalam Proses", tanggal: "2025-10-06", catatan: "Menunggu pick up"}] },
      ];
      saveTrackingLS();
    }
    
    let dataPemesanan = JSON.parse(localStorage.getItem(PEMESANAN_LS_KEY) || "null");
    if (!Array.isArray(dataPemesanan)) {
      dataPemesanan = [
        // Total harga disesuaikan dengan katalog sweater baru
        { idPesanan: "ORD001", tanggal: "2025-10-01", kodeBarang: "ORD001", jumlah: 2, resi: "RES456JNE", pembeli: "Rina Wulandari", totalHarga: 1600000, statusPembayaran: "Lunas", jasaKurir: "JNE" },
        { idPesanan: "ORD002", tanggal: "2025-10-03", kodeBarang: "ORD002", jumlah: 1, resi: "RES789POS", pembeli: "Agus Pranoto", totalHarga: 840000, statusPembayaran: "Lunas", jasaKurir: "POS" },
        { idPesanan: "ORD003", tanggal: "2025-09-28", kodeBarang: "ORD003", jumlah: 3, resi: "RES101TIKI", pembeli: "Siti Marlina", totalHarga: 1995000, statusPembayaran: "Lunas", jasaKurir: "TIKI" },
        { idPesanan: "ORD004", tanggal: "2025-10-05", kodeBarang: "ORD004", jumlah: 1, resi: "RES222SCT", pembeli: "Rina Wulandari", totalHarga: 560000, statusPembayaran: "Menunggu Pembayaran", jasaKurir: "SiCepat" },
        { idPesanan: "ORD005", tanggal: "2025-10-10", kodeBarang: "ORD005", jumlah: 5, resi: null, pembeli: "Agus Pranoto", totalHarga: 3900000, statusPembayaran: "Dibatalkan", jasaKurir: "JNE" }, 
      ];
      savePemesananLS();
    }


    /* === HELPER FUNCTIONS (LOOKUP) === */
    function getBukuByKode(kode) {
      return dataKatalogBuku.find(b => b.kodeBarang === kode);
    }

    function getTrackingByResi(resi) {
      if (!resi) return { status: "Belum Dikirim", tanggal: "-", kurir: "-", history: [], noHpPenerima: "-" }; // Tambah noHpPenerima default
      const tracking = dataTracking.find(t => t.resi === resi);
      return tracking || { status: "Resi Tidak Ditemukan", tanggal: "-", kurir: "-", history: [], noHpPenerima: "-" }; // Tambah noHpPenerima default
    }
    
    function getTrackingById(id) {
        return dataTracking.find(t => t.id === id);
    }

    function getPemesananById(idPesanan) {
      return dataPemesanan.find(p => p.idPesanan === idPesanan);
    }
    
    function getKodeBarangByResi(resi) {
        if (!resi) return "-";
        const pemesanan = dataPemesanan.find(p => p.resi === resi);
        return pemesanan ? pemesanan.kodeBarang : "N/A";
    }
    
    function formatRupiah(angka) {
      if (isNaN(angka)) return '-';
      var reverse = angka.toString().split('').reverse().join(''),
      ribuan = reverse.match(/\d{1,3}/g);
      ribuan = ribuan.join('.').split('').reverse().join('');
      return 'Rp ' + ribuan;
    }

    function parseRupiah(rupiah) {
        // Menghilangkan "Rp", spasi, dan titik
        return parseInt(rupiah.replace(/[^0-9]/g, '')) || 0;
    }

    function escapeHtml(text) {
      if (text === null || text === undefined) return "";
      return String(text).replace(/[&<>"']/g, function (m) { return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m]; });
    }
    
    function getTodayDate() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }


    /* === UTILITY === */
    function hideAllSections() {
      document.getElementById("aboutSection").style.display = "none"; // BARU
      document.getElementById("katalogSection").style.display = "none";
      document.getElementById("trackingSection").style.display = "none";
      document.getElementById("laporanPemesananSection").style.display = "none";
      document.getElementById("historyTransaksiSection").style.display = "none";
    }
    
    function saveKatalogLS() {
        localStorage.setItem(KATALOG_LS_KEY, JSON.stringify(dataKatalogBuku));
    }

    function saveTrackingLS() {
      localStorage.setItem(TRACKING_LS_KEY, JSON.stringify(dataTracking));
    }
    
    function savePemesananLS() {
      localStorage.setItem(PEMESANAN_LS_KEY, JSON.stringify(dataPemesanan));
    }
    
    function showNotification(message) {
      alert(message);
    }
    
    function getCurrentTimeGreeting() {
        const hour = new Date().getHours();
        if (hour < 12) return "Selamat Pagi!";
        else if (hour < 18) return "Selamat Siang!";
        else return "Selamat Sore!";
    }


    /* === LOGIN & PERSISTENSI DASHBOARD (MODIFIKASI) === */
    function login() {
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();
      
      const user = dataPengguna.find(u => u.email === email && u.password === password);
      
      if (user) {
        alert(`${getCurrentTimeGreeting()}! Selamat datang, ${user.nama}`);
        localStorage.setItem(LOGIN_STATUS_KEY, "true"); // Simpan status login
        localStorage.setItem(LOGGED_IN_USER_KEY, user.nama); // Simpan nama user
        showDashboard();
      } else {
        alert("Email/Password yang anda masukkan salah!");
      }
    }
    
    function logout() {
        if (confirm("Apakah Anda yakin ingin Logout?")) {
            localStorage.removeItem(LOGIN_STATUS_KEY);
            localStorage.removeItem(LOGGED_IN_USER_KEY);
            document.getElementById("dashboardPage").style.display = "none";
            document.getElementById("loginPage").style.display = "flex";
            alert("Anda telah Logout.");
        }
    }
    
    function showDashboard() {
        const userName = localStorage.getItem(LOGGED_IN_USER_KEY) || "Pengguna";
        document.getElementById("greeting").textContent = getCurrentTimeGreeting();
        document.getElementById("loginPage").style.display = "none";
        document.getElementById("dashboardPage").style.display = "block";
        
        // Memastikan tabel ter-render setelah login/refresh
        renderTabelKatalog();
        renderTrackingTable();
        renderTabelLaporanPemesanan(); 
        renderTabelHistoryTransaksi();
        renderSweaterGallery(); // BARU: Render galeri di About Section
    }

    /* === MODAL UTIL === */
    function openModal(id) { document.getElementById(id).style.display = "block"; }
    function closeModal(id) { document.getElementById(id).style.display = "none"; }
    window.onclick = function(event) {
      const modals = document.getElementsByClassName("modal");
      for (let modal of modals) {
        if (event.target == modal) modal.style.display = "none";
      }
    }

    /* === ABOUT SECTION (BARU) === */
    function tampilkanAbout() {
        hideAllSections();
        document.getElementById("aboutSection").style.display = "block";
        renderSweaterGallery();
    }
    
    function renderSweaterGallery() {
        const gallery = document.getElementById("sweaterGallery");
        gallery.innerHTML = "";
        
        const sweaterList = [
            { nama: "Adidas Adicolor Oversize Full-Zip Hoodie", foto: "adidas Adicolor Oversize Full-Zip Hoodie.png" },
            { nama: "Hoodie Full-Zip Small Logo Future Icons", foto: "Hoodie Full-Zip Small Logo Future Icons.png" },
            { nama: "Hoodie French Terry Essentials 3-Stripes", foto: "Hoodie  French Terry Essentials 3-Stripes.png" },
            { nama: "Sweatshirt Essentials Big Logo French Terry", foto: "Sweatshirt Essentials Big Logo French Terry.png" },
            { nama: "Hoodie Full-Zip Future Icons 3-Stripes", foto: "Hoodie Full-Zip Future Icons 3-Stripes.png" } 
        ];
        
        sweaterList.forEach(item => {
            const card = document.createElement("div");
            card.className = "card-item";
            
            const img = document.createElement("img");
            img.src = item.foto;
            img.alt = item.nama;
            img.onerror = function(){ this.onerror = null; this.src = PLACEHOLDER_SVG; };
            
            const p = document.createElement("p");
            p.textContent = item.nama;
            
            card.appendChild(img);
            card.appendChild(p);
            gallery.appendChild(card);
        });
    }

    /* === KATALOG (FUNGSI DI MODIFIKASI) === */
    function tampilkanKatalog() {
        hideAllSections();
        document.getElementById("katalogSection").style.display = "block";
        renderTabelKatalog();
    }
    
    const PLACEHOLDER_SVG = 'data:image/svg+xml;utf8,' + encodeURIComponent(
      '<svg xmlns="http://www.w3.org/2000/svg" width="200" height="140">' +
      '<rect width="100%" height="100%" fill="#f3f4f6"/>' +
      '<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#9ca3af" font-size="14">Tidak ada foto</text>' +
      '</svg>'
    );
    
    function renderTabelKatalog() {
      const tbody = document.querySelector("#tabelKatalog tbody");
      tbody.innerHTML = "";
      
      if (dataKatalogBuku.length === 0) {
        // Colspan adalah 9
        tbody.innerHTML = `<tr><td colspan="9">Tidak ada data katalog sweater.</td></tr>`;
        return;
      }

      dataKatalogBuku.forEach(buku => {
        const row = document.createElement("tr");

        const tdFoto = document.createElement("td");
        const img = document.createElement("img");
        img.alt = buku.namaBarang || "Foto Sweater";
        if (!buku.pathFoto) {
          img.src = PLACEHOLDER_SVG;
        } else {
          img.src = buku.pathFoto;
        }
        img.onerror = function(){ this.onerror = null; this.src = PLACEHOLDER_SVG; };
        tdFoto.appendChild(img);

        row.innerHTML = `
          <td>${escapeHtml(buku.kodeBarang || "")}</td>
          <td>${escapeHtml(buku.ukuran || "-")}</td> <td style="text-align:left;">${escapeHtml(buku.namaBarang || "")}</td>
          <td>${escapeHtml(buku.jenisBarang || "")}</td>
          <td>${escapeHtml(buku.edisi || "")}</td>
          <td>${escapeHtml(String(buku.stok || 0))}</td>
          <td>${escapeHtml(buku.harga || "")}</td>
        `;
        row.appendChild(tdFoto);
        
        const tdAksi = document.createElement("td");
        tdAksi.innerHTML = `<button class="small-btn delete-btn" onclick="hapusBuku('${escapeHtml(buku.kodeBarang)}')">Hapus</button>`;
        row.appendChild(tdAksi);

        tbody.appendChild(row);
      });
    }
    
    // IMPLEMENTASI FUNGSI TAMBAH BUKU (DIUBAH UNTUK SWEATER)
    function tambahBuku() { 
        const kodeBarang = document.getElementById("kodeBarang").value.trim().toUpperCase();
        const ukuran = document.getElementById("ukuranInput").value; // Dapatkan nilai Ukuran (dari select)
        const namaBarang = document.getElementById("namaBarang").value.trim();
        const jenisBarang = document.getElementById("jenisBarang").value.trim();
        const edisi = document.getElementById("edisi").value.trim();
        const stok = parseInt(document.getElementById("stok").value.trim());
        const hargaInput = document.getElementById("harga").value.trim();
        let pathFoto = document.getElementById("pathFoto").value.trim();
        
        const fotoUpload = document.getElementById("fotoUpload").files[0];

        if (!kodeBarang || !namaBarang || isNaN(stok) || stok < 0 || !hargaInput || !ukuran) {
            showNotification("Kode Barang, Nama Sweater, Stok, Harga, dan Ukuran wajib diisi dengan benar!");
            return;
        }
        
        if (dataKatalogBuku.some(b => b.kodeBarang === kodeBarang)) {
            showNotification(`Kode Barang ${kodeBarang} sudah ada. Gunakan kode lain atau edit data yang sudah ada.`);
            return;
        }

        const hargaNumerik = parseRupiah(hargaInput);
        const hargaFormatted = formatRupiah(hargaNumerik);
        
        // Simulasi penyimpanan file (Hanya mengambil nama file/URL)
        if (fotoUpload) {
            pathFoto = fotoUpload.name;
        } else if (!pathFoto) {
            pathFoto = null; // Tidak ada foto
        }

        const newBuku = {
            kodeBarang: kodeBarang,
            namaBarang: namaBarang,
            jenisBarang: jenisBarang,
            edisi: edisi,
            stok: stok,
            harga: hargaFormatted,
            hargaNumerik: hargaNumerik,
            pathFoto: pathFoto,
            ukuran: ukuran // Simpan Ukuran
        };

        dataKatalogBuku.push(newBuku);
        saveKatalogLS();
        renderTabelKatalog();
        renderSweaterGallery(); // BARU: Perbarui juga galeri di About Section
        
        // Bersihkan form
        document.getElementById("kodeBarang").value = "";
        document.getElementById("ukuranInput").value = ""; // Bersihkan input Ukuran
        document.getElementById("namaBarang").value = "";
        document.getElementById("jenisBarang").value = "";
        document.getElementById("edisi").value = "";
        document.getElementById("stok").value = "";
        document.getElementById("harga").value = "";
        document.getElementById("pathFoto").value = "";
        document.getElementById("fotoUpload").value = "";

        showNotification(`Sweater "${namaBarang}" berhasil ditambahkan ke katalog.`);
    }

    // IMPLEMENTASI FUNGSI HAPUS BUKU
    function hapusBuku(kode) { 
        if (confirm(`Apakah Anda yakin ingin menghapus sweater dengan kode ${kode} dari katalog?`)) {
            const initialLength = dataKatalogBuku.length;
            dataKatalogBuku = dataKatalogBuku.filter(b => b.kodeBarang !== kode);
            
            if (dataKatalogBuku.length < initialLength) {
                saveKatalogLS();
                renderTabelKatalog();
                renderSweaterGallery(); // BARU: Perbarui juga galeri di About Section
                showNotification(`Sweater dengan kode ${kode} berhasil dihapus.`);
            } else {
                showNotification("Gagal menghapus sweater. Kode tidak ditemukan.");
            }
        }
    }


    /* === TRACKING (MODIFIKASI: TAMBAH NO HP) === */
    let currentTrackingId = null; 
    
    function tampilkanTracking() {
      hideAllSections();
      document.getElementById("trackingSection").style.display = "block";
      renderTrackingTable();
    }
    
    function renderTrackingTable() {
      const tbody = document.querySelector("#tabelTracking tbody");
      tbody.innerHTML = "";

      if (dataTracking.length === 0) {
        tbody.innerHTML = `<tr><td colspan="9">Tidak ada data tracking.</td></tr>`; // Colspan 9
        return;
      }

      dataTracking.forEach((it, idx) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${idx + 1}</td>
          <td>${it.resi}</td>
          <td style="text-align:left;">${escapeHtml(it.penerima)}</td>
          <td>${escapeHtml(it.noHpPenerima || "-")}</td> <td style="text-align:left;">${escapeHtml(it.alamat || "-")}</td>
          <td>${escapeHtml(it.kurir || "-")}</td>
          <td>${it.status}</td>
          <td>${it.tanggal}</td>
          <td>
            <button class="small-btn edit-btn" onclick="openUpdateModal('${it.id}')">Edit Status</button>
            <button class="small-btn detail-btn" onclick="viewHistory('${it.id}')">History</button>
            <button class="small-btn delete-btn" onclick="deletePengiriman('${it.id}')">Delete</button>
          </td>
        `;
        tbody.appendChild(tr);
      });
    }

    function tambahPengiriman() {
        const resi = document.getElementById("inputResi").value.trim();
        const penerima = document.getElementById("inputPenerima").value.trim();
        const noHp = document.getElementById("inputNoHp").value.trim(); // BARU: Ambil No HP
        const alamat = document.getElementById("inputAlamat").value.trim();
        const kurir = document.getElementById("inputKurir").value;
        const status = document.getElementById("inputStatus").value;

        if (!resi || !penerima || !noHp) { // Validasi No HP
            showNotification("Nomor Resi, Nama Penerima, dan Nomor Ponsel wajib diisi!");
            return;
        }
        
        if (dataTracking.some(t => t.resi === resi)) {
            showNotification(`Resi ${resi} sudah ada! Harap gunakan nomor resi yang berbeda.`);
            return;
        }

        const today = getTodayDate();
        const newTracking = {
            id: uid(),
            resi: resi,
            penerima: penerima,
            noHpPenerima: noHp, // BARU: Simpan No HP
            alamat: alamat,
            kurir: kurir,
            status: status,
            tanggal: today,
            history: [{ status: status, tanggal: today, catatan: "Input data awal" }]
        };

        dataTracking.unshift(newTracking); 
        saveTrackingLS();
        renderTrackingTable();
        
        // Bersihkan form
        document.getElementById("inputResi").value = "";
        document.getElementById("inputPenerima").value = "";
        document.getElementById("inputNoHp").value = ""; // Bersihkan input No HP
        document.getElementById("inputAlamat").value = "";
        document.getElementById("inputKurir").value = "JNE";
        document.getElementById("inputStatus").value = "Dalam Proses";
        
        showNotification(`Pengiriman dengan Resi ${resi} berhasil ditambahkan.`);
    }
    
    function deletePengiriman(id) {
        if (confirm("Apakah Anda yakin ingin menghapus data tracking ini?")) {
            const initialLength = dataTracking.length;
            dataTracking = dataTracking.filter(t => t.id !== id);
            
            if (dataTracking.length < initialLength) {
                saveTrackingLS();
                renderTrackingTable();
                showNotification("Data tracking berhasil dihapus.");
            } else {
                showNotification("Gagal menghapus data tracking.");
            }
        }
    }
    
    function openUpdateModal(id) {
        const tracking = getTrackingById(id);
        if (!tracking) {
            showNotification("Data tracking tidak ditemukan!");
            return;
        }
        currentTrackingId = id;
        document.getElementById("modalResiInfo").textContent = `Resi: ${tracking.resi} - Status Saat Ini: ${tracking.status}`;
        document.getElementById("newStatusSelect").value = tracking.status;
        document.getElementById("statusNote").value = "";
        openModal('updateStatusModal');
    }
    
    function saveStatusUpdate() {
        if (!currentTrackingId) return;
        
        const trackingIndex = dataTracking.findIndex(t => t.id === currentTrackingId);
        if (trackingIndex === -1) return;
        
        const newStatus = document.getElementById("newStatusSelect").value;
        const note = document.getElementById("statusNote").value.trim() || `Diperbarui ke ${newStatus}`;
        const today = getTodayDate();
        
        // Update status utama
        dataTracking[trackingIndex].status = newStatus;
        dataTracking[trackingIndex].tanggal = today;
        
        // Tambahkan ke history
        dataTracking[trackingIndex].history.push({ status: newStatus, tanggal: today, catatan: note });
        
        saveTrackingLS();
        closeModal('updateStatusModal');
        showNotification(`Status Resi ${dataTracking[trackingIndex].resi} berhasil diperbarui menjadi: ${newStatus}`);
        renderTrackingTable();
        currentTrackingId = null;
    }
    
    function viewHistory(id) {
        const tracking = getTrackingById(id);
        if (!tracking) {
            showNotification("Data tracking tidak ditemukan.");
            return;
        }
        
        document.getElementById("historyResiInfo").textContent = `(${tracking.resi})`;
        const historyContent = document.getElementById("historyContent");
        historyContent.innerHTML = "";
        
        if (tracking.history && tracking.history.length > 0) {
            // Urutkan dari yang terbaru (tanggal paling akhir)
            tracking.history.slice().reverse().forEach(hist => {
                const p = document.createElement("p");
                p.style.margin = "8px 0";
                p.innerHTML = `[${hist.tanggal}] <strong>${hist.status}</strong>: ${escapeHtml(hist.catatan || '-')}`;
                historyContent.appendChild(p);
            });
        } else {
            historyContent.innerHTML = `<p style="font-style: italic;">Tidak ada riwayat tracking.</p>`;
        }
        
        openModal('historyTrackingModal');
    }


    /* === LAPORAN PEMESANAN (MODIFIKASI: LABEL KATALOG) === */
    function tampilkanLaporanPemesanan() {
      hideAllSections();
      document.getElementById("laporanPemesananSection").style.display = "block";
      renderTabelLaporanPemesanan();
    }

    function renderTabelLaporanPemesanan() {
      const tbody = document.querySelector("#tabelLaporanPemesanan tbody");
      tbody.innerHTML = "";

      if (dataPemesanan.length === 0) {
        tbody.innerHTML = `<tr><td colspan="9">Tidak ada data pemesanan.</td></tr>`;
        return;
      }

      dataPemesanan.forEach(pesanan => {
        const buku = getBukuByKode(pesanan.kodeBarang) || {};
        const tracking = getTrackingByResi(pesanan.resi);
        
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${pesanan.idPesanan}</td>
          <td>${pesanan.tanggal}</td>
          <td>${pesanan.pembeli}</td>
          <td style="text-align:left;">${buku.namaBarang || 'Tidak Ditemukan'}</td>
          <td>${pesanan.jumlah}</td>
          <td>${buku.harga || '-'}</td>
          <td>${formatRupiah(pesanan.totalHarga)}</td>
          <td>${pesanan.statusPembayaran}</td>
          <td>
            <button class="small-btn edit-btn" onclick="openEditPemesananModal('${pesanan.idPesanan}')">Edit</button>
            <button class="small-btn delete-btn" onclick="deletePesanan('${pesanan.idPesanan}', 'laporan')">Delete</button>
            <br><span style="font-size: 11px; margin-top: 5px; display: block;">Status: ${tracking.status}</span>
          </td>
        `;
        tbody.appendChild(row);
      });
    }
    
    let currentEditPesananId = null;
    function openEditPemesananModal(idPesanan) {
      const pesanan = getPemesananById(idPesanan);
      if (!pesanan) {
        showNotification("Data pemesanan tidak ditemukan!");
        return;
      }
      currentEditPesananId = idPesanan;
      document.getElementById("modalPesananInfo").textContent = `Pesanan ID: ${idPesanan} - Pembeli: ${pesanan.pembeli}`;
      document.getElementById("editStatusBayar").value = pesanan.statusPembayaran;
      document.getElementById("editJasaKurir").value = pesanan.jasaKurir || 'JNE';
      document.getElementById("editKodeBarang").value = pesanan.kodeBarang || '';
      
      openModal('editPemesananModal');
    }
    
    function savePemesananUpdate() {
      if (!currentEditPesananId) return;
      
      const pesananIndex = dataPemesanan.findIndex(p => p.idPesanan === currentEditPesananId);
      if (pesananIndex === -1) return;
      
      const newStatusBayar = document.getElementById("editStatusBayar").value;
      const newJasaKurir = document.getElementById("editJasaKurir").value;
      const newKodeBarang = document.getElementById("editKodeBarang").value.trim() || null;
      
      dataPemesanan[pesananIndex].statusPembayaran = newStatusBayar;
      dataPemesanan[pesananIndex].jasaKurir = newJasaKurir;
      dataPemesanan[pesananIndex].kodeBarang = newKodeBarang; 
      
      savePemesananLS();
      closeModal('editPemesananModal');
      showNotification(`Pesanan ${currentEditPesananId} berhasil diperbarui.`);
      renderTabelLaporanPemesanan();
      renderTabelHistoryTransaksi(); 
      currentEditPesananId = null;
    }


    /* === HISTORY TRANSAKSI (MODIFIKASI: DETAIL MODAL) === */
    function tampilkanHistoryTransaksi() {
      hideAllSections();
      document.getElementById("historyTransaksiSection").style.display = "block";
      renderTabelHistoryTransaksi();
    }

    function renderTabelHistoryTransaksi() {
      const tbody = document.querySelector("#tabelHistoryTransaksi tbody");
      tbody.innerHTML = "";

      if (dataPemesanan.length === 0) {
        tbody.innerHTML = `<tr><td colspan="8">Tidak ada history transaksi.</td></tr>`;
        return;
      }

      dataPemesanan.forEach(pesanan => {
        const tracking = getTrackingByResi(pesanan.resi);
        
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${pesanan.idPesanan}</td>
          <td>${pesanan.tanggal}</td>
          <td>${pesanan.pembeli}</td>
          <td>${formatRupiah(pesanan.totalHarga)}</td>
          <td>${pesanan.statusPembayaran}</td>
          <td>${pesanan.jasaKurir || '-'}</td>
          <td>${tracking.status}</td>
          <td>
            <button class="small-btn detail-btn" onclick="viewDetailTransaksi('${pesanan.idPesanan}')">Detail</button>
            <button class="small-btn delete-btn" onclick="deletePesanan('${pesanan.idPesanan}', 'history')">Delete</button>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    // FUNGSI DETAIL TRANSAKSI (MODIFIKASI: Menampilkan No HP)
    function viewDetailTransaksi(idPesanan) {
      const pesanan = getPemesananById(idPesanan);
      if (!pesanan) {
        showNotification("Data transaksi tidak ditemukan.");
        return;
      }
      const buku = getBukuByKode(pesanan.kodeBarang) || {};
      const tracking = getTrackingByResi(pesanan.resi);
      
      let detailContent = `
        <h3>Detail Transaksi Pesanan: ${pesanan.idPesanan}</h3>
        <p><strong>Tanggal:</strong> ${pesanan.tanggal}</p>
        <p><strong>Pembeli:</strong> ${pesanan.pembeli}</p>
        <p><strong>Nama Sweater:</strong> ${buku.namaBarang || 'N/A'}</p>
        <p><strong>Ukuran:</strong> ${buku.ukuran || 'N/A'}</p> <p><strong>Jumlah:</strong> ${pesanan.jumlah}</p>
        <p><strong>Harga Satuan:</strong> ${buku.harga || 'N/A'}</p>
        <p><strong>Total Pembayaran:</strong> ${formatRupiah(pesanan.totalHarga)}</p>
        <p><strong>Status Pembayaran:</strong> ${pesanan.statusPembayaran}</p>
        
        <h4>Informasi Pengiriman</h4>
        <p><strong>Nomor Ponsel:</strong> ${tracking.noHpPenerima || 'N/A'}</p> <p><strong>Jasa Kurir:</strong> ${pesanan.jasaKurir || '-'}</p>
        <p><strong>Kode Informasi Stok / Katalog Sweater:</strong> ${pesanan.kodeBarang || 'N/A'}</p>
        <p style="font-size: 12px; margin-bottom: 8px;">(Nomor Resi Pengiriman: ${pesanan.resi || 'Belum Ada Resi'})</p>
        <p><strong>Status Pengiriman:</strong> ${tracking.status}</p>
      `;

      if (tracking.history && tracking.history.length > 0) {
          detailContent += `
              <h5>History Status</h5>
              <div style="max-height: 150px; overflow-y: auto; border: 1px solid #eee; padding: 10px; border-radius: 5px; font-size: 14px;">
          `;
          tracking.history.slice().reverse().forEach(hist => { 
              detailContent += `<p style="margin: 3px 0;">[${hist.tanggal}] <strong>${hist.status}</strong>: ${hist.catatan || '-'}</p>`;
          });
          detailContent += `</div>`;
      } else {
          detailContent += `<p style="font-style: italic;">Tidak ada riwayat tracking.</p>`;
      }
      
      const modal = document.getElementById("syaratKetentuanModal"); 
      const content = modal.querySelector(".modal-content");
      content.innerHTML = `<span class="close" onclick="closeModal('syaratKetentuanModal')">&times;</span>` + detailContent;
      openModal('syaratKetentuanModal');
    }

    // FUNGSI HAPUS TRANSAKSI/PESANAN
    function deletePesanan(idPesanan, section) {
      if (confirm(`Apakah Anda yakin ingin menghapus Pesanan ID ${idPesanan}? Tindakan ini tidak dapat dibatalkan. Resi yang terkait juga tidak akan muncul di Tracking Pengiriman lagi.`)) {
        const initialLength = dataPemesanan.length;
        const pesananToDelete = dataPemesanan.find(p => p.idPesanan === idPesanan);
        const resiToDelete = pesananToDelete ? pesananToDelete.resi : null;
        
        // 1. Hapus Pesanan
        dataPemesanan = dataPemesanan.filter(p => p.idPesanan !== idPesanan);
        
        if (dataPemesanan.length < initialLength) {
          // 2. Hapus Tracking (jika ada dan tidak digunakan oleh pesanan lain)
          if (resiToDelete) {
             const isResiUsedByOtherOrder = dataPemesanan.some(p => p.resi === resiToDelete);
             if (!isResiUsedByOtherOrder) {
                 const initialTrackingLength = dataTracking.length;
                 dataTracking = dataTracking.filter(t => t.resi !== resiToDelete);
                 if (dataTracking.length < initialTrackingLength) {
                    saveTrackingLS();
                    renderTrackingTable();
                 }
             }
          }
        
          savePemesananLS();
          showNotification(`Data pesanan ${idPesanan} berhasil di-Delete. ${resiToDelete && !isResiUsedByOtherOrder ? 'Data tracking terkait juga dihapus.' : ''}`);
          
          if (section === 'history') {
            renderTabelHistoryTransaksi();
            if (document.getElementById("laporanPemesananSection").style.display === "block") {
              renderTabelLaporanPemesanan();
            }
          } else if (section === 'laporan') {
            renderTabelLaporanPemesanan();
            if (document.getElementById("historyTransaksiSection").style.display === "block") {
              renderTabelHistoryTransaksi();
            }
          }
        } else {
          showNotification("Gagal menghapus data.");
        }
      }
    }


    /* === Inisialisasi tampilan awal (MODIFIKASI) === */
    document.addEventListener("DOMContentLoaded", function(){
      // Cek status login di localStorage
      if (localStorage.getItem(LOGIN_STATUS_KEY) === "true") {
        showDashboard(); // Tampilkan dashboard jika sudah login
        tampilkanAbout(); // BARU: Tampilkan About Section sebagai default setelah login
      } else {
        document.getElementById("loginPage").style.display = "flex";
      }
    });

    // Exposed for console testing (optional)
    window.dataPemesanan = dataPemesanan;
    window.dataTracking = dataTracking;
    window.dataKatalogBuku = dataKatalogBuku;
  </script>
</body>
</html>