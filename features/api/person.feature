@api @database

Feature: Person
  As an admin
  I want to use manage People
  In order to


  Scenario: Get person
    Given I set header "Content-Type" with value "application/json"
    And I set header "Accept" with value "application/json"
    When I send a GET request to "/people/4"
    And print response
    Then the JSON should match pattern:
    """
    "Person {id: 4} does not exists"
    """


  Scenario: Create person
    Given I set header "Content-Type" with value "application/json"
    And I set header "Accept" with value "application/json"
    When I send a POST request to "/people" with body:
    """
    {
      "name": "odo",
      "surname": "Rapampam"
    }
    """
    And print response
    Then the JSON should match pattern:
    """
    @string@
    """

