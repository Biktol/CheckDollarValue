You have to change the following line's route:

"scripts": {
"start": "cross-env NODE_EXTRA_CA_CERTS=\"D:\\PROGRAMAS\\xamppp\\htdocs\\projects\\CheckDollarValue\\intermediate.pem\" node server.js"
},

To match your intermediate.pem file, otherwise it won't work.
