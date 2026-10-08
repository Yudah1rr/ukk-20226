CREATE TABLE IF NOT EXISTS `alat` (
    id_alat INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_alat VARCHAR(255) NOT NULL,
    kode_alat VARCHAR(10) NOT NULL,
    id_kategori INT UNSIGNED NULL, -- Kolom kategori yang ditambahkan
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;