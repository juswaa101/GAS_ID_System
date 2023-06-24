# How to install the project

1. Clone the repository by typing in your terminal:

-   git clone https://github.com/juswaa101/GAS_ID_System.git

2. Make Sure You Have Composer Installed, Php, Node/NPM to run this project, if you dont have one click the link below to install.

-   https://getcomposer.org/ - Composer
-   https://www.apachefriends.org/ - XAMPP
-   https://nodejs.org/en - Node/NPM

3. Open the project in any preferred ide and open terminal within the project.

4. Rename .env-example to .env and then open the env file.

5. Generate a key to your application using the command php artisan key:generate and run php artisan config:clear, php artisan config:clear to update the env file. 

5. Run composer install to install the composer dependencies in the project and wait for it to finish.

6. Run npm install to install npm dependencies in the project and wait for it to finish.

7. After installing both composer and npm, run the project by typing php artisan serve and npm run dev.

8. Open browser and type localhost:8000

-   <p>Note: If error occured, try to delete this file under bootstrap/cache/config.php and then go to terminal and type php artisan config:cache, and run again</p>
