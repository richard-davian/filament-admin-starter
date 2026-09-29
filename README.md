<div align="center">

# Filament Admin Starter

### Skip the setup. Start building.

**A production-minded Laravel Filament admin panel & dashboard template, with auth, roles & permissions, user management, backups, settings, and 8 plugins already installed and configured.**

_Template dashboard admin Laravel Filament yang sudah lengkap dan siap pakai. Tinggal clone, migrate, login, lalu kembangkan modulmu sendiri._

[![Filament](https://img.shields.io/badge/Filament-5.x-FDAE4B?style=flat-square)](https://filamentphp.com)
[![Laravel](https://img.shields.io/badge/Laravel-12%2B-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Tailwind](https://img.shields.io/badge/Tailwind-4.x-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

[Features](#-whats-included) · [Quick Start](#-quick-start) · [Cara Instalasi](#-cara-instalasi-bahasa-indonesia) · [Structure](#-project-structure)

</div>

---

## ✨ What's Included

Everything you rebuild in every new admin project, **already done**:

|     | Feature                     | What you get                                                                                          |
| --- | --------------------------- | ----------------------------------------------------------------------------------------------------- |
| 🔐  | **Complete Authentication** | Login, profile page, session management, 2FA and passkey support via Filament Breezy                  |
| 👥  | **User Management**         | Full CRUD, extra profile fields, public UUID, one-click **impersonate**                               |
| 🛡️  | **Roles & Permissions**     | Visual role editor with auto-generated permissions per resource (Filament Shield + Spatie Permission) |
| 📊  | **Dashboard**               | Stats overview widget, ready to extend with your own metrics                                          |
| ⚙️  | **App Settings Page**       | Database-driven settings editable from the panel, plus a global helper to read them anywhere          |
| 💾  | **Backup Manager**          | Create, download, and monitor database & file backups from the panel                                  |
| 🔒  | **Lock Screen**             | Lock your session without logging out                                                                 |
| 🏢  | **Tenant Module**           | Tenant management with model, resource, policy, and seeder                                            |
| 🖼️  | **Banner Manager**          | Manage banners with image upload                                                                      |
| 🔗  | **Social Media Manager**    | Manage social links for your app or site                                                              |
| 🔌  | **REST API Ready**          | Laravel Sanctum with personal access tokens                                                           |
| 📱  | **Mobile Friendly**         | Bottom navigation bar for mobile screens                                                              |
| 🎨  | **Beautiful Login**         | 56 bundled background images (25 SVG triangles + 31 curated photos)                                   |
| 🌱  | **Seeded Data**             | Roles, permissions, users, tenants, settings, and social media ready after `migrate --seed`           |

## 🔍 Feature Details

### Authentication & Security

- Login and **My Profile** page (Filament Breezy)
- **Browser sessions** tracking (`breezy_sessions` table)
- **Passkey** table and assets included
- **Lock screen** to secure an unattended session
- **Sanctum** tokens for API authentication (`routes/api.php` prepared)
- **Database notifications** table ready

### User & Access Management

- **User resource** with form schema and table split into clean, separate classes
- Extra user fields via dedicated migration
- **Public UUID** trait (`HasPublicUuid`) so you never expose auto-increment IDs
- **Impersonate** any user to debug their view
- **User observer** for lifecycle hooks
- **Role resource** with policy, managed through Shield
- Permissions synced with **Policies** (`UserPolicy`, `RolePolicy`, `TenantPolicy`, `BannerPolicy`, `SocialMediaPolicy`, `AppSocialPolicy`)
- Dedicated **backup permission seeder**, so backup access is role-controlled too

### Content & Business Modules

- **Tenants**: CRUD with migration, seeder, and policy
- **Banners**: CRUD with observer and policy
- **Social Media**: CRUD with seeder and policy
- All modules follow the **Filament v5 structure**: `Resource` + `Schemas` + `Tables` + `Pages`. Copy one as a template for your own module.

### Application Settings

- `AppSettingPage`: custom Filament page for global settings
- `app_settings` table, seeder, and **observer**
- Global helper in `app/Helpers/settings.php` for reading settings from anywhere in your code

### Backup & Maintenance

- **Spatie Laravel Backup** UI inside the panel (`config/backup.php` included)
- Backup translations bundled in `lang/vendor/filament-spatie-backup`
- Queue, cache, and jobs tables migrated out of the box

### Developer Experience

- Vite + **Tailwind CSS 4**
- Code style with **Laravel Pint**, live logs with **Laravel Pail**, **Tinker**, **Collision**
- **PHPUnit** test scaffold
- `.editorconfig` for consistent formatting
- Clean separation: Policies, Observers, Helpers, Seeders, Factories
- Separate `AdminPanelProvider` so panel configuration stays in one place

## 🔌 Pre-installed Plugins

| Package                                                                                                   | Purpose                  |
| --------------------------------------------------------------------------------------------------------- | ------------------------ |
| [`filament/filament`](https://filamentphp.com)                                                            | Admin panel core         |
| [`bezhansalleh/filament-shield`](https://github.com/bezhansalleh/filament-shield)                         | Roles & permissions      |
| [`jeffgreco13/filament-breezy`](https://github.com/jeffgreco13/filament-breezy)                           | Profile, sessions, 2FA   |
| [`stechstudio/filament-impersonate`](https://github.com/stechstudio/filament-impersonate)                 | Impersonate users        |
| [`shuvroroy/filament-spatie-laravel-backup`](https://github.com/shuvroroy/filament-spatie-laravel-backup) | Backup manager           |
| [`marjose123/filament-lockscreen`](https://github.com/marjose123/filament-lockscreen)                     | Lock screen              |
| [`swisnl/filament-backgrounds`](https://github.com/swisnl/filament-backgrounds)                           | Login backgrounds        |
| [`hammadzafar05/mobile-bottom-nav`](https://github.com/hammadzafar05/mobile-bottom-nav)                   | Mobile bottom navigation |
| [`laravel/sanctum`](https://laravel.com/docs/sanctum)                                                     | API token authentication |

## 🎯 Who Is This For?

- **Developers**: kickstart client projects, internal tools, and SaaS back-offices without repeating setup.
- **Students / Mahasiswa**: a solid base for tugas kuliah, sistem informasi, and tugas akhir. Learn a real-world Filament structure instead of starting from a blank page.
- **Freelancers & agencies**: reuse one proven foundation across many projects.

## 🚀 Quick Start

```bash
# 1. Clone (or click "Use this template" on GitHub)
git clone https://github.com/richard-davian/filament-admin-starter.git my-project
cd my-project

# 2. Install dependencies
composer install
npm install && npm run build

# 3. Environment
cp .env.example .env
php artisan key:generate

# 4. Database (set DB_* in .env first, or keep the SQLite default)
php artisan migrate --seed

# 5. Storage link & run
php artisan storage:link
php artisan serve
```

Open `http://localhost:8000/admin`

### Default Login

| Email               | Password   |
| ------------------- | ---------- |
| `admin@example.com` | `password` |

> ⚠️ Change the default credentials immediately in production.

## 🇮🇩 Cara Instalasi (Bahasa Indonesia)

1. Pastikan **PHP 8.2+**, **Composer**, dan **Node.js** sudah terpasang.
2. Clone repo ini, atau klik tombol **Use this template** di GitHub.
3. Jalankan `composer install`, lalu `npm install && npm run build`.
4. Salin `.env.example` menjadi `.env`, lalu jalankan `php artisan key:generate`.
5. Atur koneksi database di `.env` (bisa tetap SQLite), lalu jalankan `php artisan migrate --seed`.
6. Jalankan `php artisan storage:link` dan `php artisan serve`.
7. Buka `http://localhost:8000/admin` dan login dengan akun default di atas.
8. **Ganti password akun default** sebelum dipakai di server produksi.

## 📁 Project Structure

```
app/
├── Filament/
│   ├── Pages/            # Custom pages (App Settings)
│   ├── Resources/        # Users, Tenants, Banners, SocialMedia
│   │   └── <Name>/{Pages,Schemas,Tables}
│   └── Widgets/          # Dashboard widgets (StatsOverview)
├── Helpers/settings.php  # Global settings helper
├── Models/               # Eloquent models + Concerns/HasPublicUuid
├── Observers/            # AppSetting, Banner, User
├── Policies/             # Authorization, synced with Shield
└── Providers/Filament/AdminPanelProvider.php
database/{migrations,seeders,factories}
config/{backup,filament-shield,permission,sanctum}.php
```

## 🛠️ Common Tasks

```bash
# Generate a new resource
php artisan make:filament-resource Product --generate

# Regenerate permissions for all resources
php artisan shield:generate --all

# Run tests & code style
php artisan test
./vendor/bin/pint
```

## 🗺️ Roadmap

- [ ] Docker / Sail setup
- [ ] GitHub Actions (tests + Pint)
- [ ] Activity log
- [ ] Multi-language (id/en) switcher

## 🤝 Contributing

Issues and pull requests are welcome. Please run `./vendor/bin/pint` and `php artisan test` before submitting.

## 📄 License

Released under the [MIT License](LICENSE).

---

<div align="center">

Built with Laravel & Filament by [Richard Davian](https://github.com/richard-davian).
If this saves you time, give it a ⭐

</div>
