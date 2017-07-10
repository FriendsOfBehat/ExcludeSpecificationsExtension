# Exclude Specifications Extension [![License](https://img.shields.io/packagist/l/friends-of-behat/exclude-specifications-extension.svg)](https://packagist.org/packages/friends-of-behat/exclude-specifications-extension) [![Version](https://img.shields.io/packagist/v/friends-of-behat/exclude-specifications-extension.svg)](https://packagist.org/packages/friends-of-behat/exclude-specifications-extension) [![Build status on Linux](https://img.shields.io/travis/FriendsOfBehat/ExcludeSpecificationsExtension/master.svg)](http://travis-ci.org/FriendsOfBehat/ExcludeSpecificationsExtension) [![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/FriendsOfBehat/ExcludeSpecificationsExtension.svg)](https://scrutinizer-ci.com/g/FriendsOfBehat/ExcludeSpecificationsExtension/)

Allows to exclude features or scenarios in Behat tests.

## Usage

1. Install it:
    
    ```bash
    $ composer require friends-of-behat/exclude-specifications-extension --dev
    ```

2. Enable it in your Behat configuration and list features that needs to be excluded:
    
    ```yaml
    # behat.yml
    default:
        # ...
        extensions:
            FriendsOfBehat\ExcludeSpecificationsExtension:
               features:
                   - vendor/library/features/feature_to_be_skipped.feature
                   - vendor/library/features/another_feature_to_be_skipped.feature
    ```

3. That's it! :tada: Listed features are going to be excluded while executing Behat tests.
