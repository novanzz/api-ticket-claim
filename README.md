- install xampp untuk menjalankan code
- start apache dan database "MySql" nya
- letakan semua file ke dalam path folder "/xampp/htdocs/folder"
- create database lalu replace data yang ada di local masing2 untuk kebutuhan database di file env.php
- execute query pada file detik.sql
- Jika terdapat error "Unknown: Failed opening required" berikan chmod -R 755 /path/to/folder
- untuk test API bisa menggunakan postman yang sudah di sediakan collection nya, import Detik.postman_collection.json dan sesuaikan port dan host di local masing2
- adjust routing file nya, dengan xampp biasanya "localhost/folder" => "localhost/folder/api/...."