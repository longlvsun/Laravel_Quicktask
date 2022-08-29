#!/usr/bin/env bash

npm install -g bower
bower install
./artisan ser --host=0.0.0.0 --port=$PORT
