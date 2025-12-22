# 📚 PANDUAN ADMIN: MENAMBAHKAN WISATA BARU

Panduan lengkap untuk admin menambahkan informasi wisata baru ke BmsTrip.

---

## 🚀 LANGKAH-LANGKAH MENAMBAHKAN WISATA BARU

### **Langkah 1: Login ke Admin Panel**

1. Buka URL: `http://localhost:8000/admin`
2. Login dengan akun admin:
   - **Email**: `admin@bmstrip.local`
   - **Password**: `password`

### **Langkah 2: Akses Menu Kelola Wisata**

Di dashboard admin, sidebar sebelah kiri pilih:
```
🗺️ Wisata → Kelola Wisata
```

Atau buka langsung: `http://localhost:8000/admin/wisatas`

### **Langkah 3: Klik Tombol "Tambah Wisata Baru"**

Di halaman daftar wisata, ada tombol hijau di atas:
```
➕ Tambah Wisata Baru
```

Atau akses langsung: `http://localhost:8000/admin/wisatas/create`

---

## 📝 FORM TAMBAH WISATA - PENJELASAN SETIAP FIELD

### **1. INFORMASI DASAR**

#### **🏷️ Kategori** (Wajib diisi)
- **Pilihan**: Alam, Kuliner, Modern, Budaya, Relaksasi
- **Gunakan untuk**: Mengkategorikan jenis wisata
- **Contoh**: Curug Cipendok → Pilih **Alam**

#### **📢 Status Publikasi**
- **Opsi**: Centang/Kosong
- **Jika dicentang**: Wisata langsung tampil di website
- **Jika kosong**: Wisata disimpan tapi belum tampil (draft)

---

### **2. JUDUL & URL**

#### **Judul Wisata** (Wajib diisi)
- **Maksimal**: 255 karakter
- **Contoh**: 
  - Curug Cipendok
  - Soto Ayam Banyumas
  - Museum Gajah

#### **Slug (URL)** (Wajib diisi & Unik)
- **Format**: Huruf kecil + dash (-) sebagai pemisah
- **Penting**: TIDAK BOLEH SAMA dengan wisata lain
- **Contoh**:
  - `curug-cipendok`
  - `soto-ayam-banyumas`
  - `museum-gajah`
- **Gunakan untuk**: URL di website akan menjadi `/wisatas/curug-cipendok`

---

### **3. LOKASI & HARGA**

#### **Lokasi**
- **Format**: Desa/Kota, Banyumas
- **Contoh**: 
  - Desa Sidareja, Banyumas
  - Jalan Sudirman, Purwokerto, Banyumas
- **Opsional**: Boleh dikosongkan

#### **Harga (Rp)**
- **Format**: Angka saja (misal: 30000, bukan Rp 30.000)
- **Opsional**: Boleh dikosongkan jika gratis
- **Contoh**: 
  - 10000 (untuk tiket masuk Curug Cipendok)
  - 25000 (untuk porsi soto ayam)
  - Kosongkan jika gratis/harga bervariasi

---

### **4. DESKRIPSI LENGKAP** (Opsional tapi disarankan)

Tulis deskripsi detail tentang wisata:
- Sejarah/latar belakang
- Fasilitas yang ada
- Aktivitas yang bisa dilakukan
- Jam operasional
- Tips berkunjung

**Contoh untuk Curug Cipendok:**
```
Curug Cipendok adalah air terjun multi tingkat yang indah di Banyumas. 
Terletak di ketinggian, air terjun ini memiliki beberapa tingkat 
dengan total tinggi mencapai 92 meter.

Fasilitas:
- Taman air terjun
- Kolam renang alami
- Jalur trekking
- Saung untuk istirahat
- Warung makanan

Aktivitas:
- Berenang di kolam alami
- Fotografi alam
- Trekking
- Picnic keluarga

Jam Operasional: 08:00 - 17:00
Hari Libur: Tutup hari Senin
```

---

### **5. GAMBAR** (Opsional)

#### **URL Gambar**
- **Format**: URL eksternal (dari Unsplash, Pexels, Imgur, dll)
- **Tidak support**: Upload file lokal
- **Contoh URL Unsplash**:
  ```
  https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1000&q=80&auto=format&fit=crop
  ```

#### **Cara Mencari Gambar di Unsplash:**

1. Buka: https://unsplash.com
2. Cari keyword: "waterfall banyumas", "food indonesia", dll
3. Klik gambar yang sesuai
4. Klik tombol "Copy Image URL" atau copy URL dari address bar
5. Paste di field **URL Gambar**

---

## ✅ CONTOH PENGISIAN LENGKAP

### **Contoh 1: Wisata Alam (Curug)**

```
Kategori:         Alam ✓
Status:           Centang (Publikasikan sekarang) ✓
Judul:            Curug Cipendok
Slug:             curug-cipendok
Lokasi:           Desa Sidareja, Cilongok, Banyumas
Harga:            10000
Deskripsi:        [Lihat contoh deskripsi di atas]
Gambar URL:       https://images.unsplash.com/photo-...
```

