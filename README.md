# 🧑‍💻 PHP Online Learning & Task Management Platform

## 📌 Overview  
This is a modern PHP-based online learning and productivity platform built as a group project.  
It includes learning modules, quizzes, a to-do manager, authentication, an admin dashboard, and a simple chatbot.  
The project supports Docker deployment and includes a CI/CD workflow with GitHub Actions.

---

## ✨ Features  
- 🔐 User Authentication (Login & Signup)  
- 📘 Learning Pages  
- 📝 Quiz Module  
- ✅ To-Do Task Manager  
- 🛠️ Admin Dashboard  
- 🤖 Simple Chatbot  
- 🐳 Docker Support  
- 🚀 CI/CD Pipeline (GitHub Actions)  
- ☁️ Heroku Deployment Files  

---

## 📁 Project Structure  
```
├── Admin/
├── Login/
├── SignUp/
├── Project/              
├── To-Do/
├── chatbot/
├── vendor/              
├── connection.php
├── index.php
├── composer.json
├── composer.lock
├── Dockerfile
├── docker-compose.yml
├── heroku.yml
├── README.md
└── .github/workflows/    
```

---

## ⚙️ Installation

### ✅ Requirements  
- PHP 8+  
- Composer  
- MySQL  
- Docker (optional)

### 📥 Install Dependencies  

composer install


### 🗄️ Import Database  
- Create a MySQL database  
- Import the provided SQL file (if available)  
- Update credentials in `connection.php`

---

## 🐳 Run with Docker  
Start the application using Docker Compose:

docker-compose up -d


Application will be available at:

http://localhost:8080

---

## 🚀 Deployment

### ✅ GitHub Actions  
The repository includes an automated build and deployment workflow located in:

.github/workflows/


### ✅ Heroku  
This project contains a `heroku.yml` file for container-based deployment on Heroku.

---

## 👥 Team  
This platform was developed as a collaborative group project focused on learning, productivity, and full-stack PHP development.
