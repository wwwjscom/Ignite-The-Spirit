class WelcomesController < ApplicationController

  def index
  end

  def about
  end

  def supporters
  end

  def contact
    render :action => 'contact_thanks' if request.post?
  end

  def contact_thanks
    msg = { :msg => params[:msg], :name => params[:name], :email => params[:email] }
    Postoffice.deliver_contact_form(msg)
  end

end
