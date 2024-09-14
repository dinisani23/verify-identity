# Document Forgery Detection System

## Overview
This web application is designed to automatically detect forgery in Malaysian identity cards and driving licenses. By leveraging web scraping and image processing techniques, the system verifies the authenticity of documents efficiently. It combines data retrieval from websites with CAPTCHA solving to ensure reliable verification.

## Features
- Automatic Verification: Automatically fetches and verifies identity card and driving license details.
- CAPTCHA Solving: Uses the TwoCaptcha API to handle CAPTCHA challenges.
- Database Integration: Stores and updates verification results in a MySQL database.
- Web Scraping: Extracts data using Selenium and BeautifulSoup.

## Prerequisites
- Python 3.x
- MySQL Database
- Required Python libraries: pymysql, selenium, BeautifulSoup4, twocaptcha, mysql-connector-python
- ChromeDriver (compatible with your version of Google Chrome)
- Database setup
- Captcha API key configuration

## Project Structure
- verify_identity_card.py: Script to verify Malaysian identity cards.
- verify_driving_license.py: Script to verify Malaysian driving licenses.
- requirements.txt: List of Python dependencies.
- public/captchas/: Directory where CAPTCHA images are saved temporarily.
- database_setup.sql: SQL file for setting up the database schema.


## Database Schema
Ensure your MySQL database has the following tables:

- input_data (for identity cards)
- scraped_data (for storing identity card verification results)
- input_dl (for driving licenses)
- scraped_dl (for storing driving license verification results)

## Troubleshooting
- CAPTCHA Solving Issues: Ensure that the TwoCaptcha API key is correctly set and valid.
- Web Scraping Issues: Web page structures may change; update the scraping logic if the website layout changes.
- Database Connection Issues: Verify database credentials and ensure the MySQL server is running.
