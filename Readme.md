# Raygun Error Tracking 

#### The Official Raygun error tracking tool for Magento 2

Allowing you to be aware of issues as they happen on your Magento 2 site. 


* Immediate registry of errors allows you to fix bugs proactively 
* IP details of users affected
* Occurance times and duration of the issue 
* Intergration into Slack messagener( errors reported in slack channel ) 
* Can uncover hacking attempts 
* Magento 1 version here - [Raygun 1.0](https://github.com/springtimesoft/springtimesoft_raygun)

### Prerequisites

* Composer 
* Magento 2.2 +
* Raygun.io account / API Key
* Slack messenger ( optional )

### Installing

##### Instructions for Composer :
* Add or update your composer.json in the root of your Magento install


```
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
```

* Navigate to the root folder in your terminal and run :
```
composer update 
```
##### Manual Instructions :

* Download this repo and place the `Springtimesoft` folder inside the `htdocs > app > code` 


##### Run commands in your Magento 2 project :

```
php bin/magento cache:clean
php bin/magento setup: upgrade
```

##### Configure the Raygun extension inside the Magento 2 admin :
* Navigate to `Store > Configuration` and the to the Raygun tab. 
* Enter your API key from Raygun.io ( [Raygun](https://app.raygun.com/signup)
 )
* The extension is enabled by default, disable will stop errors being sent to Raygun
* Next log out and then back in, this is to prevent a 404 error from occurring when accessing the configuration page.
* There is the option to disable errors from your local project , just enter your local url eg. `mymagentoshop.dev`


## Running the tests

* Test that raygun is working and configured correctly by throwing error `<?php throw new Exception('test'); ?>.`
* The Error should appear in your raygun account

## Built With

* [Raygun4PHP](https://github.com/MindscapeHQ/raygun4php) - Raygun.io client for php
* [Magento 2](http://devdocs.magento.com/) - Magento 2 ecommerce framework

## Support

* Please use the Q&A section on Magento Connect, or the GitHub issue tracker for any questions.
* For more information about this extension, please visit the Raygun website.
