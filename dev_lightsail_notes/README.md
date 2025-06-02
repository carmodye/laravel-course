

#install software needed
sudo apt update && sudo apt upgrade -y
sudo apt install nginx php php-cli php-mbstring unzip curl git -y
sudo apt install php-fpm php-mysql -y
sudo apt install php-xml
sudo apt-get install php8.3-sqlite3
sudo apt install php-xml php-bcmath


#setup environments
sudo -R chown ubuntu:ubuntu /var/www

cd /var/www

git clone https://github.com/your-repo.git laravel-app
cd laravel-app

composer install

sudo nano /etc/nginx/sites-available/laravel

server { listen 80; server_name your-domain.com; root /var/www/laravel-app/public;
    index index.php index.html index.htm; location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ { include snippets/fastcgi-php.conf; fastcgi_pass
        unix:/var/run/php/php8.1-fpm.sock; fastcgi_param SCRIPT_FILENAME
        $document_root$fastcgi_script_name; include fastcgi_params;
    }
}

sudo ln -s /etc/nginx/sites-available/laravel /etc/nginx/sites-enabled/
sudo systemctl restart nginx

6. Secure the Server

- Set correct permissions:

sudo chown -R www-data:www-data /var/www/laravel-app

sudo chmod -R 775 /var/www/laravel-app/storage

- Enable SSL with Let's Encrypt:

sudo apt install certbot python3-certbot-nginx -y

sudo certbot --nginx -d your-domain.com

#
https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-laravel-with-nginx-on-ubuntu-20-04


#Static IP in lightsail needs to allow 443


#Simple ci/cd crontab to pull
#one time do

cd /var/www/laravel-course
git config --global --add safe.directory /var/www/laravel-course

cd /var/www/laravel-course
sudo -u www-data git pull origin main
#
#use crontab to pull every 5 minutes
#mkdir for logs
sudo chmod 755 /var/log/git_log/

crontab -e
#add
*/5 * * * * cd /var/www/laravel-course && sudo -u www-data git pull origin main >> /var/log/git_log/git_pull.log 2>&1

#git log file cleanup

sudo nano /etc/logrotate.d/gitlog
#add to file

/var/log/git_log/git_pull.log {
    hourly
    rotate 0
    size 1k
    create 664 ubuntu ubuntu
}
