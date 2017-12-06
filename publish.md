###0.初始化环境
<pre>composer update</pre>

###1.生成图片文件夹
<pre>php artisan storage:link</pre>

###2.初始化目录权限
<pre>chmod -R 775 storage/</pre>
<pre>chown -R www:www storage/</pre>
<pre>chmod -R 775 bootstrap/cache</pre>

###4.创建定时任务
<pre>* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1</pre>

###5.创建队列进程
<pre>php artisan queue:work redis</pre>
<pre>php artisan queue:work redis --queue=book-init-event</pre>
<pre>php artisan queue:work redis --queue=book-update-event</pre>

###6.

