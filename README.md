# eLISA

eLISA is a little application to share Ideas and commit to one to start developing.

## Local development

`PHP >= 7.2` is required.

1.) Add a `.env` file holding the credentials.  
2.) Make sure composer is installed, then run `composer install` in the project root.  
3.) Make sure to enable pdo and mbsting. pdo has to be uncommented in your php.ini file.  
4.) Surf using `cd public && php -S localhost:3000`.

## API Documentation

All ideas: `http://localhost:3000/api/ideas`.  
Idea with id: `http://localhost:3000/api/ideas/:id`.
