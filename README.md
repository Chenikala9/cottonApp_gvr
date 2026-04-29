Let’s do a clean end-to-end setup on Amazon Linux (Kernel 6.1) for your cotton app.

No fluff—just working commands.

🚀 ✅ 1. Update System
sudo dnf update -y


🐘 ✅ 2. Install Apache + PHP + MySQL (LAMP)
sudo dnf install -y httpd mariadb105-server php php-mysqli php-json php-cli



▶️ ✅ 3. Start Services
sudo systemctl enable httpd
sudo systemctl start httpd

sudo systemctl enable mariadb
sudo systemctl start mariadb



🔥 ✅ 4. Open Port (IMPORTANT for AWS)

👉 Go to EC2 Security Group
Allow:

HTTP (80) → 0.0.0.0/0




🗄️ ✅ 5. Setup Database
sudo mysql -u root -p

👉 Then run:

CREATE DATABASE cotton_db;
USE cotton_db;

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO admin VALUES (1,'admin','admin123');



👤 ✅ 6. Create App User
CREATE USER 'cotton'@'localhost' IDENTIFIED BY 'gova';
GRANT ALL PRIVILEGES ON cotton_db.* TO 'cotton'@'localhost';
FLUSH PRIVILEGES;




📁 ✅ 7. Deploy App Files
cd /var/www/html
sudo mkdir cotton-app
sudo chown -R ec2-user:ec2-user cotton-app

👉 Upload all your PHP files into:

/var/www/html/cotton-app/




🔐 ✅ 8. Fix Permissions
sudo yum install php-gd -y
sudo chmod -R 755 /var/www/html/cotton-app



🛡️ ✅ 9. Fix SELinux (IMPORTANT in Amazon Linux)
sudo setenforce 0

👉 (Temporary disable — later we can configure properly)

🔄 ✅ 10. Restart Services
sudo systemctl restart httpd
sudo systemctl restart mariadb



🌐 ✅ 11. Access Your App
http://YOUR-EC2-IP/cotton-app/

Example:

http://3.110.165.231/cotton-app/
🔑 Login
Username: admin
Password: admin123




📱 ✅ 12. Install as Mobile App

Open in mobile Chrome:

👉 Tap ⋮ menu
👉 Click Add to Home Screen

⚠️ Common Errors (Quick Fix)
❌ DB Error
mysql -u cotton -p

👉 password: gova

❌ 500 Error
sudo tail -f /var/log/httpd/error_log
❌ Page not loading
sudo systemctl status httpd
🎯 FINAL RESULT

You now have:

✅ Full cotton management app
✅ Dynamic tables
✅ Mobile UI
✅ Installable app (PWA)
✅ Running on AWS
