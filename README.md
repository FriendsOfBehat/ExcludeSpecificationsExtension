# Skip Extension [![License](https://img.shields.io/packagist/l/friends-of-behat/skip-extension.svg)](https://packagist.org/packages/friends-of-behat/skip-extension) [![Version](https://img.shields.io/packagist/v/friends-of-behat/skip-extension.svg)](https://packagist.org/packages/friends-of-behat/skip-extension) [![Build status on Linux](https://img.shields.io/travis/FriendsOfBehat/SkipExtension/master.svg)](http://travis-ci.org/FriendsOfBehat/SkipExtension) [![Scrutinizer Quality Score](https://img.shields.io/scrutinizer/g/FriendsOfBehat/SkipExtension.svg)](https://scrutinizer-ci.com/g/FriendsOfBehat/SkipExtension/)

Allows to skip features and scenarios in Behat tests.

## Usage

1. Install it:
    
    ```bash
    $ composer require friends-of-behat/skip-extension --dev
    ```

2. Enable it in your Behat configuration and list features that needs to be skipped:
    
    ```yaml
    # behat.yml
    default:
        # ...
        extensions:
            SkipExtension:
               features:
                   - vendor/library/features/feature_to_be_skipped.feature
                   - vendor/library/features/another_feature_to_be_skipped.feature
    ```

3. That's it! :tada: Listed features are going to be skipped while executing Behat tests.
