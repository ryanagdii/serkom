# Sistem Pendaftaran Beasiswa Mahasiswa

# Struktur File

- css/\* (Custom CSS)
- db/\* (Database)
- func/\* (Function File)
- js/\* (Custom JS File)
- layout/\* (Layout)
- uploads/\* (Uploaded File)

# Tools

- XAMPP (PHP, MySQL)
- Text Editor (Vscode)

# Installation

- Buat database (Ganti $dbname pada file db/koneksi.php sesuaikan dengan nama database yang dibuat)
- Buat table mahasiswa dan beasiswa (bisa juga dengan import sql yang ada di dalam folder db/)
- Query table mahasiswa

```sh
CREATE TABLE mahasiswa
(
    nim varchar(255) not null primary key,
    nama varchar(255) not null,
    email varchar(255) not null,
    no_hp varchar(255) not null,
    semester int not null,
    ipk decimal(3,2) not null
);
```

- Query table beasiswa

```sh
CREATE TABLE beasiswa
(
    id int not null auto_increment primary key,
    nim varchar(255) not null,
    nama varchar(255) not null,
    email varchar(255) not null,
    no_hp varchar(255) not null,
    semester int not null,
    ipk decimal(3,2) not null,
    pilihan_beasiswa varchar(255) not null,
    berkas_syarat varchar(255) not null,
    status_ajuan enum('Belum diverifikasi', 'Sudah diverifikasi')
);
```

- Dummy Data

```sh
Jika mengimport file sql yang ada di dalam folder db/, terdapat dummy data sebanyak 2 yaitu:
(NIM, Nama, Email, No HP, Semester, IPK)
('123', 'Abdul', 'abdul@gmail.com', '08123', 3, 2.50),
('1234', 'Ahmad', 'ahmad@gmail.com', '08321', 5, 3.51);
```
