Feature: Skipping single feature file
    In order to not run Behat feature which I don't want to be executed
    As a Behat User
    I want to exclude specific files

    Scenario: Excluded features are not execuded
        Given a Behat configuration containing:
        """
        default:
            extensions:
                FriendsOfBehat\ExcludeSpecificationsExtension:
                    features:
                        - "features/excluded.feature"
        """
        And a context file "features/bootstrap/FeatureContext.php" containing:
        """
        <?php

        use Behat\Behat\Context\Context;

        class FeatureContext implements Context
        {
            /**
             * @When I do nothing
             */
            public function iDoNothing()
            {
            }
        }
        """
        And a feature file "features/excluded.feature" containing:
        """
        Feature: Feature to exclude

            Scenario: Doing nothing
                When I do nothing
        """
        And a feature file "features/not_excluded.feature" containing:
        """
        Feature: Feature not to exclude

            Scenario: Doing nothing
                When I do nothing
        """
        When I run Behat
        Then it should pass with:
        """
        1 scenario (1 passed)
        """

