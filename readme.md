# Bigup Web Custom Fields

## Goal

Make a single plugin that allows a user to create custom post types and unlimited custom meta fields
which can be applied to any post types. The main purpose, is to easily use WordPress as a headless
CMS without having to manually code custom post types and meta fields for every build.

## Specification

- Create unlimited custom post types.
- Create unlimited custom meta field groups.
- Add meta groups to single posts/pages or post types filtered by IDs and other taxonomy.
- All custom meta fields accessible in Gutenburg editor.
- Make metadata available in REST and GraphQL.
- Options and whole groups can be deleted, updated and imported/exported as json.
- Plugin should be standalone - no dependencies.

## GraphQL Support

To support the WP GraphQL plugin popularly used with React and SSGs like Gatsby, all options are
automatically available in both REST and GraphQL APIs. This option should be deselected by default
for sensitive fields such as passwords.

GraphQL is available outside the WordPress 'admin' context, therefore when registering options and
option sections, they must NOT be registered using is_admin() or they will not appear in GraphQL.

E.g. Hooks used to register options should use 'init' NOT 'admin_init'.

`add_action( 'init', [ &$this, 'do_options' ] );`

https://www.wpbeginner.com/wp-tutorials/how-to-create-custom-post-types-in-wordpress/

https://developer.wordpress.org/reference/functions/register_post_type/#taxonomies

##### TABS
https://nimblewebdeveloper.com/blog/add-tabs-to-wordpress-plugin-admin-page

##### MULTIPLE FORMS ON PAGE
http://www.mendoweb.be/blog/wordpress-settings-api-multiple-forms-on-same-page/


### Linting

This project uses PHP_CodeSniffer (installed via Composer) to lint PHP. It also uses wpcs (WordPress coding standards) 'sniffs' to validate code in adherence with WP coding standards.

To install the project dependencies:
'composer install'

Register an added coding standard (wpcs):
'./vendor/bin/phpcs --config-set installed_paths /vendor/wp-coding-standards/wpcs'

Update your VS Code settings file:
'"./vendor/bin/phpcs.standard": "WordPress"'

Check the installed standards:
'./vendor/bin/phpcs -i'

#### Global install

Install PHP_CodeSniffer globally
'composer global require "squizlabs/php_codesniffer=*"'

Make sure you have the composer bin dir in your PATH. The default value is ~/.composer/vendor/bin/, but you can check the value that you need to use by running 'composer global config bin-dir --absolute'.

#### Usage

Check code
'./vendor/bin/phpcs **/*.php'

Fix Code
'./vendor/bin/phpcbf **/*.php'

Summarize large outputs:
'./vendor/bin/phpcs --report=summary **/*.php'

Specifying a Coding Standard:
'./vendor/bin/phpcs --standard=WordPress /path/to/code/myfile.inc'

[PHP_CodeSniffer Github](https://github.com/squizlabs/PHP_CodeSniffer#installation)
[WordPress Coding Standards for PHP_CodeSniffer Github](https://github.com/WordPress/WordPress-Coding-Standards#installation)

#### PHP8.0 Bugfix

See this README for patching instructions:

'./vendor-wpcs-php8-bugfix/wp-coding-standards/wpcs/WordPress/Sniffs/WhiteSpace/README.md'