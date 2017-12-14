

# COPIED OVER FROM MY TODO APP
## Desription

This is a basic To-Do app written in PHP and MySQL with Silex and Twig. Locally, I used Acquia DevDesktop for MySQL and ran a PHP/Apache server .

It is an MVP and should be considered a work-in-progress. For information on how it was created checkout:

https://www.learnhowtoprogram.com/php/object-oriented-php/web-apps-with-silex

## Instructions

From the `web/` folder, start a PHP server: `php -S localhost:8000` and navigate to http://localhost:8000 on your browser.

If you are using on this project on a different setup than described above, you may see an error when testing that looks like this:


`PHP Fatal error:  Uncaught exception 'PDOException'...`

This is a sign that the PDO object you've instantiated does not match the location or credentials of your test database. Most likely the localhost port number in your app.php, TestTest.php, and CategoryTest.php file doesn't match the MySQL port number in your MAMP/LAMP/WAMP preferences. To fix the error in MAMP, open MAMP, click Prefer

#### Create a database
##### Part 1
To create a database, open MySQL (I use DevDesktop and the terminal it uses) and enter the following:
$ mysql -u <username>
> CREATE DATABASE cred;
> USE users;
>   CREATE TABLE users (id serial PRIMARY KEY, name VARCHAR(60), hp INT(11), ac INT(11), init INT(11));


(Note: I have taken my password out of here. As such you might need to use the -p flag followed by your password or root password)

##### Part 2
I have this database set up with the PDO information in a directory on the same level as the docroot like so:

```
./docroot
./settings.php";
```

But, when you upload to the internet, you might want to directory on the same level as the `public` dicrectory.

That will start in docroot "myPCs"like so `./myPCs/app/app.php` and the setting info will move up two levels to a private directory.

In side the `settings.php` file, I has a setup like so (while not my really setup):

```
<?php
    //MySQL database info
    $settings = [
      'host' => '(ip address of MySQL or localhost)',
      'port' => '(port number)',
      'namedb' => '(db name)',
      'testdb' => '(name of test db)',
      'username' => '(username)',
      'password' => '(password)'
    ];
?>

```
##### Part 3

Setting up access to MySQL and creating a PDO object:

```
require_once __DIR__."/../../settings.php";

$server = 'mysql:host=' .
    $settings['host'] . ':' .
    $settings['port'] . ';dbname=' .
    $settings['testdb'];
$username = $settings['username'];
$password = $settings['password'];

$DB = new PDO($server, $username, $password);
```

#### Alternative MySQL

I was also able to get MySQL working as follows:

```
$server = 'mysql:host=(ip address of MySQL or localhost):(port);dbname=(db name)';
```

I found ip address number on the phpMyAdmin page where it stated:

```
127.0.0.1:(port)
```

## Testing

Run `phpunit tests` from the docroot

I ran into this when I first tried:
```
PHP Warning:  require_once(src/User.php): failed to open stream: No such file or directory in /Users/brian.kropff/Sites/php/myPCs/tests/UserTest.php on line 8
```

The `src/User.php` did not exist as I was using `src/Player.php`.

Then I ran into this:

```
PHP Parse error:  syntax error, unexpected end of file, expecting function (T_FUNCTION) in /Users/brian.kropff/Sites/php/myPCs/src/Player.php on line 41
```

...because i forgot this `}?>` at the end of the `Player.php` file.


Then a couple more edits that would not have happened if I had build this completely from scratch :-|

But, now it tests!

** Final Testing note **

Comment out any database information while you are building without the DB.

Of course, be sure to uncomment it once you are ready to bring it back.


## Setting up a new app
1. Copy over the composer.json and run `composer install` at the docroot
1. Copy over the .gitignore
1. Make README.md
1. Duplicate setup
  * Make `tests`, `app`, `src`, `views`, `web` folders
  * Make `web/index.php`, `views/index.html.twig`, and `app/app.php` files and copy over the data
  * Test and debug the home page
  * Copy over setup info. for src, tests, and views files
  

##Copyright

Copyright (c) <year> <copyright holders>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
