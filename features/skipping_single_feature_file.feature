Feature: Skipping single feature file
    In order to not run Behat feature which I don't want to be executed
    As a Behat User
    I want to skip specific files

    Background:
        Given a Behat configuration containing:
        """
        default:
            extensions:
                FriendsOfBehat\SkipExtension:
                    features:
                        - "features/skip.feature"
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
        And a feature file "features/skip.feature" containing:
        """
        Feature: Feature to skip

            Scenario: Doing nothing
                When I do nothing
        """
        And a feature file "features/run.feature" containing:
        """
        Feature: Feature to run

            Scenario: Doing nothing
                When I do nothing
        """

    Scenario: Seeing information about skipped features
        When I run Behat
        Then it should pass with:
        """
        1 scenario (1 passed)
        """

