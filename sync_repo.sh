#!/bin/bash

git checkout master
git pull origin master
git fetch --all 
git rebase FabLabOrigin/master
git push origin master
