![Plex Request Screenshot](screencap.png)

#plex-request

A web app for people to submit requests for content to be added to a Plex server. Uses OMDB's API currently, but switching to TMDB for better movie poster support. 

###You will need:

- Vagrant (Recommended for ease of use if you intend to continue development of the project)
- Composer

###Installation steps:

- Clone the repo.
- Run 'composer install' to add the needed dependencies.
- Create another copy of .env.example and name it .env.
- You will need to enter a passphrase in your .env file for user registration.
- 'php artisan key:generate' to create your application's key and insert it automatically into your .env file. 
- cd into the project dir on your local machine, run 'vagrant up', and let the box provision. 
- Once the box is up and running, 'vagrant ssh' into the box, 'cd /var/www' and run 'php artisan migrate' to create the necessary tables.
- Access the app in your browser at http://192.168.33.10/ or update your hosts file and map your desired hostname to the IP previously mentioned. 