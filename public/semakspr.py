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
cursor.execute('SELECT input_ID FROM input_data WHERE id = (SELECT MAX(id) FROM input_data)')
icNum = cursor.fetchone()
cursor.close()
connection.close()
icNum = str(icNum[0])
icNum = icNum.replace("-", "")

#toScrape = 'https://mysprsemak.spr.gov.my/semakan/daftarPemilih'
chrome_options = webdriver.ChromeOptions()
chrome_options.add_argument('--disable-gpu')
chrome_options.add_argument("--headless")
browser = webdriver.Chrome(options=chrome_options)
browser.get('https://mysprsemak.spr.gov.my/semakan/daftarPemilih')

captcha_img = browser.find_element(By.ID, 'img_captcha')
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
    browser.find_element(By.XPATH, '//*[@id="formSemak"]/div[1]/input').send_keys(icNum)
    browser.find_element(By.XPATH, '//*[@id="formSemak"]/div[2]/div/div[1]/input').send_keys(code)
    browser.find_element(By.XPATH, '//*[@id="formSemak"]/div[3]/input[1]').click()
    #wait = WebDriverWait(browser, 30)
    #wait.until(EC.presence_of_element_located((By.ID, 'resultAjax')))
    #result_img = browser.find_element(By.CSS_SELECTOR, "#resultAjax .box")
    WebDriverWait(browser, 60).until(EC.presence_of_element_located((By.ID, "outputForm")))
    html = browser.page_source
    soup = BeautifulSoup(html, 'html.parser')
    res = soup.find('div', id='outputForm')
    #res_str = res.text
    #icSPR = soup.find('td', text='No. Kad Pengenalan').find_next_sibling('td').text
    #sprData = []
    
    if res:
        mydb = mysql.connector.connect(host="localhost",
        user="root",
        password="",
        database="attemptdb")
        mycursor = mydb.cursor()

        element = soup.select_one('#outputForm > div > div:first-child')
        soup = BeautifulSoup(str(element), 'html.parser')
        table_cells = soup.find_all('td', {'class': 'w-5/6 text-left py-3 px-4 border-l border'})
        sprData = []
        for cell in table_cells:
            sprData.append(cell.text)
        sql = "INSERT INTO scraped_data (spr_name,spr_ICnum,spr_gender) VALUES (%s, %s, %s)"
        mycursor.execute(sql, sprData)
        #print(sprData)

        #table_rows = soup.find_all('tr')
        #for row in table_rows:
            #table_cells = row.find_all('td', {'class': 'w-5/6 text-left py-3 px-4 border-l border'})
            #sprData = []
            #for cell in table_cells:
                #sprData.append(cell.text)
            #sql = "INSERT INTO scraped_data (spr_name,spr_ICnum,spr_birthdate,spr_gender) VALUES (%s, %s, %s, %s)"
            #mycursor.execute(sql, sprData)
            #print(sprData)

        query = '''SELECT * FROM input_data ORDER BY id DESC LIMIT 1'''
        mycursor.execute(query)
        latest_row = mycursor.fetchone()
        update_query = '''UPDATE input_data SET input_result = %s WHERE id = %s'''
        mycursor.execute(update_query, ('TRUE', latest_row[0]))
        mydb.commit()
    else:
        mydb = mysql.connector.connect(host="localhost",
        user="root",
        password="",
        database="attemptdb")
        mycursor = mydb.cursor()
        sql = "INSERT INTO scraped_data (spr_name,spr_ICnum,spr_gender) VALUES (%s, %s, %s)"
        val = ["-", "-", "-", "-"]
        mycursor.execute(sql, val)
        query = '''SELECT * FROM input_data ORDER BY id DESC LIMIT 1'''
        mycursor.execute(query)
        latest_row = mycursor.fetchone()
        update_query = '''UPDATE input_data SET input_result = %s WHERE id = %s'''
        mycursor.execute(update_query, ('FALSE', latest_row[0]))
        mydb.commit()
time.sleep(90)