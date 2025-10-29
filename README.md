# Telegram Bot Notification Hook for WHMCS

A lightweight WHMCS hook that sends automated notifications to Telegram using a bot.  
It can be used to alert admins or customers when certain WHMCS events occur (e.g., new orders, suspensions, terminations).

---

## ✨ Features

- Send instant notifications via Telegram
- Compatible with major WHMCS lifecycle events
- Fully customizable message content
- Simple and clean code — easy to extend

---

## 📦 Requirements

- WHMCS 8.x+
- PHP 7.4+
- Telegram Bot Token & Chat ID

---

## 🔧 Installation

1. Upload the hook file
2. Edit the file and configure:
```php
$botToken = 'YOUR_BOT_TOKEN';
$chatId = 'YOUR_CHAT_ID';


---

## ✅ Hook 2 — `radius_dracula_servers.php`


# RADIUS Data Cleanup Hook for WHMCS (Dracula Servers)

This WHMCS hook clears user RADIUS traffic usage when a product is terminated.  
It ensures accurate accounting and prevents leftover data in the FreeRADIUS database.

---

## ✨ Features

- Automatically clears traffic usage on service termination
- Works directly with RADIUS database tables
- Protects against overcounting data after cancellation
- No need for manual admin intervention

---

## 📦 Requirements

- WHMCS 8.x+
- PHP 7.4+
- FreeRADIUS with accounting enabled
- Proper DB credentials configured inside hook file

---

## 🔧 Installation

1. Upload the hook file
2. Edit DB connection info inside:
```php
$db_host = 'localhost';
$db_user = 'radius';
$db_pass = 'password';
$db_name = 'radius';
