# README #

Welcome to WalletBrute. Here are a few hints for the install and other resources.

### Install Instructions ###

1. Unzip the package onto your webserver. The zip outputs a folder names "walletbrute/".
2. Adjust permissions temporarily while doing the install:

```
#!bash
$ sudo chmod -R 777 /my/web/location/walletbrute
```

3. Go to the new folder in your web browser and complete the install.
4. Once the install is complete and the application is working, reset the permissions:

```
#!bash
$ sudo chmod -R 755 /my/web/location/walletbrute
```

### Requirements ###
* Python 2 (3's MySQL is broken)
* Python MySQL Connector
* MySQL Server 
* PHP 5+
* Web Server w/ the Above Configured

### Includes ###
* Bootstrap
* jQuery
* jQuery dataTables
* Flot
* Blockchain.info API
* Other various API's

### WARNING ###
We include all of the data you enter into your database along with our main database. We call this "contributing to our database". You can disable this in the settings, after installing the application. 

We do this for testing purposes. None of the data is kept, and we use a secure connection via SSL layers when transporting the data. It is simply meant to help develop this application further by working out the data bugs and vulnerabilities.
