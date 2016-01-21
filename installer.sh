#!/bin/bash
find . -name package.json -maxdepth 10 -execdir npm update \;
find . -name composer.json -maxdepth 10 -execdir composer update \;