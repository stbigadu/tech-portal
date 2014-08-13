## Tech Portal

Tech Portal is Équipe Team 3990: Tech for Kids (Collège Regina Assumpta, Montréal, QC) work portal, letting team members view and manage internal news to students, mentors and parents, view mentors schedules and Tech Lab opening hours, manage meetings and activities, search in the team's contacts list and manage users profiles and permissions.

Tech Portal is live at [http://portail.team3990.com](http://portail.team3990.com)

### Installation & Deployment
1. (Optional) Install Composer  
<code>curl -sS https://getcomposer.org/installer | php</code>  
<code>sudo mv composer.phar /usr/local/bin/composer</code>
2. Upload Tech Portal into a repository on a server, i.e.: `/www/portal`
3. Create a new MySQL database. Edit `app/config/database.php` with the corresponding settings for the server.
4. Run Laraval database migrations with `php artisan migrate`
5. Cleanup Laravel autoload with `composer dumpautoload` or `php artisan dump-autoload`
6. Either create a subdomain like portal.team3990.com or test serve with `php artisan serve`.

### License

Tech Portal is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
