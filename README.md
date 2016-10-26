# Skip Extension

Allows to skip features and scenarios in Behat tests.

## Usage

1. Install it:
    
    ```bash
    $ composer require mzalewski/skip-extension --dev
    ```

2. Enable it in your Behat configuration and list features that needs to be skipped:
    
    ```yaml
    default:
        # ...
        extensions:
            SkipExtension:
               features:
                   - vendor/library/features/feature_to_be_skipped.feature
                   - vendor/library/features/another_feature_to_be_skipped.feature
    ```

3. That's it! :tada: Listed features are going to be skipped while executing Behat tests.
