Given /^the following cal_years:$/ do |cal_years|
  CalYear.create!(cal_years.hashes)
end

When /^I delete the (\d+)(?:st|nd|rd|th) cal_year$/ do |pos|
  visit cal_years_url
  within("table tr:nth-child(#{pos.to_i+1})") do
    click_link "Destroy"
  end
end

Then /^I should see the following cal_years:$/ do |expected_cal_years_table|
  expected_cal_years_table.diff!(tableish('table tr', 'td,th'))
end
