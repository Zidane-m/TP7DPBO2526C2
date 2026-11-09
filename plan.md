# Rencana Tugas Praktikum 7 (TP7) DPBO 2526 C2
**OOP dalam Website PHP Native dengan GUI & Database MySQL (Modul 8)**

---

## 1. Analisis Persyaratan & Ketentuan Modul 8

Berdasarkan dokumen panduan **Modul 8 (OOP dalam Website PHP dengan GUI)** halaman 9, spesifikasi tugas praktikum adalah sebagai berikut:

1. **Paradigma Pemrograman & Arsitektur:**
   - Berbasis **PHP Native** murni dengan menerapkan prinsip **Object-Oriented Programming (OOP)**.
   - Mengikuti pola pemisahan tanggung jawab (*Separation of Concerns*) dan struktur folder standar modul:
     - `class/`: Berisi Class PHP per entitas/tabel yang menangani query dan manipulasi data.
     - `config/`: Berisi konfigurasi dan koneksi database menggunakan PDO (*PHP Data Objects*).
     - `database/`: Berisi berkas skema dan data database (`.sql`).
     - `view/`: Berisi komponen antarmuka modular (header, footer, tabel data, form input).
     - `index.php`: Titik awal aplikasi (*front controller*) yang mengatur alur request/response cycle dan navigasi halaman.
     - `style.css`: Berkas penataan gaya visual antarmuka (GUI).

2. **Database & Relasi Entitas:**
   - **Minimal 3 Entitas (3 Tabel)**.
   - **Minimal 1 Tabel memiliki Relasi (*Foreign Key*)** terhadap tabel lain.
   - Contoh tema:
     - Sistem Perpustakaan (*Books*, *Members*, *Loans* - relasi foreign key `book_id` dan `member_id` pada `loans`).
     - Sistem Manajemen Kursus / Sekolah (*Courses*, *Instructors*, *Enrollments*).
     - Sistem Rumah Sakit / Apotek (*Patients*, *Doctors*, *Appointments* / *Medicines*, *Categories*, *Transactions*).

3. **Koneksi Database & Query:**
   - **Wajib menggunakan Prepared Statement** (`$db->prepare(...)` dan `$stmt->execute(...)`) untuk seluruh query database.
   - **TIDAK DIPERBOLEHKAN** menggunakan query mentah langsung tanpa prepare (seperti `mysqli_query()` atau `$db->query()` tanpa prepared statement).

4. **Kelengkapan Fitur CRUD:**
   - Setiap entitas **wajib memiliki fitur Create, Read, Update, dan Delete (CRUD)** secara lengkap.

