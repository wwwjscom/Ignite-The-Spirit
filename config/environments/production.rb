# Settings specified here will take precedence over those in config/environment.rb

# The production environment is meant for finished, "live" apps.
# Code is not reloaded between requests
config.cache_classes = true

# Full error reports are disabled and caching is turned on
config.action_controller.consider_all_requests_local = false
config.action_controller.perform_caching             = true
config.action_view.cache_template_loading            = true

# See everything in the log (default is :info)
# config.log_level = :debug

# Use a different logger for distributed setups
# config.logger = SyslogLogger.new

# Use a different cache store in production
# config.cache_store = :mem_cache_store

# Enable serving of images, stylesheets, and javascripts from an asset server
# config.action_controller.asset_host = "http://assets.example.com"

# Disable delivery errors, bad email addresses will be ignored
# config.action_mailer.raise_delivery_errors = false

# Enable threaded mode
# config.threadsafe!



# Heroku email config
# http://docs.heroku.com/smtp
# http://wiki.slicehost.com/doku.php?id=lightweight_mail_relay_to_google_apps_or_gmail_smtp_server#a_lightweight_smtp_relay_using_google_apps_email
# http://github.com/collectiveidea/action_mailer_optional_tls
require "smtp_tls"
ActionMailer::Base.delivery_method = :smtp
ActionMailer::Base.smtp_settings = {
  :tls => true, 
  :address        => 'smtp.gmail.com',
  :port           => 587,
  :domain         => 'ignitethespirit.org',
  :authentication => :plain,
  :user_name      => 'admin@ignitethespirit.org',
  :password       => '746U86'
}
