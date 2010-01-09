Feature: Manage cal_years
  In order to [goal]
  [stakeholder]
  wants [behaviour]
  
	Scenario: Order cal_year (numeric only)
		Given the following cal_years:
			| year |
			| 2009 |
			| 2007 |
			| 2004 |
			| 2008 |
		When I go to path "/meet"
    Then I should see "2009" within "span[class=years] ul li[class='0']"
    And I should see "2008" within "span[class=years] ul li[class='1']"
    And I should see "2004" within "span[class=years] ul li[class='3']"


	Scenario: Order cal_year (alpha_num)
		Given the following cal_years:
			| year |
			| 2009 |
			| 2007 - Men |
			| 2007 - Women |
			| 2004 |
			| 2008 |
		When I go to path "/meet"
    Then I should see "2009" within "span[class=years] ul li[class='0']"
    And I should see "2007 - Men" within "span[class=years] ul li[class='2']"
    And I should see "2007 - Women" within "span[class=years] ul li[class='3']"



#  Scenario: Register new cal_year
#    Given I am on the new cal_year page
#    And I press "Create"
#
#  Scenario: Delete cal_year
#    Given the following cal_years:
#      ||
#      ||
#      ||
#      ||
#      ||
#    When I delete the 3rd cal_year
#    Then I should see the following cal_years:
#      ||
#      ||
#      ||
#      ||
