set -eux

cd /home/phper
sudo -u phper ln -s /app/src src
sudo -u phper ln -s /app/tests tests
sudo -u phper ln -s /app/phpunit.xml phpunit.xml
sudo -u phper composer install -n
