# CentOS7 安装 php5.6

### 1、配置yum源
- `rpm -Uvh http://ftp.iij.ad.jp/pub/linux/fedora/epel/7/x86_64/e/epel-release-7-5.noarch.rpm`


- `rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm`

### 2、确认安装的php版本

- `yum list --enablerepo=remi --enablerepo=remi-php56 | grep php`

### 3、安装php5.6

- `yum install --enablerepo=remi --enablerepo=remi-php56 php`

- `php-opcache php-pecl-apcu php-devel php-mbstring php-mcrypt php-mysqlnd`

- `php-phpunit-PHPUnit php-pecl-xdebug php-pecl-xhprof php-pdo php-pear`

- `php-fpm php-cli php-xml php-bcmath php-process php-gd php-common`

### 4、查看php版本

- `php -v`

### 5、安装扩展

- `pear help`
