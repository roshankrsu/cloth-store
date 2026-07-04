# 🛍️ Online Clothing Store

A full-stack **E-Commerce Web Application** built using **PHP**, **MySQL**, **Bootstrap 5**, **HTML**, **CSS**, and **JavaScript**. The application provides a complete online shopping experience with secure user authentication, product management, shopping cart, order processing, and an admin dashboard.

## 🚀 Live Demo

**Website:** https://clothstore.infinityfreeapp.com/

---

## ✨ Features

### 👤 Customer Features

- User Registration & Login
- Secure Session Authentication
- Browse Products
- Product Details Page
- Product Search
- Category Filter
- Product Sorting
- Pagination
- Shopping Cart
- Checkout System
- Place Orders
- View Order History
- Responsive User Interface

---

### 🛠️ Admin Features

- Admin Dashboard
- Add Products
- Edit Products
- Delete Products
- Manage Orders
- Upload Product Images

---

## 🔒 Security

- Password Hashing
- Prepared Statements (SQL Injection Protection)
- Session-Based Authentication
- Input Validation
- XSS Protection using `htmlspecialchars()`

---

# 🛠️ Tech Stack

### Frontend

- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- Bootstrap Icons

### Backend

- PHP

### Database

- MySQL

### Development

- XAMPP

### Deployment

- InfinityFree

---

# 📂 Project Structure

```text
cloth-store/
│
├── admin/
├── assets/
│   ├── css/
│   ├── images/
│   └── js/
│
├── config/
├── database/
│   └── shopping.sql
│
├── includes/
│
├── index.php
├── products.php
├── product.php
├── cart.php
├── checkout.php
├── login.php
├── register.php
├── my_orders.php
└── README.md
```

---

# ⚙️ Installation

### Clone the repository

```bash
git clone https://github.com/YOUR_USERNAME/cloth-store.git
```

### Move the project

Copy the project into the XAMPP `htdocs` directory.

```text
C:\xampp\htdocs\
```

### Create the database

Create a MySQL database named:

```text
shopping
```

Import:

```text
database/shopping.sql
```

### Configure Database

Update:

```text
config/database.php
```

Example:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "shopping";
```

### Start XAMPP

Start:

- Apache
- MySQL

Visit:

```text
http://localhost/cloth-store/
```

---

# 📌 Future Improvements

- Product Reviews & Ratings
- Wishlist
- Coupon System
- Order Tracking
- PDF Invoice
- Email Notifications
- Dashboard Analytics
- Product Recommendations

---

# 📖 Learning Outcomes

This project helped me gain practical experience with:

- PHP & MySQL
- CRUD Operations
- Session Management
- User Authentication
- Admin Panel Development
- Shopping Cart Logic
- Order Processing
- File Uploads
- Responsive Web Design
- Database Design
- Deployment on InfinityFree

---

# 👨‍💻 Author

**Roshan Kumar**

- GitHub: https://github.com/YOUR_USERNAME
- LinkedIn: https://linkedin.com/in/YOUR_LINKEDIN
- Live Demo: https://clothstore.infinityfreeapp.com/

---

# 📄 License

This project is created for educational and portfolio purposes.