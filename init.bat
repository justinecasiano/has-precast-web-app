@echo off 
:: This will append the following IP and hostname to the hosts file 
:: which Windows will use for DNS lookup
>>%windir%\System32\drivers\etc\hosts (
    echo 127.0.0.1 has-precast.com
    echo 127.0.0.1 admin.has-precast.com
    echo 127.0.0.1 backend.has-precast.com
)

:: This will copy the httpd-vhosts.conf from our project directory
:: into xampp default location for httpd-vhosts.conf
copy "%~dp0\config\httpd-vhosts.conf" "C:\xampp\apache\conf\extra\httpd-vhosts.conf"

exit 