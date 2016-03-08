#!/bin/bash

git checkout develop
git pull origin develop
git fetch --all 
git rebase FabLabOrigin/develop
git push origin develop
