class Admin < ActiveRecord::Base

  def self.bounce?(pw)
    pw == ADMIN_PW
  end
end
