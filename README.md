# Dunkers kulturhus

## Getting started

### WordPress Configuration

1. Duplicate the ```config/database-example.php``` file and rename it to ```database.php```. Fill in your database credentials.
2. Duplicate the ```config/salts-example.php``` and rename it to ```salts.php```. Fill in new salt values.

### Composer

Composer is a PHP dependency manager. We use it to install and maintain the main dependencies of this project. To install the component follow the below steps:

1. Install Composer (http://getcomposer.org) if you haven't done so already.
2. Open terminal and run the following command from the project folder: ```composer install```

To update dependencies run ```composer update``` from the project folder in your terminal.

### Blade Cache

We're using the templating engine Blade. Blade needs a folder for its cache files. Please run the following command to create it:

```
mkdir -p wp-content/uploads/cache/blade-cache
```

### Node Modules

Run the following command to install JavaScript dependencies needed.

```
find . -name package.json -maxdepth 4 -execdir npm install \;
```
