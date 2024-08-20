const path = require('path');
const projectRoot = __dirname;

const certPath = path.join(projectRoot, 'intermediate.pem');

const config = {
    host    : 'localhost',
    user    : 'root',
    password: '',
    database: 'check_dollar',
    certPath: certPath
};
  


 module.exports = config;