# Doctoral Defense Digital Attendance & Live Auditorium Board (CI4)

> **Onsite Digital Guest Book, Pen Tablet Canvas Signature, Real-Time TV Live Board & Automated Official Minutes**  
> *Built with PHP 8.x & CodeIgniter 4 MVC for Formal Academic Doctoral Promotion Defense (FIAI UII)*

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![CodeIgniter 4](https://img.shields.io/badge/CodeIgniter-4.x_MVC-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)](https://codeigniter.com/)
[![MySQL](https://img.shields.io/badge/MySQL-Relational-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Live Demo](https://img.shields.io/badge/Interactive_Demo-Try_Live-059669?style=for-the-badge)](https://prestianhanif.github.io/portfolio/absendoktor.html)

---

## Overview

Handling 100+ VVIP academic guests during an open doctoral defense traditionally creates registration queues, scattered paper attendance sheets, and slow post-event reporting. This system replaces the manual workflow with a fast, paperless onsite registration desk integrated with a live auditorium projector display and one-click official minutes export.

---

## Key Features

- **High-Speed Onsite Registration Desk (`AttendanceController`):** Instant guest lookup by full name, institution, guest code, or WhatsApp number with separate flows for Invited VVIP Guests and Walk-In Guests.
- **Pen Tablet / Touch Digital Signature (`HTML5 Canvas API`):** Captures authentic guest signatures via stylus, pen tablet, or touchscreen, stores them securely as PNG files (`base64` decoded server-side), and supports optional congratulatory wishes.
- **Live Attendance Board (Auditorium TV / Projector):** High-contrast presentation view featuring real-time check-in metrics (*Present vs Pending*) and AJAX auto-polling without page reloads.
- **Event Lock Protection (`is_event_completed`):** Official attendance closure lock once the defense concludes to preserve audit integrity.
- **Automated Export & Official Minutes (`PdfController`, `ExportController`):** One-click official attendance sheet export to PDF (institutional letterhead) and Excel spreadsheets, plus batch Excel guest import.

---

## Tech Stack

- **Backend:** PHP 8.x, CodeIgniter 4 (MVC Architecture, Filters, REST/AJAX Endpoints)
- **Database:** MySQL / MariaDB (`database/schema.sql`)
- **Frontend:** HTML5 Canvas Signature API, Bootstrap 5, Vanilla JavaScript
- **Reporting:** PDF & Excel Export Pipelines

---

## Quick Local Setup

```bash
# 1. Clone repository & install PHP dependencies
git clone https://github.com/PrestianHanif/ci4-doctoral-attendance.git
cd ci4-doctoral-attendance
composer install

# 2. Configure environment
cp .env.example .env
# Edit .env with your local MySQL credentials

# 3. Import clean database schema
mysql -u root -p db_doctoral_attendance < database/schema.sql

# 4. Run local development server
php spark serve
```

> **Interactive Preview:** Try the standalone frontend simulation (Pen Tablet Canvas, Live Board TV & Print Sheet) directly at [prestianhanif.github.io/portfolio/absendoktor.html](https://prestianhanif.github.io/portfolio/absendoktor.html).

---

## Author

**Prestyan Dwi Febrianto** — Fullstack Web Developer & Operations Specialist  
- Portfolio: [prestianhanif.github.io/portfolio/portfolio.html](https://prestianhanif.github.io/portfolio/portfolio.html)  
- Interactive CV: [prestianhanif.github.io/portfolio/cv.html](https://prestianhanif.github.io/portfolio/cv.html)  
- LinkedIn: [linkedin.com/in/prestyan-dwi-febrianto-6a5bb2406](https://linkedin.com/in/prestyan-dwi-febrianto-6a5bb2406)
