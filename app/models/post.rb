class Post < ActiveRecord::Base

  def self.recent(posts = 1)
    if posts == 1
      self.last
    else
      self.find(:all, :order => 'id DESC', :limit => posts)
    end
  end
end
