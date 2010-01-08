class Bio < ActiveRecord::Base
  has_many :upload
  belongs_to :month
  belongs_to :cal_year

  def month
    Month.find(self.month_id).month
  end

  def cal_year
    CalYear.find(self.cal_year_id).year
  end

  def thumb_image
    Upload.find(:first, :conditions => ["thumb = ? AND bio_id = ?", true, self.id])
  end

  def full_image
    Upload.find(:first, :conditions => ["thumb = ? AND bio_id = ?", false, self.id])
  end

end
