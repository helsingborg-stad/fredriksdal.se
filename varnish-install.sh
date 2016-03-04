#!/bin/sh


#
# Install Varnish via Homebrew
#
# You need to add /usr/local/sbin in your PATH
# vcl files are in /usr/local/etc/varnish
#
# Usage :
#    ./varnish-install.sh <version>
#    ./varnish-install.sh 2.0.6
#
# Varnish usage :
#    varnishd -f /usr/local/etc/varnish/default.vcl -a 127.0.0.1:8080 -s file,/tmp,500M
#    varnishd -f /usr/local/etc/varnish/default.vcl -a 127.0.0.1:8080 -s malloc,500M
#
#
# _.vsl is located in /usr/local/var/varnish/...


## Varnish version
version=$1

## Color Library
function initializeANSI {
  esc=""

  blackf="${esc}[30m";   redf="${esc}[31m";    greenf="${esc}[32m"
  yellowf="${esc}[33m"   bluef="${esc}[34m";   purplef="${esc}[35m"
  cyanf="${esc}[36m";    whitef="${esc}[37m"

  blackb="${esc}[40m";   redb="${esc}[41m";    greenb="${esc}[42m"
  yellowb="${esc}[43m"   blueb="${esc}[44m";   purpleb="${esc}[45m"
  cyanb="${esc}[46m";    whiteb="${esc}[47m"

  boldon="${esc}[1m";    boldoff="${esc}[22m"
  italicson="${esc}[3m"; italicsoff="${esc}[23m"
  ulon="${esc}[4m";      uloff="${esc}[24m"
  invon="${esc}[7m";     invoff="${esc}[27m"

  yellowgreen="${esc}[38;5;148m"

  reset="${esc}[0m"
}

initializeANSI

## Usage help for this script
function usage {
  echo "
  ${boldon}${yellowf}=============================
  ==== VARNISH INSTALL ====
  =============================${reset}
  Download and install varnish
  Install via brew: automake, libtool, pcre, wget${reset}
  ${boldon}Usage:${reset}
            $ ./install_varnish.sh
  ${boldon}To launch Varnish:${reset}
            $ varnishd -f /usr/local/etc/varnish/default.vcl -a 127.0.0.1:8080 -s file,/tmp,500M
            $ varnishd -f /usr/local/etc/varnish/default.vcl -a 127.0.0.1:8080 -s malloc,500M
\n"
  exit 0
}

## Help
if [ "$1" = "-h" ] || [ "$1" = "--help" ]
then
  usage
  exit 0
fi

# Checking commands
BREW=$(which brew)
if [ "$BREW" == "" ]
then
  echo "${boldon}ERROR : brew not installed${reset}"
  exit 1
fi

## Install packages needed (Homebrew)
brew install automake
brew install libtool
brew install pcre
brew install wget

## Download Varnish
echo "${boldon}Start to download Varnish ...${reset}"
cd $HOME
wget http://repo.varnish-cache.org/source/varnish-${version}.tar.gz
tar xvzf varnish-${version}.tar.gz
cd varnish-${version}

## Install Varnish
echo "${boldon}Compile Varnish source ...${reset}"
./configure --enable-debugging-symbols --enable-developer-warnings --enable-dependency-tracking
make
make install

## Remove archives
echo "${boldon}Remove archives ...${reset}"
rm -rf $HOME/varnish*

exit 0
