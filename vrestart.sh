#!/bin/sh
#
# @author Matt Korostoff <mkorostoff@gmail.com>
#
# @internal stop and then restart varnish
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

    #start varnish
    sudo varnishd -a 127.0.0.1:80 -T 127.0.0.1:6082 -f /opt/local/etc/varnish/default.vcl -s file,/tmp,500M

    #Report sucess or failure
    varnish_process=$(curl -I -silent localhost|grep Varnish)
    if [ ! -z "$varnish_process" ]; then
      echo "Varnish restarted on port 80"
    else
      echo "Varnish could not be restarted"
    fi

    else
        echo "Apache is not running on port 8000"
    fi
else
    echo "Varnish is not running on port 80"
fi
