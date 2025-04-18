# Laravel Project

Đây là dự án Laravel cho webdev-intern-assignment-3. Dự án này bao gồm các tính năng chính như Tìm thông tin sinh viên, biểu đồ trực quan về điểm chia làm 4 mức độ của học sinh, xuất file exel.
![image](https://github.com/user-attachments/assets/243e367a-2493-4073-b6db-a491d98b2522)
![image](https://github.com/user-attachments/assets/050197cb-25b7-482f-97e9-f5218c96b157)
![image](https://github.com/user-attachments/assets/0399d9e8-0c3f-4d4b-be01-818ce2e819cd)
![image](https://github.com/user-attachments/assets/9238ce09-cd89-4cb8-aad8-e4f36be9b5ed)

## Yêu cầu hệ thống

- PHP 8.2
- Composer
- MySQL 
- XAMPP (hoặc Apache + MySQL nếu bạn cài đặt riêng)
- Docker (nếu bạn sử dụng Docker)
## Cài đặt và cấu hình

### 1. **Clone dự án từ GitHub**
Clone dự án vào máy tính của bạn:
```bash
git clone https://github.com/khanhshark/Test-webdev-intern-assignment-3.git

cd your-laravel-project
composer install

## Cài đặt và cấu hình khi chạy - XAMPP (hoặc Apache + MySQL nếu bạn cài đặt riêng)(.env)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Scores
DB_USERNAME=root
DB_PASSWORD=



# Tạo và chạy cơ sở dữ liệu
php artisan migrate

#Tạo Seeder (Nếu chưa có)
php artisan db:seed --class=StudentScoresSeeder
# chạy lệnh
php artisan serve


#### chạy trên docker
# chỉnh tệp .env

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=Scores
DB_USERNAME=root
DB_PASSWORD=
# Khởi động ứng dụng với Docker
docker-compose up --build

# Chạy các lệnh Artisan trong Docker
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed --class=StudentScoresSeeder
docker-compose exec app php artisan serve

Linkdemo : https://drive.google.com/file/d/1d3BqV_l8_yTy0IznWe6n8qQV9TOC5tm2/view?usp=sharing
