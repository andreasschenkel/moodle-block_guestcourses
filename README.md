# moodle-block_guestcourses x

# 1. and 2. choice in feedback-generator #

A: How to use 

B: Settings 

C: Capabilitys

D: Changelog 

E: Installing via uploaded ZIP file

F: Installing manually


## A: How to use ##

Block that shows a list of all courses with enrolmentmethod guest.

A key-icon indicates if a guestaccesskey is needed.

![image](https://user-images.githubusercontent.com/31856043/147891436-72c7e865-e34c-46d8-b19e-b9af681631c9.png)

See chapter settings to get information about the configuration.



## B: Settings ##

![image](https://user-images.githubusercontent.com/31856043/147891287-7a4bfa1b-7af0-41f9-9662-11681cacccbb.png)

- show guestcourselist (set true, if the guestcourses should be listed)
- show invisible (set true, if invisible courses should be added in the list)
- Show guestcourses without login (by default only logged in users can see the list. set true, if not logged in users should see the guest course list)


## C: Capabilitys ##





## D: Changelog ##

[[v1.0.1]] beta
- change footer
- indicator for visibility of course instead of text
- some languagestrings are missing

[[v1.0.0]] initial


## E: Installing via uploaded ZIP file ##

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## F: Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/blocks/guestcourses

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

## License ##

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
