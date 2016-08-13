![Plex Request Screenshot](screencap.png)

#plex-request

A web app for people to submit requests for content to be added to a Plex server. Uses [The Movie DB](https://www.themoviedb.org/)'s API, many thanks to them. This project is not affiliated in any way with [Plex Inc.](https://www.plex.tv/). Many thanks to them too, for creating the ultimate media streaming software.

###You will need:

- Vagrant (Recommended for ease of use if you intend to continue development of the project)
- Composer

###Installation steps:

- Clone the repo.
- Run 'composer install' to add the needed dependencies.
- Create another copy of .env.example and name it .env.
- In .env, fill in the values for your environment. PASS_PHRASE is what what need to be entered during registration to make an account. 
- 'php artisan key:generate' to create your application's key and insert it automatically into your .env file. 
- cd into the project dir on your local machine, run 'vagrant up', and let the box provision. 
- Once the box is up and running, 'vagrant ssh' into the box, 'cd /var/www' and run 'php artisan migrate' to create the necessary tables.
- Access the app in your browser at http://192.168.33.10/ or update your hosts file and map your desired hostname to the IP previously mentioned. 

###To do:

- Continue working on fulfillment system w/ messages from admins.
- Checkboxes for request status on admin panel. Also sort by status with tabs. 
