# Gyandayini Women's College — Dynamic PHP Website

A fully dynamic college website built with PHP 8 + MySQL, featuring an integrated admin management panel.
Everything — navigation menus, content pages, circulars & notices, photo gallery, faculty directory, courses, and site settings — is dynamically managed through the admin panel without touching code.

---

## 1. Hostinger / Web Server Deployment (4 Steps)

### Step 1 — Upload Files
- Open hPanel / cPanel → **File Manager** → navigate to `public_html`
- Backup and remove old files (or move them to an archive folder)
- Upload this project package into `public_html` and **Extract**
- Verify that `public_html/index.php`, `public_html/admin/`, `public_html/config/` are in place

### Step 2 — Create MySQL Database
- Go to **Databases → MySQL Databases**
- Create a new database, e.g., `u123456789_gdmmv`
- Create a database user with a **strong password** and assign full privileges to the database
- Note down your database name, username, and password

### Step 3 — Import Database Schema & Content
- Open **phpMyAdmin** → select your database
- Click on the **Import** tab → choose the `install/database.sql` file → click **Go**
- Verify successful import message
- This creates 12 tables and populates all 39 institutional pages and complete menu trees

### Step 4 — Configure Database Settings
Edit the `config/config.php` file:

```php
define('DB_NAME', 'u123456789_gdmmv');   // Your database name
define('DB_USER', 'u123456789_gdmmv');   // Your database username
define('DB_PASS', 'YourStrongPassword'); // Your database password
define('BASE_URL', 'https://gyandayanigmmv.com');  // No trailing slash
```

Your website is now live at `https://gyandayanigmmv.com`.

---

## 2. Administration Portal

**URL:** `https://gyandayanigmmv.com/admin/`

| Parameter | Default Value |
|---|---|
| Username | `admin` |
| Password | `gdmmv@2026` |

> **Recommended:** Change your password immediately upon first login under **🔒 Change Password**.

### Admin Panel Capabilities

| Module | Features & Capabilities |
|---|---|
| 📄 Pages | Edit text/HTML of all 39 content pages, create new custom pages |
| ☰ Menus | Add/remove/reorder menu items, manage multi-level dropdowns — **100% dynamic navigation** |
| 🔔 Notices | Publish notices, upload PDF attachments, toggle "NEW" badges, synced with home ticker |
| 🖼️ Sliders | Hero banner images and captions |
| 🎓 Courses | Program details, duration, eligibility, subject lists |
| 👩‍🏫 Faculty | Faculty profiles, designations, departments, photos |
| 🪔 Leadership | Founders and executive leadership cards |
| 📷 Gallery | Categorized photo gallery with automatic filter tabs |
| 📅 Events | Institutional events and achievements showcase |
| 🔗 Quick Links | Homepage icon shortcuts and direct portal links |
| 📥 Inquiries | View contact and admission inquiries, one-click WhatsApp reply, CSV export |
| ⚙️ Settings | Global site name, logos, phones, emails, address, Google Maps, social links, stats |

---

## 3. Post-Deployment Checklist

1. **Change Password** — `admin/password.php`
2. **Update Site Settings** — Enter verified institutional email, phone numbers, and address
3. **Embed Google Map** — In Google Maps, click Share → Embed a map → copy the `src` URL into Site Settings
4. **Fee Structure** — Update current academic year fee figures on the Fee Structure page
5. **Faculty & Staff Directory** — Update faculty names and designations in the Faculty module

---

## 4. Directory Structure

```
public_html/
├── index.php              Homepage
├── page.php               Dynamic content pages (e.g. page/about-college)
├── courses.php            Courses and programs catalog
├── faculty.php            Faculty and staff directory
├── gallery.php            Photo gallery with category filtering & lightbox
├── notices.php            Notices and circulars
├── events.php             Events and student activities
├── admission.php          Admissions overview & inquiry form
├── contact.php            Contact info, Google Map & message form
├── sitemap.php            Dynamic XML/HTML SEO sitemap
├── robots.txt
├── .htaccess              URL rewriting, HTTPS enforcement, security & caching
├── config/
│   ├── config.php         ← Database and base URL configuration
│   └── db.php             PDO database connection handler
├── includes/
│   ├── functions.php      Global utility helpers
│   ├── header.php         Topbar, masthead & navigation header
│   └── footer.php         Footer columns, copyright & lightbox modal
├── assets/css/style.css   Core stylesheet & design tokens
├── assets/js/main.js      Hero slider, scroll animations, counters, lightbox, contrast toggle
├── uploads/               Media and document uploads folder
├── admin/                 Administrative portal
│   ├── login.php          Admin authentication
│   ├── index.php          Dashboard & KPIs
│   ├── manage.php         Universal CRUD engine
│   ├── entities.php       Entity schemas & field definitions
│   ├── settings.php       Site configuration editor
│   ├── enquiries.php      Inquiries viewer & CSV exporter
│   └── password.php       Password manager
└── install/database.sql   Full database schema and seed data
```

---

## 5. Technology Stack & Features

- **Backend:** Native PHP 8.x + MySQL / MariaDB (PDO with prepared statements)
- **Design System:** Deep Indigo Night (`#0B0E24`) + Warm Marigold Gold (`#E8B44A`) + Lotus Accent
- **Typography:** Marcellus & Outfit / Inter / Mukta Google Fonts
- **Security:** CSRF token verification, PDO parameterized queries, XSS sanitization, HTTP security headers
- **Accessibility:** Dark/High-contrast mode toggle, semantic HTML5, skip navigation links
- **Mobile Responsive:** Fully responsive layout with mobile drawer navigation
