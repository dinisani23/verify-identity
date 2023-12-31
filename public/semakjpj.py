import pymysql
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
from twocaptcha import TwoCaptcha
import time
import sys
from bs4 import BeautifulSoup
import mysql.connector

# Connect to the database
connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             db='attemptdb')
cursor = connection.cursor()
cursor.execute('SELECT input_dlID FROM input_dl WHERE id = (SELECT MAX(id) FROM input_dl)')
icNum = cursor.fetchone()
cursor.close()
connection.close()

#toScrape = 'https://www.jpj.gov.my/web/main-site/semakan-tarikh-luput-lesen-memandu'
chrome_options = webdriver.ChromeOptions()
chrome_options.add_argument('--disable-gpu')
chrome_options.add_argument("--headless")
browser = webdriver.Chrome(options=chrome_options)
browser.get('https://www.jpj.gov.my/web/main-site/semakan-tarikh-luput-lesen-memandu')

select_element = browser.find_element(By.ID, '_drivinglicense_WAR_JPJDXPPluginportlet_catid')
select = Select(select_element)
select.select_by_value('1')
browser.find_element(By.ID, '_drivinglicense_WAR_JPJDXPPluginportlet_idNumber').send_keys(icNum)

captcha_img = browser.find_element(By.CLASS_NAME, 'captcha')
captcha_img.screenshot('public\\captchas\\captcha.png')

api_key = "7ef16b5d6c0511db3fe5fc1300d45e66"

solver = TwoCaptcha(api_key)

try:
    balance = solver.balance()    
    result = solver.normal('public\\captchas\\captcha.png')

except Exception as e:
    #print('An error has occured. Please try again later')
    sys.exit(e);

else:
    code = result['code']
    #sys.exit('result: ' + str(result) + ',balance: ' + str(balance))
    result = str(result)
    browser.find_element(By.ID, '_drivinglicense_WAR_JPJDXPPluginportlet_captchaText').send_keys(code)
    browser.find_element(By.XPATH, '//*[@id="submitAjax"]').click()
    #wait = WebDriverWait(browser, 30)
    #wait.until(EC.presence_of_element_located((By.ID, 'resultAjax')))
    #result_img = browser.find_element(By.CSS_SELECTOR, "#resultAjax .box")
    WebDriverWait(browser, 80).until(EC.presence_of_element_located((By.CSS_SELECTOR, "#resultAjax .box")))
    html = browser.page_source
    soup = BeautifulSoup(html, 'html.parser')
    span = soup.find('span', id='resultAjax')
    
    if span.find('p', align='left'):
        mydb = mysql.connector.connect(host="localhost",
        user="root",
        password="",
        database="attemptdb")
        mycursor = mydb.cursor()

        #res = soup.select_one('div', {'id': 'resultAjax'}).find('div', {'class': '1'})
        soup = BeautifulSoup(str(span), 'html.parser')
        spans = soup.find_all('span')
        #spans = res.find_all('span')
        nama = spans[2].text
        id = spans[4].text
        category = spans[6].text
        #if len(spans) > 1:
            #nama = spans[2].text
        #else:
            #nama = 'Not found'
        #one = soup.find('p', string='Nama : ').find_next_sibling('p').text.strip()
        #two = soup.find('p', string='No. Pengenalan  : ').find_next_sibling('p').text.strip()
        #three = soup.find('p', string='Kategori ID : ').find_next_sibling('p').text.strip()
        jpjData = [nama, id, category]
        sql = "INSERT INTO scraped_dl (jpj_name,jpj_ICnum,jpj_category) VALUES (%s, %s, %s)"
        mycursor.execute(sql, jpjData)
        #print(jpjData)

        query = '''SELECT * FROM input_dl ORDER BY id DESC LIMIT 1'''
        mycursor.execute(query)
        latest_row = mycursor.fetchone()
        update_query = '''UPDATE input_dl SET input_dlResult = %s WHERE id = %s'''
        mycursor.execute(update_query, ('TRUE', latest_row[0]))
        mydb.commit()
    else:
        mydb = mysql.connector.connect(host="localhost",
        user="root",
        password="",
        database="attemptdb")
        mycursor = mydb.cursor()

        sql = "INSERT INTO scraped_dl (jpj_name,jpj_ICnum,jpj_category) VALUES (%s, %s, %s)"
        val = ["-", "-", "-", "-"]
        mycursor.execute(sql, val)

        query = '''SELECT * FROM input_dl ORDER BY id DESC LIMIT 1'''
        mycursor.execute(query)
        latest_row = mycursor.fetchone()
        update_query = '''UPDATE input_dl SET input_dlResult = %s WHERE id = %s'''
        mycursor.execute(update_query, ('FALSE', latest_row[0]))
        mydb.commit()
time.sleep(90)