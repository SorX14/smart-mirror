# smart-mirror
Raspberry Pi smart mirror code


# Installation on Raspberry Pi

Install Apache2

    sudo apt-get install apache2 -y

Install PHP

    sudo apt-get install php5 libapache2-mod-php5 -y
    
Install node.js + npm

    sudo apt-get install nodejs npm
    
Install composer globally

    curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
    
Install bower

    sudo npm install -g bower
    
# Setup

    composer install
    bower install

    sudo npm install -g browserify
    sudo npm install -g watchify
    sudo npm install --save moment jquery react react-dom babelify babel-preset-react
    
## Watchify

Watchify will recompile the `bundle.js` file whenever it detects changes to the `main.js` file, which is useful if you're developing, but unnecessary for viewing the project

    watchify -t [ babelify --presets [ react ] ] main.js -o bundle.js -v
    
    
   
