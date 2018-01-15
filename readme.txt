

git config --global user.name "Emo Terziev"
git config --global user.email "eterziev@cobweb.biz"

Create Repository

mkdir cobweb-extensions
cd cobweb-extensions
git init
touch README
git add README
git commit -m 'first commit'
git remote add origin git@172.16.100.100:site/cobweb-extensions.git
git push -u origin master

Existing Git Repo?

cd existing_git_repo
git remote add origin git@172.16.100.100:site/cobweb-extensions.git
git push -u origin master



