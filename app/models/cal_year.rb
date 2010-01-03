class CalYear < ActiveRecord::Base
  has_many :bio

  def bios
    Bio.find(:all, :conditions => ['cal_year_id = ?', self.id], :order => 'month_id')
  end
end
