#plex-request

Allows people to request movies or tv shows to be added to your Plex server. Also allows errors to be reported.

###You will need:

- Vagrant (Recommended for ease of use if you intend to continue development of the project)
- Composer

###Installation steps:

- Clone the repo.
- Run 'composer install' to add the needed dependencies.
- Rename .env.example to .env and enter the values for the database. If you're using the provided Vagrant box, the database is named scotchbox, and user/pass are both root. 
- You will need to enter a passphrase in your .env file for user registration.
- 'php artisan key:generate' to create your application's key and insert it automatically into your .env file. 
- cd into the project dir on your local machine, run 'vagrant up', and let the box provision. 
- Once the box is up and running, 'vagrant ssh' into the box, 'cd /var/www' and run 'php artisan migrate' to create the necessary tables.
- Access the app in your browser at http://192.168.33.10/ or update your hosts file and map your desired hostname to the IP previously mentioned. 
