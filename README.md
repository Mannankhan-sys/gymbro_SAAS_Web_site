# 🏋️ GymBro – Smart Gym Membership Management System

GymBro is a full-stack web-based gym management system developed as a Final Year Project (FYP).  
It provides user registration, subscription handling, trainer assignment, payments, dashboards, and admin control.

The system follows modern SaaS workflow patterns and role-based access (User + Admin).

---

## 🚀 Features

### 👤 User Side
- Registration & Login System
- Silver / Gold Subscription Plans
- Secure Payment Flow (Mock Payment)
- Auto Trainer Assignment (Gold Only)
- Dashboard:
  - Personal Info
  - Active Plan
  - Assigned Trainer
- Logout System

---

### 🧑‍💼 Admin Side
- Admin Login
- Total Users Count
- Gold / Silver Member Stats
- Trainer Availability Tracking
- Subscription Overview
- Payment Records

---

## 🧭 User Flow (Professional SaaS Pattern)

1. User lands on Public Home Page
2. Views plans (Silver / Gold)
3. Clicks Subscribe
4. Redirected to Login/Register
5. Completes authentication
6. Chooses plan
7. Payment processing
8. Trainer assigned (Gold)
9. Redirected to Dashboard
10. Full access granted

---

## 🧑‍💻 Technologies Used

### Frontend
- HTML5
- CSS3

### Backend
- PHP (Procedural + MySQLi)

### Database
- MySQL (phpMyAdmin)

### Server
- Apache (XAMPP / AMPPS)

---

## 🗄 Database Tables

- users
- subscriptions
- trainers
- payments
- admin

---

## 🔐 Security Concepts Implemented

- PHP Sessions
- Prepared Statements
- Input Validation
- Role Based Access
- Login Guards
- Page Protection

---

## 📊 Trainer Assignment Logic

- Only Gold users receive trainers
- Each trainer supports max 10 users
- Auto reassignment when user unsubscribes

---

## 📐 Software Architecture

Pattern followed:
- MVC inspired structure
- Layer separation:
  - UI
  - Logic
  - Database


---

## 🎯 SaaS Standards Followed

- Authentication Gate
- Subscription Flow
- Role Based Pages
- Central Database
- Modular Backend
- Secure Sessions

---

## 🏁 Future Enhancements

- BMI Calculator
- Workout Streak Calendar
- AI Fitness Assistant
- Real Payment Gateway
- Progress Analytics
- Mobile App Integration

---

## 👨‍🎓 Developed By

Mannan Khan  
BS Software Engineering  
 

---

## 📜 License

Educational Use Only