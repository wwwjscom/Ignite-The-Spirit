class CalYear < ActiveRecord::Base
  has_many :bio, :dependent => :destroy

  def bios
    Bio.find(:all, :conditions => ['cal_year_id = ?', self.id], :order => 'month_id')
  end
end
