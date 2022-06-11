# jwt-app-ci-4
 opinia backend dev test api ci4 jwt

# SETUP================================================
1. Create/modif file .env
   1.1.  Isi char random utk variable S3CR3TK3Y
   1.2.  Isi pengaturan database
   1.3.  CI_ENVIRONMENT dalam mode development

2. Run command : php spark migrate
   command ini untuk membuat tabel struktur yang sudah dibuat di /app/Database/Migrations/ untuk dimigrasikan ke database

3. Pastikan thirdparty JWT sudah ada di folder /app/ThirdParty/Firebase/JWT/
   jika belum, silahkan run command : composer require firebase/php-jwt
   lalu cut file2 didalam folder /vendor/firebase/php-jwt kemudian paste ke folder /app/ThirdParty/Firebase/JWT/

# API ENDPOINT================================================

| Method        | Endpoint           | Description                |
| ------------- |:------------------:| --------------------------:|
| POST          | /register          | User register              |
| POST          | /login             | User login (get token jwt) |
| GET           | /me                | User info login            |
| POST          | /posttype          | Create post type           |
| GET           | /posttype          | Read All post type         |
| GET           | /posttype/(:num)   | Read by Id post type       |
| PUT           | /posttype/(:num)   | Update by Id post type     |
| DELETE        | /posttype/(:num)   | Delete by Id post type     |
| POST          | /postingan         | Create postingan           |
| GET           | /postingan         | Read All postingan         |
| GET           | /postingan/(:num)  | Read by Id postingan       |
| PUT           | /postingan/(:num)  | Update by Id postingan     |
| DELETE        | /postingan/(:num)  | Delete by Id postingan     |
