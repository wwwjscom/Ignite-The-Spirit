class CreateUploads < ActiveRecord::Migration
  def self.up
    create_table :uploads do |t|
      t.string :filename
      t.integer :size
      t.string :content_type
      t.integer :bio_id
      t.boolean :thumb
    end
  end

  def self.down
    drop_table :uploads
  end
end
