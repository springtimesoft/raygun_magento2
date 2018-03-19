Raygun
This is the official provider for the Raygun error reporting and tracking service built by Springtimesoft, allowing you to automatically send errors and exceptions to Raygun from your Magento 2 site.

Features
Simple Magento admin section to configure the extension and set up your API key
Adds Magento version and user details for easier debugging
Supports Magento 2.2 & later
Uses Raygun4PHP
Set up
Instructions for Composer:
Add or update your composer.json in the root of your Magento install:

{
    "name": "yourcompany/your-magento-project",
    "repositories": [
            {
                    "type": "vcs",
                    "url": "https://github.com/springtimesoft/springtimesoft_raygun"
            }
    ],
    "require": {
        "magento-hackathon/magento-composer-installer": "*",
        "springtimesoft/springtimesoft_raygun": "*"
    },
    "extra":{
        "magento-root-dir": "./",
        "magento-force": true
    }
}
Then run composer update followed by composer install.

See https://github.com/magento-hackathon/magento-composer-installer for more information.

Instructions for Modman:
Instructions for manual install
Get a .zip file of the extension contents.
Extract the .zip file in the root of your Magento install.
Configuration
Clear the Magento Cache by navigating to System > Cache Management and refreshing Configuration and Layouts.

Next log out and then back in, this is to prevent a 404 error from occurring when accessing the configuration page.

Now navigate to Stores > Configuration > Raygun > Configuration and enter your Raygun API key. Adjust other options as necessary.

Raygun.io
Raygun detects and diagnoses your software errors in real-time, so your team can fix bugs faster. With an intuitive and powerful web interface, Raygun enables you to view error trends, receive real time updates via email alerts and much more. A 30-day free trial of Raygun is available. This extension allows you to send PHP errors and exceptions generated by your Magento site to Raygun. It is quickly and easily configured using the settings page available from your admin panel.

Support
Please use the Q&A section on Magento Connect, or the GitHub issue tracker for any questions.

For more information about this extension, please visit the Raygun website.

Roadmap
Implement JavaScript error tracking as well
Add a button to the configuration page for throwing a test exception