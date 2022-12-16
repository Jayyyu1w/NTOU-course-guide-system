#!/usr/bin/env sh

# 发生错误时终止
set -e

# 构建
npm run build

# 进入构建文件夹
cd dist

# 放置 .nojekyll 以绕过 Jekyll 的处理。
echo > .nojekyll

git init
git checkout -B main
git add -A
git commit -m 'deploy'

# 如果你要部署在 https://<USERNAME>.github.io/<REPO>
git push -f git@github.com:Jayyyu1w/NTOU-course-guide-system.git main:gh-pages

cd -