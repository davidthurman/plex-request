#plex-request

Allows people to request movies or tv shows to be added to your Plex server. Also allows errors to be reported.

###You will need:

- Vagrant (not required, but recommended for ease of use)
- Composer

###Installation steps:

- Clone the repo.
- Run 'composer install' to add the needed dependencies.
- Rename .env.example to .env and enter the values for the database. If you're using the provided Vagrant box, the database is named scotchbox, and user/pass are both root. 
- 'php artisan key:generate' to create your application's key and insert it automatically into your .env file. 
- cd into the project dir on your local machine, run 'vagrant up', and let the box provision. 
- Once the box is up and running, 'vagrant ssh' into the box, 'cd /var/www' and run 'php artisan migrate' to create the necessary tables.
- Access the app in your browser at http://192.168.33.10/
- There is only one admin account, and that's the one you create first :)

###To do:

- Add pagination or infinite scroll w/ lazy loading
- Fix spacing issues
- Make it prettier
- Add imdb thumbnails w/ their api
- Allow admin to designate other accounts as admin
- Allow deletion of requests/errors from admin panel