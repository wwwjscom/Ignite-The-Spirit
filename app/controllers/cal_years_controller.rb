class CalYearsController < ApplicationController
  # GET /cal_years
  # GET /cal_years.xml
  def index
    @cal_years = CalYear.all

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @cal_years }
    end
  end

  # GET /cal_years/1
  # GET /cal_years/1.xml
  def show
    @cal_year = CalYear.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @cal_year }
    end
  end

  # GET /cal_years/new
  # GET /cal_years/new.xml
  def new
    @cal_year = CalYear.new

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @cal_year }
    end
  end

  # GET /cal_years/1/edit
  def edit
    @cal_year = CalYear.find(params[:id])
  end

  # POST /cal_years
  # POST /cal_years.xml
  def create
    @cal_year = CalYear.new(params[:cal_year])

    respond_to do |format|
      if @cal_year.save
        flash[:notice] = 'CalYear was successfully created.'
        format.html { redirect_to(@cal_year) }
        format.xml  { render :xml => @cal_year, :status => :created, :location => @cal_year }
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @cal_year.errors, :status => :unprocessable_entity }
      end
    end
  end

  # PUT /cal_years/1
  # PUT /cal_years/1.xml
  def update
    @cal_year = CalYear.find(params[:id])

    respond_to do |format|
      if @cal_year.update_attributes(params[:cal_year])
        flash[:notice] = 'CalYear was successfully updated.'
        format.html { redirect_to(@cal_year) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @cal_year.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /cal_years/1
  # DELETE /cal_years/1.xml
  def destroy
    @cal_year = CalYear.find(params[:id])
    @cal_year.destroy

    respond_to do |format|
      format.html { redirect_to(cal_years_url) }
      format.xml  { head :ok }
    end
  end
end
