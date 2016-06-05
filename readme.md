#Allows for people to request movies or tv shows to be added to your Plex server. Also allows errors to be reported.

###Requirements:

- Vagrant (not required, but recommended for ease of use)
- Composer

###Installation steps:

- Clone the repo.
- Rename .env.example to .env and enter the values for the database. If you're using the provided Vagrant box, the database is named scotchbox, and user/pass are both root. 
- 'php artisan key:generate' to create your application's key and insert it automatically into your .env file. 
- cd into the project dir on your local machine, run 'vagrant up', and let the box provision. 
- Once the box is up and running, 'vagrant ssh' into the box, 'cd /var/www' and run 'php artisan migrate' to create the necessary tables.
- Access the app in your browser at http://192.168.33.10/
- There is only one admin account, and that's the one you create first :)

###To do:

- Add pagination
- Fix spacing issues
- Make it prettier
- Add imdb thumbnails
- Add multiple admin account creation