CREATE TABLE IF NOT EXISTS `pengembalian` (
   id_pengembalian INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   id_peminjaman INT UNSIGNED NOT NULL, -- Harus INT UNSIGNED agar cocok
   tanggal_dikembali DATE NOT NULL,
   denda INT DEFAULT 0,
   created_at DATETIME NULL,
   updated_at DATETIME NULL,
   CONSTRAINT fk_pengembalian_peminjaman 
       FOREIGN KEY (id_peminjaman) 
       REFERENCES peminjaman(id_peminjaman) 
       ON DELETE CASCADE 
       ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;