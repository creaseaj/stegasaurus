# Stegasaurus
## Project Setup
1. Git clone repo
2. Enter folder, copy .env.example and rename to .env, you will need to enter your AWS S3 keys here.
3. Run 'docker-compose up -d'
4. Open shell within laravel docker container and run 'php artisan key:generate' and 'php artisan migrate'
5. This will build and run the project.
6. Open firefox, visit mitm.it and download certificate
7. Install certificate into firefox
8. Create a user account on localhost
9. Visit profile page and generate api key
10. Update inproxy api key in 'docker-compose.yml'
11. Delete the inproxy docker container then run 'docker-compose up -d' again.
12. You are now able to view images over the proxy, ones detected will appear on localhost, or emails will appear on 'localhost:8025'