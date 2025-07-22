🚚 Logistic Management System
A complete web-based solution to manage logistics operations including vehicle tracking, shipment management, route assignments, and real-time status updates. Designed for transport companies and warehouse operations to streamline and automate logistics workflows.

📌 Features
🔐 User Authentication

Secure login/logout for Admin, Dispatcher, and Manager roles.

📦 Shipment Management

Add and manage shipments, assign vehicles and drivers.

Real-time status updates (Pending, In-Transit, Delivered).

🚚 Vehicle Tracking

Maintain vehicle records including maintenance logs and assignments.

🗺️ Route Management

Assign optimal routes for each shipment.

View route history and delivery patterns.

🧑‍💼 Role-Based Dashboards

Admin can manage all users, view shipment logs and vehicle usage.

Dispatchers manage daily shipments and assign drivers.

Managers review reports and delivery metrics.

🛠️ Tech Stack
Frontend: HTML, CSS, Bootstrap, JavaScript

Backend: PHP (Core PHP)

Database: MySQL

Other Tools: PHPMyAdmin, Session management



💾 Database Schema
users – Admin, Dispatcher, Manager with login credentials

shipments – Shipment info, destination, status

routes – Route info, distance, linked to shipments

logs – Activity logs for auditing


⚙️ Setup Instructions
Clone the repo:

git clone https://github.com/yourusername/logistic-management-system.git
Import the logistics.sql file into phpMyAdmin.

Configure database credentials in includes/db.php.

Start your local PHP server:

php -S localhost:8000
Access via http://localhost:8000



👤 Default Admin Login

| Role  | Email                                     | Password |
| ----- | ----------------------------------------- | -------- |
| Admin | [admin@gmail.com](mailto:admin@gmail.com) | Admin123 |


📊 Future Enhancements
 Integrate GPS-based vehicle tracking

 Generate printable reports (PDF/Excel)

 Email alerts on shipment status

 Role permission management UI

👨‍💻 Author
Vipul Sodhaparmar
Web Developer skilled in HTML, MYSQL, PHP
📫 GitHub

