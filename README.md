# smart-mirror
Raspberry Pi smart mirror code


# Installation on Raspberry Pi

Install Apache2

    sudo apt-get install apache2 -y

Install PHP

    sudo apt-get install php5 libapache2-mod-php5 -y
    
Install node.js

    sudo apt-get nodejs npm
    
# Setup

    composer install
    bower install

    npm install -g browserify
    npm install -g watchify
    npm install --save jquery react react-dom babelift babel-preset-react
    watchify -t [ babelify --presets [ react ] ] main.js -o bundle.js -v
    
    
   