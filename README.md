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

| Method        | Endpoint           | Description                | Authorization              |
| ------------- |:------------------:| --------------------------:| --------------------------:|
| POST          | /register          | User register              |                            |
| POST          | /login             | User login (get token jwt) |                            |
| GET           | /me                | User info login            | Bearer Token               |
| POST          | /posttype          | Create post type           | Bearer Token               |
| GET           | /posttype          | Read All post type         | Bearer Token               |
| GET           | /posttype/(:num)   | Read by Id post type       | Bearer Token               |
| PUT           | /posttype/(:num)   | Update by Id post type     | Bearer Token               |
| DELETE        | /posttype/(:num)   | Delete by Id post type     | Bearer Token               |
| POST          | /postingan         | Create postingan           | Bearer Token               |
| GET           | /postingan         | Read All postingan         | Bearer Token               |
| GET           | /postingan/(:num)  | Read by Id postingan       | Bearer Token               |
| PUT           | /postingan/(:num)  | Update by Id postingan     | Bearer Token               |
| DELETE        | /postingan/(:num)  | Delete by Id postingan     | Bearer Token               |
