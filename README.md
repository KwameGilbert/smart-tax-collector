# Tax Collection Platform

A robust, scalable, and secure digital platform for managing municipal tax collection processes. The system supports multi-role access for revenue officers, tax collectors, IT admins, and municipal executives. It enables both online and offline tax collection, invoice generation, real-time reporting, and secure communication via email and SMS.

---

## ✨ Platform Overview

- **Web App:** PHP backend with MySQL database, using Tailwind CSS, Axios, and SweetAlert2 for the frontend.
- **Mobile App:** React Native application for tax collectors with offline-first capabilities.
- **Communication:** Integrated email notifications (Gmail SMTP via Mailer) and SMS alerts (Arkesel SMS API).
- **Offline Sync:** Custom sync agents ensure that tax data is captured even without network and synced later.

---

## 📆 Features

### 🔹 Core Functionalities
- Business registration & tax assignments
- Tax type setup with frequency & amount rules
- Invoice generation (PDF format)
- Real-time dashboard analytics
- Payment tracking (cash, card, mobile money)
- Audit logs and transparency tracking
- Employment & officer assignment
- Multi-level approval system

### 🔹 Roles Supported
- **Collectors:** Capture payments, view invoices, and sync data offline
- **Officers:** Review and approve payments, generate reports
- **IT Admins:** Manage users, system settings, backups
- **Executives (MCE, MP, Finance):** View financial summaries and export data

---

## 🧰 Tech Stack

| Layer           | Technology                 |
|----------------|----------------------------|
| **Frontend**    | HTML, Tailwind CSS, Axios, SweetAlert2 |
| **Backend**     | PHP (modular), MySQL       |
| **Mobile App**  | React Native               |
| **Email**       | Mailer + Gmail SMTP        |
| **SMS**         | Arkesel SMS API            |
| **Offline Sync**| Custom Sync Agents (Web & Mobile) |

---

## ⚙️ Installation

### 1. Clone the Repository
```bash
git clone https://github.com/your-org/tax-collection-platform.git
cd tax-collection-platform
```

### 2. Set Up Backend
- Rename `.env.example` to `.env` and configure DB + mail
- Run migrations:
```bash
php migrate.php
```

### 3. Set Up Frontend
- Use any PHP server (XAMPP, Laravel Valet, NGINX)
- Ensure Tailwind is compiled (optional: use CDN for quick setup)

### 4. Mobile App Setup
```bash
cd mobile-app
npm install
npx expo start
```

---

## 🔐 Security & Permissions

- Password hashing (bcrypt)
- Role-based access control
- Audit trails for all financial and user actions
- OTP verification for account recovery

---

## 🚀 Future Plans

- Multi-municipal dashboard for RCC-level oversight
- Biometric authentication
- Revenue forecasting with ML integration
- Customizable tax rules per region

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

## 🙌 Contributors

Built and maintained by:
- Gilbert Kukah (Lead Dev, Backend & Architecture)
- Nolex-Prime Engineering Team
- [Sefwi Wiawso Municipal Assembly](#) *(Pilot)*

---

## 📬 Contact

For questions, support, or custom deployment:

📧 Email: kwamegilbert1114@gmail.com    
📱 WhatsApp: [+233 541 143 6414](https://wa.me/+233541436414)
🌐 Website: [nolexprime.dev](#)
