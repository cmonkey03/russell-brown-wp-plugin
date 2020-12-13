# PRACTICE WORDPRESS PLUGIN

## INSTRUCTIONS TO BUILD THIS PLUGIN
- Your repository should include a well organized and detailed README.md file which explains what the plugin does and any special instructions that users would need to install and/or use the plugin.
- The plugin should register a custom post type and add a menu item for the custom post type to the left hand rail navigation in WP Admin.
- The custom post type should have a title field and should support the Gutenberg editor. It doesn't need to support anything else.
- Add a custom metabox to your custom post type. The metabox should have a text field within it for a text string. Label and name the field whatever you would like.
- Last, add the text field from your custom meta box to the REST API endpoint for your custom post type so that a query for your custom post type will include the post meta data from your custom meta box.

- Don't hesitate to ask questions. Asking for clarification or help demonstrates that you are willing to learn and interested in quality. 
- Don't stress too much about whether you are doing things the "right" way. Just do things in the way that you think is best and be sure to explain *why* you did things that way. 
- Be sure to comment your code extensively.

## LOCAL DEVELOPMENT SETUP
1. Use [Wordpress Docker Compose](https://github.com/nezhar/wordpress-docker-compose)
2. Add plugin as submodule
```
$ cd /wp-app/wp-content/plugins
$ git submodule add https://github.com/cmonkey03/russell-brown-wp-plugin
```

### TO INSTALL LOCAL PHP CODESNIFFER
Add PHP Codesniffer to check for WPVIP code standards.

#### INSTALL COMPOSER ON PROJECT
[Install Composer](https://getcomposer.org/download/)

#### INSTALL CODESNIFFER ON PROJECT
[Install Codesniffer](https://wpvip.com/documentation/how-to-install-php-code-sniffer-for-wordpress-vip/)
```
$ php composer.phar require --dev automattic/vipwpcs dealerdirect/phpcodesniffer-composer-installer
$ which vendor/bin/phpcs
```
Should return the path to phpcs

#### VS CODE LINTING
[install php codesniffer plugin](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs)
edit settings.json:
```
{
    "window.zoomLevel": 0,
    "phpcs.autoConfigSearch": false,
    "phpcs.executablePath": "./wp-app/wp-content/plugins/russell-brown-wp-plugin/vendor/bin/phpcs",
    "phpcs.enable": true,
}
```

#### CLI CODESNIFFER
`phpcs` is the executable command, so run it from the vendor/bin directory
```
$ vendor/bin/phpcs --standard=WordPress-VIP-Go -sp --basepath=. --ignore=vendor .
```

- Ensure .gitignore
- phpcs.xml.dist adds configuration
- compose.json has additional settings
