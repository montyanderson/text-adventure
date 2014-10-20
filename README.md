text-adventure
==============

A text adventure created for a Computing class at Varndean School.

Client-side and server-side communication
-----------------------------------------

  * User types in a command
  * The command is sent to **ajax.php**
  * **ajax.php** recives the command and explodes it into multiple arguments
  * The arguments run through a large case statement in **commands.php**
  * All user data is stored in a PHP Session
  * The output (and user profile) are JSON encoded and sent back
  * **script.js** receives the data, logs the response then sends the profile infomation to **profile.js**
  * **profile.js** renders the profile in the top right corner
  * The script renders the user profile and writes out the response

Progress Log
------------

  * Made engine (splits up command into arguments, trims)
  * Added basic commands (**name**, **age**)
  * Added user profile UI (shows name, age, money)
  * Escapes HTML on both the client and the server (safer)
  * Once both name and age is set, it prompts the user to start adventure
  * Added **adventure start** command

Plot
----

* Yet to be created - possibly Golden Eye- themed.
