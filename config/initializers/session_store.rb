# Be sure to restart your server when you modify this file.

# Your secret key for verifying cookie session data integrity.
# If you change this key, all old sessions will become invalid!
# Make sure the secret is at least 30 characters and all random, 
# no regular words or you'll be exposed to dictionary attacks.
ActionController::Base.session = {
  :key         => '_ITS_session',
  :secret      => 'af13c0fa5b0f56f22c4b8ff76c3eb77c7a917771ac6c987433ef1a593122512821bbae6be03594ecbc1d742af86ccc6b9e9dbdcbda885dd5cf686a8d8b98f3b2'
}

# Use the database for sessions instead of the cookie-based default,
# which shouldn't be used to store highly confidential information
# (create the session table with "rake db:sessions:create")
# ActionController::Base.session_store = :active_record_store
