#!/bin/bash

git checkout develop
git pull origin develop
git fetch --all 
git merge FabLabOrigin/master
git push origin master
