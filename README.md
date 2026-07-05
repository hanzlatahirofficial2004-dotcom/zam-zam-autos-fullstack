# 🏍️ ZAM-ZAM Autos — Full-Stack Bike Spare Parts & Services Platform

**ZAM-ZAM Autos** is an enterprise-grade, full-stack web application engineered to stream-line motorcycle spare parts retail and online workshop service bookings. Powered by the **Laravel framework** on the backend and a robust **MySQL relational database**, this platform bridges the gap between digital e-commerce and physical automotive servicing.
<img width="1902" height="868" alt="image" src="https://github.com/user-attachments/assets/b05fbb4d-f1d3-44be-b416-f490cca4ac71" />


---

## 🚀 Key Features
<img width="1917" height="869" alt="image" src="https://github.com/user-attachments/assets/e6cab8e9-340a-4d20-a008-f071a86d0e16" />


### 🛒 1. E-Commerce Marketplace (Spare Parts)
* **Dynamic Product Catalog:** Categorized listings for various motorcycle models and spare parts.
* **Live Inventory Tracking:** Automated stock level deduction using SQL transactions upon orders.
* **Shopping Cart & Checkout:** Seamless add-to-cart workflow with real-time price totals calculation.
* <img width="1899" height="868" alt="image" src="https://github.com/user-attachments/assets/bd060ee3-1c84-4bab-9aaf-913493981931" />


### 🛠️ 2. Online Service Booking Engine
<img width="1906" height="872" alt="image" src="https://github.com/user-attachments/assets/443f3e0d-a6b2-4140-b9fe-a0586d8c5deb" />

* **Digital Scheduling:** Allows users to pick specific dates, times, and types of maintenance services online.
* **Status Tracking:** Keeps users updated on whether their bike servicing is pending, in-progress, or completed.
* <img width="1913" height="872" alt="image" src="https://github.com/user-attachments/assets/3e6411fe-9526-48b8-ae9c-a359c92a5bda" />


### 🔒 3. Backend & Security Architecture

* **Secure Authentication:** Integrated user login, registration, and session management guarded by Laravel's built-in security protocols.
* **Relational Database Design:** Well-structured MySQL database optimized with proper foreign keys and indexings.
* **Admin Dashboard (Optional/Control Panel):** Centralized control to add products, modify stock levels, and manage booking pipelines.

---

## 🛠️ Tech Stack & System Architecture
<img width="1907" height="870" alt="image" src="https://github.com/user-attachments/assets/c91ce902-bed0-487a-9c05-7b235e4c38fc" />


| Layer | Technologies Used |
| :--- | :--- |
| **Frontend** | HTML5, CSS3 (Custom Responsive Layouts), JavaScript (Dynamic DOM & Form Validations) |
| **Backend** | PHP, Laravel MVC Framework |
| **Database** | MySQL (Relational Tables, Structured Querying) |
| **Tools** | Composer, Artisan CLI, Git |

---

## 📂 Database Schema Overview
The relational backend focuses on standard normalized structures including:
* **`users`**: Customer credentials and account metadata.
* **`products`**: Spare parts stock management, pricing matrices, and descriptions.
* **`bookings`**: Timestamps, service descriptions, and relationship links back to specific user entries.
* **`orders`**: Transaction histories connecting users to purchased catalog items.

---

## 💻 Local Installation & Setup Guide

Follow these steps to deploy **ZAM-ZAM Autos** locally:

1. **Clone the Repository:**
   ```bash
   git clone [https://github.com/hanzlatahikofficial2004-dotcom/YOUR-REPO-NAME.git](https://github.com/hanzlatahikofficial2004-dotcom/YOUR-REPO-NAME.git)
   cd YOUR-REPO-NAME
