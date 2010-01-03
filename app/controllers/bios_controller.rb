class BiosController < ApplicationController

  before_filter :bouncer, :except => [:index, :show]

  # GET /bios
  # GET /bios.xml
  def index
    @bios = Bio.all

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @bios }
    end
  end

  # GET /bios/1
  # GET /bios/1.xml
  def show
    @bio = Bio.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @bio }
    end
  end

  # GET /bios/new
  # GET /bios/new.xml
  def new
    @bio = Bio.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @bio }
    end
  end

  # GET /bios/1/edit
  def edit
    @bio = Bio.find(params[:id])
  end

  # POST /bios
  # POST /bios.xml
  def create
    @bio = Bio.new(params[:bio])

    respond_to do |format|
      if @bio.save
        flash[:notice] = 'Bio was successfully created.'
        format.html { redirect_to(@bio) }
        format.xml  { render :xml => @bio, :status => :created, :location => @bio }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @bio.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /bios/1
  # PUT /bios/1.xml
  def update
    @bio = Bio.find(params[:id])

    respond_to do |format|
      if @bio.update_attributes(params[:bio])
        flash[:notice] = 'Bio was successfully updated.'
        format.html { redirect_to(@bio) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @bio.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /bios/1
  # DELETE /bios/1.xml
  def destroy
    @bio = Bio.find(params[:id])
    @bio.destroy

    respond_to do |format|
      format.html { redirect_to(bios_url) }
      format.xml  { head :ok }
    end
  end
end