5. **Ketentuan Pengumpulan & Repositori:**
   - Repositori GitHub publik dengan format penamaan: `TP7DPBO2526C2`.
   - Di dalam direktori project menyertakan:
     - Berkas database `.sql` (skema tabel + data dummy).
     - Berkas dokumentasi `README.md` lengkap (penjelasan tema, struktur database & ERD, penjelasan alur program/flow, serta bukti dokumentasi eksekusi berupa tangkapan layar dan rekaman video screen record).
   - Tautan formulir pengumpulan: [https://forms.gle/hpBcpRtUHUGJfWfX7](https://forms.gle/hpBcpRtUHUGJfWfX7).
   - Batas akhir pengumpulan (*Deadline*): **10 November 2026, pukul 23:59 WIB**.

---

## 2. Pembagian Peran dan Tanggung Jawab

| No | Komponen / Pekerjaan | Tanggung Jawab | Deskripsi Teknis |
|---|---|---|---|
| 1 | **Analisis & Perancangan Skema Database** | **AI & User** | Menentukan tema (contoh: *Library System* atau *Hospital Management*), mendesain 3 tabel, relasi foreign key, dan skrip `database/*.sql`. |
| 2 | **Konfigurasi Koneksi PDO** | **AI (Antigravity)** | Mengonfigurasi `config/db.php` menggunakan PDO dengan error handling `ATTR_ERRMODE => ERRMODE_EXCEPTION`. |
| 3 | **Implementasi Class Model OOP** | **AI (Antigravity)** | Membangun class pada folder `class/` dengan enkapsulasi dan method CRUD penuh berbasis **100% Prepared Statements**. |
| 4 | **Pembangunan Antarmuka Modular (View)** | **AI (Antigravity)** | Membuat komponen antarmuka GUI di `view/` (header, footer, navigasi, tabel responsif, modal/form tambah & edit). |
| 5 | **Pengembangan Front Controller (`index.php`)** | **AI (Antigravity)** | Mengatur routing halaman (`?page=...`), pemrosesan request HTTP POST (tambah/ubah data), dan HTTP GET (hapus data). |
| 6 | **Polesan Desain Antarmuka GUI (`style.css`)** | **AI (Antigravity)** | Menghadirkan tampilan website modern, bersih, profesional, dan nyaman digunakan di berbagai ukuran layar. |
| 7 | **Verifikasi Server & Setup Database Lokal** | **User & AI** | Menyalakan MySQL di Laragon/XAMPP, mengimpor database `.sql`, dan menjalankan web server (`php -S localhost:8000` atau via Laragon). |
| 8 | **Pengujian Fungsional Menyeluruh (Testing Matrix)** | **User & AI** | Menguji operasi Create, Read, Update, dan Delete untuk ketiga entitas guna memastikan data tersimpan akurat dan bebas bug. |
| 9 | **Perekaman Media Dokumentasi** | **User (Manual)** | Merekam video demonstrasi pengujian CRUD seluruh entitas serta mengambil screenshot untuk folder `Dokumentasi/`. |
| 10 | **Penyusunan Berkas `README.md`** | **AI (Antigravity)** | Menyusun laporan akhir lengkap dengan deskripsi tema, diagram relasi database (ERD), flow alur program, dan tautan bukti dokumentasi. |
| 11 | **Commit & Push GitHub** | **User (Manual)** | Menyerahkan kode akhir ke branch utama repositori GitHub sebelum tenggat deadline. |

---

## 3. Struktur Direktori Proyek yang Direncanakan

```
TP7DPBO2526C2/
├── .git/
├── class/                      # Kumpulan Class PHP untuk setiap entitas
│   ├── Book.php                # Class model & operasi CRUD tabel Buku
│   ├── Member.php              # Class model & operasi CRUD tabel Anggota
│   └── Loan.php                # Class model & operasi CRUD tabel Peminjaman (Relasi FK)
├── config/                     # Pengaturan konfigurasi dan koneksi
│   └── db.php                  # Koneksi database MySQL menggunakan PDO
├── database/                   # Skrip database
│   └── db_library.sql          # DDL create table, foreign keys, & data dummy
├── view/                       # Potongan elemen antarmuka (GUI) modular
│   ├── header.php              # Navbar dan header halaman
│   ├── footer.php              # Footer halaman
│   ├── books.php               # Tampilan tabel, form tambah & edit data Buku
│   ├── members.php             # Tampilan tabel, form tambah & edit data Anggota
│   └── loans.php               # Tampilan tabel, form pinjam & pengembalian
├── Dokumentasi/                # Folder rekaman video & tangkapan layar pengujian
│   ├── gameplayrecord.mp4      # Rekaman video demonstrasi seluruh alur CRUD
│   └── (screenshot-screenshot)
├── index.php                   # Titik awal / Front Controller routing aplikasi
├── style.css                   # Berkas penataan gaya tampilan GUI
├── plan.md                     # Berkas rencana kerja dan milestone ini
└── README.md                   # Laporan dokumentasi resmi tugas praktikum
```

---

## 4. Tahapan Pengerjaan Rinci (Milestones & Checkpoints)

### MILESTONE 1: Fondasi Skema Database & Relasi Foreign Key
- [x] **Langkah 1.1:** Menyusun berkas `database/db_library.sql`.
- [x] **Langkah 1.2:** Mendefinisikan tabel `books` (primary key: `id`).
- [x] **Langkah 1.3:** Mendefinisikan tabel `members` (primary key: `id`).
- [x] **Langkah 1.4:** Mendefinisikan tabel berelasi `loans` dengan foreign key `book_id` (mereferensi `books.id`) dan `member_id` (mereferensi `members.id`).
- [x] **Langkah 1.5:** Menyertakan instruksi DDL `CREATE DATABASE`, `USE`, serta sekumpulan data awal (`INSERT INTO`) yang realistis.

---

### MILESTONE 2: Konfigurasi Koneksi Database PDO
- [x] **Langkah 2.1:** Mengonfigurasi class `Database` pada `config/db.php`.
- [x] **Langkah 2.2:** Menerapkan koneksi `new PDO("mysql:host=localhost;dbname=...", $user, $pass)`.
- [x] **Langkah 2.3:** Mengatur atribut PDO error mode: `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`.
- [x] **Langkah 2.4:** Mengatur default fetch mode: `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`.

---

### MILESTONE 3: Implementasi Class OOP & 100% Prepared Statements
- [x] **Langkah 3.1: Entitas 1 (`Book.php`)**
  - [x] `getAll()`: `SELECT * FROM books ORDER BY id DESC` (Prepared Statement).
  - [x] `getById($id)`: `SELECT * FROM books WHERE id = ?` (Prepared Statement).
  - [x] `create($title, $author, $isbn, $stock)`: `INSERT INTO books ...` (Prepared Statement).
  - [x] `update($id, $title, $author, $isbn, $stock)`: `UPDATE books SET ... WHERE id = ?` (Prepared Statement).
  - [x] `delete($id)`: `DELETE FROM books WHERE id = ?` (Prepared Statement).
- [x] **Langkah 3.2: Entitas 2 (`Member.php`)**
  - [x] `getAll()`: `SELECT * FROM members ORDER BY id DESC` (Prepared Statement).
  - [x] `getById($id)`: `SELECT * FROM members WHERE id = ?` (Prepared Statement).
  - [x] `create($name, $email, $phone)`: `INSERT INTO members ...` (Prepared Statement).
  - [x] `update($id, $name, $email, $phone)`: `UPDATE members SET ... WHERE id = ?` (Prepared Statement).
  - [x] `delete($id)`: `DELETE FROM members WHERE id = ?` (Prepared Statement).
- [x] **Langkah 3.3: Entitas 3 (`Loan.php`) - Relasi Peminjaman**
  - [x] `getAllLoans()`: `SELECT loans.*, books.title, members.name FROM loans JOIN books ... JOIN members ...` (Prepared Statement).
  - [x] `borrowBook($book_id, $member_id)`: Memeriksa ketersediaan stok, mengurangi stok buku via prepared statement, dan mencatat peminjaman (Prepared Statement).
  - [x] `returnBook($loan_id)`: Memperbarui tanggal kembali `return_date = CURDATE()` dan mengembalikan stok buku (+1) (Prepared Statement).
  - [x] `deleteLoan($loan_id)`: Menghapus riwayat transaksi pinjam (Prepared Statement).

---

### MILESTONE 4: Pengembangan Front Controller & Routing (`index.php`)
- [x] **Langkah 4.1:** Memuat seluruh class model yang dibutuhkan (`require_once`).
- [x] **Langkah 4.2:** Mengatur penanganan aksi form melalui HTTP POST:
  - Penambahan data baru (Book, Member, Loan).
  - Pembaharuan data (Update Book, Update Member).
- [x] **Langkah 4.3:** Mengatur penanganan aksi via HTTP GET:
  - Penghapusan data (`?page=...&action=delete&id=...`).
  - Pengembalian buku (`?page=loans&action=return&id=...`).
- [x] **Langkah 4.4:** Mengatur mekanisme redirect setelah operasi manipulasi data untuk mencegah *form resubmission*.
- [x] **Langkah 4.5:** Mengatur navigasi halaman dinamis (`?page=books`, `?page=members`, `?page=loans`).

---

### MILESTONE 5: Antarmuka Pengguna Modular (View & Styling)
- [x] **Langkah 5.1:** Membuat `view/header.php` dengan navigasi aktif yang bersih.
- [x] **Langkah 5.2:** Membuat `view/footer.php` sebagai penutup struktur HTML.
- [x] **Langkah 5.3:** Menyempurnakan `view/books.php` (tabel data buku, badge stok, form modal/inline tambah & edit, tombol hapus).
- [x] **Langkah 5.4:** Menyempurnakan `view/members.php` (tabel data anggota, form tambah & edit, tombol hapus).
- [x] **Langkah 5.5:** Menyempurnakan `view/loans.php` (tabel riwayat peminjaman dengan status belum kembali/sudah kembali, form dropdown pemilihan buku & anggota, tombol return).
- [x] **Langkah 5.6:** Mengembangkan `style.css` agar tampilan rapi, kontras, modern, dan nyaman digunakan sesuai prinsip antislop.

---

### MILESTONE 6: Pengujian Fungsional Menyeluruh (Testing Matrix)
Memverifikasi fungsionalitas CRUD ketiga entitas:

| No | Modul / Entitas | Fitur yang Diuji | Tindakan Pengujian | Ekspektasi Hasil | Status |
|---|---|---|---|---|:---:|
| 1 | **Books** | Create (Tambah) | Input judul, penulis, ISBN, stok | Data baru muncul di tabel buku | [ ] |
| 2 | **Books** | Read (Tampil) | Buka halaman buku | Seluruh data buku termuat rapi | [ ] |
| 3 | **Books** | Update (Ubah) | Edit judul/stok buku | Data terbarui secara instan | [ ] |
| 4 | **Books** | Delete (Hapus) | Klik hapus buku | Data terhapus dari tabel | [ ] |
| 5 | **Members** | Create (Tambah) | Input nama, email, no HP | Anggota baru terdaftar | [ ] |
| 6 | **Members** | Read (Tampil) | Buka halaman anggota | Daftar anggota tampil di tabel | [ ] |
| 7 | **Members** | Update (Ubah) | Edit nama/no HP anggota | Data anggota berhasil diperbarui | [ ] |
| 8 | **Members** | Delete (Hapus) | Klik hapus anggota | Anggota terhapus dari database | [ ] |
| 9 | **Loans** | Create (Pinjam) | Pilih buku & anggota, klik Pinjam | Transaksi tercatat, stok buku berkurang 1 | [ ] |
| 10 | **Loans** | Read (Tampil) | Buka halaman peminjaman | Transaksi tampil dengan join judul & nama | [ ] |
| 11 | **Loans** | Update (Kembali)| Klik tombol Return | Status tanggal kembali terisi, stok buku bertambah 1 | [ ] |
| 12 | **Loans** | Delete (Hapus) | Klik hapus riwayat peminjaman | Riwayat transaksi terhapus | [ ] |

---

### MILESTONE 7: Dokumentasi & Penyusunan `README.md`
- [ ] **Langkah 7.1:** Merekam video demonstrasi (*screen record*) pengujian CRUD seluruh tabel dan menyimpannya di folder `Dokumentasi/`.
- [ ] **Langkah 7.2:** Mengambil tangkapan layar antarmuka setiap halaman (Books, Members, Loans).
- [ ] **Langkah 7.3:** Menyusun berkas `README.md` dengan struktur yang selaras dengan TP1 s.d. TP6:
  - Header judul & Janji kejujuran akademik.
  - Deskripsi dan Tema Website.
  - Perancangan Skema Database (Daftar tabel, atribut, relasi Foreign Key, Diagram ERD).
  - Penjelasan Arsitektur OOP & Alur Kode (Class, Method, Prepared Statements).
  - Bukti Dokumentasi Eksekusi (Tangkapan layar & rekaman video).
  - Panduan Menjalankan Program (Konfigurasi database & web server).

---

### MILESTONE 8: Finalisasi Git & Pengumpulan Tugas
- [ ] **Langkah 8.1:** Memeriksa kebersihan repositori (`git status`).
- [ ] **Langkah 8.2:** Melakukan commit dengan pesan deskriptif.
- [ ] **Langkah 8.3:** Melakukan push ke repositori publik GitHub `TP7DPBO2526C2`.
- [ ] **Langkah 8.4:** Mengisi formulir pengumpulan tugas sebelum batas akhir 10 November 2026 pukul 23:59 WIB.

