# Methods added to this helper will be available to all templates in the application.
module ApplicationHelper

  def admin?
    not session[:admin].blank?
  end

  def body_class(body_class)
    content_for(:body_class) { body_class }
  end

  def title(title)
    content_for(:title) { title }
  end

end
