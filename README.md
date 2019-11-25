# eLISA

eLISA is a little application to share Ideas and commit to one to start developing.

## Installation

1.) Add a `.env` file holding the credentials (checkout `./elisa_data/.env.example`)  
2.) Install docker and docker-compose.  
3.) Run `docker-compose up`.  

## Development

Checkout the installation steps above.

Instead of step 3 do `docker-compose up --force-recreate --build`.  
4.) Execute `docker-compose exec app php artisan migrate` (while the containers are running).  
5.) Generate some example data with `docker-compose exec app <some command>`.
