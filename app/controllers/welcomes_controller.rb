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
  end

end
