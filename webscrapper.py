import os
import selenium
from selenium import webdriver
import time
from PIL import Image
import io
import requests
from webdriver_manager.chrome import ChromeDriverManager
from selenium.common.exceptions import ElementClickInterceptedException
import pandas as pd
import csv

driver = webdriver.Chrome(ChromeDriverManager().install())
search_url="https://indiankanoon.org/"
driver.get(search_url)
search_bar = driver.find_element_by_name('formInput')
search_bar.send_keys("robbery")
driver.find_element_by_id('submit-button').click()
driver.find_element_by_link_text('Judgments').click()

li = []
links = []
keywords = []
for j in range(0, 10):
    for i in range(0, 10):
        head = driver.find_elements_by_class_name('result_title')[i].text
        li.append(head)
        title = driver.find_element_by_link_text(head)
        links.append(title.get_attribute('href'))
        str1 = str(i+2)
        str2 = "/html/body/div[1]/div[3]/div["+str1+"]/span/a[3]"
        # driver.find_element_by_xpath(str2).click()
        tex = driver.find_elements_by_class_name('headline')[i].text
        # tex = tex.translate(str.maketrans("\n", ","))
        keywords.append(tex)
        # driver.back()
    driver.find_element_by_link_text('Next').click()


file = open('case_dataset.csv', 'a+', newline='')
with file:
    header = ['Sr_no', 'Title', 'links', 'description']
    writer = csv.DictWriter(file, fieldnames=header)
    for i in range(len(li)):
        writer.writerow({'Sr_no': i+501,
                         'Title': li[i],
                         'links': links[i],
                         'description': keywords[i]})

driver.quit()