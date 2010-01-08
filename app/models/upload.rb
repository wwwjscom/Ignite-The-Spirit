class Upload < ActiveRecord::Base
  belongs_to :bio

  has_attachment :storage => :s3

  #validates_as_attachment


  # Delete that pesky 2nd entry that for some reason,
  # attachment_fu created, even if you don't wnat a
  # thumb
  def after_save
    if filename.blank?
      Upload.delete(id)
    end
  end

  # Stub method, required.
  def self.thumb
  end

  # Delete the old bio image before uploading a new one
  def self.delete_old(thumb, bio_id)
    logger.info "Thumb: #{thumb}"
    old = Upload.find(:first, :conditions => ["thumb = ? AND bio_id = ?", thumb, bio_id])
    Upload.delete(old.id) unless old.blank?
  end
end
