#!/usr/bin/python

import urllib
import re
import smtplib
import string
from xml.dom import minidom
from email.mime.text import MIMEText

WEATHER_URL = 'http://xml.weather.yahoo.com/forecastrss?p=%s'
WEATHER_NS = 'http://xml.weather.yahoo.com/ns/rss/1.0'
RAIN_CODES = (5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 17, 18, 35, 40, 45)
USERS_URL = 'http://www.dailyraincheck.com/users.php?password=redacted' # yes, it's not secure, but this is a quick hack
HOST = 'outgoing.mit.edu'
FROM = 'landa@mit.edu'

def weather_for_zip(zip_code):
  url = WEATHER_URL % zip_code
  dom = minidom.parse(urllib.urlopen(url))
  forecasts = []
  for node in dom.getElementsByTagNameNS(WEATHER_NS, 'forecast'):
    forecasts.append({
      'date': node.getAttribute('date'),
      'low': node.getAttribute('low'),
      'high': node.getAttribute('high'),
      'condition': node.getAttribute('text'),
      'code': node.getAttribute('code')
    })
  ycondition = dom.getElementsByTagNameNS(WEATHER_NS, 'condition')[0]
  return {
    'current_condition': ycondition.getAttribute('text'),
    'current_temp': ycondition.getAttribute('temp'),
    'forecasts': forecasts,
    'title': dom.getElementsByTagName('title')[0].firstChild.data
  }

def validateEmail(email):
  if len(email) > 7:
    if re.match("^.+\\@(\\[?)[a-zA-Z0-9\\-\\.]+\\.([a-zA-Z]{2,3}|[0-9]{1,3})(\\]?)$", email) != None:
      return True
  return False

def validatePhone(phone):
  if re.match("\\d{11}", phone) != None:
    return True
  return False

def validateZipcode(zipcode):
  if re.match("\\d{5}", zipcode) != None:
    return True
  return False

users = []
user_list = urllib.urlopen(USERS_URL)
for line in user_list.read().splitlines():
  users.append(line.split(','))

server = smtplib.SMTP(HOST)

for user in users:
  zipcode, email, phone = user
  if not validateZipcode(zipcode): continue
  weather = weather_for_zip(zipcode)
  forecast = weather["forecasts"][0]
  if int(forecast["code"]) in RAIN_CODES:
    message = forecast["condition"] + "; hi=" + forecast["high"] + ", lo=" + forecast["low"] + "."
    print message
    if validateEmail(email):
      print "Sending email to", email
      body = "Subject: %s\nBrought to you by DailyRainCheck.com" % message
      server.sendmail(FROM, [email], body)
    print ""
server.quit()
