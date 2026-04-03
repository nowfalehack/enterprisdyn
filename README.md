# 🚀 Enterprise Dynamic Form Management System

### Laravel + WordPress Integration

---

## 📌 Project Overview

This project is a **full-stack enterprise-level system** built using:

* **Laravel (Backend API + Admin Panel)**
* **WordPress CMS (Frontend Integration via Plugin)**

It includes:

* Role-based authentication
* Dynamic form builder
* CSV import/export system
* REST API with pagination
* WordPress integration using API

---

## 🛠️ Tech Stack

### Backend

* PHP 8+
* Laravel (Latest Version)
* MySQL
* Laravel Breeze (Authentication)

### Frontend

* WordPress CMS
* Custom Plugin
* Swiper.js (Slider UI)

---

# 🔐 PART 1 – Laravel Backend

## ✅ 1. Authentication & Roles

* User Registration, Login, Logout
* Role-based access (`admin`, `user`)
* Admin Seeder:

```
Email: admin@test.com  
Password: password123
```

* Admin middleware protection

---

## 🧭 2. Admin Panel Routes

| Route                | Description      |
| -------------------- | ---------------- |
| `/admin/dashboard`   | Dashboard        |
| `/admin/forms`       | Manage forms     |
| `/admin/users`       | Manage users     |
| `/admin/submissions` | View submissions |
| `/admin/import`      | Import CSV       |
| `/admin/export`      | Export CSV       |

---

## 🧩 3. Dynamic Form Builder

* Create forms with:

  * Title
  * Status (Active/Inactive)

### Fields Supported:

* Text
* Number
* Email
* Date
* Dropdown
* Checkbox

### Stored Data:

* Label
* Type
* Required flag
* Validation rules
* Options (JSON)
* Order

---

## ⚙️ 4. Dynamic Validation Engine

* Validation rules generated dynamically
* Supports:

  * Required
  * Email
  * Numeric

---

## 📊 5. Submission Management

* View all submissions
* Filter by form
* Delete submissions
* Pagination enabled

---

## 📥 6. Advanced CSV Import

* Upload CSV file
* Preview data before insert:

  * ✅ Valid rows
  * ❌ Invalid rows
* Only valid data is stored

---

## 📤 7. Export Feature

* Export submissions as CSV
* Dynamic headers based on fields
* Filter by form supported

---

# 🌐 PART 2 – REST API

## 🔗 Endpoints

### Get Users

```
GET /api/users
GET /api/users?limit=10
GET /api/users?page=1
```

---

## 📦 Response Format

```json
{
  "status": true,
  "message": "Users fetched successfully",
  "data": [
    {
      "id": 1,
      "name": "Admin",
      "email": "admin@test.com",
      "role": "admin"
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 10,
    "total": 2,
    "next_page_url": null,
    "prev_page_url": null
  }
}
```

---

# 🌍 PART 3 – WordPress Integration

## 🔌 1. Custom Plugin

* Created custom plugin: `user-api`
* Uses:

```php
wp_remote_get()
```

* Handles API failures gracefully

---

## 🎞 2. Landing Page Slider

* Fetches latest 10 users from API
* Displays in responsive slider (Swiper.js)
* Shows:

  * Name
  * Email

---

## 📄 3. View All Users Page

* Displays all users in table
* Pagination using API response
* “View All” navigation implemented

---

# ⚙️ SETUP INSTRUCTIONS

---

## 🔧 Laravel Setup

```bash
git clone https://github.com/YOUR-USERNAME/form-system.git
cd form-system
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## 🔐 Admin Login

```
Email: admin@test.com  
Password: password123
```

---

## 🌐 API URL

```
http://127.0.0.1:8000/api/users
```

---

## 🧩 WordPress Setup

1. Copy plugin folder:

```
wp-content/plugins/user-api
```

2. Activate plugin from WordPress Admin

3. Use shortcodes:

```
[users_slider]
[all_users]
```

---

## 🗄️ Database Setup

* Import `database.sql` into MySQL

---

# 📁 PROJECT STRUCTURE

```
submission/
├── laravel-project/
├── user-api/
├── database.sql
├── README.md
```

---

# 👨‍💻 Author

**Nowfal Nazar**

---

# 🏁 FINAL STATUS

✅ Laravel Backend Completed
✅ REST API Completed
✅ WordPress Integration Completed
✅ CSV Import/Export Completed
✅ Dynamic Form Builder Completed

---

🔥 **This project demonstrates full-stack Laravel + WordPress integration with enterprise-level architecture.**
