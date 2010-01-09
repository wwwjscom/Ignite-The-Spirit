class CalYear < ActiveRecord::Base
  has_many :bio, :dependent => :destroy

  def bios
    Bio.find(:all, :conditions => ['cal_year_id = ?', self.id], :order => 'month_id')
  end

  # Returnes all cal years, ordered by cal year
  # Ordering: ASEC or DSC
  def self.all_ordered ordering = "DESC"
    self.find(:all, :order => ["year ", ordering])
  end
end
