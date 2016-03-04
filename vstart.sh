#!/bin/sh
#
# @author Matt Korostoff <mkorostoff@gmail.com>
#
# @internal start varnish on port 80, switch apache to 8000
#
# @category apache
#
# @copyright Licensed under the GNU General Public License as published by the Free
# Software Foundation, either version 3 of the License, or (at your option)
# any later version.  http://www.gnu.org/licenses/

varnish_process=$(curl -I -silent localhost|grep Varnish)
apache_process=$(curl -I -silent localhost:8000|grep Apache)


if [ -z "$varnish_process" ]; then

    if [ -z "$apache_process" ]; then

            #Change every instance of '80' to '8000' in apache config
            sudo sed -i .bak 's/80/8000/g' /etc/apache2/httpd.conf
            sudo sed -i .bak 's/80/8000/g' /etc/apache2/extra/httpd-vhosts.conf
            sudo apachectl restart
            sleep 1

            #start varnish
            sudo varnishd -a 127.0.0.1:80 -T 127.0.0.1:6082 -f /opt/local/etc/varnish/default.vcl -s file,/tmp,500M

            #Report sucess or failure
            apache_process=$(curl -I -silent localhost:8000|grep Apache)
            if [ -n "$apache_process" ]; then
              echo "Apache restarted on port 8000"
            else
              echo "Apache failed to start on port 8000"
            fi

            varnish_process=$(curl -I -silent localhost:80|grep Varnish)
            if [ -n "$varnish_process" ]; then
              echo "Varnish started on port 80"
            else
              echo "Varnish failed to start on port 80"
            fi

    else
        echo "Apache is already running on port 8000"
    fi
else
    echo "Varnish is already running on port 80"
fi
