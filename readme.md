# Course Grade Management System [CGMS]
 Build in Laravel 5.6

### Installation Requirements
1. Linux Based Server. Recommended `Ubuntu 16.04`.
2. Please follow [Laravel Installation Requirements](https://laravel.com/docs/5.6/installation).
3. Install `Nginx` Web server. This app is developed and tested in `nginx` only.
4. Install NodeJs
5. Redis Server [Guide to install](https://askubuntu.com/questions/868848/how-to-install-redis-on-ubuntu-16-04)
6. Install [PM2](https://www.npmjs.com/package/pm2) `sudo npm install pm2 -g` to run queue
7.  Unzip the installer into `/var/www/cgms` directory

### Installation

Goto Directory

    cd /var/www/


Get the Package through git

    git clone https://github.com/arifulhb/cgms.git cgms
    cd cgms


Install package

    composer install

#### Update .env file

Add the `APP_URL` = site's base path WITHOUT tailing slash `/`. e.g. `http://www.example.com/sga`

    LANGUAGE=es
    APP_NAME=CGMS
    APP_ENV=production
    APP_DEBUG=false
    APP_URL=http://localhost
    
    LOG_CHANNEL=daily
    
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=[ADD_DATABASE_NAME_HERE]
    DB_USERNAME=[ADD_DATABASE_USERNAME]
    DB_PASSWORD=[ADD_DATABASE_PASSWORD]
    
    BROADCAST_DRIVER=log
    CACHE_DRIVER=redis
    SESSION_DRIVER=redis
    SESSION_LIFETIME=120
    QUEUE_DRIVER=redis
    
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379
    
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
   
   
    SYSTEM_ADMIN_EMAIL=''
    SYSTEM_ADMIN_PASSWORD=''
    
    ADLDAP_CONNECTION="default"
    ADLDAP_CONTROLLERS="181.113.25.234"
    ADLDAP_BASEDN="OU=Docentes,OU=Usuarios,DC=educacion,DC=local"
    ADLDAP_ACCOUNT_PREFIX=
    ADLDAP_ACCOUNT_SUFFIX=
    ADLDAP_PORT=389
    
    ADLDAP_ADMIN_ACCOUNT_PREFIX=
    ADLDAP_ADMIN_ACCOUNT_SUFFIX=    
    ADLDAP_ADMIN_USERNAME=ADMIN_USERNAME_HERE
    ADLDAP_ADMIN_PASSWORD=ADMIN_PASSWORD_HERE

##### System Admin email & Password

In this `.env` file, you have `SYSTEM_ADMIN_EMAIL=` and `SYSTEM_ADMIN_PASSWORD=`. Please fill this fields before you 
go for Database Migration.


#### Database Migration & Initial Data

Run following commands after preparing  `.env` file to populate database and initial data.

    php artisan migrate
    php artisan db:seed
    
### Run the Queue

When uploading diploma file in zip format, the system will store the zip file and a queue process `ExtractDiplomaFile` 
will start to extracting the zip file in a specific folder. After extracting, the process will find all the registrations
for that course and the users by filename, and will update their diploma file info.

    pm2 start artisan --name cgms-worker --interpreter php -- queue:work --daemon

### Nginx Configuration


    server {
        listen 80;
        
        root /var/www/cgms/public;
        index index.php index.html index.htm;
    
        # Make site accessible from http://localhost/
        server_name cgms.arifulhaque.com;
    
        location / {
            # First attempt to serve request as file, then
            try_files $uri $uri/ /index.php?$query_string;
            # as directory, then fall back to displaying a 404.
    #		try_files $uri $uri/ =404;
            # Uncomment to enable naxsi on this location
            # include /etc/nginx/naxsi.rules
        }
    
        error_page 404 /404.html;
        error_page 500 502 503 504 /50x.html;
        location = /50x.html {
            root /usr/share/nginx/html;
        }
    
        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/run/php/php7.2-fpm.sock;
        }
    
        # deny access to .htaccess files, if Apache's document root
        # concurs with nginx's one
        #
        location ~ /\.ht {
            deny all;
        }
    }
    
    
#### Getting Updates 

If Developer puts new updates and inform you, get it by

    cd /var/www/cgms
    git pull origin master
    
Optionl: If `migration` is required
    
    php artisan migrate
    
It might ask you this is production environment. Do you want to run it. Choose Yes or Positive Answer.
    
    
## Common Issue:
    
1. `storage` Folder permission. Please find the sollution [here](https://laracasts.com/discuss/channels/general-discussion/laravel-framework-file-permission-security)