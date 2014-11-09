Symfony DDD Edition
========================

Welcome to the Symfony DDD Edition - a fully-functional Symfony2
application that you can use as the skeleton for your new applications.

[![Build Status](https://travis-ci.org/crafics/symfony-ddd-edition?branch=master)](https://travis-ci.org/crafics/symfony-ddd-edition)
[![Coverage Status](https://coveralls.io/repos/crafics/symfony-ddd-edition/badge.png?branch=master)](https://coveralls.io/r/crafics/symfony-ddd-edition?branch=master)

This edition is a modified clone of the great gimler/symfony-rest-edition.

This document contains information on how to download, install, and start
using Symfony. For a more detailed explanation, see the [Installation][1]
chapter of the Symfony Documentation.

1) Installing the DDD Edition
----------------------------------

When it comes to installing the Symfony DDD Edition, you have the
following options.

### Use Composer (*recommended*)

As Symfony uses [Composer][2] to manage its dependencies, the recommended way
to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `create-project` command to generate a new Symfony application:

    php composer.phar create-project crafics/symfony-ddd-edition --stability=dev path/to/install

Composer will install Symfony and all its dependencies under the
`path/to/install` directory.

### Download an Archive File

To quickly test Symfony, you can also download an [archive][3] of the Standard
Edition and unpack it somewhere under your web server root directory.

If you downloaded an archive "without vendors", you also need to install all
the necessary dependencies. Download composer (see above) and run the
following command:

    php composer.phar install

2) Checking your System Configuration
-------------------------------------

Before starting coding, make sure that your local system is properly
configured for Symfony.

Execute the `check.php` script from the command line:

    php app/check.php

Access the `config.php` script from a browser:

    http://localhost/path/to/symfony/app/web/config.php

If you get any warnings or recommendations, fix them before moving on.
