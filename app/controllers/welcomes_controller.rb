class WelcomesController < ApplicationController

  def index
  end

  def about
  end

  def supporters
  end

  def contact
    if request.post?
      msg = { :msg => params[:msg], :name => params[:name], :email => params[:email] }
      Postoffice.deliver_contact_form(msg)
      render :action => 'contact_thanks'
    end
  end

  def contact_thanks
  end

end
