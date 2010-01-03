class Postoffice < ActionMailer::Base

  # Send a new client a welcome email
  def contact_form(msg)
    recipients    "admin@ignitethespirit.org"
    from          "ITS Admin <admin@ignitethespirit.org>"
    reply_to      "#{msg[:name]} <#{msg[:email]}>"
    bcc           "richpinskey@aol.com, ksoo45@gmail.com"
    subject       "[Ignite The Spirit] Contact Form"
    sent_on       Time.now
    body          :msg => msg
    content_type  "text/html"
  end

end
