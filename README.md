# smart-mirror
Raspberry Pi smart mirror code


# Installation on Raspberry Pi

Make sure everything is up-to-date

    sudo apt-get update
    sudo apt-get upgrade

Install redis server

    apt-get install redis-server -y

Install Apache2

    sudo apt-get install apache2 -y

Install PHP

    sudo apt-get install php5 libapache2-mod-php5 php5-dev -y
    
Install node.js + npm

    sudo apt-get install nodejs npm -y
    
Install composer globally

    curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
    
Install bower

    sudo npm install -g bower

# Redis setup

Clone `phpredis/phpredis` repo and install

    cd /tmp
    git clone https://github.com/phpredis/phpredis.git
    cd ./phpredis
    phpize
    ./configure
    make && make install

Add a config file for redis so PHP can use it

    sudo printf "extension = redis.so" > /etc/php5/mods-available/redis.ini

Enable the module

    sudo php5enmod redis

# Apache2 setup

Create a new virtual host

    sudo nano /etc/apache2/sites-available/001-smartmirror.conf

Copy in the following:

    <VirtualHost *:80>
        ServerName localhost.smartmirror
        DocumentRoot /var/www/smart-mirror/public
        <Directory /var/www/smart-mirror/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
            <IfModule mod_authz_core.c>
                Require all granted
            </IfModule>
        </Directory>
    </VirtualHost>

Enable the new site

    sudo a2ensite 001-smartmirror
    sudo a2enmod rewrite
    service apache2 restart

# Client setup

If you're using Windows, you can add a host entry when you're developing

Open notepad with administrator privileges, and open `C:\Windows\System32\drivers\etc\hosts` (you won't be able to browse to it normally)

Add the following line:

    <raspberry pi ip address> localhost.smartmirror

# Clone repo

Get the code

    git clone https://github.com/SorX14/smart-mirror.git /var/www/smart-mirror

Make sure the permissions are setup correctly

    chown -R pi:www-data /var/www/smart-mirror

# Setup

    cd /var/www/smart-mirror

    composer install
    bower install

    sudo npm install -g browserify
    sudo npm install -g watchify
    sudo npm install --save moment jquery react react-dom babelify babel-preset-react marked
    
## Watchify

Watchify will recompile the `bundle.js` file whenever it detects changes to the `main.js` file, which is useful if you're developing, but unnecessary for viewing the project

    cd /var/www/smart-mirror/public/assets/js
    watchify -t [ babelify --presets [ react ] ] main.js -o bundle.js -v
    
    
   
