-- Database: webhammy (PostgreSQL)

CREATE TABLE "user" (
    id_user SERIAL PRIMARY KEY,
    nama_user VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE gejala (
    id_gejala SERIAL PRIMARY KEY,
    kode_gejala VARCHAR(10) NOT NULL UNIQUE,
    nama_gejala VARCHAR(255) NOT NULL
);

CREATE TABLE penyakit (
    id_penyakit SERIAL PRIMARY KEY,
    nama_penyakit VARCHAR(100) NOT NULL,
    solusi TEXT NOT NULL
);

CREATE TABLE rule (
    id_rule SERIAL PRIMARY KEY,
    id_penyakit INTEGER REFERENCES penyakit(id_penyakit) ON DELETE CASCADE,
    id_gejala INTEGER REFERENCES gejala(id_gejala) ON DELETE CASCADE
);

CREATE TABLE data_hamster (
    "IdBio" SERIAL PRIMARY KEY,
    id_user INTEGER REFERENCES "user"(id_user) ON DELETE CASCADE,
    namahamster VARCHAR(100) NOT NULL,
    jenishamster VARCHAR(50) NOT NULL,
    jeniskel VARCHAR(20) NOT NULL,
    umur INTEGER NOT NULL
);

CREATE TABLE diagnosa (
    id_diagnosa SERIAL PRIMARY KEY,
    id_user INTEGER REFERENCES "user"(id_user) ON DELETE CASCADE,
    "IdBio" INTEGER REFERENCES data_hamster("IdBio") ON DELETE CASCADE,
    id_penyakit INTEGER REFERENCES penyakit(id_penyakit),
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    hasil TEXT NOT NULL
);

-- Basic Data Seeding / Contoh Data Awal
INSERT INTO "user" (nama_user, username, password) VALUES ('Administrator', 'admin', 'admin123');
INSERT INTO "user" (nama_user, username, password) VALUES ('Syarifah', 'syarifah', 'user123');

INSERT INTO penyakit (nama_penyakit, solusi) VALUES 
('Flu / Pilek', 'Berikan kehangatan pada kandang, bersihkan kandang dari debu. Jangan dimandikan dengan air. Berikan vitamin tambahan.'),
('Diare / Wet Tail', 'Segera pisahkan dari hamster lain. Hentikan pemberian sayuran dan buah segar, berikan pelet kering murni dan air beras (opsional) atau larutan elektrolit khusus.'),
('Kutu / Jamur', 'Bersihkan seluruh kandang dan ganti serbuk kayu gergaji. Boleh gunakan bedak khusus jamur atau salep dari dokter hewan.'),
('Luka Gigitan', 'Pisahkan dari teman yang agresif. Bersihkan luka perlahan dengan cairan antiseptik hewan peliharaan.');

INSERT INTO gejala (kode_gejala, nama_gejala) VALUES 
('G001', 'Hidung berair atau bersin-bersin'),
('G002', 'Napas berbunyi (ngorok)'),
('G003', 'Feses (kotoran) basah dan menempel pada bulu ekor'),
('G004', 'Sering menggaruk secara ekstrem dan bulu rontok'),
('G005', 'Kulit kemerahan atau ada bintik putih kering'),
('G006', 'Terdapat luka goresan atau pendarahan ringan');

INSERT INTO rule (id_penyakit, id_gejala) VALUES 
(1, 1), (1, 2),              -- Rule untuk Flu (G001, G002)
(2, 3),                      -- Rule untuk Diare (G003)
(3, 4), (3, 5),              -- Rule untuk Jamur (G004, G005)
(4, 6);                      -- Rule untuk Luka (G006)

-- Create Admin Table
CREATE TABLE admin (
    id_admin SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password) VALUES ('admin', 'admin123');
