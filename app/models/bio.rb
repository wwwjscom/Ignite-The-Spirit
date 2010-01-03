class Bio < ActiveRecord::Base
  belongs_to :month
  belongs_to :cal_year

  def month
    Month.find(self.month_id).month
  end

  def cal_year
    CalYear.find(self.cal_year_id).year
  end

end
