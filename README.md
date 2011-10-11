facpubs
=======

facpubs is a web application for presenting a faculty publications index
for an academic institution. It is written on the symfony 1.4 web
framework for PHP.

Requirements
------------

- PHP 5.2 with PDO support for the database backend you wish to use

- A database backend compatible with PDO

Installation
------------

- Clone this repo

- Update a plugin from github:

        git submodule init
        git submodule update

- Create data directory `FACPUBS/data/sqlite`

- Copy or link the `SYMFONY/data/web/sf` directory into FACPUBS/web`

- Download the latest symfony 1.4 from
  http://www.symfony-project.org/installation/1_4

- Specify the path to your symfony installation in
  `FACPUBS/config/ProjectConfiguration.class.php`

- If you wish to use a non-default data store, configure it in
  `FACPUBS/config/databases.yml`

- In some versions of PHP (e.g. 5.2.17), you will need to change the
  following line in `FACPUBS/lib/model/doctrine/FacultyTable.class.php`:

        public function retrieveForYnAjax( $term, $limit = 10, array $not = array() )
  to

        public function retrieveForYnAjax( $term, $limit, array $not )

- Run some symfony commands to initialize your installation:

        php symfony plugin:publish-assets
        php symfony doctrine:build --all

- Make sure your webserver has read-write privileges

- Point your webserver at `FACPUBS/web`

Operation
---------

For backend access, use http://yoursite.com/backend.php

No authentication is included with facpubs; we used regular HTTP Basic
authentication.

Start by adding subjects, schools, and publication types. Then you can add
faculty and publications.

Slugs refer to the URL-friendly version of a string; for example, the slug
for a school `School of Health Sciences` might be `health-sciences`

Theming
-------

You can edit the frontend template at
`FACPUBS/apps/frontend/templates/layout.php`

Theming for the tabs is available at
http://jqueryui.com/themeroller/

Selecting the options for the themeroller may be more involved that it
seems it should; if you're stuck, drop us a line.

Contact
-------

If anything is broken, please don't hesitate to contact us at
yitznewton@hotmail.com

