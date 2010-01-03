class CreateMonths < ActiveRecord::Migration
  def self.up
    create_table :months do |t|
      t.string :month
    end

    Month.create(:month => 'January')
    Month.create(:month => 'February')
    Month.create(:month => 'March')
    Month.create(:month => 'April')
    Month.create(:month => 'May')
    Month.create(:month => 'June')
    Month.create(:month => 'July')
    Month.create(:month => 'August')
    Month.create(:month => 'September')
    Month.create(:month => 'October')
    Month.create(:month => 'November')
    Month.create(:month => 'December')
  end

  def self.down
    drop_table :months
  end
end