### **Contoh 2: Wisata Kuliner (Restoran)**

```
Kategori:         Kuliner ✓
Status:           Centang ✓
Judul:            Soto Ayam Meriah
Slug:             soto-ayam-meriah
Lokasi:           Jalan Sudirman, Purwokerto, Banyumas
Harga:            25000
Deskripsi:        Warung soto ayam terkenal dengan bumbu tradisional...
Gambar URL:       https://images.unsplash.com/photo-...
```

### **Contoh 3: Wisata Modern**

```
Kategori:         Modern ✓
Status:           Centang ✓
Judul:            Grand Mall Banyumas
Slug:             grand-mall-banyumas
Lokasi:           Jalan Ahmad Yani, Purwokerto, Banyumas
Harga:            (Kosongkan - gratis masuk)
Deskripsi:        Mall dengan 5 lantai, bioskop 8 layar, food court...
Gambar URL:       https://images.unsplash.com/photo-...
```

---

## 💾 MENYIMPAN WISATA BARU

1. **Setelah semua field terisi**, klik tombol:
   ```
   ✅ Tambah Wisata
   ```

2. **Jika ada error/validasi gagal**:
   - Layar akan menunjukkan pesan error merah
   - Perbaiki field yang error (ditandai biru)
   - Klik **Tambah Wisata** lagi

3. **Jika berhasil**:
   - Akan redirect ke halaman daftar wisata
   - Muncul pesan hijau: "Wisata berhasil ditambahkan!"
   - Wisata baru akan muncul di daftar (paling atas)

---

## 🔍 MELIHAT WISATA YANG SUDAH DITAMBAHKAN

### **Di Admin Panel:**

1. Buka: `http://localhost:8000/admin/wisatas`
2. Lihat daftar semua wisata
3. Klik tombol **👁️ Lihat** untuk preview di website
4. Klik **✏️ Edit** untuk mengubah
5. Klik **🗑️ Hapus** untuk menghapus

### **Di Website Publik:**

1. Homepage: `http://localhost:8000/`
   - Wisata baru akan tampil di "Wisata Terbaru" (jika published)
   
2. Semua Wisata: `http://localhost:8000/wisata`
   - Lihat semua wisata dari berbagai kategori

3. Filter Kategori: Klik kategori di homepage
   - Lihat wisata berdasarkan kategori yang dipilih

---

## ⚠️ VALIDASI & ATURAN PENTING

| Field | Validasi | Keterangan |
|-------|----------|-----------|
| **Kategori** | Wajib pilih | Tidak boleh kosong |
| **Judul** | Wajib + Max 255 | Tidak boleh kosong |
| **Slug** | Wajib + Unik | Tidak boleh duplikat |
| **Lokasi** | Opsional | Boleh kosong |
| **Harga** | Angka | Min 0, kosong = gratis |
| **Deskripsi** | Opsional | Boleh kosong |
| **Gambar** | Opsional | URL eksternal |

---

## 🔧 TROUBLESHOOTING

### **Error: "The slug has already been taken"**
- **Penyebab**: Slug sudah digunakan wisata lain
- **Solusi**: Gunakan slug yang berbeda/unik
- **Contoh**: Ganti `curug-cipendok-2` untuk wisata serupa

### **Error: "The category id does not exist"**
- **Penyebab**: Kategori tidak dipilih dengan benar
- **Solusi**: Refresh halaman dan pilih kategori lagi

### **Error: "The price must be a number"**
- **Penyebab**: Input harga bukan angka
- **Solusi**: Masukkan angka saja (30000, bukan Rp 30.000)

### **Gambar tidak tampil**
- **Penyebab**: URL gambar tidak valid/broken
- **Solusi**: Coba URL gambar lain dari Unsplash/sumber lain

### **Wisata tidak tampil di website**
- **Penyebab**: Status publikasi tidak dicentang
- **Solusi**: Edit wisata → Centang "Publikasikan sekarang"

---

## 📌 TIPS & BEST PRACTICES

### ✅ Lakukan

- ✅ Gunakan slug yang deskriptif (mudah dipahami)
- ✅ Isi deskripsi selengkap mungkin
- ✅ Gunakan gambar berkualitas tinggi
- ✅ Cek preview di website sebelum publish
- ✅ Update data jika ada perubahan info

### ❌ Jangan Lakukan

- ❌ Gunakan slug dengan spasi atau karakter khusus
- ❌ Duplicate slug antar wisata
- ❌ Upload gambar lokal (harus URL eksternal)
- ❌ Masukkan harga dengan format "Rp 30.000"
- ❌ Publikasikan wisata dengan data tidak lengkap

---

## 📞 BANTUAN LEBIH LANJUT

Jika ada pertanyaan atau masalah:

1. **Chat dengan developer**: Admin dashboard → Hubungi Support
2. **Baca dokumentasi lengkap**: `/DOKUMENTASI.md`
3. **Check database langsung**: phpMyAdmin → bmstrip → wisatas

---

**Last Updated**: November 14, 2025

