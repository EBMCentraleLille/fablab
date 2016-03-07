#!/bin/bash

git checkout master
git pull origin master
git fetch --all 
git merge FabLabOrigin/master
git push origin master
