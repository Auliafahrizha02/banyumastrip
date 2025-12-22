# 📋 DOKUMENTASI LENGKAP BMSTRIP

**BmsTrip** adalah platform rekomendasi wisata berbasis Laravel 11 yang menyediakan informasi destinasi wisata di Banyumas dengan fitur review dan rating.

---

## 📊 TABLE OF CONTENTS
1. [Arsitektur Sistem](#arsitektur-sistem)
2. [Database Schema](#database-schema)
3. [Alur Aplikasi (Flowchart)](#alur-aplikasi-flowchart)
4. [Model-Controller-View](#model-controller-view)
5. [Fitur Utama](#fitur-utama)
6. [API Routes](#api-routes)

---

## 🏗️ ARSITEKTUR SISTEM

```
┌─────────────────────────────────────────────────────────────┐
│                     LARAVEL 11 APPLICATION                  │
├─────────────────────────────────────────────────────────────┤
│                                                               │
│  ┌──────────────────────────────────────────────────────┐   │
│  │         ROUTES (routes/web.php)                      │   │
│  │  - Public: /, /wisata, /wisatas/{slug}              │   │
│  │  - Auth: /login, /register, /logout                 │   │
│  │  - Admin: /admin/* (protected)                       │   │
│  └──────────────────────────────────────────────────────┘   │
│                           ↓                                   │
│  ┌──────────────────────────────────────────────────────┐   │
│  │         CONTROLLERS                                   │   │
│  │  - HomeController       (homepage)                   │   │
│  │  - WisataController     (listing & detail)           │   │
│  │  - ReviewController     (submit review)              │   │
│  │  - AdminController      (dashboard & CRUD)           │   │
│  └──────────────────────────────────────────────────────┘   │
│                           ↓                                   │
│  ┌──────────────────────────────────────────────────────┐   │
│  │         MODELS (Eloquent ORM)                        │   │
│  │  - User (role: admin/user)                           │   │
│  │  - Category (5: Alam, Kuliner, Modern, Budaya, etc) │   │
│  │  - Wisata (destination, price, image, rating)       │   │
│  │  - Review (wisata + user + rating + comment)        │   │
│  └──────────────────────────────────────────────────────┘   │
│                           ↓                                   │
│  ┌──────────────────────────────────────────────────────┐   │
│  │         DATABASE (MySQL)                             │   │
│  │  - users, categories, wisatas, reviews              │   │
│  └──────────────────────────────────────────────────────┘   │
│                                                               │
└─────────────────────────────────────────────────────────────┘
```

---

## 🗄️ DATABASE SCHEMA

### Users Table
```
id (PK)         → Integer, Primary Key
name            → String (255)
email           → String (255), Unique
password        → String (hashed)
role            → Enum: 'user' | 'admin'
email_verified_at → Timestamp (nullable)
created_at, updated_at → Timestamps
```

### Categories Table
```
id (PK)         → Integer, Primary Key
name            → String (255) - Alam, Kuliner, Modern, Budaya, Relaksasi
slug            → String (255), Unique
description     → Text (nullable)
created_at, updated_at → Timestamps
```

### Wisatas Table
```
id (PK)         → Integer, Primary Key
category_id (FK) → Integer, Foreign Key → categories.id
title           → String (255)
slug            → String (255), Unique
description     → Text (nullable)
location        → String (255)
price           → Decimal (nullable)
image           → String (nullable) - Unsplash URL
published       → Boolean (default: true)
created_at, updated_at → Timestamps
```

### Reviews Table
```
id (PK)         → Integer, Primary Key
wisata_id (FK)  → Integer, Foreign Key → wisatas.id
user_id (FK)    → Integer, Foreign Key → users.id
rating          → Integer (1-5)
comment         → Text (nullable)
created_at, updated_at → Timestamps
```

### Entity Relationship Diagram
```
┌─────────────────────┐
│       USERS         │
├─────────────────────┤
│ id (PK)             │
│ name                │
│ email (unique)      │
│ password            │
│ role (admin/user)   │
│ timestamps          │
└──────────┬──────────┘
           │ 1:N
           │
           │ (user_id)
           ▼
┌─────────────────────┐       ┌──────────────────┐
│     REVIEWS         │◄──────┤   WISATAS        │
├─────────────────────┤  N:1  ├──────────────────┤
│ id (PK)             │   (wisata_id)   │ id (PK)          │
│ wisata_id (FK)      │       │ category_id (FK)─┼──────┐
│ user_id (FK)        │       │ title            │      │
│ rating (1-5)        │       │ slug (unique)    │      │
│ comment             │       │ description      │      │ 1:N
│ timestamps          │       │ location         │      │
└─────────────────────┘       │ price            │      │
                              │ image            │      │
                              │ published        │      │
                              │ timestamps       │      │
                              └────────┬─────────┘      │
                                       │                │
                                       │ N:1            │
                                       │ (category_id)  │
                                       │                │
                                       └────────────────┤
                                              ▼
                                    ┌──────────────────┐
                                    │  CATEGORIES      │
                                    ├──────────────────┤
                                    │ id (PK)          │
                                    │ name             │
                                    │ slug (unique)    │
                                    │ description      │
                                    │ timestamps       │
                                    └──────────────────┘
```

---

## 🔄 ALUR APLIKASI (FLOWCHART)

### 1️⃣ ALUR HOMEPAGE / LANDING PAGE

```
┌──────────────────────────────┐
│  User membuka website        │
│  GET /                        │
└───────────────┬──────────────┘
                │
                ▼
        ┌──────────────────────┐
        │ HomeController       │
        │ @index()             │
        └───────────┬──────────┘
                    │
        ┌───────────┴───────────┐
        │                       │
    Query DB            Cari (jika ada 'q')
    ┌───────┐        ┌──────────────────┐
    │       │        │ WHERE            │
    │ Wisatas.       │ - title LIKE     │
    │ with()         │ - location LIKE  │
    │ .published     │ - category LIKE  │
    │ .latest()      └──────────────────┘
    │       │        
    └───┬───┘        
        │
        ▼
    ┌──────────────────────┐
    │ Get Categories       │
    │ Category::all()      │
    └───────────┬──────────┘
                │
                ▼
    ┌──────────────────────┐
    │ Return View:         │
    │ 'home.blade.php'     │
    │ with:                │
    │ - $wisatas           │
    │ - $categories        │
    │ - $avgRating         │
    │ - $searchQuery       │
    └───────────┬──────────┘
                │
                ▼
        ┌──────────────────┐
        │ Display Cards:   │
        │ - Image          │
        │ - Title          │
        │ - Location       │
        │ - Rating ⭐      │
        │ - Price 💰       │
        │ - Button Detail  │
        └──────────────────┘
```

### 2️⃣ ALUR DETAIL WISATA & REVIEWS

```
┌──────────────────────────────┐
│  User klik "Lihat Detail"    │
│  GET /wisatas/{slug}         │
└───────────────┬──────────────┘
                │
                ▼
        ┌──────────────────────┐
        │ WisataController     │
        │ @show($slug)         │
        └───────────┬──────────┘
                    │
        ┌───────────┴───────────────────────┐
        │                                   │
    ┌─────────────────────┐    ┌──────────────────────┐
    │ Cari Wisata:        │    │ Get Recommendations: │
    │ WHERE slug = $slug  │    │ Wisata dari kategori │
    │ with reviews.user   │    │ yang sama (exclude   │
    │                     │    │ wisata saat ini)     │
    └──────────┬──────────┘    └──────────┬───────────┘
               │                          │
               └──────────────┬───────────┘
                              │
                              ▼
                ┌──────────────────────────┐
                │ Return View:             │
                │ 'wisata.detail.blade.php'│
                │ with:                    │
                │ - $wisata (full data)    │
                │ - $recommendations       │
                │ - $avgRating             │
                └──────────────┬───────────┘
                               │
                ┌──────────────┴──────────────┐
                │                             │
    ┌──────────────────────┐    ┌────────────────────┐
    │ Display Wisata:      │    │ Display Reviews:   │
    │ - Image (Unsplash)   │    │ - Rating (stars)   │
    │ - Title              │    │ - Comment          │
    │ - Location           │    │ - User name        │
    │ - Price              │    │ - Date posted      │
    │ - Description        │    │ - Form Add Review  │
    │ - Category           │    │  (auth required)   │
    │ - Avg Rating         │    └────────────────────┘
    └──────────────────────┘
```

### 3️⃣ ALUR SUBMIT REVIEW

```
┌──────────────────────────────┐
│  User Login (jika belum)     │
│  Isi Form Review:            │
│  - Rating (1-5 ⭐)           │
│  - Comment (optional)        │
└───────────────┬──────────────┘
                │
                ▼
        ┌──────────────────────┐
        │ POST /wisatas/{id}   │
        │ /reviews             │
        └───────────┬──────────┘
                    │
                    ▼
        ┌──────────────────────┐
        │ ReviewController     │
        │ @store()             │
        └───────────┬──────────┘
                    │
        ┌───────────┴───────────┐
        │                       │
    ┌─────────────┐      ┌──────────────┐
    │ Validate:   │      │ Check Auth:  │
    │ - rating    │      │ User login?  │
    │ - comment   │      │              │
    │ (1-5, 2000) │      └──────────────┘
    └─────────────┘      
        │                 
        ▼                 
    ┌──────────────────────┐
    │ Create Review:       │
    │ Review::create([     │
    │   wisata_id,         │
    │   user_id,           │
    │   rating,            │
    │   comment            │
    │ ])                   │
    └──────────┬───────────┘
               │
               ▼
    ┌──────────────────────┐
    │ Redirect Back:       │
    │ with success message │
    │                      │
    │ Display review baru  │
    │ di page detail       │
    └──────────────────────┘
```

### 4️⃣ ALUR ADMIN DASHBOARD

```
┌──────────────────────────────┐
│ Admin Login:                 │
│ GET /login                   │
└───────────────┬──────────────┘
                │
        ┌───────▼─────────┐
        │ POST /login     │
        │ Validate email  │
        │ & password      │
        │ Auth::attempt() │
        └───────┬─────────┘
                │
        ┌───────▼──────────────────┐
        │ Success?                 │
        │ Set session              │
        │ Redirect to /admin       │
        └───────┬──────────────────┘
                │
                ▼
        ┌──────────────────────────┐
        │ Middleware: IsAdmin      │
        │ Check user->isAdmin()    │
        └───────┬──────────────────┘
                │
        ┌───────▼──────────────────┐
        │ Admin? YES / NO          │
        └───────┬────────┬─────────┘
                │        │
              YES       NO
                │        │
                ▼        ▼
            ┌─────┐  ┌────────────────┐
            │ OK  │  │ Abort 403      │
            └──┬──┘  │ Unauthorized   │
               │     └────────────────┘
               │
               ▼
    ┌────────────────────────────────┐
    │ AdminController @dashboard()   │
    └───────────────┬────────────────┘
                    │
        ┌───────────┼───────────┬──────────────┐
        │           │           │              │
    Count:      Count:      Count:         Get:
    Wisatas     Categories  Users          Recent
                                          Reviews
        │           │           │              │
        ▼           ▼           ▼              ▼
    View: admin.dashboard
    Display:
    - Total Wisata
    - Total Kategori
    - Total User
    - Recent Reviews (table)
```

### 5️⃣ ALUR ADMIN CRUD WISATA

```
┌─────────────────────────────────────────┐
│ Admin di /admin/wisatas                 │
│ GET /admin/wisatas                      │
└──────────────────┬──────────────────────┘
                   │
                   ▼
    ┌──────────────────────────────┐
    │ AdminController              │
    │ @wisatasIndex()              │
    └─────────────┬────────────────┘
                  │
                  ▼
    ┌────────────────────────────────┐
    │ Query: Wisata::with('category')│
    │ orderBy('created_at', 'desc')  │
    │ paginate(20)                   │
    └─────────────┬────────────────┘
                  │
                  ▼
    ┌────────────────────────────────┐
    │ Display Table:                 │
    │ - ID, Title, Category, Price   │
    │ - Action: Edit, Delete         │
    │ - Button: Create New           │
    └─────────────┬──────────────────┘
                  │
        ┌─────────┴──────────┬─────────┐
        │                    │         │
    CREATE/EDIT          DELETE    REFRESH
        │                    │
        ▼                    ▼
    Form Validate      confirm->Delete
    POST /admin/       DELETE
    wisatas or         /admin/wisatas/{id}
    PUT /admin/
    wisatas/{id}
        │                    │
        ▼                    ▼
    Save to DB          Delete from DB
        │                    │
        ▼                    ▼
    Redirect back
    with success msg
```

---

## 🏛️ MODEL-CONTROLLER-VIEW

### MODEL: User.php
```php
// Relationships
- User hasMany Review

// Methods
- isAdmin(): bool → Check if role === 'admin'
- reviews() → Get all reviews by user

// Attributes
- id, name, email, password
- role (enum: 'admin' | 'user')
```

### MODEL: Category.php
```php
// Relationships
- Category hasMany Wisata

// Methods
- wisatas() → Get all wisatas in category

// Attributes
- id, name, slug (unique), description
```

### MODEL: Wisata.php
```php
// Relationships
- Wisata belongsTo Category
- Wisata hasMany Review

// Methods
- category() → Get category
- reviews() → Get all reviews
- averageRating(): float → Calculate avg rating

// Attributes
- id, category_id, title, slug (unique)
- description, location, price, image
- published (boolean)
```

### MODEL: Review.php
```php
// Relationships
- Review belongsTo Wisata
- Review belongsTo User

// Methods
- wisata() → Get wisata
- user() → Get user

// Attributes
- id, wisata_id, user_id
- rating (1-5), comment
```

### CONTROLLER: HomeController
```php
public function index(Request $request)
  - Query wisatas (published, latest)
  - Optional: filter by search query (title/location/category)
  - Get all categories for sidebar
  - Return view('home.blade.php')
  - Displays: paginated wisata cards + categories
```

### CONTROLLER: WisataController
```php
public function index(Request $request)
  - List all published wisatas
  - Optional: filter by category (query param)
  - Optional: search by keyword
  - Paginate 9 per page
  - Return view('wisata.index')

public function show($slug)
  - Get wisata by slug with reviews
  - Get 3 recommendations (same category)
  - Return view('wisata.detail')
  - Display: wisata + reviews + recommendations
```

### CONTROLLER: ReviewController
```php
public function store(Request $request, $wisataId)
  - Validate: rating (1-5), comment (max 2000 chars)
  - Check user is authenticated
  - Get wisata
  - Create review: Review::create()
  - Redirect back with success
  - Display: review on detail page
```

### CONTROLLER: AdminController
```php
Dashboard methods:
  - dashboard() → count stats + recent reviews

Category CRUD:
  - categoriesIndex() → list
  - categoriesStore() → create
  - categoriesUpdate() → edit
  - categoriesDestroy() → delete

Wisata CRUD:
  - wisatasIndex() → list
  - wisatasStore() → create
  - wisatasUpdate() → edit
  - wisatasDestroy() → delete

User management:
  - usersIndex() → list
  - usersUpdate() → change role
  - usersDestroy() → delete
```

---

## ✨ FITUR UTAMA

### 1. **Homepage / Landing Page**
- ✅ Display wisata terbaru (published only)
- ✅ Pagination (9 per page)
- ✅ Search by title, location, category name
- ✅ Sidebar kategori filter
- ✅ Card display: image, title, location, rating, price

### 2. **Wisata Listing Page**
- ✅ Full list with pagination
- ✅ Filter by category
- ✅ Search functionality
- ✅ Average rating dari reviews
- ✅ Load related reviews (eager loading)

### 3. **Wisata Detail Page**
- ✅ Full description & details
- ✅ Image (Unsplash URL)
- ✅ Location & price
- ✅ Category info
- ✅ Average rating
- ✅ All reviews with user info & dates
- ✅ Recommendations: 3 wisata dari kategori sama

### 4. **Review System**
- ✅ Submit review (auth required)
- ✅ Rating: 1-5 stars
- ✅ Comment: optional (max 2000 chars)
- ✅ Display all reviews sorted by latest
- ✅ Show user name + date posted

### 5. **Authentication**
- ✅ Register (custom form, role=user)
- ✅ Login (email + password)
- ✅ Logout (invalidate session)
- ✅ Session management
- ✅ Role-based access (user/admin)

### 6. **Admin Panel**
- ✅ Dashboard (stats + recent reviews)
- ✅ CRUD Wisata (create, read, update, delete)
- ✅ CRUD Category
- ✅ Manage Users (view, change role, delete)
- ✅ Protected by IsAdmin middleware

### 7. **Data Management**
- ✅ 24 sample wisata (pre-seeded)
- ✅ 5 categories (Alam, Kuliner, Modern, Budaya, Relaksasi)
- ✅ 3 demo users (admin + 2 normal users)
- ✅ 10 sample reviews
- ✅ Unsplash images for all wisatas

---

## 🛣️ API ROUTES

### Public Routes
```
GET  /                          → HomeController@index
GET  /wisata                    → WisataController@index
GET  /wisatas/{slug}            → WisataController@show
GET  /login                     → Show login form
POST /login                     → Store login
GET  /register                  → Show register form
POST /register                  → Store registration
POST /logout                    → Logout
```

### Review Routes (Auth Required)
```
POST /wisatas/{wisata}/reviews  → ReviewController@store
```

### Admin Routes (Auth + IsAdmin Middleware)
```
GET  /admin                             → AdminController@dashboard
GET  /admin/categories                  → AdminController@categoriesIndex
POST /admin/categories                  → AdminController@categoriesStore
PUT  /admin/categories/{category}       → AdminController@categoriesUpdate
DELETE /admin/categories/{category}     → AdminController@categoriesDestroy

GET  /admin/wisatas                     → AdminController@wisatasIndex
POST /admin/wisatas                     → AdminController@wisatasStore
PUT  /admin/wisatas/{wisata}            → AdminController@wisatasUpdate
DELETE /admin/wisatas/{wisata}          → AdminController@wisatasDestroy

GET  /admin/users                       → AdminController@usersIndex
PUT  /admin/users/{user}                → AdminController@usersUpdate
DELETE /admin/users/{user}              → AdminController@usersDestroy
```

---

## 🔐 MIDDLEWARE & SECURITY

### Middleware: IsAdmin
```php
- Check: user must be authenticated
- Check: user->isAdmin() must return true
- Abort 403 if not admin
- Applied to all /admin routes
```

### Middleware: Auth
```php
- Required for: review submission, logout
- Redirect to /login if not authenticated
```

### Middleware: Guest
```php
- Required for: login, register
- Redirect to / if already authenticated
```

---

## 🗂️ FILE STRUCTURE PENTING

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── WisataController.php
│   │   ├── ReviewController.php
│   │   └── AdminController.php
│   └── Middleware/
│       └── IsAdmin.php
├── Models/
│   ├── User.php
│   ├── Category.php
│   ├── Wisata.php
│   └── Review.php
│
database/
├── migrations/
│   ├── *_create_users_table.php
│   ├── *_create_cache_table.php
│   ├── *_create_jobs_table.php
│   ├── *_add_role_to_users.php
│   ├── *_create_categories_table.php
│   ├── *_create_wisatas_table.php
│   ├── *_create_reviews_table.php
│   └── *_add_image_to_wisatas_table.php
├── seeders/
│   ├── DatabaseSeeder.php
│   ├── DemoSeeder.php
│   └── WisataSeeder.php
│
resources/
├── css/
│   └── app.css (Tailwind v4)
├── js/
│   ├── app.js
│   └── bootstrap.js
└── views/
    ├── layouts/
    ├── home.blade.php
    ├── wisata/
    ├── auth/
    └── admin/

routes/
└── web.php
```

---

## 📝 RINGKASAN DATA

### Categories (5)
1. **Alam** - Wisata alam dan outdoor
2. **Kuliner** - Tempat makan dan mencoba kuliner lokal
3. **Modern** - Tempat modern dan hiburan
4. **Budaya** - Wisata budaya dan bersejarah
5. **Relaksasi** - Tempat relaksasi dan spa

### Sample Data
- **Wisata**: 24 entries (Banyumas tourism destinations)
- **Reviews**: 10 entries (from 3 demo users)
- **Users**: 3 (1 admin + 2 normal)
- **Images**: All from Unsplash URLs

### Demo Users
- `admin@bmstrip.local` / password → **Admin**
- `budi@example.com` / password → **User**
- `siti@example.com` / password → **User**

---

## 🚀 CARA MENJALANKAN

### 1. Setup Database
```bash
php artisan migrate:fresh --seed
```

### 2. Bersihkan Cache
```bash
php artisan cache:clear
php artisan config:cache
php artisan view:clear
```

### 3. Jalankan Development Server
```bash
php artisan serve
# atau
php artisan serve --port=8000
```

### 4. Akses
- **Homepage**: http://localhost:8000
- **Admin**: http://localhost:8000/admin
  - Email: `admin@bmstrip.local`
  - Password: `password`

---

## 📌 CATATAN PENTING

1. **Middleware IsAdmin** melindungi semua route `/admin`
2. **Review hanya bisa di-submit oleh user yang login** (auth middleware)
3. **Wisata hanya ditampilkan jika published = true**
4. **Gambar menggunakan Unsplash URLs** (tidak perlu upload lokal)
5. **Rating dihitung dari average review**
6. **Search mencari di 3 field**: title, location, category name
7. **Pagination**: 9 per page untuk homepage, 20 untuk admin

---

**Created**: November 14, 2025  
**Framework**: Laravel 11  
**Database**: MySQL  
**CSS Framework**: Tailwind CSS v4  
**Build Tool**: Vite 7

