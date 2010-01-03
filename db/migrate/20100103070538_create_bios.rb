class CreateBios < ActiveRecord::Migration
  def self.up
    create_table :bios do |t|
      t.string :name
      t.string :thumb_image_url
      t.string :full_image_url
      t.text :bio
      t.integer :cal_year_id
      t.integer :month_id

      t.timestamps
    end
  end

  def self.down
    drop_table :bios
  end
end
