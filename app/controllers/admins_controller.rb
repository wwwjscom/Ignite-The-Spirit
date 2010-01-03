class AdminsController < ApplicationController

  before_filter :bouncer, :except => [:login]

  # GET /admins
  # GET /admins.xml
  def index
    redirect_to posts_path
  end

  def login
    # Just redirect if already logged in
    if session[:admin]
      redirect_to :action => 'index'
    end

    # Otherwise check the login info
    if request.post?
      unless Admin.bounce?(params[:password])
        session[:admin] = true
        redirect_to :action => 'index'
      end
    end
  end

end
