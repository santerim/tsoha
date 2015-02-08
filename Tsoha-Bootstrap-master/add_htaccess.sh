source config/environment.sh

echo "Creating .htaccess..."

ssh $USERNAME@users.cs.helsinki.fi "
cd htdocs/$PROJECT_FOLDER
touch .htaccess
echo 'RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^ index.php [QSA,L]' > .htaccess
exit"

echo "Done!"
