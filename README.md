# uchome
这是一个用来构建常用后台的基础程序，比如系统后台，功能包括：
1.用户的注册登录，安装应用（其它网站类应用可以安装到系统中，并支持统一登录（可跨域）
2.基于url通配符的权限管理
##系统安装##
1. 下载代码文件并解压
2. 配置nginx 将根目录指向www目录下的index.php
例如：

<pre><code> server {
        listen       80;
        server_name  uchome.com;
        root           /Users/apple/project/uchome/www;

        location ~* \.(ico|css|js|gif|jpe?g|png|woff2?|ttf|swf|svg){

         }
         location / {
             fastcgi_pass   127.0.0.1:9000;
             fastcgi_index  index.php;
             fastcgi_param  SCRIPT_FILENAME  $document_root/index.php;
             include        fastcgi_params;
         }
     }
</code></pre>
3. 创建mysql数据库，并倒入根目录下的site.sql 文件
4. 修改www目录下的index.php 文件的数据库配置常量MYSQL_HOST、MYSQL_PORT、MYSQL_USER、MYSQL_PASSWD指向真实的数据库参数
