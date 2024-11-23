# Restaurant-Website (Full stack)

Full stack restuarant website developed with Php, Css, Html, JavaScript, Composer

<img src="images/picture10.jpg"><br>

## Install PHPMailer with Composer

Run the following Composer command to install PHPMailer:

```bash
composer require phpmailer/phpmailer
```

## View installed SSL Certificates

View and mange installed SSL certificates on your local server by pressing win key + r, giving this command

```bash
certmgr.msc
```

## Autoload PHPMailer

Send email fucntion imports

```javascript
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../vendor/autoload.php';
```

## SSL Certificate

Genarate via SSl Certificate by using this link 🔗<a href="https://youtu.be/zrbaE1Wdviw">youtube</a> for your loocal project

# 🍽️ The Gallery Café - Web Application

This project is a web application for **The Gallery Café**, designed to manage restaurant operations efficiently. It includes a range of features tailored for customers, employees, and administrators, with a strong emphasis on security and user experience.

## 🚀 Main Features

- **Cart Management**: Add, remove, clear, and submit items in the cart.
- **User Authentication**:
  - Login
  - Signup
  - Logout
  - Reset Password
  - OTP Sending
  - User Verification
- **Reservations**: Make and manage table reservations.
- **User Profile**: Edit and update profile information.

## 🏷️ Admin Functions

- **User Management**:
  - Add new users (customers, admins, staff)
  - Manage existing users (employees and customers)
- **Menu Management**:
  - Add, update, and delete menu items
  - Manage menu item categories
- **Order Management**: Oversee both online and in-shop orders.
- **Reservations Management**: Manage customer reservations.
- **Restaurant Management**:
  - Manage tables and their types
  - View order and reservation details

## 🏷️ Employee Functions

- **Menu Management**: Update and manage menu items.
- **Order Management**: Oversee online and in-shop orders.
- **Reservations Management**: Handle customer reservations.
- **Restaurant Management**: Manage restaurant tables.
- **View Information**: Access order and reservation details.

## 🏷️ Customer Functions

- **Ordering**: Place and manage online orders.
- **Reservations**: Book and manage restaurant reservations.
- **Menu Browsing**: View available menu items.

## ⚙️ Utility and Security Features

- **Access Control**: Different user roles have restricted access to specific pages.
- **Cross-Site Request Forgery (CSRF) Protection**: Enhanced form security.
- **HTTPS Enforcement**: All traffic is redirected to HTTPS for secure communication.
- **Security Headers**:
  - `X-Content-Type-Options: nosniff`: Prevents browsers from interpreting files as a different MIME type.
  - `X-Frame-Options: DENY`: Prevents the page from being embedded in an iframe.
- **Session Security**:
  - Secure session settings (HTTP-only cookies, secure cookies over HTTPS).
  - Session regeneration every 30 minutes to mitigate session fixation.
  - Session data validation on each request to prevent session hijacking (IP address and user agent checks).
  - Automatic session destruction if mismatched session data is detected.
- **CSRF Tokens**: Forms are secured with CSRF tokens.
- **Secure Logout**: Proper session termination.
- **Error Handling**: Robust error management for a smoother user experience.
- **SSL Certificate**: Ensure a secure connection.

## 🛠️ Installation & Setup

1. Clone the repository:

   ```bash
   git clone https://github.com/KevinThulnith/Restaurant-Website.git
   ```
