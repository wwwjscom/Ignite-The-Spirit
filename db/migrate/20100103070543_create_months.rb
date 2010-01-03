class CreateMonths < ActiveRecord::Migration
  def self.up
    create_table :months do |t|
      t.string :month
    end

    Month.create(:month => 'Janurary')
    Month.create(:month => 'Feburary')
  end

  def self.down
    drop_table :months
  end
end
