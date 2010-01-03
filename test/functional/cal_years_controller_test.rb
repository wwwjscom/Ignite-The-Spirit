require 'test_helper'

class CalYearsControllerTest < ActionController::TestCase
  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:cal_years)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create cal_year" do
    assert_difference('CalYear.count') do
      post :create, :cal_year => { }
    end

    assert_redirected_to cal_year_path(assigns(:cal_year))
  end

  test "should show cal_year" do
    get :show, :id => cal_years(:one).to_param
    assert_response :success
  end

  test "should get edit" do
    get :edit, :id => cal_years(:one).to_param
    assert_response :success
  end

  test "should update cal_year" do
    put :update, :id => cal_years(:one).to_param, :cal_year => { }
    assert_redirected_to cal_year_path(assigns(:cal_year))
  end

  test "should destroy cal_year" do
    assert_difference('CalYear.count', -1) do
      delete :destroy, :id => cal_years(:one).to_param
    end

    assert_redirected_to cal_years_path
  end
end
