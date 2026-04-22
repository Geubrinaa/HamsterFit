-- Basic Data Seeding / Contoh Data Awal

INSERT INTO admin (username, password) VALUES ('admin', 'admin123');

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
