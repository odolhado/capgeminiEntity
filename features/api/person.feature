@api @database

Feature: Person
  As an admin
  I want to use manage People
  In order to


  Scenario: Get person
    Given I set header "Content-Type" with value "application/json"
    And I set header "Accept" with value "application/json"
    When I send a GET request to "/api/people/4"
    Then the JSON should match pattern:
    """
    {
      "id": "@string@"
    }
    """


  Scenario: Create person
    Given I set header "Content-Type" with value "application/json"
    And I set header "Accept" with value "application/json"
    When I send a POST request to "/api/people" with body:
    """
    {
      "title": "Section",
      "type": "collectionSpec"
    }
    """
    Then the JSON should match pattern:
    """
    {
      "id": "@string@"
    }
    """

