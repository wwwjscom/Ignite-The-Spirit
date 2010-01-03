class CreateCalYears < ActiveRecord::Migration
  def self.up
    create_table :cal_years do |t|
      t.integer :year

      t.timestamps
    end
  end

  def self.down
    drop_table :cal_years
  end
end
