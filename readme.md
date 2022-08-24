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