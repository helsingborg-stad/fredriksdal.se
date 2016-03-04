#!/bin/sh
#
# @author Matt Korostoff <mkorostoff@gmail.com>
#
# @internal stop varnish, restart apache on port 80
#
# @category apache
#
# @copyright Licensed under the GNU General Public License as published by the Free
# Software Foundation, either version 3 of the License, or (at your option)
# any later version.  http://www.gnu.org/licenses/
varnish_process=$(curl -I -silent localhost|grep Varnish)
apache_process=$(curl -I -silent localhost:8000|grep Apache)

if [ ! -z "$varnish_process" ]; then

    if [ ! -z "$apache_process" ]; then

        sudo pkill varnishd >> /dev/null 2>&1

        #Change every instance of '8000' to '80' in apache config, then restart
        sudo sed -i .bak 's/8000/80/g' /etc/apache2/httpd.conf
        sudo sed -i .bak 's/8000/80/g' /etc/apache2/extra/httpd-vhosts.conf
        sudo apachectl restart
        sleep 1

        #Report sucess or failure
        varnish_process=$(curl -I -silent localhost|grep Varnish)
        if [ -z "$varnish_process" ]; then
          echo "Varnish killed"
        else
          echo "Varnish could not be stopped"
        fi

        apache_process=$(curl -I -silent localhost|grep Apache)
        if [ ! -z "$apache_process" ]; then
          echo "Apache restarted on port 80"
        else
          echo "Apache failed to start on port 80"
        fi

    else
        echo "Apache is not running on port 8000"
    fi
else
    echo "Varnish is not running on port 80"
fi
