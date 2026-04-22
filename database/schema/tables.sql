-- Database: webhammy (PostgreSQL) - SCHEMA DEFINITION

CREATE TABLE "user" (
    id_user SERIAL PRIMARY KEY,
    nama_user VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE admin (
    id_admin SERIAL PRIMARY KEY,
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
