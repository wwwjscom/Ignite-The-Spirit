class Admin < ActiveRecord::Base

  # Unless the pw is right, bounce em!
  def self.bounce?(pw)
    not pw == ADMIN_PW
  end
end
