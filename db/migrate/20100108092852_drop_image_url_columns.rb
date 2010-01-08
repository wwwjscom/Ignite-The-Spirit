class DropImageUrlColumns < ActiveRecord::Migration
  def self.up
    remove_column :bios, :thumb_image_url
    remove_column :bios, :full_image_url
  end

  def self.down
    add_column :bios, :thumb_image_url, :string
    add_column :bios, :full_image_url, :string
  end
end
