# 📦 inventory: Enterprise Asset Intelligence

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](LICENSE)

inventory is a high-performance, modern Asset Inventory Management System built to help organizations track, manage, and optimize their physical hardware and equipment lifecycle.

[Explore Demo](#) · [Report Bug](https://github.com/mozahid679/inventory/issues) · [Request Feature](https://github.com/mozahid679/inventory/issues)

---

## ✨ Key Features

- **🚀 Real-time Dashboard**: Gain instant visibility into asset distribution, health status, and custodian assignments.
- **🛠 Lifecycle Management**: Track assets from procurement and deployment to maintenance and disposal.
- **📱 QR Code Integration**: Generate unique tags for every asset. Scan via mobile to instantly update status or location.
- **📉 Depreciation Engine**: Built-in support for Straight Line and Double Declining depreciation methods for financial accuracy.
- **🔐 Role-Based Access Control (RBAC)**: Granular permissions for Admins, Managers, and Staff using a modern UI.
- **🌓 Dark Mode Native**: Fully optimized for both light and dark environments using the Next.js/Geist aesthetic.

## 🛠 Tech Stack

- **Framework**: [Laravel 12](https://laravel.com)
- **Frontend**: [Tailwind CSS](https://tailwindcss.com) & [Alpine.js](https://alpinejs.dev)
- **Database**: MySQL
- **Icons**: [Lucide Icons](https://lucide.dev)
- **Auth**: Laravel Breeze / Fortify

## 🚀 Getting Started

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM

### Installation

1. **Clone the repository**
    ```bash
    git clone [https://github.com/mozahid679/inventory.git](https://github.com/mozahid679/inventory.git)
    cd inventory
    Install dependencies
    ```

Bash
composer install
npm install
Environment Setup

Bash
cp .env.example .env
php artisan key:generate
Database Configuration
Configure your .env file with your database credentials, then run:

Bash
php artisan migrate --seed
Start the engines

Bash
npm run dev
php artisan serve
📸 Preview
Modern Interface
inventory utilizes a "Geist-inspired" design, focusing on high-contrast typography and a clean "bento-box" grid layout for data visualization.

Dashboard Structure
Active Assets: Live count of deployed hardware.

Maintenance Queue: Quick access to items requiring technical attention.

Asset Tags: Instant QR generation for physical labeling.

🤝 Contributing
Contributions make the open-source community an amazing place to learn, inspire, and create.

Fork the Project

Create your Feature Branch (git checkout -b feature/AmazingFeature)

Commit your Changes (git commit -m 'Add some AmazingFeature')

Push to the Branch (git push origin feature/AmazingFeature)

Open a Pull Request

📄 License
Distributed under the MIT License. See LICENSE for more information.

Built with ❤️ by Mozahidul Islam (fb.me/mozahid679)
