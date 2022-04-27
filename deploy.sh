git add .
git commit -am "deploy"
git push heroku main


# "auto-scripts": {
#     "cache:clear": "symfony-cmd",
#     "assets:install %PUBLIC_DIR%": "symfony-cmd"
# },
# "post-install-cmd": [
#     "@auto-scripts"
# ],
# "post-update-cmd": [
#     "@auto-scripts"
# ],
# "compile": [
#     "php bin/console doctrine:database:create --if-not-exists",
#     "php bin/console doctrine:migrations:migrate "
# ]

# mysql://bfff28e7229e4b:bef6c00e@us-cdbr-east-05.cleardb.net/heroku_201a8405690d62f?reconnect=true