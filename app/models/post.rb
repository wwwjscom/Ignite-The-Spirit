class Post < ActiveRecord::Base

  def self.recent
    self.last
  end
end
