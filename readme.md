# Stock Knowledge LMS 
is a PHP based web app that manages educational content that are stored in a MySQL database. All digestible content will be served by the PHP app that then delivers it via RESTFul API to Frontend Clients. Everything is coded in native/vanilla and procedural PHP7.x with minimal OOP and REST for speed and future proofing.

## Stock Knowledge Mobile Web App 
is built using PWA and WebXR standards in native/vanilla JavaScript. It communicates to the Stock Knowledge LMS via fetching JSON data using the REST API endpoints as coded in the LMS.

Additional shared information across the whole ecosystem are;
- Leaderboard of points gained in playing/exploring the mobile web app
- Login data
- Additional assets.

# Installation
## LMS Seed Files and Data

### clone github repo
git clone -b master https://github.com/Stock-Knowledge-Engineering/aws.git 

### create and seed the database
cat /admin/stockknowledge.sql | mysql -u root -p$(cat /bitnami_application_password)

### modify the configuration file
sed -i.bak "s/\"\"/\"$(cat /bitnami_application_password)\"/;" /admin/_conf.dba.inc.php

### modify the home_url
nano /admin/header.php

