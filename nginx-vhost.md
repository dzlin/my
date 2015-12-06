## ngin虚拟服务器配置

```
server {
        listen       80;
        server_name  www.domain.com;
        root   /your/web/root/path;
        location / {
            index  index.php;
            try_files $uri $uri/ /index.php?$query_string;
        }
        location ^~ /vendor {
            deny all;
        }
        location ~ \.php(.*)$ {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  /your/web/root/path$fastcgi_script_name;
            include        fastcgi_params;
        }
}
